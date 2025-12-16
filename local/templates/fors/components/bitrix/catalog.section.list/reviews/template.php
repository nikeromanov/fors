<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?><?if(!empty($arResult['SECTIONS'])){?>
	 <section class="page-section container">
	<h2 class="about-us__title page-section__title">что о нас говорят</h2>
	<!-- bx:reviews-tabs -->
	<div class="reviews-tabs js-reviews-tabs">
	  <div class="reviews-tabs__header">
		<ul class="tabs reviews-tabs" role="tablist" aria-label="отзывы клиентов">
		<?
		foreach ($arResult['SECTIONS'] as $k=>$arSection)
		{
					
		?>
			<li class="tabs__item" role="presentation">
				<button
				  class="tabs__button <?if($k==0){?>tabs__button--active<?}?>"
				  role="tab"
				  aria-selected="true"
				  aria-controls="reviews-tab-<?=$arSection["ID"];?>"
				  data-reviews-tab="reviews-tab-<?=$arSection["ID"];?>"
				  tabindex="0"
				>
				  <?=$arSection["NAME"];?>
				</button>
		  </li>
		<?}?>
		</ul>
		<a href="/reviews/" class="reviews-tabs__show-all">
		  Показать все
		  <span class="ui-icon pagination__icon" aria-hidden="true" data-icon="right-arrow"></span>
		</a>
	  </div>

	  <?
		foreach ($arResult['SECTIONS'] as $k=>$arSection)
		{		
		?>
		  <div
			class="reviews-tabs__content js-reviews-panel"
			id="reviews-tab-<?=$arSection["ID"];?>"
			role="tabpanel"
			aria-labelledby="reviews-tab-<?=$arSection["ID"];?>"
			tabindex="0"
			<?if($k>0){?>hidden<?}?>
		  >
		  <?if($arSection["NAME"] == "Видео"){?>
			<ul class="video-grid">
			<?if(!empty($arResult["ITEMS"][$arSection["ID"]])){?>
					<?foreach($arResult["ITEMS"][$arSection["ID"]] as $item){
						$date = strtotime($item["DATE_ACTIVE_FROM"]);
						if(!empty($item["PROPERTIES"]["VIDEO"]["VALUE"])&&!empty($item["PREVIEW_PICTURE"])){
						?>
						<li class="video-card">
							<div class="video-card__header">
							  <span class="video-card__author"><?=$item["NAME"];?></span>
							  <time class="video-card__date"><?=date("d.m.Y",$date);?> | <?=date("H:i:s",$date);?></time>
							</div>
							<a
							  href="<?=$item["PROPERTIES"]["VIDEO"]["VALUE"];?>"
							  data-fancybox="video-reviews"
							  class="video-card__embed"
							>
							  <img
								src="<?=CFile::GetPath($item["PREVIEW_PICTURE"]);?>"
								alt=""
								class="video-card__thumbnail"
								loading="lazy"
							  />
							  <span class="video-card__play-icon" aria-hidden="true"></span>
							</a>
						  </li>
					<?}?>
				<?}?>
			<?}?>
			</ul>
		  <?}else{?>
			<ul class="about-us__list">
				<?if(!empty($arResult["ITEMS"][$arSection["ID"]])){?>
					<?foreach($arResult["ITEMS"][$arSection["ID"]] as $item){
						$date = strtotime($item["DATE_ACTIVE_FROM"]);
						?>
					
						<li class="reviews-card">
							<span class="reviews-card__author"><?=$item["NAME"];?></span>
							<time class="reviews-card__date" ><?=date("d.m.Y",$date);?> | <?=date("H:i:s",$date);?></time>
							<div class="reviews-card__review-text">
								<?=$item["PREVIEW_TEXT"];?>
							</div>
						  </li>
					<?}?>
				<?}?>
			</ul>
		  <?}?>
		  </div>
		<?}?>
	</div>
	<!-- /bx:reviews-tabs -->
  </section>
	
	
<?}?>
				