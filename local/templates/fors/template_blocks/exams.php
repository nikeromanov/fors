<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$settingsPageCur = getSettings(27);
$title="";
$subtitle="";
if(!empty($settingsPageCur["PROPERTIES"]["TITLE_BOTTOM"]["VALUE"])){
	$title=$settingsPageCur["PROPERTIES"]["TITLE_BOTTOM"]["VALUE"];
}
if(!empty($settingsPageCur["PROPERTIES"]["SUBTITLE_BOTTOM"]["VALUE"])){
	$subtitle=$settingsPageCur["PROPERTIES"]["SUBTITLE_BOTTOM"]["VALUE"];
}
$imageUrl = "";
if(!empty($settingsPageCur["DETAIL_PICTURE"])){
	$imageUrl=CFile::GetPath($settingsPageCur["DETAIL_PICTURE"]);
}
?>
<section class="page-section exams container" aria-labelledby="exams-title">
        <div class="exams__intro">
          <h1 class="exams__title" id="exams-title"><? $APPLICATION->ShowTitle(false); ?></h1>
		  <?if($settingsPageCur["PREVIEW_TEXT"]){?>
			  <div class="exams__description">
				<?=$settingsPageCur["PREVIEW_TEXT"];?>
			  </div>
		  <?}?>
        </div>

        <div class="exams__content">
          <?if(!empty($settingsPageCur["PROPERTIES"]["SUBTITLE"]["VALUE"])){?><h2 class="exams__section-title" id="exams-subtitle"><?=$settingsPageCur["PROPERTIES"]["SUBTITLE"]["VALUE"];?></h2><?}?>
          <?if($settingsPageCur["DETAIL_TEXT"]){?><?=$settingsPageCur["DETAIL_TEXT"];?>
		  <?}?>
		  <?if(!empty($settingsPageCur["PROPERTIES"]["BLOCKS"]["~VALUE"])){?>
          <div class="exams__details">
			<?foreach($settingsPageCur["PROPERTIES"]["BLOCKS"]["~VALUE"] as $k=>$vl){?>
            <div class="exams__detail-container">
              <div class="exams__stage-badge">
                <span class="exams__stage-name"><?=$settingsPageCur["PROPERTIES"]["BLOCKS"]["DESCRIPTION"][$k];?></span>
              </div>
              <div class="exams__detail-card <?if($k % 2 == 0){?>exams__detail-card--theory<?}else{?>exams__detail-card--practice<?}?>">
                <div class="exams__detail-text">
                 <?=$vl["TEXT"];?>
                </div>
              </div>
            </div>
			<?}?>
          </div>
		  <?}?>
		  <?if($settingsPageCur["PREVIEW_PICTURE"]){?>
          <figure class="exams__figure">
            <picture>
              <img
                src="<?=CFile::GetPath($settingsPageCur["PREVIEW_PICTURE"]);?>"
                alt=""
                class="exams__figure-img"
                loading="lazy"
                width="1320"
                height="514"
              />
            </picture>
          </figure>
		  <?}?>
		   <?if(!empty($settingsPageCur["PROPERTIES"]["TEXT"]["~VALUE"]["TEXT"])){?>
          <div class="exams__description">
            <?=$settingsPageCur["PROPERTIES"]["TEXT"]["~VALUE"]["TEXT"];?>
          </div>
		   <?}?>
        </div>

       
      
       
      </section>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"preims", 
	[
		"TITLE"=>$title,
		"SUBTITLE"=>$subtitle,
		"IMAGE"=>$imageUrl,
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
		"IBLOCK_ID" => "28",
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
	    
		
<? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>