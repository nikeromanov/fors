<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260824221319 extends Version
{
    protected $author = "admin";

    protected $description = "Исправить ARIA-ссылки на странице вождения (задача 603961)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->replaceAriaReferences(true);
    }

    public function down()
    {
        $this->replaceAriaReferences(false);
    }

    private function replaceAriaReferences(bool $removeInvalidReference): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $element = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => 26, 'ACTIVE' => 'Y'],
            false,
            ['nTopCount' => 2],
            ['ID', 'IBLOCK_ID', 'DETAIL_TEXT']
        );

        $page = $element->Fetch();
        if (!$page || $element->Fetch()) {
            throw new MigrationException('Не найден единственный активный элемент страницы «Вождение»');
        }

        $text = (string)$page['DETAIL_TEXT'];
        $search = $removeInvalidReference ? ' driving-section"' : '"';
        $references = [
            'driving-intro-title',
            'driving-features-title',
            'driving-useful-title',
            'driving-benefits-title',
            'driving-why-title',
        ];

        foreach ($references as $reference) {
            $from = 'aria-labelledby="' . $reference . $search;
            $to = 'aria-labelledby="' . $reference . ($removeInvalidReference ? '"' : ' driving-section"');

            if (substr_count($text, $from) !== 1) {
                throw new MigrationException('Не найдена единственная ARIA-ссылка: ' . $reference);
            }

            $text = str_replace($from, $to, $text, $replaceCount);
            if ($replaceCount !== 1) {
                throw new MigrationException('Не удалось обновить ARIA-ссылку: ' . $reference);
            }
        }

        $iblockElement = new \CIBlockElement();
        if (!$iblockElement->Update((int)$page['ID'], [
            'DETAIL_TEXT' => $text,
            'DETAIL_TEXT_TYPE' => 'html',
        ])) {
            throw new MigrationException($iblockElement->LAST_ERROR);
        }

        \CIBlock::clearIblockTagCache((int)$page['IBLOCK_ID']);
        $this->outSuccess('ARIA-ссылки страницы «Вождение» обновлены');
    }
}
