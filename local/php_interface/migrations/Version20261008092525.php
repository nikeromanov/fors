<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20261008092525 extends Version
{
    protected $author = "admin";

    protected $description = "Заменить ссылку на документы Сигнал в футере на Яндекс Диск";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->replaceLink('/upload/OOO_Signal.zip', 'https://disk.yandex.ru/d/slsx6BHbimFtrg');
    }

    public function down()
    {
        $this->replaceLink('https://disk.yandex.ru/d/slsx6BHbimFtrg', '/upload/OOO_Signal.zip');
    }

    private function replaceLink(string $from, string $to): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $elements = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => 1, 'ACTIVE' => 'Y'],
            false,
            ['nTopCount' => 2],
            ['ID']
        );
        $settings = $elements->Fetch();
        if (!$settings || $elements->Fetch()) {
            throw new MigrationException('Не найден единственный элемент общих настроек');
        }

        $elementId = (int)$settings['ID'];
        $property = \CIBlockElement::GetProperty(1, $elementId, [], ['CODE' => 'FOOTER'])->Fetch();
        $value = $property['~VALUE'] ?? $property['VALUE'] ?? null;
        if (!is_array($value) || empty($value['TEXT'])) {
            throw new MigrationException('Свойство FOOTER общих настроек не найдено');
        }

        $search = 'href="' . $from . '"';
        $replacement = 'href="' . $to . '"';
        if (substr_count($value['TEXT'], $search) === 0 && substr_count($value['TEXT'], $replacement) === 1) {
            $this->outInfo('Ссылка на документы Сигнал уже обновлена');
            return;
        }
        if (substr_count($value['TEXT'], $search) !== 1 || strpos($value['TEXT'], $replacement) !== false) {
            throw new MigrationException('Не найдена единственная ожидаемая ссылка на документы Сигнал');
        }

        $value['TEXT'] = str_replace($search, $replacement, $value['TEXT']);
        \CIBlockElement::SetPropertyValuesEx($elementId, 1, ['FOOTER' => ['VALUE' => $value]]);

        $saved = \CIBlockElement::GetProperty(1, $elementId, [], ['CODE' => 'FOOTER'])->Fetch();
        $savedValue = $saved['~VALUE'] ?? $saved['VALUE'] ?? null;
        if ($savedValue !== $value) {
            throw new MigrationException('Не удалось сохранить ссылку на документы Сигнал');
        }

        \CIBlock::clearIblockTagCache(1);
        $this->outSuccess('Ссылка на документы Сигнал обновлена');
    }
}
