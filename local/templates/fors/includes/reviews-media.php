<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
global $forsVideoReviewsFilter;
$forsVideoReviewsFilter = ["!PROPERTY_VIDEO" => false];
?>
<div class="reviews-media">
	<a class="btn btn--secondary btn--medium" href="https://yandex.ru/maps/org/forsazh/1022362733/reviews/" target="_blank" rel="noopener noreferrer"><?=Loc::getMessage('FORS_REVIEWS_YANDEX');?></a>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"video-reviews",
		[
			"IBLOCK_TYPE" => "data",
			"IBLOCK_ID" => "9",
			"FILTER_NAME" => "forsVideoReviewsFilter",
			"PROPERTY_CODE" => ["VIDEO"],
			"FIELD_CODE" => ["DATE_ACTIVE_FROM", "PREVIEW_PICTURE"],
			"NEWS_COUNT" => "20",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"CHECK_DATES" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
		],
		false
	);?>
</div>
