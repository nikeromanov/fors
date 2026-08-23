<?php

namespace Sprint\Migration;

use Bitrix\Iblock\InheritedProperty\ElementTemplates;
use Bitrix\Iblock\InheritedProperty\ElementValues;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260823220109 extends Version
{
    protected $author = "admin";

    protected $description = "SEO-метатеги страниц calendar, policy и oplata-gosposhliny (задача 603928)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->setMetaTags([
            'ELEMENT_META_TITLE' => 'Оплата госпошлины перед экзаменом в автошколе «Форсаж» в Воронеже: порядок внесения средств и получения квитанции',
            'ELEMENT_META_DESCRIPTION' => 'Узнайте, как оплатить госпошлину перед экзаменом в автошколе «Форсаж» в Воронеже: порядок внесения средств и необходимые данные для платежа.',
        ]);
    }

    public function down()
    {
        $this->setMetaTags([
            'ELEMENT_META_TITLE' => '',
            'ELEMENT_META_DESCRIPTION' => '',
        ]);
    }

    private function setMetaTags(array $metaTags): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $iblock = \CIBlock::GetList([], [
            'TYPE' => 'content',
            '=NAME' => 'Страницы',
        ])->Fetch();

        if (!$iblock) {
            throw new MigrationException('Инфоблок «Страницы» не найден');
        }

        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => (int)$iblock['ID'],
            '=CODE' => 'oplata-gosposhliny',
        ], false, false, [
            'ID',
            'IBLOCK_ID',
            'CODE',
        ])->Fetch();

        if (!$element) {
            throw new MigrationException('Страница «oplata-gosposhliny» не найдена');
        }

        $templates = new ElementTemplates((int)$element['IBLOCK_ID'], (int)$element['ID']);
        $templates->set($metaTags);

        $values = new ElementValues((int)$element['IBLOCK_ID'], (int)$element['ID']);
        $values->clearValues();

        \CIBlock::clearIblockTagCache((int)$element['IBLOCK_ID']);

        $this->outSuccess('SEO обновлено для страницы «oplata-gosposhliny»');
    }
}
