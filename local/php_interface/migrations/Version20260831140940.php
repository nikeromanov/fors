<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260831140940 extends Version
{
    protected $author = "admin";

    protected $description = "Поля фиксации согласий заявок";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $properties = [
            'PERSONAL_DATA_CONSENT' => ['NAME' => 'Согласие на обработку персональных данных', 'SORT' => 130],
            'ADVERTISING_CONSENT' => ['NAME' => 'Согласие на рекламные сообщения', 'SORT' => 140],
            'CONSENT_DATE' => ['NAME' => 'Дата и время предоставления согласия', 'SORT' => 150],
            'CONSENT_PAGE' => ['NAME' => 'Страница предоставления согласия', 'SORT' => 160],
            'CONSENT_VERSION' => ['NAME' => 'Версия текста согласия', 'SORT' => 170],
        ];

        foreach ($properties as $code => $fields) {
            $existing = \CIBlockProperty::GetList([], [
                'IBLOCK_ID' => 12,
                '=CODE' => $code,
            ])->Fetch();
            if ($existing) {
                continue;
            }

            $property = new \CIBlockProperty();
            $propertyId = $property->Add([
                'IBLOCK_ID' => 12,
                'NAME' => $fields['NAME'],
                'CODE' => $code,
                'PROPERTY_TYPE' => 'S',
                'MULTIPLE' => 'N',
                'SORT' => $fields['SORT'],
            ]);
            if (!$propertyId) {
                throw new MigrationException($property->LAST_ERROR ?: 'Не удалось создать поле ' . $code);
            }
        }

        \CIBlock::clearIblockTagCache(12);
        $this->outSuccess('Поля фиксации согласий в заявках подготовлены');
    }

    public function down()
    {
        $this->outInfo('Поля оставлены, чтобы не удалить уже собранные данные согласий');
    }
}
