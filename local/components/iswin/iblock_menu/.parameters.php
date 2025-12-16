<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock')) {
    return;
}

$arIBlocks = [];
$rsIBlocks = CIBlock::GetList(
    ['SORT' => 'ASC'],
    ['ACTIVE' => 'Y']
);
while ($arIBlock = $rsIBlocks->Fetch()) {
    $arIBlocks[$arIBlock['ID']] = '[' . $arIBlock['ID'] . '] ' . $arIBlock['NAME'];
}

$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_ID' => [
            'PARENT'  => 'BASE',
            'NAME'    => 'Инфоблок',
            'TYPE'    => 'LIST',
            'VALUES'  => $arIBlocks,
            'REFRESH' => 'N',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];