<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/css/components/reviews-media.css');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/js/reviews-video-slider.js');
require_once $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/lib/YandexReviewsRating.php';
$yandexRating = \Fors\YandexReviewsRating::get();
$reviewCount = $yandexRating['review_count'];
$reviewRemainder = $reviewCount % 100;
$reviewForm = ($reviewRemainder >= 11 && $reviewRemainder <= 14) ? 'MANY'
	: (($reviewCount % 10 === 1) ? 'ONE' : (($reviewCount % 10 >= 2 && $reviewCount % 10 <= 4) ? 'FEW' : 'MANY'));
$reviewStats = Loc::getMessage('FORS_REVIEWS_YANDEX_STATS_'.$reviewForm, ['#COUNT#' => number_format($reviewCount, 0, ',', ' ')]);
?>
<section class="reviews-media" aria-labelledby="reviews-media-title">
	<div class="reviews-media__intro">
		<span class="reviews-media__eyebrow"><?=Loc::getMessage('FORS_REVIEWS_EYEBROW');?></span>
		<h2 id="reviews-media-title" class="reviews-media__title"><?=Loc::getMessage('FORS_REVIEWS_VIDEO_TITLE');?></h2>
		<p class="reviews-media__description"><?=Loc::getMessage('FORS_REVIEWS_VIDEO_DESCRIPTION');?></p>
		<a class="reviews-media__rating" href="<?=htmlspecialcharsbx(\Fors\YandexReviewsRating::URL);?>" target="_blank" rel="noopener noreferrer">
			<span class="reviews-media__rating-score"><span aria-hidden="true">★</span> <?=number_format($yandexRating['rating'], 1, ',', '');?></span>
			<span class="reviews-media__rating-copy">
				<strong><?=Loc::getMessage('FORS_REVIEWS_YANDEX_TITLE');?></strong>
				<span><?=htmlspecialcharsbx($reviewStats);?></span>
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
