<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$settingsPageCur = getSettings(26);
?>

<section class="page-section driving container" aria-labelledby="driving-title">
<div class="split-banner">
  <div class="split-banner__content driving__banner-content">
	<h1 class="driving__title" id="driving-title"><? $APPLICATION->ShowTitle(false); ?></h1>
  </div>
  <figure class="split-banner__image-wrapper">
	<?if(!empty($settingsPageCur["DETAIL_PICTURE"])){?>
	<picture>
	  <img
		src="<?=CFile::GetPath($settingsPageCur["DETAIL_PICTURE"]);?>"
		alt=""
		class="split-banner__image"
		loading="lazy"
		width="646"
		height="447"
	  />
	</picture>
	<?}?>
  </figure>
</div>
</section>

<div class="driving-layout">
<aside class="driving-sidebar" aria-labelledby="driving-sidebar-title">
  <h2 class="driving-sidebar__title" id="driving-sidebar-title">Курсантам:</h2>
   <?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"left",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(""),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "left",
				"USE_EXT" => "N"
			)
		);?>
</aside>

<div class="driving-content">
	<?=$settingsPageCur["DETAIL_TEXT"];?>
 
</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"courses", 
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
			0 => "",
			1 => "",
		],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
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
			0 => "PRICE",
			1 => "PRICE_AUTO",
			2 => "DRIVING_TIME",
			3 => "READ_DRIVE",
			4 => "TYPE_DRIVING",
			5 => "ICO",
			6 => "",
		],
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "preims"
	],
	false
);?>
<? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"main_prices", 
	[
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => [
			0 => "NAME",
			1 => "",
		],
		"SECTION_ID" => "",
		"SECTION_URL" => "",
                "SECTION_USER_FIELDS" => [
                        0 => "UF_NAME",
                        1 => "UF_LETTER",
                        2 => "UF_ANONCE",
                        3 => "UF_SROK",
                        4 => "UF_FORMAT",
                        5 => "UF_SECTION_ICON",
                        6 => "",
                ],
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	],
	false
);?>