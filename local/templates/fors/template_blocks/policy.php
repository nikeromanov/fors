<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$set = getSettings(21);
$settingsPage = $set["PROPERTIES"];
?>
<section class="page-section page-section__flex policy container" aria-labelledby="policy-title">
        <h1 class="policy__title page-section__title" id="policy-title"><?$APPLICATION->ShowTitle(false)?></h1>
        <article class="policy__document">
			<?=$set["DETAIL_TEXT"];?>
        </article>
      </section>
	  <?if(!empty($settingsPage["DOCUMENTS"]["VALUE"])){?>
      <section class="page-section documents-slider container" aria-labelledby="documents-gallery-title">
        <h2 class="documents-slider__title" id="documents-gallery-title">Документы</h2>

        <div class="swiper documents-slider__slider" aria-label="Галерея документов">
          <div class="swiper-wrapper">
			<?foreach($settingsPage["DOCUMENTS"]["VALUE"] as $doc){?>
            <div class="swiper-slide documents-slider__slide">
              <a href="<?=CFile::GetPath($doc);?>" data-fancybox="documents-gallery" class="documents-slider__link">
                <img src="<?=CFile::GetPath($doc);?>" alt="" class="documents-slider__image" loading="lazy" />
              </a>
            </div>
			<?}?>
            
          </div>
        </div>
        
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line documents-slider__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button
              class="slider__nav-btn documents-slider__nav-btn--prev"
              type="button"
              aria-label="Предыдущая страница"
            >
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current documents-slider__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total documents-slider__page-total">3</span>
            </span>
            <button
              class="slider__nav-btn documents-slider__nav-btn--next"
              type="button"
              aria-label="Следующая страница"
            >
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </section>
	  <?}?>