<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$settingsPage = getSettings(25);
$properties = $settingsPage["PROPERTIES"];
?><section class="page-section article-detail container" aria-labelledby="article-detail-heading">
<div class="article-detail__inner u-container">
  <article class="article-detail__article">
	<header class="article-detail__header">
	  <h1 class="article-detail__title" id="article-detail-heading">
		<? $APPLICATION->ShowTitle(false); ?>
	  </h1>
	 <?$APPLICATION->ShowViewContent('date');?>
	</header>
<?
$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	[
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		'STRICT_SECTION_CHECK' => $arParams['STRICT_SECTION_CHECK'],
	],
	$component
);?> </article>
</div>
</section>
<?php include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH . "/includes/form.php"; ?>
<?if(!empty($properties["BLOCK1_TITLE"]["VALUE"])||!empty($properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"])||!empty($properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"])){?>
<section class="page-section page-section__flex discount" aria-labelledby="discount-bonus">
	<?if(!empty($properties["BLOCK1_TITLE"]["VALUE"])){?><h2 class="page-section__title" id="discount-bonus"><?=$properties["BLOCK1_TITLE"]["VALUE"];?></h2><?}?>
	<?if(!empty($properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"])||!empty($properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"])){?><div class="discount__container">
	  <?if(!empty($properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"])){?><div class="discount__text">
		<?=$properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"];?>
	  </div><?}?>
	  <?if(!empty($properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"])){?><div class="discount__text">
		<?=$properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"];?>
	  </div><?}?>
	</div><?}?>
  </section>
<?}?>

<?if(!empty($properties["BLOCK2_TITLE"]["VALUE"])||!empty($properties["BLOCK2_SUBTITLE"]["VALUE"])||!empty($properties["BLOCK2_LIST"]["VALUE"])){?>
<section class="page-section page-section__flex discount__badges container" aria-labelledby="discount-badges-title">
<?if(!empty($properties["BLOCK2_TITLE"]["VALUE"])){?><h2 class="page-section__title" id="discount-badges-title"><?=$properties["BLOCK2_TITLE"]["VALUE"];?></h2><?}?>
<?if(!empty($properties["BLOCK2_SUBTITLE"]["VALUE"])){?><p class="discount__badges-description"><?=$properties["BLOCK2_SUBTITLE"]["VALUE"];?></p><?}?>
<?if(!empty($properties["BLOCK2_LIST"]["VALUE"])){?>
<ul class="badge-list" role="list">
	<?foreach($properties["BLOCK2_LIST"]["VALUE"] as $k=>$item){?>
  <li class="badge-list__item">
	<div class="badge-list__container">
	  <span class="ui-icon" aria-hidden="true" style="mask-image: url('<?=CFile::GetPath($item);?>');" data-icon="student"></span>
	</div>
	<p class="badge-list__description"><?=$properties["BLOCK2_LIST"]["DESCRIPTION"][$k];?></p>
  </li>
	<?}?>
  
</ul>
<?}?>
</section>
<?}?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"preims", 
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
		"IBLOCK_ID" => "22",
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
			0 => "",
			1 => "ICO",
			2 => "",
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
		"COMPONENT_TEMPLATE" => "why_we"
	],
	false
);?>