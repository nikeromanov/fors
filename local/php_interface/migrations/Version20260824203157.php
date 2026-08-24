<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260824203157 extends Version
{
    protected $author = "admin";

    protected $description = "Категория D: исправить название раздела скидок (задача 600296)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->replaceText('«Акции»', '«Скидки»');
    }

    public function down()
    {
        $this->replaceText('«Скидки»', '«Акции»');
    }

    private function replaceText(string $search, string $replacement): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $sectionId = $this->getSectionId();
        $sectionData = \CIBlockSection::GetList(
            [],
            ['ID' => $sectionId, 'IBLOCK_ID' => $this->getIblockId()],
            false,
            ['ID', 'UF_TEXT']
        )->Fetch();
        $text = (string)($sectionData['UF_TEXT'] ?? '');

        if (substr_count($text, $search) !== 1) {
            throw new MigrationException('Не найден единственный ожидаемый фрагмент текста категории D');
        }

        $updatedText = str_replace($search, $replacement, $text, $replaceCount);
        if ($replaceCount !== 1) {
            throw new MigrationException('Не удалось обновить название раздела скидок');
        }

        $section = new \CIBlockSection();
        if (!$section->Update($sectionId, ['UF_TEXT' => $updatedText])) {
            throw new MigrationException($section->LAST_ERROR);
        }

        \CIBlock::clearIblockTagCache($this->getIblockId());
        $this->outSuccess('Название раздела скидок в тексте категории D обновлено');
    }

    private function getSectionId(): int
    {
        $section = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            '=CODE' => 'kategoriya-d-d1',
        ], false, ['ID'])->Fetch();

        if (empty($section['ID'])) {
            throw new MigrationException('Раздел kategoriya-d-d1 не найден');
        }

        return (int)$section['ID'];
    }

    private function getIblockId(): int
    {
        return 5;
    }
}
