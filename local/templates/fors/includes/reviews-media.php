<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/css/components/reviews-media.css');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/reviews-video-slider.js');
?>
<section class="reviews-media" aria-labelledby="reviews-media-title">
	<div class="reviews-media__intro">
		<span class="reviews-media__eyebrow"><?=Loc::getMessage('FORS_REVIEWS_EYEBROW');?></span>
		<h2 id="reviews-media-title" class="reviews-media__title"><?=Loc::getMessage('FORS_REVIEWS_VIDEO_TITLE');?></h2>
		<p class="reviews-media__description"><?=Loc::getMessage('FORS_REVIEWS_VIDEO_DESCRIPTION');?></p>
		<?// Verified against Yandex Maps on 2026-11-17: 4.9, 517 reviews (812 ratings).?>
		<a class="reviews-media__rating" href="https://yandex.ru/maps/org/forsazh/70026884601/reviews/" target="_blank" rel="noopener noreferrer">
			<span class="reviews-media__rating-score"><span aria-hidden="true">★</span> 4,9</span>
			<span class="reviews-media__rating-copy">
				<strong><?=Loc::getMessage('FORS_REVIEWS_YANDEX_TITLE');?></strong>
				<span><?=Loc::getMessage('FORS_REVIEWS_YANDEX_STATS');?></span>
			</span>
			<span class="reviews-media__rating-arrow" aria-hidden="true">↗</span>
		</a>
	</div>
	<div class="reviews-media__videos">
	<?$APPLICATION->IncludeComponent(
		"iswin:video.reviews",
		".default",
		["IBLOCK_ID" => 9, "CACHE_TYPE" => "A", "CACHE_TIME" => 36000000],
		false
	);?>
	</div>
</section>
<h2 class="reviews-media__text-title"><?=Loc::getMessage('FORS_REVIEWS_TEXT_TITLE');?></h2>
