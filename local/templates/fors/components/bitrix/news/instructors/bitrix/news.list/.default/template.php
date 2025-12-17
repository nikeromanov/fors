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
?>
<?if(!empty($arResult["ITEMS"])){?>
 <div class="swiper instructors__slider" aria-label="Наши инструкторы">
	  <div class="swiper-wrapper">
		  <?foreach($arResult["ITEMS"] as $item){
			  ?>
			  		<div class="swiper-slide instructors__slide">
		  <a href="<?=$item["DETAIL_PAGE_URL"];?>" class="instructors__card">
			<picture>
			  
			  <?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){
				  $file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>750, 'height'=>750), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				  ?><img
				src="<?=$file["src"];?>"
				alt=""
				class="instructors__image"
				loading="lazy"
				width="315"
				height="450"
			  /><?}?>
			</picture>
			<div class="instructors__info">
			  <h3 class="instructors__name">
				<?=$item["NAME"];?>
			  </h3>
			  <div class="instructors__meta">
				<?if(!empty($item["PROPERTIES"]["NUMBER"]["VALUE"])){?>
					<div class="instructors__rating">
					  <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
					  <span class="instructors__rating-value"><?=$item["PROPERTIES"]["NUMBER"]["VALUE"];?></span>
					</div>
				<?}?>
				<?if(!empty($item["PROPERTIES"]["REVIEWS"]["VALUE"])){?>
					<div class="instructors__reviews">
					  <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
					  <span class="instructors__reviews-count"><?=$item["PROPERTIES"]["REVIEWS"]["VALUE"];?></span>
					</div>
				<?}?>
			  </div>
			</div>
		  </a>
		</div>
		  <?}?>

		
	  </div>
	</div>



   
       
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line instructors__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button class="slider__nav-btn instructors__nav-btn--prev" type="button" aria-label="Предыдущая страница">
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current instructors__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total instructors__page-total">2</span>
            </span>
            <button class="slider__nav-btn instructors__nav-btn--next" type="button" aria-label="Следующая страница">
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
<?}?>