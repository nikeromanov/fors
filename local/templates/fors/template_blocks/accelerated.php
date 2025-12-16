<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$settingsPageCur = getSettings(31);

$titlePrices="";
$subtitlePrices="";
if(!empty($settingsPageCur["PROPERTIES"]["TITLE_PRICES"]["VALUE"])){
	$titlePrices=$settingsPageCur["PROPERTIES"]["TITLE_PRICES"]["VALUE"];
}
if(!empty($settingsPageCur["PROPERTIES"]["SUBTITLE_PRICES"]["VALUE"])){
	$subtitlePrices=$settingsPageCur["PROPERTIES"]["SUBTITLE_PRICES"]["VALUE"];
}

$titlePochemu="";
$subtitlePochemu="";
if(!empty($settingsPageCur["PROPERTIES"]["TITLE_US"]["VALUE"])){
	$titlePochemu=$settingsPageCur["PROPERTIES"]["TITLE_US"]["VALUE"];
}
if(!empty($settingsPageCur["PROPERTIES"]["SUBTITLE_US"]["VALUE"])){
	$subtitlePochemu=$settingsPageCur["PROPERTIES"]["SUBTITLE_US"]["VALUE"];
}
?>
 <section class="page-section fast-courses container" aria-labelledby="fast-courses__title">
        <h1 class="fast-courses__title" id="fast-courses__title"><? $APPLICATION->ShowTitle(false); ?></h1>
        <div class="fast-courses__container">
          <?if($settingsPageCur["PREVIEW_TEXT"]){?><div class="fast-courses__col detail_content content_block">
            <?=$settingsPageCur["PREVIEW_TEXT"];?>
          </div><?}?>

          <?if($settingsPageCur["DETAIL_TEXT"]){?><div class="fast-courses__col detail_content content_block">
            <?=$settingsPageCur["DETAIL_TEXT"];?>
          </div><?}?>
        </div>
      </section>
	<?if(!empty($settingsPageCur["PROPERTIES"]["TITLE"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["SUBTITLE"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["PREIMS"]["VALUE"])){?>
      <section class="page-section fast-benefits container" aria-labelledby="fast-benefits__title">
       <?if(!empty($settingsPageCur["PROPERTIES"]["TITLE"]["VALUE"])){?><h2 class="fast-benefits__title" id="fast-benefits__title"><?=$settingsPageCur["PROPERTIES"]["TITLE"]["VALUE"];?></h2><?}?>
         <?if(!empty($settingsPageCur["PROPERTIES"]["SUBTITLE"]["VALUE"])){?><p class="fast-benefits__subtitle">
          <?=$settingsPageCur["PROPERTIES"]["SUBTITLE"]["VALUE"];?>
        </p><?}?>
<?if(!empty($settingsPageCur["PROPERTIES"]["PREIMS"]["VALUE"])){?>
        <ul class="fast-benefits__grid">
			<?foreach($settingsPageCur["PROPERTIES"]["PREIMS"]["VALUE"] as $k=>$preim){?>
          <li class="fast-benefit__card">
            <h3 class="fast-benefit__card-title"><?=$settingsPageCur["PROPERTIES"]["PREIMS"]["DESCRIPTION"][$k];?></h3>
            <img
              src="<?=CFile::GetPath($preim);?>"
              alt=""
              class="fast-benefit__card-image"
              loading="lazy"
              decoding="async"
              width="315"
              height="192"
            />
          </li>
			<?}?>
          
        </ul>
<?}?>
      </section>
	<?}?>
	<?if(!empty($settingsPageCur["PROPERTIES"]["ETAP_TITLE"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["ETAP_SUBTITLE"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["ETAPS"]["VALUE"])){?>
      <section class="page-section fast-benefits container" aria-labelledby="fast-steps__title">
        <?if(!empty($settingsPageCur["PROPERTIES"]["ETAP_TITLE"]["VALUE"])){?><h2 class="fast-benefits__title" id="fast-steps__title"><?=$settingsPageCur["PROPERTIES"]["ETAP_TITLE"]["VALUE"];?></h2><?}?>
        <?if(!empty($settingsPageCur["PROPERTIES"]["ETAP_SUBTITLE"]["VALUE"])){?><p class="fast-benefits__subtitle"><?=$settingsPageCur["PROPERTIES"]["ETAP_SUBTITLE"]["VALUE"];?></p><?}?>
		<?if(!empty($settingsPageCur["PROPERTIES"]["ETAPS"]["VALUE"])){?>
        <div class="steps" role="group" aria-labelledby="steps-title">
          <ol class="steps__list">
			<?foreach($settingsPageCur["PROPERTIES"]["ETAPS"]["VALUE"] as $k=>$etap){?>
				<li class="steps__item">
				  <p class="steps__number" aria-hidden="true"><?=str_pad(($k+1), 2, '0', STR_PAD_LEFT);?></p>
				  <h3 class="steps__title"><?=$etap;?></h3>
				</li>
			<?}?>
          </ol>
        </div>
		<?}?>
      </section>
	<?}?>
	<?if(!empty($settingsPageCur["PROPERTIES"]["DOCS_TITLE"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["DOCS"]["VALUE"])){?>
      <section class="page-section page-section__flex docs container" aria-labelledby="docs-title">
        <?if(!empty($settingsPageCur["PROPERTIES"]["DOCS_TITLE"]["VALUE"])){?><h2 class="docs__title page-section__title" id="docs-title"><?=$settingsPageCur["PROPERTIES"]["DOCS_TITLE"]["VALUE"];?></h2><?}?>

	<?if(!empty($settingsPageCur["PROPERTIES"]["DOCS"]["VALUE"])){?>
        <ul class="docs__list">
			<?foreach($settingsPageCur["PROPERTIES"]["DOCS"]["VALUE"] as $k=>$dc){
				$desc = splitByParentheses($settingsPageCur["PROPERTIES"]["DOCS"]["DESCRIPTION"][$k]);
				?>
			  <li class="docs__card">
				<h3 class="docs__card-title"><?=$desc["text"];?></h3>
				<p class="docs__card-description"><?=$desc["inside"];?></p>
				<img
				  class="docs__card-image"
				  src="<?=CFile::GetPath($dc);?>"
				  alt=""
				  loading="lazy"
				  decoding="async"
				  width="350"
				  height="350"
				/>
			  </li>
			<?}?>
         
        </ul>
	<?}?>
      </section>
	<?}?>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"pochemu", 
	[
		"TITLE"=>$titlePochemu,
		"SUBTITLE"=>$subtitlePochemu,
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
		"IBLOCK_ID" => "32",
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
      

     <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"courses", 
	[
		"TITLE"=>$titlePrices,
		"SUBTITLE"=>$subtitlePrices,
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
			5 => "",
		],
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	],
	false
);?>
	  <? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>