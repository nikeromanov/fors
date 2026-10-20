<?php

declare(strict_types=1);

use Bitrix\Main\FileTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);

class IswinEducationDocumentsComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['IBLOCK_TYPE'] = trim((string)($arParams['IBLOCK_TYPE'] ?? 'content'));
        $arParams['IBLOCK_CODE'] = trim((string)($arParams['IBLOCK_CODE'] ?? 'education_documents'));
        $arParams['CACHE_TIME'] = max(0, (int)($arParams['CACHE_TIME'] ?? 3600));
        return $arParams;
    }

    public function executeComponent(): void
    {
        global $USER, $CACHE_MANAGER;

        if (!preg_match('/^[a-z0-9_]+$/D', $this->arParams['IBLOCK_TYPE'])
            || !preg_match('/^[a-z0-9_]+$/D', $this->arParams['IBLOCK_CODE'])
            || !Loader::includeModule('iblock')
        ) {
            ShowError(Loc::getMessage('FORS_EDUCATION_UNAVAILABLE'));
            return;
        }

        // Штатный API учитывает права инфоблока и привязку к текущему сайту.
        $result = CIBlock::GetList([], [
            'TYPE' => $this->arParams['IBLOCK_TYPE'],
            'CODE' => $this->arParams['IBLOCK_CODE'],
            'SITE_ID' => SITE_ID,
            'ACTIVE' => 'Y',
            'CHECK_PERMISSIONS' => 'Y',
            'MIN_PERMISSION' => 'R',
        ]);
        $iblock = $result->Fetch();
        if (!$iblock || $result->Fetch()) {
            ShowError(Loc::getMessage('FORS_EDUCATION_UNAVAILABLE'));
            return;
        }
        $iblockId = (int)$iblock['ID'];
        $cacheContext = [$iblockId, (int)$USER->GetID(), $USER->GetGroups()];
        if (!$this->StartResultCache(false, $cacheContext)) {
            return;
        }

        try {
            if (defined('BX_COMP_MANAGED_CACHE')) {
                $CACHE_MANAGER->RegisterTag('iblock_id_' . $iblockId);
            }
            $this->arResult = ['SECTIONS' => $this->loadSections($iblockId)];
            $this->IncludeComponentTemplate();
        } catch (Throwable $exception) {
            $this->AbortResultCache();
            throw $exception;
        }
    }

    private function loadSections(int $iblockId): array
    {
        $sections = [];
        $children = [];
        $result = CIBlockSection::GetList(['SORT' => 'ASC', 'ID' => 'ASC'], [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
            'GLOBAL_ACTIVE' => 'Y',
            'CHECK_PERMISSIONS' => 'Y',
            'MIN_PERMISSION' => 'R',
        ], false, ['ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID']);
        while ($section = $result->Fetch()) {
            $id = (int)$section['ID'];
            $sections[$id] = $section;
            $children[(int)$section['IBLOCK_SECTION_ID']][] = $id;
        }
        if (!$sections) {
            return [];
        }

        $elements = [];
        $fileIds = [];
        $result = CIBlockElement::GetList(['SORT' => 'ASC', 'ID' => 'ASC'], [
            'IBLOCK_ID' => $iblockId,
            'IBLOCK_LID' => SITE_ID,
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',
            'CHECK_PERMISSIONS' => 'Y',
            'MIN_PERMISSION' => 'R',
        ], false, false, ['ID', 'NAME', 'IBLOCK_SECTION_ID', 'PROPERTY_PDF_FILE']);
        while ($element = $result->Fetch()) {
            $fileId = (int)$element['PROPERTY_PDF_FILE_VALUE'];
            if ($fileId > 0 && isset($sections[(int)$element['IBLOCK_SECTION_ID']])) {
                $elements[] = $element;
                $fileIds[$fileId] = $fileId;
            }
        }

        // Метаданные всех файлов одним запросом, без запроса на каждый документ.
        $files = [];
        if ($fileIds) {
            $result = FileTable::getList(['filter' => ['@ID' => array_values($fileIds)]]);
            while ($file = $result->fetch()) {
                if (strtolower(pathinfo($file['ORIGINAL_NAME'], PATHINFO_EXTENSION)) !== 'pdf') {
                    continue;
                }
                $files[(int)$file['ID']] = [
                    'URL' => CFile::GetFileSRC($file),
                    'SIZE' => str_replace('.', ',', CFile::FormatSize($file['FILE_SIZE'], 1)),
                ];
            }
        }
        $documents = [];
        foreach ($elements as $element) {
            $file = $files[(int)$element['PROPERTY_PDF_FILE_VALUE']] ?? null;
            if ($file) {
                $documents[(int)$element['IBLOCK_SECTION_ID']][] = [
                    'ID' => (int)$element['ID'],
                    'NAME' => $element['NAME'],
                    'URL' => $file['URL'],
                    'SIZE' => $file['SIZE'],
                ];
            }
        }
        return $this->buildTree(0, $sections, $children, $documents);
    }

    private function buildTree(int $parentId, array $sections, array $children, array $documents): array
    {
        $tree = [];
        foreach ($children[$parentId] ?? [] as $id) {
            $nested = $this->buildTree($id, $sections, $children, $documents);
            $items = $documents[$id] ?? [];
            $count = count($items) + array_sum(array_column($nested, 'COUNT'));
            if ($count === 0) {
                continue;
            }
            $tree[] = [
                'ID' => $id,
                'NAME' => $sections[$id]['NAME'],
                'CODE' => $sections[$id]['CODE'],
                'ANCHOR' => 'education-section-' . $id,
                'DOCUMENTS' => $items,
                'CHILDREN' => $nested,
                'COUNT' => $count,
            ];
        }
        return $tree;
    }
}
