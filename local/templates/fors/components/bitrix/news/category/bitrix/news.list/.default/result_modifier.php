<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult["SECTION"] = [];
$arResult["VARIANTS"] = [];
$arResult["WHATS"] = [];
if(!empty($arResult["ITEMS"])){
	$idResult = 0;
	foreach($arResult["ITEMS"] as $item){
		$idResult = $item["IBLOCK_SECTION_ID"];
	}
	$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID' => $idResult); 
	$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter,false,["UF_*"]);
	if ($arSect = $rsSect->GetNext())
	{
		$arResult["SECTION"] = $arSect;
		$arResult["PRICES"] = [];
	
		$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_PRICE");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "IBLOCK_SECTION_ID"=>$arSect["ID"], "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("PROPERTY_PRICE"=>"ASC"), $arFilter, false, Array("nTopCount"=>1), $arSelect);
		if($ob = $res->Fetch())
		{
			$arResult["PRICES"][$arSect["ID"]] = $ob["PROPERTY_PRICE_VALUE"];
		}
	
		if(!empty($arSect["UF_VARIANTS"])){
			$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_*");
			$arFilter = Array("IBLOCK_ID"=>18, "ID"=>$arSect["UF_VARIANTS"], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$properties = $ob->GetProperties();
				$arFields["PROPERTIES"]=$properties;
				$arResult["VARIANTS"][] = $arFields;
			}
		}
		
		if(!empty($arSect["UF_WHAT_IN"])){
			$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_*");
			$arFilter = Array("IBLOCK_ID"=>19, "ID"=>$arSect["UF_WHAT_IN"], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$properties = $ob->GetProperties();
				$arFields["PROPERTIES"]=$properties;
				$arResult["WHATS"][] = $arFields;
			}
		}
		
	}
}
?>