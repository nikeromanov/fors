<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260825194611 extends Version
{
    protected $author = "admin";

    protected $description = "Заменить article без собственного заголовка в политике (задача 603961)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updatePolicyWrapper(true);
    }

    public function down()
    {
        $this->updatePolicyWrapper(false);
    }

    private function updatePolicyWrapper(bool $useNeutralContainer): void
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
        $articleOpen = '<article>';
        $articleClose = '</article>';
        $containerOpen = '<div class="policy-document-body">';
        $containerClose = '</div><!-- /policy-document-body -->';
        $fromOpen = $useNeutralContainer ? $articleOpen : $containerOpen;
        $fromClose = $useNeutralContainer ? $articleClose : $containerClose;
        $toOpen = $useNeutralContainer ? $containerOpen : $articleOpen;
        $toClose = $useNeutralContainer ? $containerClose : $articleClose;

        if (substr_count($content, $fromOpen) === 0 && substr_count($content, $toOpen) === 1) {
            $this->outInfo('Обёртка политики уже находится в требуемом состоянии');
            return;
        }
        if (substr_count($content, $fromOpen) !== 1 || substr_count($content, $fromClose) !== 1) {
            throw new MigrationException('Структура article в политике отличается от ожидаемой');
        }

        $updated = str_replace([$fromOpen, $fromClose], [$toOpen, $toClose], $content, $replaceCount);
        if ($replaceCount !== 2) {
            throw new MigrationException('Не удалось обновить обёртку политики конфиденциальности');
        }

        $element = new \CIBlockElement();
        if (!$element->Update((int)$policy['ID'], [
            'DETAIL_TEXT' => $updated,
            'DETAIL_TEXT_TYPE' => $policy['DETAIL_TEXT_TYPE'] ?: 'html',
        ])) {
            throw new MigrationException($element->LAST_ERROR ?: 'Не удалось сохранить политику конфиденциальности');
        }

        \CIBlock::clearIblockTagCache(21);
        $this->outSuccess('Обёртка политики конфиденциальности обновлена');
    }
}
