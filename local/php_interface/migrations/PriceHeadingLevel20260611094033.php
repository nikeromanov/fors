<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class PriceHeadingLevel20260611094033 extends Version
{
    protected $author = "admin";

    protected $description = "Change price heading level to H3";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateText('<h3>Прайс</h3>');
    }

    public function down()
    {
        $this->updateText('<h2>Прайс</h2>');
    }

    private function updateText(string $heading): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $elementId = $this->getElementId();
        $property = \CIBlockElement::GetProperty(36, $elementId, [], ['CODE' => 'SEO_TEXT_PRICE'])->Fetch();
        $value = $property['~VALUE']['TEXT'] ?? $property['VALUE']['TEXT'] ?? $property['~VALUE'] ?? $property['VALUE'] ?? '';

        if ($value === '') {
            throw new MigrationException('SEO_TEXT_PRICE страницы цен не найден');
        }

        $value = preg_replace('/<h[23]>Прайс<\/h[23]>/u', $heading, (string)$value, 1);

        \CIBlockElement::SetPropertyValuesEx($elementId, 36, [
            'SEO_TEXT_PRICE' => [
                'VALUE' => [
                    'TYPE' => 'HTML',
                    'TEXT' => $value,
                ],
            ],
        ]);

        $this->outSuccess('Уровень заголовка "Прайс" обновлен');
    }

    private function getElementId(): int
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => 36,
            'ACTIVE' => 'Y',
        ], false, ['nTopCount' => 1], ['ID'])->Fetch();

        if (empty($element['ID'])) {
            throw new MigrationException('Элемент настроек страницы цен не найден');
        }

        return (int)$element['ID'];
    }
}
