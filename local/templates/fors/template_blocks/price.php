<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$settingsPageCur = getSettings(36);
?>


<section class="page-section price-intro container" aria-labelledby="price-title">
        <h1 class="price-intro__title u-text-center" id="price-title"><? $APPLICATION->ShowTitle(false); ?></h1>
        <div class="split-banner">
          <div class="split-banner__content">
           <?if($settingsPageCur["PREVIEW_TEXT"]){?>
			  <div class="content_block detail_content price_content">
				<?=$settingsPageCur["PREVIEW_TEXT"];?>
			  </div>
		  <?}?>
            <a class="btn btn--secondary btn--large" data-fancybox data-service="Записаться на курс" href="#consult_form">Записаться на курс</a>
          </div>
		  <?if(!empty($settingsPageCur["PREVIEW_PICTURE"])){?>
			<figure class="split-banner__image-wrapper"><picture>
			  <img
				src="<?=CFile::GetPath($settingsPageCur["PREVIEW_PICTURE"]);?>"
				alt=""
				class="split-banner__image"
				loading="lazy"
				width="646"
				height="447"
			  />
			</picture></figure>
			<?}?>
        </div>
        <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"courses_with_types", 
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
                "NEWS_COUNT" => "200",
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
      </section>

<?if(!empty($settingsPageCur["PROPERTIES"]["TITLE_WHAT"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["WHAT"]["VALUE"])){?>
<section class="page-section price-benefits container" aria-labelledby="price-benefits-title">
  <div class="u-container price-benefits__inner">
    <?if(!empty($settingsPageCur["PROPERTIES"]["TITLE_WHAT"]["VALUE"])){?><h2 class="price-benefits__title" id="price-benefits-title"><?=$settingsPageCur["PROPERTIES"]["TITLE_WHAT"]["VALUE"];?></h2><?}?>
	<?if(!empty($settingsPageCur["PROPERTIES"]["WHAT"]["VALUE"])){
		$items = array_chunk($settingsPageCur["PROPERTIES"]["WHAT"]["VALUE"],round(count($settingsPageCur["PROPERTIES"]["WHAT"]["VALUE"])/2));
		
		?>
    <div class="price-benefits__grid">
      <?foreach($items as $elems){?>
	  
	  <div class="price-benefits__group">
		
        <ul class="price-benefits__list">
			<?foreach($elems as $el){?>
				<li class="price-benefits__item">
					<span class="ui-icon ui-icon_small price-benefits__icon" aria-hidden="true" data-icon="checkbox"></span>
					<span class="price-benefits__text"><?=$el;?></span>
				</li>
			<?}?>
        </ul>
		
      </div><?}?>
    </div>
	<?}?>
  </div>
</section>
<?}?>
<? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>
<?
$seoText = $settingsPageCur["PROPERTIES"]["SEO_TEXT"]["~VALUE"]["TEXT"]
	?? $settingsPageCur["PROPERTIES"]["SEO_TEXT"]["~VALUE"]
	?? $settingsPageCur["PROPERTIES"]["SEO_TEXT"]["VALUE"];
?>
<?if(!empty($seoText)){?>
<section class="page-section price-seo container" aria-label="SEO текст">
	<div class="content_block detail_content">
		<?=$seoText;?>
	</div>
</section>
<?}?>
<?if(!empty($settingsPageCur["PROPERTIES"]["TITLE_NAPR"]["VALUE"])||!empty($settingsPageCur["PROPERTIES"]["NAPRS"]["VALUE"])){?>
	<section class="page-section price-directions container" aria-labelledby="price-directions-title">
	  <?if(!empty($settingsPageCur["PROPERTIES"]["TITLE_NAPR"]["VALUE"])){?><h2 class="page-section__title" id="price-directions-title"><?=$settingsPageCur["PROPERTIES"]["TITLE_NAPR"]["VALUE"];?></h2><?}?>
	  <?
	  $seoTextCategory = $settingsPageCur["PROPERTIES"]["SEO_TEXT_CATEGORY"]["~VALUE"]["TEXT"]
		?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_CATEGORY"]["~VALUE"]
		?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_CATEGORY"]["VALUE"];
	  ?>
	  <?if(!empty($seoTextCategory)){?>
	  <div class="content_block detail_content">
		<?=$seoTextCategory;?>
	  </div>
	  <?}?>
	  <?
	  $seoTextMethods = $settingsPageCur["PROPERTIES"]["SEO_TEXT_METHODS"]["~VALUE"]["TEXT"]
		?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_METHODS"]["~VALUE"]
		?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_METHODS"]["VALUE"];
	  ?>
	  <?if(!empty($seoTextMethods)){?>
	  <div class="content_block detail_content">
		<?=$seoTextMethods;?>
	  </div>
	  <?}?>
	  <ul class="badge-list" role="list">
	  <?foreach($settingsPageCur["PROPERTIES"]["NAPRS"]["VALUE"] as $k=>$el){?>
		<li class="badge-list__item">
		  <?if(!empty($settingsPageCur["PROPERTIES"]["NAPRS"]["DESCRIPTION"][$k])){?>
			  <div class="badge-list__container">
				<span class="badge-list__badge" aria-hidden="true"><?=$settingsPageCur["PROPERTIES"]["NAPRS"]["DESCRIPTION"][$k];?></span>
			  </div>
		  <?}?>
		  <p class="badge-list__description"><?=$el;?></p>
		</li>
	  <?}?>
		
		  </ul>
		  <?
		  $seoTextAfterCategory = $settingsPageCur["PROPERTIES"]["SEO_TEXT_AFTER_CATEGORY"]["~VALUE"]["TEXT"]
			?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_AFTER_CATEGORY"]["~VALUE"]
			?? $settingsPageCur["PROPERTIES"]["SEO_TEXT_AFTER_CATEGORY"]["VALUE"];
		  ?>
		  <?if(!empty($seoTextAfterCategory)){?>
		  <div class="content_block detail_content">
			<?=$seoTextAfterCategory;?>
		  </div>
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
