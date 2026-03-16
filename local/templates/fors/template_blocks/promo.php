<?
global $APPLICATION;

$promoIblockId = getIblockIdByCode('settings', 'promo_pages');
$promoPage = $promoIblockId > 0 ? getSettingsByCode('promo', $promoIblockId) : [];
$promoProperties = $promoPage['PROPERTIES'] ?? [];
$promoName = trim((string)($promoPage['NAME'] ?? ''));
$promoElementId = (int)($promoPage['ID'] ?? 0);

if ($promoName !== '') {
	$APPLICATION->SetTitle($promoName);
}

$sliderView = '';
$normalizePromoValue = static function ($value) {
	$value = trim((string)$value);
	if ($value === '') {
		return '';
	}

	if (function_exists('mb_strtoupper')) {
		return mb_strtoupper($value, 'UTF-8');
	}

	return strtoupper($value);
};

if ($promoElementId > 0) {
	$sliderViewFields = CIBlockElement::GetList(
		[],
		['ID' => $promoElementId, 'IBLOCK_ID' => $promoIblockId],
		false,
		false,
		['ID', 'PROPERTY_SLIDER_VIEW']
	)->Fetch();

	$sliderView = $normalizePromoValue($sliderViewFields['PROPERTY_SLIDER_VIEW_VALUE'] ?? '');
}

if ($sliderView === '') {
	$sliderView = $normalizePromoValue($promoProperties['SLIDER_VIEW']['VALUE_XML_ID'] ?? '');
}

if ($sliderView === '') {
	$sliderView = $normalizePromoValue($promoProperties['SLIDER_VIEW']['VALUE'] ?? 'CONTAINER');
}

$isWideSlider = in_array($sliderView, ['FULL', 'WIDE', 'FULL_WIDTH', 'НА ВСЮ ШИРИНУ'], true);
$gallery = $promoProperties['GALLERY']['VALUE'] ?? [];
$gallery = is_array($gallery) ? array_values(array_filter($gallery)) : [];
$galleryTitle = trim((string)($promoProperties['GALLERY_TITLE']['VALUE'] ?? ''));
$previewText = (string)($promoPage['PREVIEW_TEXT'] ?? '');
$detailText = (string)($promoPage['DETAIL_TEXT'] ?? '');
$hasContent = $previewText !== '' || $detailText !== '';
$sliderSectionClass = $isWideSlider ? 'promo-hero promo-hero--wide' : 'promo-hero promo-hero--boxed';
$sliderContainerClass = $isWideSlider ? 'promo-hero__container' : 'promo-hero__container container';
?>

<?if(empty($promoPage)){?>
<section class="page-section promo-page container" aria-labelledby="promo-title">
	<h1 class="promo-page__title" id="promo-title"><? $APPLICATION->ShowTitle(false); ?></h1>
	<div class="promo-page__content content_block">
		<p>Контент промо-страницы пока не заполнен.</p>
	</div>
</section>
<?return;?>
<?}?>

<?if(!empty($gallery)){?>
<section class="<?=$sliderSectionClass;?>" aria-label="Промо-слайдер">
	<div class="<?=$sliderContainerClass;?>">
		<div class="promo-hero-slider">
			<div class="swiper promo-hero-slider__slider" aria-label="Промо-слайдер">
				<div class="swiper-wrapper">
					<?foreach($gallery as $index => $item){?>
					<div class="swiper-slide promo-hero-slider__slide">
						<figure class="promo-hero-slider__media">
							<picture>
								<img
									src="<?=CFile::GetPath($item);?>"
									alt="<?=$promoName !== '' ? htmlspecialcharsbx($promoName) . ' — слайд ' . ($index + 1) : 'Промо-слайд ' . ($index + 1);?>"
									width="1440"
									height="520"
								/>
							</picture>
						</figure>
					</div>
					<?}?>
				</div>
			</div>
			<div class="promo-hero-slider__controls">
				<div class="promo-hero-slider__pagination" aria-hidden="true"></div>
				<button class="promo-hero-slider__nav promo-hero-slider__nav--prev" type="button" aria-label="Предыдущий слайд">
					<span class="ui-icon promo-hero-slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
				</button>
				<button class="promo-hero-slider__nav promo-hero-slider__nav--next" type="button" aria-label="Следующий слайд">
					<span class="ui-icon promo-hero-slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</div>
</section>
<?}?>

<section class="page-section promo-page container" aria-labelledby="promo-title">
	<h1 class="promo-page__title" id="promo-title"><? $APPLICATION->ShowTitle(false); ?></h1>
	<?if($galleryTitle !== ''){?><p class="promo-page__subtitle"><?=$galleryTitle;?></p><?}?>
	<?if($hasContent){?>
	<div class="promo-page__content content_block detail_content">
		<?if($previewText !== ''){?>
		<div class="promo-page__lead">
			<?=$previewText;?>
		</div>
		<?}?>
		<?if($detailText !== ''){?>
		<div class="promo-page__text">
			<?=$detailText;?>
		</div>
		<?}?>
	</div>
	<?}?>
</section>

<? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>
