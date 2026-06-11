<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class CategoryBDiscountsWord20260611095657 extends Version
{
    protected $author = "admin";

    protected $description = "Replace discounts word on category B page";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->replaceText('налогового вычета, скидок', 'налогового вычета, акций');
    }

    public function down()
    {
        $this->replaceText('налогового вычета, акций', 'налогового вычета, скидок');
    }

    private function replaceText(string $from, string $to): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $sectionId = $this->getSectionId();
        $sectionData = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => 5,
            '=CODE' => 'kategoriya-v-v1',
        ], false, ['ID', 'UF_TEXT'])->Fetch();

        $text = (string)($sectionData['UF_TEXT'] ?? '');
        if ($text === '') {
            throw new MigrationException('Текст раздела kategoriya-v-v1 не найден');
        }

        $updatedText = str_replace($from, $to, $text);
        if ($updatedText === $text) {
            $this->out('Фраза для замены не найдена, текст не изменен');
            return;
        }

        $section = new \CIBlockSection();
        if (!$section->Update($sectionId, [
            'UF_TEXT' => $updatedText,
        ])) {
            throw new MigrationException($section->LAST_ERROR);
        }

        $this->outSuccess('Слово в тексте категории B обновлено');
    }

    private function getSectionId(): int
    {
        $section = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => 5,
            '=CODE' => 'kategoriya-v-v1',
        ], false, ['ID'])->Fetch();

        if (empty($section['ID'])) {
            throw new MigrationException('Раздел kategoriya-v-v1 не найден');
        }

        return (int)$section['ID'];
    }
}
