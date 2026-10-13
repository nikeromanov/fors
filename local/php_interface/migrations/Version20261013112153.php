<?php

namespace Sprint\Migration;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Fors\SitemapPolicy;
use Sprint\Migration\Exceptions\MigrationException;

class Version20261013112153 extends Version
{
    protected $author = 'admin';
    protected $description = 'Исключить макеты и технические страницы из штатной Sitemap и поискового индекса';
    protected $moduleVersion = '5.6.4';

    public function up()
    {
        $this->checkEnvironment();
        $storage = $this->getStorageManager();
        $backup = $storage->getSavedData('backup', null);
        if ($backup === null) {
            $options = Option::getForModule('main');
            $searchOptions = Option::getForModule('search');
            $backup = [
                'enabled' => $options[SitemapPolicy::OPTION] ?? null,
                'exclude_mask' => $searchOptions['exclude_mask'] ?? null,
                'documents' => [],
            ];
            $map = new \CSiteMap();
            $map->GetURLs('s1', 0);
            while ($row = $map->Fetch()) {
                if (!SitemapPolicy::isExcluded((string)$row['URL'])) {
                    continue;
                }
                $document = \CSearch::GetIndex($row['MODULE_ID'], $row['ITEM_ID']);
                if (!$document || count($document['SITE_ID']) !== 1 || !isset($document['SITE_ID']['s1'])) {
                    throw new MigrationException('Не удалось безопасно сохранить поисковую запись для отката');
                }
                $document['DATE_CHANGE'] = $row['FULL_DATE_CHANGE'];
                $backup['documents'][] = $document;
            }
            // Save everything before changing settings or removing derived index data.
            $storage->saveData('backup', $backup);
        }

        $masks = array_filter(array_map('trim', explode(';', Option::get('search', 'exclude_mask'))));
        foreach (SitemapPolicy::EXCLUDED_DIRECTORIES as $directory) {
            $masks[] = $directory . '*';
        }
        $masks = array_merge($masks, SitemapPolicy::EXCLUDED_FILES);
        Option::set('search', 'exclude_mask', implode(';', array_unique($masks)));
        Option::set('main', SitemapPolicy::OPTION, 'Y');

        foreach ($backup['documents'] as $document) {
            \CSearch::DeleteIndex($document['MODULE_ID'], $document['ITEM_ID'], false, false, 's1');
        }
        $this->outSuccess('Исключения сохранены. Удалено технических поисковых записей: ' . count($backup['documents']));
        $this->outInfo('Сгенерируйте Sitemap: php local/tools/sitemap.php');
    }

    public function down()
    {
        $this->checkEnvironment();
        $storage = $this->getStorageManager();
        $backup = $storage->getSavedData('backup', null);
        if ($backup === null) {
            throw new MigrationException('Нет сохраненных данных для отката');
        }

        $this->restoreOption('main', SitemapPolicy::OPTION, $backup['enabled']);
        $this->restoreOption('search', 'exclude_mask', $backup['exclude_mask']);
        foreach ($backup['documents'] as $document) {
            $module = $document['MODULE_ID'];
            $item = $document['ITEM_ID'];
            unset($document['ID'], $document['MODULE_ID'], $document['ITEM_ID']);
            if (!\CSearch::GetIndex($module, $item) && !\CSearch::Index($module, $item, $document, true)) {
                throw new MigrationException('Не удалось восстановить поисковую запись');
            }
        }
        $storage->deleteSavedData('backup');
        $this->outSuccess('Настройки и поисковые записи восстановлены. Повторно сгенерируйте Sitemap.');
    }

    private function restoreOption(string $module, string $name, ?string $value): void
    {
        if ($value === null) {
            Option::delete($module, ['name' => $name]);
        } else {
            Option::set($module, $name, $value);
        }
    }

    private function checkEnvironment(): void
    {
        if (!Loader::includeModule('search') || !class_exists(SitemapPolicy::class)) {
            throw new MigrationException('Не подключен модуль search или SitemapPolicy');
        }
        $site = \CSite::GetByID('s1')->Fetch();
        if (!$site || $site['DIR'] !== '/' || $site['SERVER_NAME'] !== 'fors36.ru') {
            throw new MigrationException('Не найден ожидаемый сайт fors36.ru в корне s1');
        }
    }
}
