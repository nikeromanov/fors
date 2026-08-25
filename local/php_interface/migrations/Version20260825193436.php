<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260825193436 extends Version
{
    protected $author = "admin";

    protected $description = "Удалить устаревший charset у JavaScript Envybox (задача 603961)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateFooterScript(true);
    }

    public function down()
    {
        $this->updateFooterScript(false);
    }

    private function updateFooterScript(bool $removeCharset): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $element = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => 1, 'ACTIVE' => 'Y'],
            false,
            ['nTopCount' => 2],
            ['ID']
        );
        $settings = $element->Fetch();
        if (!$settings || $element->Fetch()) {
            throw new MigrationException('Не найден единственный элемент общих настроек');
        }

        $property = \CIBlockElement::GetProperty(1, (int)$settings['ID'], [], ['CODE' => 'FOOTER'])->Fetch();
        $value = $property['~VALUE']['TEXT'] ?? $property['VALUE']['TEXT'] ?? '';
        $type = $property['~VALUE']['TYPE'] ?? $property['VALUE']['TYPE'] ?? 'HTML';
        if ($value === '') {
            throw new MigrationException('Свойство FOOTER общих настроек не найдено');
        }

        if (strpos($value, 'https://cdn.envybox.io/widget/cbk.js') === false) {
            $this->outInfo('Код Envybox в свойстве FOOTER отсутствует, изменение не требуется');
            return;
        }

        $withCharset = ' charset="UTF-8" async';
        $withoutCharset = ' async';
        $from = $removeCharset ? $withCharset : $withoutCharset;
        $to = $removeCharset ? $withoutCharset : $withCharset;

        if (substr_count($value, $from) !== 1) {
            $this->outInfo('Атрибут charset у Envybox уже находится в требуемом состоянии');
            return;
        }

        $updated = str_replace($from, $to, $value, $replaceCount);
        if ($replaceCount !== 1) {
            throw new MigrationException('Не удалось обновить атрибут charset у Envybox');
        }

        \CIBlockElement::SetPropertyValuesEx((int)$settings['ID'], 1, [
            'FOOTER' => [
                'VALUE' => [
                    'TYPE' => $type,
                    'TEXT' => $updated,
                ],
            ],
        ]);

        \CIBlock::clearIblockTagCache(1);
        $this->outSuccess('Атрибут charset у JavaScript Envybox обновлён');
    }
}
