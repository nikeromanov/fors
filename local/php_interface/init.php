<?php
define("SETTINGS_IBLOCK_ID","1");
define("CATALOG_IBLOCK_ID","2");

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