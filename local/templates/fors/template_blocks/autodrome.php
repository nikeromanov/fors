<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$settingsPageCur = getSettings(15);
?>
<section class="page-section autodrome container" aria-labelledby="autodrome-title">
        <h1 id="autodrome-title" class="page-section__title"><? $APPLICATION->ShowTitle(false); ?></h1>
        <div class="split-banner">
          <div class="split-banner__content autodrome-banner__content">
            <div class="split-banner__description autodrome-banner__description">
              <?=$settingsPageCur["PREVIEW_TEXT"];?>
            </div>
			<?if(!empty($settingsPageCur["PROPERTIES"]["ADDRESSES"]["VALUE"])){?>
				<ul class="office-map__locations">
					<?foreach($settingsPageCur["PROPERTIES"]["ADDRESSES"]["VALUE"] as $k=>$address){?>
						  <li class="office-map__locations-item">
							<span class="office-map__locations-item-wrapper">
							  <img src="<?=SITE_TEMPLATE_PATH;?>/assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
							 <?=$address;?>
							</span>
							<span class="office-map__locations-description"><?=$settingsPageCur["ADDRESSES"]["DESCRIPTION"][$k];?></span>
						  </li>
					<?}?>
				</ul>
			<?}?>
          </div>
          <?if(!empty($settingsPageCur["PREVIEW_PICTURE"])){?><figure class="split-banner__image-wrapper">
            <picture>
              
              <img
                src="<?=CFile::GetPath($settingsPageCur["PREVIEW_PICTURE"]);?>"
                alt=""
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure><?}?>
        </div>
      </section>
<?if(!empty($settingsPageCur["PROPERTIES"]["UPR"]["VALUE"])){?>
      <section class="page-section autodrome container" aria-labelledby="autodrome-features-title">
        <?if(!empty($settingsPageCur["PROPERTIES"]["OSOB_TITLE"]["VALUE"])){?><h2 class="autodrome-features__title page-section__title" id="autodrome-features-title"><?=$settingsPageCur["PROPERTIES"]["OSOB_TITLE"]["VALUE"];?></h2><?}?>
		<?if(!empty($settingsPageCur["PROPERTIES"]["OSOB_LEFT"]["~VALUE"]["TEXT"])||!empty($settingsPageCur["PROPERTIES"]["OSOB_RIGHT"]["~VALUE"]["TEXT"])){?>
        <div class="autodrome-features__content">
          <?if(!empty($settingsPageCur["PROPERTIES"]["OSOB_LEFT"]["~VALUE"]["TEXT"])){?><article>
            <?=$settingsPageCur["PROPERTIES"]["OSOB_LEFT"]["~VALUE"]["TEXT"];?>
          </article><?}?>

          <?if(!empty($settingsPageCur["PROPERTIES"]["OSOB_RIGHT"]["~VALUE"]["TEXT"])){?><article>
            <?=$settingsPageCur["PROPERTIES"]["OSOB_RIGHT"]["~VALUE"]["TEXT"];?>
          </article><?}?>
        </div>
		<?}?>
         <?if(!empty($settingsPageCur["PROPERTIES"]["UPR_TITLE"]["VALUE"])){?><h3 class="autodrome-exercises__title" id="autodrome-exercises-title"><?=$settingsPageCur["PROPERTIES"]["UPR_TITLE"]["VALUE"];?></h3><?}?>
        <?if(!empty($settingsPageCur["PROPERTIES"]["UPR"]["VALUE"])){?><ul class="badge-list" role="list">
			  <?foreach($settingsPageCur["PROPERTIES"]["UPR"]["VALUE"] as $k=>$item){?>
			  <li class="badge-list__item">
				<div class="badge-list__container">
				  <span class="ui-icon" aria-hidden="true" style="mask-image: url('<?=CFile::GetPath($item);?>');" data-icon="parking"></span>
				</div>
				<p class="badge-list__description"><?=$settingsPageCur["PROPERTIES"]["UPR"]["DESCRIPTION"][$k];?></p>
			  </li>
			  <?}?>
        </ul>
		<?}?>
      </section>
<?}?>
<?if(!empty($settingsPageCur["PROPERTIES"]["GALLERY"]["VALUE"])){?>
      <section class="page-section gallery-slider container" aria-labelledby="autodrome-gallery-title">
       <?if(!empty($settingsPageCur["PROPERTIES"]["GALLERY_TITLE"]["VALUE"])){?><h2 class="gallery-slider__title" id="autodrome-gallery-title"><?=$settingsPageCur["PROPERTIES"]["GALLERY_TITLE"]["VALUE"];?></h2><?}?>

        <!-- bx:autodrome-gallery-slider -->
        <div class="swiper gallery-slider__slider" aria-label="Галерея автодрома">
          <div class="swiper-wrapper">
            <?foreach($settingsPageCur["PROPERTIES"]["GALLERY"]["VALUE"] as $item){?>
			<div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="<?=CFile::GetPath($item);?>"
                  data-fancybox="autodrome-gallery"
                  data-caption=""
                >
                  <picture>
                   
                    <img
                      src="<?=CFile::GetPath($item);?>"
                      alt=""
                      width="650"
                      height="415"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden"></figcaption>
              </figure>
            </div>
			<?}?>
            
          </div>
        </div>
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button class="slider__nav-btn slider__nav-btn--prev" type="button" aria-label="Предыдущая страница">
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total"><?=count($settingsPageCur["PROPERTIES"]["GALLERY"]["VALUE"]);?></span>
            </span>
            <button class="slider__nav-btn slider__nav-btn--next" type="button" aria-label="Следующая страница">
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </section>
<?}?>
<?if(!empty($settingsPageCur["PROPERTIES"]["PREIM"]["VALUE"])){?>
      <section class="page-section autodrome-benefits container" aria-labelledby="autodrome-benefits-title">
        <?if(!empty($settingsPageCur["PROPERTIES"]["PREIM_TITLE"]["VALUE"])){?><h2 class="page-section__title autodrome-benefits__title" id="autodrome-benefits-title">
          <?=$settingsPageCur["PROPERTIES"]["PREIM_TITLE"]["VALUE"];?>
        </h2><?}?>

        <ul class="why-list">
			<?foreach($settingsPageCur["PROPERTIES"]["PREIM"]["VALUE"] as $el){?>
          <?if($el["title"]){?>
		  <li class="why-list__item why-list__item--text autodrome-benefits__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor" style="mask-image:url('<?=CFile::GetPath($el["image"]);?>')"></span>
            <div class="why-list__content">
              <h3 class="why-list__title"><?=$el["title"];?></h3>
              <p class="why-list__description">
               <?=$el["text"];?>
              </p>
            </div>
          </li>
		  <?}elseif($el["image"]){?>
			 <li class="why-list__item why-list__item--image autodrome-benefits__why--item">
				<figure class="why-list__figure">
				  <picture>
					<img
					  src="<?=CFile::GetPath($el["image"]);?>"
					  alt=""
					  class="why-list__img"
					  loading="lazy"
					  width="315"
					  height="315"
					/>
				  </picture>
				</figure>
			  </li>
		  <?}?>
			<?}?>
         
        </ul>
      </section>
<?}?>

<? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>