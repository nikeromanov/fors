<?
define("TEMPLATE_PAGE","about");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Читайте полную информацию о нас: как проходит обучение, адрес и телефон - автошкола \"Форсаж\".");
$APPLICATION->SetPageProperty("keywords", "О нас");
$APPLICATION->SetPageProperty("title", "Вся информация о нас: обучение, адрес, телефон - автошкола \"Форсаж\" ");
$APPLICATION->SetTitle("О нас");
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>