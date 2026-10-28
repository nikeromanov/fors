<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20261028110142 extends Version
{
    protected $author = 'admin';
    protected $description = 'Обновить правовые ссылки в подвале и убрать ссылку на документы Форсаж';
    protected $moduleVersion = '5.6.4';

    public function up()
    {
        [$elementId, $current] = $this->readFooter();
        $updated = $current;
        $updated['TEXT'] = preg_replace(
            '~<a\b[^>]*>\s*Правовая\s+информация\s+Форсаж\s*</a>[ \t]*(?:<br\s*/?>)?[ \t]*(?:\r?\n)?~iu',
            '',
            $updated['TEXT'],
            -1,
            $removed
        );
        if ($updated['TEXT'] === null || $removed > 1
            || strpos($updated['TEXT'], 'https://disk.yandex.ru/d/HprqwhiUaH2L5g') !== false
        ) {
            throw new MigrationException('Не удалось однозначно определить ссылку на документы Форсаж');
        }
        $updated['TEXT'] = $this->replaceHref($updated['TEXT'],
            'https://disk.yandex.ru/d/slsx6BHbimFtrg', 'https://signal36.ru/');
        $updated['TEXT'] = $this->replaceHref($updated['TEXT'],
            'https://disk.yandex.ru/d/rWcN7kl0A451MQ', 'https://avtoshkolavrn.ru/');
        if ($current === $updated) {
            $this->outInfo('Правовые ссылки уже обновлены');
            return;
        }

        $storage = $this->getStorageManager();
        $backup = $storage->getSavedData('footer', null);
        if ($backup === null) {
            $storage->saveData('footer', ['elementId' => $elementId, 'before' => $current, 'after' => $updated]);
        } elseif ($backup['elementId'] !== $elementId || $backup['before'] !== $current) {
            throw new MigrationException('Содержимое подвала изменено после сохранения копии, обновление остановлено');
        }
        $this->saveFooter($elementId, $updated);
        $this->outSuccess('Ссылка Форсаж убрана, Сигнал и ИП Корчагин ведут на указанные сайты');
    }

    public function down()
    {
        [$elementId, $current] = $this->readFooter();
        $backup = $this->getStorageManager()->getSavedData('footer', null);
        if ($backup === null || $current === $backup['before']) {
            $this->outInfo('Откат правовых ссылок не требуется');
            return;
        }
        if ($backup['elementId'] !== $elementId || $current !== $backup['after']) {
            throw new MigrationException('Содержимое подвала изменено, автоматический откат остановлен');
        }
        $this->saveFooter($elementId, $backup['before']);
        $this->outSuccess('Исходный HTML подвала восстановлен');
    }

    private function replaceHref(string $html, string $from, string $to): string
    {
        $old = 'href="' . $from . '"';
        $new = 'href="' . $to . '"';
        if (substr_count($html, $old) === 0 && substr_count($html, $new) === 1) {
            return $html;
        }
        if (substr_count($html, $old) !== 1 || strpos($html, $new) !== false) {
            throw new MigrationException('Не найдена единственная ожидаемая ссылка: ' . $from);
        }
        return str_replace($old, $new, $html);
    }

    private function readFooter(): array
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }
        // В существующем проекте общие настройки не имеют символьного кода.
        if (\CIBlock::GetArrayByID(1, 'IBLOCK_TYPE_ID') !== 'settings'
            || \CIBlock::GetArrayByID(1, 'NAME') !== 'Общие настройки'
        ) {
            throw new MigrationException('Не найден ожидаемый инфоблок общих настроек');
        }
        $elements = \CIBlockElement::GetList([], ['IBLOCK_ID' => 1, 'ACTIVE' => 'Y'],
            false, ['nTopCount' => 2], ['ID']);
        $settings = $elements->Fetch();
        if (!$settings || $elements->Fetch()) {
            throw new MigrationException('Не найден единственный элемент общих настроек');
        }
        $elementId = (int)$settings['ID'];
        $property = \CIBlockElement::GetProperty(1, $elementId, [], ['CODE' => 'FOOTER'])->Fetch();
        $value = $property['~VALUE'] ?? $property['VALUE'] ?? null;
        if (!is_array($value) || empty($value['TEXT'])) {
            throw new MigrationException('Свойство FOOTER общих настроек не найдено');
        }
        return [$elementId, $value];
    }

    private function saveFooter(int $elementId, array $value): void
    {
        \CIBlockElement::SetPropertyValuesEx($elementId, 1, ['FOOTER' => ['VALUE' => $value]]);
        $property = \CIBlockElement::GetProperty(1, $elementId, [], ['CODE' => 'FOOTER'])->Fetch();
        if (($property['~VALUE'] ?? $property['VALUE'] ?? null) !== $value) {
            throw new MigrationException('Не удалось сохранить HTML подвала');
        }
        \CIBlock::clearIblockTagCache(1);
    }
}
