<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260825193323 extends Version
{
    protected $author = "admin";

    protected $description = "Удалить устаревший type у JavaScript (задача 603961)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateFooterScript(true);
    }

    public function down()
    {
        $this->updateFooterScript(false);
    }

    private function updateFooterScript(bool $removeType): void
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

        $withType = '<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js';
        $withoutType = '<script src="https://cdn.envybox.io/widget/cbk.js';
        $from = $removeType ? $withType : $withoutType;
        $to = $removeType ? $withoutType : $withType;

        if (substr_count($value, $from) === 0 && substr_count($value, $to) === 0) {
            $this->outInfo('Код Envybox в свойстве FOOTER отсутствует, изменение не требуется');
            return;
        }
        if (substr_count($value, $from) !== 1) {
            $this->outInfo('Атрибут type у Envybox уже находится в требуемом состоянии');
            return;
        }

        $updated = str_replace($from, $to, $value, $replaceCount);
        if ($replaceCount !== 1) {
            throw new MigrationException('Не удалось обновить атрибут type у Envybox');
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
        $this->outSuccess('Атрибут type у JavaScript Envybox обновлён');
    }
}
