<?php
define("SETTINGS_IBLOCK_ID","1");
define("CATALOG_IBLOCK_ID","2");

include_once __DIR__ . '/vendor/autoload.php';

function getSettings($iblockId = 0,$id = 0){
	CModule::IncludeModule("iblock");
	if($iblockId==0){
		$iblockId=SETTINGS_IBLOCK_ID;
	}
	$arSelect = Array("ID", "IBLOCK_ID","PROPERTY_*","NAME","PREVIEW_TEXT","DETAIL_TEXT","DETAIL_PICTURE","PREVIEW_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>$iblockId,  "ACTIVE"=>"Y");
	if($id>0){
		$arFilter["ID"] = $id;
	}
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields();  
	
		$arProps = $ob->GetProperties();
		$arFields["PROPERTIES"]=$arProps;
	}
	return $arFields;
}
function num_word_standart($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}
function splitByParentheses(string $s): array
{
    $s = trim($s);

    if (preg_match('/^(.*?)(?:\s*\((.*?)\)\s*)$/u', $s, $m)) {
        return [
            'text'   => trim($m[1]),                
            'inside' => trim($m[2]) !== '' ? trim($m[2]) : '', 
        ];
    }

    return ['text' => $s, 'inside' => null];
}

AddEventHandler('main', 'OnEpilog', 'forsSendLastModifiedHeader');

function forsSendLastModifiedHeader()
{
    global $APPLICATION;

    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
        return;
    }

    if (!class_exists('CHTTP') || !is_object($APPLICATION) || !method_exists($APPLICATION, 'GetPageProperty')) {
        return;
    }

    if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
        return;
    }

    $request = \Bitrix\Main\Context::getCurrent()->getRequest();

    if (!$request || !in_array($request->getRequestMethod(), ['GET', 'HEAD'], true)) {
        return;
    }

    $lastModified = 0;
    $pageProperty = trim((string)$APPLICATION->GetPageProperty('last_modified'));

    if ($pageProperty !== '') {
        $timestamp = MakeTimeStamp($pageProperty);

        if ($timestamp) {
            $lastModified = $timestamp;
        }
    }

    $documentRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
    $paths = [];

    $curPage = $APPLICATION->GetCurPage(true);

    if ($curPage) {
        $paths[] = $documentRoot . $curPage;
    }

    if (defined('SITE_TEMPLATE_PATH')) {
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/header.php';
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/footer.php';
    }

    if (defined('TEMPLATE_PAGE') && TEMPLATE_PAGE != '') {
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/template_blocks/' . TEMPLATE_PAGE . '.php';
    }

    foreach ($paths as $path) {
        if (is_file($path)) {
            $mtime = filemtime($path);

            if ($mtime && $mtime > $lastModified) {
                $lastModified = $mtime;
            }
        }
    }

    if ($lastModified > 0 && !headers_sent()) {
        if (is_callable(['CHTTP', 'SetLastModified'])) {
            CHTTP::SetLastModified($lastModified);
        } else {
            $headerValue = gmdate('D, d M Y H:i:s', $lastModified) . ' GMT';

            header('Last-Modified: ' . $headerValue);
        }
    }
}