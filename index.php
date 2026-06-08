<?
define("TEMPLATE_PAGE","main");
define("HOME_META_DESCRIPTION", "Запишитесь на обучение в автошколу Воронежа по привлекательной цене: отучитесь на автокурсах и сдайте на права, получите водительское удостоверение для вождения легкового автомобиля - пройдите курсы водителя в школе \"Форсаж\".");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", HOME_META_DESCRIPTION);
$APPLICATION->SetPageProperty("keywords", "Форсаж");
$APPLICATION->SetPageProperty("title", "Автошкола в Воронеже: обучение на права на курсах вождения легкового автомобиля по выгодной цене - сдать экзамен, отучиться на водителя и получить водительское удостоверение на автокурсах в школе \"Форсаж\"");
$APPLICATION->SetTitle("Автошкола Форсаж в Воронеже");
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
