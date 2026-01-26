<?
use Bitrix\Main\Page\Asset;

global $settings;
$settingsPage = getSettings(3);
$properties = $settingsPage["PROPERTIES"];
if(!empty($settings["AKC_DATE"]["VALUE"])&&strtotime($settings["AKC_DATE"]["VALUE"])>time()){
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/home-hero-timer.js');
}
?><main id="main" tabindex="-1">
  
  <section class="home-hero" aria-labelledby="hero-title">
	<div class="home-hero__container container">
	  <div class="home-hero__content">
		<h1 class="home-hero__title" id="hero-title"><?=$settingsPage["NAME"];?></h1>

		<div class="home-hero__lead">
			<?=$settingsPage["PREVIEW_TEXT"];?>
		</div>
		<?if(!empty($settings["AKC_DATE"]["VALUE"])&&strtotime($settings["AKC_DATE"]["VALUE"])>time()){?>
			<div class="home-hero__offer" role="group" aria-labelledby="hero-offer-title">
			  <h2 class="home-hero__offer-title" id="hero-offer-title">До конца акции осталось</h2>
			  <dl class="home-hero__timer" aria-label="Таймер окончания акции" data-date="<?=date("d.m.Y H:i:s",strtotime($settings["AKC_DATE"]["VALUE"]));?>" data-curdate="<?=date("d.m.Y H:i:s");?>">
				<div class="home-hero__timer-item">
				  <dd class="home-hero__timer-value">
					<time datetime="P5D">00</time>
				  </dd>
				  <dt class="home-hero__timer-label">Дней</dt>
				</div>
				<div class="home-hero__timer-item">
				  <dd class="home-hero__timer-value">
					<time datetime="PT48H">00</time>
				  </dd>
				  <dt class="home-hero__timer-label">Часов</dt>
				</div>
				<div class="home-hero__timer-item">
				  <dd class="home-hero__timer-value">
					<time datetime="PT0M">00</time>
				  </dd>
				  <dt class="home-hero__timer-label">Минут</dt>
				</div>
				<div class="home-hero__timer-item">
				  <dd class="home-hero__timer-value">
					<time datetime="PT0S">00</time>
				  </dd>
				  <dt class="home-hero__timer-label">Секунд</dt>
				</div>
                          </dl>
                          <?if(!empty($settings["PHONE"]["VALUE"])) {?>
                            <a
                              class="home-hero__phone phone_alloka"
                              href="tel:<?=str_replace(["-"," ",")","(","_"],"",$settings["PHONE"]["VALUE"]);?>"
                            >
                              <span aria-hidden="true" class="home-hero__phone-icon" data-icon="phone"></span>
                              <?=$settings["PHONE"]["VALUE"];?>
                            </a>
                          <?}?>
			  <a class="btn btn--primary btn--large btn--block" data-fancybox data-service="Записаться на курс" href="#consult_form">Записаться на курс</a>
			 <?if(!empty($settings["AKC_LEFT"]["VALUE"])){?> <div class="home-hero__badge">
				<span class="home-hero__badge-label">осталось</span>
				<span class="home-hero__badge-value"><?=$settings["AKC_LEFT"]["VALUE"];?></span>
				<span class="home-hero__badge-label">мест</span>
			  </div>
			 <?}?>
			</div>
		<?}?>
	  </div>
	</div>
  </section>
  <?if(!empty($properties["BLOCK1_TITLE"]["VALUE"])||!empty($properties["BLOCK1_LEFT"]["VALUE"])||!empty($properties["BLOCK1_RIGHT"]["VALUE"])||!empty($properties["BLOCK1_ELEMENTS"]["VALUE"])){?>
	  <section class="page-section school container" aria-labelledby="school-title">
		<?if(!empty($properties["BLOCK1_TITLE"]["VALUE"])){?><h2 class="school__title" id="school-title"><?=$properties["BLOCK1_TITLE"]["VALUE"];?></h2><?}?>
		<?if(!empty($properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"])||!empty($properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"])){?>
			<div class="school__text-container">
			  <?if(!empty($properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"])){?><div class="school__text content_block">
				<?=$properties["BLOCK1_LEFT"]["~VALUE"]["TEXT"];?>
			  </div><?}?>
			  <?if(!empty($properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"])){?><div class="school__text content_block">
				<?=$properties["BLOCK1_RIGHT"]["~VALUE"]["TEXT"];?>
			  </div><?}?>
			</div>
		<?}?>
		<?if(!empty($properties["BLOCK1_ELEMENTS"]["VALUE"])){?>
		
			<ul class="school__cards-list">
			<?foreach($properties["BLOCK1_ELEMENTS"]["VALUE"] as $item){?>
				<?if($item["image"]){?>
				<li class="school__card school__card--image <?if($item["two"]){?>school__card--wide<?}?>">
					<figure class="school__card-figure">
					  <picture>
						<img
						  src="<?=CFile::GetPath($item["image"]);?>"
						  alt=""
						  class="school__card-img"
						  loading="lazy"
						  width="315"
						  height="315"
						/>
					  </picture>
					</figure>
				  </li>
				<?}else{?>
					<li class="school__card school__card--stat <?if($item["two"]){?>school__card--wide<?}?>">
					<div class="school__card-content">
					  <p class="school__card-value"><?=$item["title"];?></p>
					  <p class="school__card-label"><?=$item["value"];?></p>
					</div>
				  </li>
				<?}?>
			  
			<?}?>
			</ul>
		<?}?>
		<?
		$seoTextFeatures = $properties["FEATURES"]["~VALUE"]["TEXT"]
			?? $properties["FEATURES"]["~VALUE"]
			?? $properties["FEATURES"]["VALUE"];
		?>
		<?if(!empty($seoTextFeatures)){?>
			<div class="content_block detail_content">
				<?=$seoTextFeatures;?>
			</div>
		<?}?>
		
		<?if(!empty($settings["VK"]["VALUE"])||!empty($settings["MAX"]["VALUE"])||!empty($settings["TELEGRAM"]["VALUE"])){?>
		<div class="social-banner">
		  <?if(!empty($properties["SOC_TITLE"]["VALUE"])){?><h5 class="social-banner__title"><?=$properties["SOC_TITLE"]["VALUE"];?></h5><?}?>
		  <div class="social-banner__buttons">
			<?if(!empty($settings["TELEGRAM"]["VALUE"])){?><a href="<?=$settings["TELEGRAM"]["VALUE"];?>" target="_blank" class="social-btn social-btn--telegram">
			  <span class="social-btn__icon" aria-hidden="true"></span>
			  Связаться в TG
			</a><?}?>
                        <?if(!empty($settings["MAX"]["VALUE"])){?><a href="<?=$settings["MAX"]["VALUE"];?>" target="_blank" class="social-btn social-btn--max">
                          <span class="social-btn__icon" aria-hidden="true"></span>
                          Связаться в MAX
                        </a><?}?>
			<?if(!empty($settings["VK"]["VALUE"])){?><a href="<?=$settings["VK"]["VALUE"];?>" target="_blank" class="social-btn social-btn--vk">
			  <span class="social-btn__icon" aria-hidden="true"></span>
			  Связаться в VK
			</a><?}?>
		  </div>
		</div>
		<?}?>
	  </section>
  <?}?>

  <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"advantages", 
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
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "10",
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
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
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
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"offices", 
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
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "10",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => [
			0 => "SUBTITLE",
			1 => "LIST",
			2 => "BIG_TITLE",
			3 => "AUTOS",
			4 => "MAP",
			5 => "",
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
);?>

  <section class="page-section page-section--light container" aria-labelledby="steps-title">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"etaps", 
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
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "10",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => [
			0 => "",
			1 => "SUBTITLE",
			2 => "LIST",
			3 => "BIG_TITLE",
			4 => "AUTOS",
			5 => "MAP",
			6 => "",
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
		"STRICT_SECTION_CHECK" => "Y",
		"COMPONENT_TEMPLATE" => "etaps"
	],
	false
);?>
<?php include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH . "/includes/fast-banner.php"; ?>

  </section>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"etaps_pol", 
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
		"IBLOCK_ID" => "8",
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
			1 => "SUBTITLE",
			2 => "LIST",
			3 => "BIG_TITLE",
			4 => "AUTOS",
			5 => "MAP",
			6 => "",
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
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "etaps"
	],
	false
);?>

	<?
	$stagesOfStudy = $properties["STAGES_OF_STUDY"]["~VALUE"]["TEXT"]
		?? $properties["STAGES_OF_STUDY"]["~VALUE"]
		?? $properties["STAGES_OF_STUDY"]["VALUE"];
	$whyWe = $properties["WHY_WE"]["~VALUE"]["TEXT"]
		?? $properties["WHY_WE"]["~VALUE"]
		?? $properties["WHY_WE"]["VALUE"];
	?>
	<?if(!empty($stagesOfStudy)){?>
		<section class="page-section container">
			<div class="content_block detail_content steps__seo">
				<?=$stagesOfStudy;?>
			</div>
		</section>
	<?}?>

	<?if(!empty($properties["BLOCK6_LIST"]["VALUE"])||!empty($properties["BLOCK7_LIST"]["VALUE"])){?>
  <section class="page-section remote container">
	<?if(!empty($properties["BLOCK6_LIST"]["VALUE"])){?>
	<?if(!empty($properties["BLOCK6_TITLE"]["VALUE"])){?><h2 class="remote__title"><?=$properties["BLOCK6_TITLE"]["VALUE"];?></h2><?}?>
	<div class="remote-banner">
	  <ul class="remote-banner__content">
		<?foreach($properties["BLOCK6_LIST"]["VALUE"] as $k=>$item){?>
			<li class="remote-banner__item">
			  <span class="remote-banner__item-icon remote-banner__item-icon--hat" style="    mask-image: url('<?=CFile::GetPath($item);?>'); -webkit-mask-image: url('<?=CFile::GetPath($item);?>');" aria-hidden="true"></span>
			  <?=$properties["BLOCK6_LIST"]["DESCRIPTION"][$k];?>
			</li>
		<?}?>
		
	  </ul>
	  <?if(!empty($properties["BLOCK6_IMAGE"]["VALUE"])){?>
		  <figure class="remote-banner__image-wrapper">
			<picture>
			  <img
				src="<?=CFile::GetPath($properties["BLOCK6_IMAGE"]["VALUE"]);?>"
				alt="Баннер удалённого обучения"
				class="remote-banner__image"
				loading="lazy"
				width="646"
				height="558"
			  />
			</picture>
		  </figure>
	  <?}?>
	</div>
	<?}?>
	<div class="profit-banner">
	  <?if(!empty($properties["BLOCK7_TITLE"]["VALUE"])){?><h2 class="profit-banner__title">
		<?=$properties["BLOCK7_TITLE"]["VALUE"];?>
	  </h2><?}?>
	  <?if(!empty($properties["BLOCK7_SUBTITLE"]["VALUE"])){?><p class="profit-banner__list-title"><?=$properties["BLOCK7_SUBTITLE"]["VALUE"];?></p><?}?>
	  <?if(!empty($properties["BLOCK7_LIST"]["VALUE"])){?><ul class="profit-banner__list">
	  <?foreach($properties["BLOCK7_LIST"]["VALUE"] as $item){?>
		<li class="profit-banner__item">
		  <span class="profit-banner__item-icon" aria-hidden="true"></span>
		  <?=$item;?>
		</li>
	  <?}?>
	  </ul><?}?>
	  <?if(!empty($properties["BLOCK7_SUBTITLE2"]["VALUE"])){?><p class="profit-banner__conclusion">
		<?=$properties["BLOCK7_SUBTITLE2"]["VALUE"];?>
	  </p><?}?>
	  <a class="btn btn--secondary btn--large profit-banner__btn" data-fancybox data-service="Записаться на курс" href="#consult_form">Записаться на курс</a>
	</div>
	<?if(!empty($whyWe)){?>
		<div class="content_block detail_content steps__seo">
			<?=$whyWe;?>
		</div>
	<?}?>
  </section>
	<?}?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"reviews", 
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
		"IBLOCK_ID" => "9",
		"IBLOCK_TYPE" => "content",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => [
			0 => "",
			1 => "",
		],
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => [
			0 => "",
			1 => "",
		],
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	],
	false
);?>
  <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"faq", 
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
		"IBLOCK_ID" => "10",
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
			0 => "LIST",
			1 => "",
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
		"STRICT_SECTION_CHECK" => "N"
	],
	false
);?>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_news", 
	[
		"ACTIVE_DATE_FORMAT" => "j F Y",
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
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "10",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => [
			0 => "",
			1 => "LIST",
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
		"STRICT_SECTION_CHECK" => "Y",
		"COMPONENT_TEMPLATE" => "faq"
	],
	false
);?>
  <?php include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH . "/includes/form.php"; ?>
</main>
