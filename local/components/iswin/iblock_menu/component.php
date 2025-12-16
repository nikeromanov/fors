<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$iblockId = (int)$arParams['IBLOCK_ID'];
if ($iblockId <= 0) {
    return;
}

// можно добавить поддержку CACHE_TYPE, если надо
if (!isset($arParams['CACHE_TIME'])) {
    $arParams['CACHE_TIME'] = 3600;
}

if ($this->StartResultCache(false)) {

    $sections = [];

    // 1) Берем активные разделы с UF_LINK
    $rsSections = CIBlockSection::GetList(
        ['SORT' => 'ASC', 'NAME' => 'ASC'],
        [
            'IBLOCK_ID'     => $iblockId,
            'ACTIVE'        => 'Y',
            'GLOBAL_ACTIVE' => 'Y',
        ],
        false,
        ['ID', 'NAME', 'UF_LINK']
    );

    while ($arSection = $rsSections->GetNext()) {
        $sections[$arSection['ID']] = [
            'ID'     => (int)$arSection['ID'],
            'NAME'   => $arSection['NAME'],
            'LINK'   => $arSection['UF_LINK'] ?: '#',
            'CHILDS' => [], // сюда пойдут элементы
        ];
    }

    // 2) Берем элементы и раскладываем по разделам
    if (!empty($sections)) {
        $rsElements = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            [
                'IBLOCK_ID'          => $iblockId,
                'ACTIVE'             => 'Y',
                'SECTION_ID'         => array_keys($sections),
                'INCLUDE_SUBSECTIONS'=> 'N', // если не нужны элементы из подразделов
            ],
            false,
            false,
            ['ID', 'IBLOCK_SECTION_ID', 'NAME', 'PROPERTY_LINK']
        );

        while ($arElement = $rsElements->GetNext()) {
            $sectionId = (int)$arElement['IBLOCK_SECTION_ID'];
            if (!isset($sections[$sectionId])) {
                continue;
            }

            $sections[$sectionId]['CHILDS'][] = [
                'ID'   => (int)$arElement['ID'],
                'NAME' => $arElement['NAME'],
                'LINK' => $arElement['PROPERTY_LINK_VALUE'] ?: '#',
            ];
        }
    }

    // 3) Можно выбросить разделы без детей (если не нужны пустые)
    $result = [];
    foreach ($sections as $section) {
        // если нужны только разделы с дочерними элементами — раскомментируй:
        // if (empty($section['CHILDS'])) {
        //     continue;
        // }
        $result[] = $section;
    }

    $this->arResult = $result;
    $this->IncludeComponentTemplate();
}