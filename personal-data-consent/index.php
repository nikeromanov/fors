<?
define("TEMPLATE_PAGE", "legal");
$legalDocumentFile = "personal-data-consent-2026-08-26.html";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Согласие на обработку персональных данных пользователей сайта автошколы «Форсаж».");
$APPLICATION->SetPageProperty("title", "Согласие на обработку персональных данных — автошкола «Форсаж»");
$APPLICATION->SetTitle("Согласие на обработку персональных данных");
?>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>
