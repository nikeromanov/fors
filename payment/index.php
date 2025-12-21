<?
define("TEMPLATE_PAGE","payment");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Читайте информацию об условиях оплаты и возврата на сайте автошколы Форсаж");
$APPLICATION->SetPageProperty("keywords", "Оплата");
$APPLICATION->SetPageProperty("title", "Условия оплаты и возврата от автошколы Форсаж");
$APPLICATION->SetTitle("Оплата");
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>