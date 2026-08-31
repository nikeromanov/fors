<?
define("TEMPLATE_PAGE", "legal");
$legalDocumentFile = "analytics-consent-2026-08-26.html";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Согласие на использование аналитических и маркетинговых технологий на сайте автошколы «Форсаж».");
$APPLICATION->SetPageProperty("title", "Согласие на аналитику и маркетинговые технологии — автошкола «Форсаж»");
$APPLICATION->SetTitle("Согласие на аналитические и маркетинговые технологии");
?>
<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>
