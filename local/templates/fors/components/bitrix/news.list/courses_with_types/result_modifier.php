<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult["SECTIONS"] = [];
$sectionIds = [];
$arResult["ITEMS_SECT"] = [];
if(!empty($arResult["ITEMS"])){
	foreach($arResult["ITEMS"] as $item){
		if(!empty($item["IBLOCK_SECTION_ID"])){
			$sectionIds[]=$item["IBLOCK_SECTION_ID"];
			$arResult["ITEMS_SECT"][$item["IBLOCK_SECTION_ID"]][]=$item;
		}
	}

	if(!empty($sectionIds)){
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID'=>$sectionIds); 
		$rsSect = CIBlockSection::GetList(['left_margin' => 'asc'],$arFilter,false,["ID","NAME"]);
		while ($arSect = $rsSect->GetNext())
		{
			$arResult["SECTIONS"][$arSect["ID"]] = $arSect["NAME"];
		}
	}

}
?>