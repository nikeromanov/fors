<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_REQUEST["action"]="addform"&&$_REQUEST["phone"]){
	CModule::IncludeModule('iblock'); 

	$nameForm = "Записаться на курс";
	$el = new CIBlockElement;
	$PROP=array();
	$PROP["PHONE"] = $_REQUEST["phone"];
	$PROP["NAME"] = $_REQUEST["name"];
	$PROP["EMAIL"] = $_REQUEST["email"];
	$PROP["URL"] = $_REQUEST["url"];
	if($_REQUEST["service"]){
		$nameForm = $_REQUEST["service"];
	}
	if (!empty($_FILES['file']['tmp_name'])) {
		$PROP["FILE"] = $_FILES['file'];
	}
	$arLoadProductArray = Array(
	  "IBLOCK_SECTION_ID" => false,         
	  "IBLOCK_ID"      => 12,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"=>$nameForm,
	  "DETAIL_TEXT"=>$_REQUEST["message"]
	);
	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		
			echo json_encode(["result"=>"success","message"=>'Спасибо, ваша заявка отправлена']);
		
	}else{
		echo json_encode(["result"=>"error","message"=>'<h3 style="color:red">'.$el->LAST_ERROR.'</h3>']);
		
	}
}

?>