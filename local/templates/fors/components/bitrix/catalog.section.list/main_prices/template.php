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
$settingsPage = getSettings(3);
?>
<?if(!empty($arResult['SECTIONS'])){?>

<section class="page-section categories container" aria-labelledby="categories-title">
  <?if(!empty($settingsPage["PROPERTIES"]["BLOCK3_TITLE"]["VALUE"])){?><h2 class="categories__title" id="categories-title"><?=$settingsPage["PROPERTIES"]["BLOCK3_TITLE"]["VALUE"];?></h2><?}?>
  <?if(!empty($settingsPage["PROPERTIES"]["BLOCK3_SUBTITLE"]["VALUE"])){?><p class="categories__subtitle">
    <?=$settingsPage["PROPERTIES"]["BLOCK3_SUBTITLE"]["VALUE"];?>
  </p><?}?>

  <!-- bx:categories-slider -->
  <div class="swiper categories__slider categories__slider--nudge" aria-label="Категории обучения">
    <div class="swiper-wrapper">
                <?
                foreach ($arResult['SECTIONS'] as $arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
		<div class="swiper-slide categories__slide">
			<div class="price-card">
			  <div class="price-card__header">
				<span class="price-card__category"><?=$arSection["UF_LETTER"];?></span>
				<a href="<?=$arSection["SECTION_PAGE_URL"];?>" class="price-card__title"><?=$arSection["UF_NAME"];?></a>
			  </div>
			  <div class="price-card__description">
				<?=$arSection["UF_ANONCE"];?>
			  </div>

			  <dl class="price-card__info">
				<?if($arSection["UF_SROK"]){?>
					<div class="price-card__length">
					  <dt class="price-card__info-title">Срок обучения:</dt>
					  <dd class="price-card__info-value"><?=$arSection["UF_SROK"];?></dd>
					</div>
				<?}?>
				<?if($arSection["UF_FORMAT"]){?>
					<div class="price-card__format">
					  <dt class="price-card__info-title">Формат:</dt>
					  <dd class="price-card__info-value"><?=$arSection["UF_FORMAT"];?></dd>
					</div>
				<?}?>
			  </dl>
			  <span class="price-card__price"><?if(!empty($arResult["PRICES"][$arSection["ID"]])){?>от <?=CurrencyFormat($arResult["PRICES"][$arSection["ID"]],"RUB");?><?}?></span>
			  <a href="#consult_form" data-fancybox class="btn btn--secondary btn--large" href="#consult_form" data-service="<?=$arSection["UF_NAME"];?>">Записаться на курс</a>
			</div>
		  </div>
				<?
		}?>
      
    </div>
  </div>

  <div class="slider__navigation">
    <div class="slider__progress-bar">
      <div class="slider__progress-line categories__progress-line"></div>
    </div>
    <div class="slider__page-info">
      <button class="slider__nav-btn categories__nav-btn--prev" type="button" aria-label="Предыдущая страница">
        <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
      </button>
      <span class="slider__page-counter">
        <span class="slider__page-current categories__page-current">1</span>
        <span class="slider__page-divider">/</span>
        <span class="slider__page-total categories__page-total"><?=count(array_chunk($arResult['SECTIONS'],3));?></span>
      </span>
      <button class="slider__nav-btn categories__nav-btn--next" type="button" aria-label="Следующая страница">
        <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
      </button>
    </div>
  </div>
</section>


		
<?}?>