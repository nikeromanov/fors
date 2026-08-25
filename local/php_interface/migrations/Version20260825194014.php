<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260825194014 extends Version
{
    protected $author = "admin";

    protected $description = "Заменить секции без заголовков в политике на нейтральные контейнеры (задача 603961)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updatePolicyMarkup(true);
    }

    public function down()
    {
        $this->updatePolicyMarkup(false);
    }

    private function updatePolicyMarkup(bool $useNeutralContainers): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $result = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => 21, 'ACTIVE' => 'Y'],
            false,
            ['nTopCount' => 2],
            ['ID', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE']
        );
        $policy = $result->Fetch();
        if (!$policy || $result->Fetch()) {
            throw new MigrationException('Не найден единственный активный элемент политики конфиденциальности');
        }

        $content = (string)$policy['DETAIL_TEXT'];
        $sectionPattern = '~<section>(\s*<p>.*?)</section>~s';
        $containerPattern = '~<div class="policy-section">(\s*<p>.*?)</div>~s';
        $sourcePattern = $useNeutralContainers ? $sectionPattern : $containerPattern;
        $targetMarkup = $useNeutralContainers
            ? '<div class="policy-section">$1</div>'
            : '<section>$1</section>';

        $sourceCount = preg_match_all($sourcePattern, $content);
        $targetCount = preg_match_all($useNeutralContainers ? $containerPattern : $sectionPattern, $content);
        if ($sourceCount === 0 && $targetCount === 5) {
            $this->outInfo('Разметка политики уже находится в требуемом состоянии');
            return;
        }
        if ($sourceCount !== 5 || $targetCount !== 0) {
            throw new MigrationException('Структура секций политики отличается от ожидаемой');
        }

        $updated = preg_replace($sourcePattern, $targetMarkup, $content, -1, $replaceCount);
        if ($updated === null || $replaceCount !== 5) {
            throw new MigrationException('Не удалось обновить секции политики конфиденциальности');
        }

        $element = new \CIBlockElement();
        if (!$element->Update((int)$policy['ID'], [
            'DETAIL_TEXT' => $updated,
            'DETAIL_TEXT_TYPE' => $policy['DETAIL_TEXT_TYPE'] ?: 'html',
        ])) {
            throw new MigrationException($element->LAST_ERROR ?: 'Не удалось сохранить политику конфиденциальности');
        }

        \CIBlock::clearIblockTagCache(21);
        $this->outSuccess('Секции политики конфиденциальности обновлены');
    }
}
