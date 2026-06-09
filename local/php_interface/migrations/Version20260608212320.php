<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260608212320 extends Version
{
    protected $author = "admin";

    protected $description = "Add WhatsApp setting";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->ensureIblockModule();
        $this->ensureProperty();
        $this->setValue('#');
    }

    public function down()
    {
        $this->ensureIblockModule();
        $this->setValue(false);
    }

    private function ensureProperty(): void
    {
        $exists = \CIBlockProperty::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            'CODE' => 'WHATSAPP',
        ])->Fetch();

        if ($exists) {
            return;
        }

        $property = new \CIBlockProperty();
        $propertyId = $property->Add([
            'IBLOCK_ID' => $this->getIblockId(),
            'NAME' => 'WhatsApp',
            'CODE' => 'WHATSAPP',
            'PROPERTY_TYPE' => 'S',
            'MULTIPLE' => 'N',
            'SORT' => 540,
        ]);

        if (!$propertyId) {
            throw new MigrationException($property->LAST_ERROR);
        }
    }

    private function setValue($value): void
    {
        \CIBlockElement::SetPropertyValuesEx($this->getElementId(), $this->getIblockId(), [
            'WHATSAPP' => $value,
        ]);
    }

    private function getElementId(): int
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            'ACTIVE' => 'Y',
        ], false, ['nTopCount' => 1], ['ID'])->Fetch();

        if (empty($element['ID'])) {
            throw new MigrationException('Элемент общих настроек не найден');
        }

        return (int)$element['ID'];
    }

    private function getIblockId(): int
    {
        return 1;
    }

    private function ensureIblockModule(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }
    }
}
