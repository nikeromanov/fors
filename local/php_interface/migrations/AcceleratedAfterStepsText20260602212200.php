<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class AcceleratedAfterStepsText20260602212200 extends Version
{
    protected $author = "admin";

    protected $description = "Add text after accelerated page steps";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->ensureProperty();
        $this->setAfterStepsText($this->getText());
    }

    public function down()
    {
        $this->setAfterStepsText(false);
    }

    private function ensureProperty(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $exists = \CIBlockProperty::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            'CODE' => 'AFTER_STEPS_TEXT',
        ])->Fetch();

        if ($exists) {
            return;
        }

        $property = new \CIBlockProperty();
        $propertyId = $property->Add([
            'IBLOCK_ID' => $this->getIblockId(),
            'NAME' => 'Текст после этапов',
            'CODE' => 'AFTER_STEPS_TEXT',
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'HTML',
            'MULTIPLE' => 'N',
            'SORT' => 505,
        ]);

        if (!$propertyId) {
            throw new MigrationException($property->LAST_ERROR);
        }
    }

    private function setAfterStepsText($value): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        \CIBlockElement::SetPropertyValuesEx($this->getElementId(), $this->getIblockId(), [
            'AFTER_STEPS_TEXT' => $value === false ? false : [
                'VALUE' => [
                    'TYPE' => 'HTML',
                    'TEXT' => $value,
                ],
            ],
        ]);

        $this->outSuccess('Текст после этапов на странице "Ускоренные курсы вождения" обновлён');
    }

    private function getText(): string
    {
        return '<p>В нашей автошколе обучение вождению для получения прав будет проходить в быстром темпе и в комфортном для вас режиме.</p>';
    }

    private function getElementId(): int
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            'ACTIVE' => 'Y',
        ], false, ['nTopCount' => 1], ['ID'])->Fetch();

        if (empty($element['ID'])) {
            throw new MigrationException('Элемент настроек страницы не найден');
        }

        return (int)$element['ID'];
    }

    private function getIblockId(): int
    {
        return 31;
    }
}
