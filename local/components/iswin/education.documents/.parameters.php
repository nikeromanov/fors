<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
Loc::loadMessages(__DIR__ . '/class.php');
$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_TYPE' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('FORS_EDUCATION_TYPE'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'content',
        ],
        'IBLOCK_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('FORS_EDUCATION_CODE'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'education_documents',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
