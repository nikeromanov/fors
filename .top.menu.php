<?
\Bitrix\Main\Localization\Loc::loadMessages($_SERVER["DOCUMENT_ROOT"]."/info/index.php");

$aMenuLinks = Array(
	Array(
		"Категории и цены", 
		"/category/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Экзамены и вождение", 
		"/exams/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Отзывы", 
		"/reviews/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Оплата", 
		"/payment/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Сертификаты",
		"/sertifikaty-i-diplomy/",
		Array(),
		Array(),
		"1==1"
	),
	Array(
		\Bitrix\Main\Localization\Loc::getMessage("FORS_EDUCATION_MENU_TITLE"),
		"/info/",
		Array(),
		Array(),
		""
	)
);
?>
