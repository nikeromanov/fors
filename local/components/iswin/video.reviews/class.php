<?php

use Bitrix\Main\FileTable;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class IswinVideoReviewsComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['IBLOCK_ID'] = (int)($arParams['IBLOCK_ID'] ?? 0);
        $arParams['CACHE_TIME'] = max(0, (int)($arParams['CACHE_TIME'] ?? 3600));
        return $arParams;
    }

    public function executeComponent(): void
    {
        global $USER, $CACHE_MANAGER;

        if ($this->arParams['IBLOCK_ID'] <= 0 || !Loader::includeModule('iblock')) return;
        if (!$this->StartResultCache(false, [$USER->GetGroups(), SITE_ID])) return;

        try {
            $iblockId = $this->arParams['IBLOCK_ID'];
            $iblock = CIBlock::GetList([], [
                'ID' => $iblockId, 'ACTIVE' => 'Y', 'SITE_ID' => SITE_ID,
                'CHECK_PERMISSIONS' => 'Y', 'MIN_PERMISSION' => 'R',
            ])->Fetch();
            if (!$iblock) {
                $this->AbortResultCache();
                return;
            }
            if (defined('BX_COMP_MANAGED_CACHE')) {
                $CACHE_MANAGER->RegisterTag('iblock_id_'.$iblockId);
            }

            // The legacy iblock API provides site and element permission checks.
            // No navigation limits: every published video belongs in the carousel.
            $result = CIBlockElement::GetList(
                ['ACTIVE_FROM' => 'DESC', 'SORT' => 'ASC', 'ID' => 'DESC'],
                [
                    'IBLOCK_ID' => $iblockId, 'IBLOCK_LID' => SITE_ID,
                    'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '!PROPERTY_VIDEO' => false,
                    'CHECK_PERMISSIONS' => 'Y', 'MIN_PERMISSION' => 'R',
                ],
                false, false,
                ['ID', 'NAME', 'DATE_ACTIVE_FROM', 'PREVIEW_PICTURE', 'PROPERTY_VIDEO']
            );
            $this->arResult['ITEMS'] = [];
            $pictureIds = [];
            while ($item = $result->GetNext()) {
                $url = trim((string)$item['PROPERTY_VIDEO_VALUE']);
                if (!in_array(strtolower((string)parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) continue;
                $item['PROPERTIES']['VIDEO']['VALUE'] = $item['~PROPERTY_VIDEO_VALUE'] ?? $url;
                $pictureId = (int)$item['PREVIEW_PICTURE'];
                if ($pictureId > 0) $pictureIds[$pictureId] = $pictureId;
                $this->arResult['ITEMS'][(int)$item['ID']] = $item;
            }
            $pictures = [];
            if ($pictureIds) {
                $files = FileTable::getList(['filter' => ['@ID' => array_values($pictureIds)]]);
                while ($file = $files->fetch()) $pictures[(int)$file['ID']] = ['SRC' => CFile::GetFileSRC($file)];
            }
            foreach ($this->arResult['ITEMS'] as &$item) {
                $item['PREVIEW_PICTURE'] = $pictures[(int)$item['PREVIEW_PICTURE']] ?? false;
            }
            unset($item);
            $this->IncludeComponentTemplate();
        } catch (Throwable $exception) {
            $this->AbortResultCache();
            throw $exception;
        }
    }
}
