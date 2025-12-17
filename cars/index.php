<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталог учебных машин, на которых проходит обучение вождению в автошколе Форсаж в Воронеже: все данные о транспортных средствах на сайте.");
$APPLICATION->SetPageProperty("keywords", "Машины учебные");
$APPLICATION->SetPageProperty("title", "Учебные машины автошколы Форсаж: автотранспорт, на котором проходит обучение вождению в Воронеже на сайте");
$APPLICATION->SetTitle("Машины учебные");
?><div class="cars__text cars__intro container">
	 Современный автопарк
 Собственные автомобили Volkswagen Polo (АКПП/МКПП), мотоциклы, грузовики и квадроциклы 2022–2025 гг. — техника в отличном состоянии, вся принадлежит автошколе.
В нашей автошколе занятия по вождению проходят на новых и современных автомобилях Фольксваген Поло. Эта марка славится своей надежностью и редко ломается по этому нет отмены занятий в связи с ремонтом и наши ученики успевают пройти программу по вождению вовремя. Хорошая управляемость, динамика и проходимость делают автомобиль комфортным и предсказуемым на дороге. Автомобили оборудованы кондиционерами для комфорта будущих водителей.
Ваша экономия - время.
</div>
 <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"cars", 
	[
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => [
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "",
		],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "16",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => [
			0 => "OBJEM",
			1 => "KOROBKA",
			2 => "YEAR",
			3 => "",
		],
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	],
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>