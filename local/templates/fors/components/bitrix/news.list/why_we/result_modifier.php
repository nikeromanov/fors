<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult["SECTIONS"] = [];
$sectionIds = [];
if(!empty($arResult["ITEMS"])){
	foreach($arResult["ITEMS"] as $item){
		if(!empty($item["IBLOCK_SECTION_ID"])){
			$sectionIds[]=$item["IBLOCK_SECTION_ID"];
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