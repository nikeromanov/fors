<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
Loc::loadMessages(__DIR__ . '/class.php');
$arComponentDescription = [
    'NAME' => Loc::getMessage('FORS_EDUCATION_COMPONENT_NAME'),
    'DESCRIPTION' => Loc::getMessage('FORS_EDUCATION_COMPONENT_DESCRIPTION'),
    'CACHE_PATH' => 'Y',
    'PATH' => ['ID' => 'my_components', 'NAME' => Loc::getMessage('FORS_EDUCATION_COMPONENT_GROUP')],
];
