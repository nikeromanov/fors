<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
if (empty($arResult["ITEMS"])) return;
?>
<div class="reviews-video-slider js-reviews-video-slider" role="region" aria-roledescription="<?=Loc::getMessage('FORS_VIDEO_CAROUSEL');?>" aria-label="<?=Loc::getMessage('FORS_VIDEO_LABEL');?>">
<div class="swiper reviews-video-slider__viewport">
<ul class="swiper-wrapper">
	<?foreach ($arResult["ITEMS"] as $item) {
		$videoUrl = trim((string)$item["PROPERTIES"]["VIDEO"]["VALUE"]);
		$videoType = '';
		$videoHost = strtolower((string)parse_url($videoUrl, PHP_URL_HOST));
		$videoScheme = strtolower((string)parse_url($videoUrl, PHP_URL_SCHEME));
		if (!in_array($videoScheme, ['https', 'http'], true)) continue;
		if ($videoHost === 'rutube.ru' || $videoHost === 'www.rutube.ru') {
			$videoType = 'iframe';
			$videoPath = (string)parse_url($videoUrl, PHP_URL_PATH);
			if (preg_match('~^/video/(private/)?([a-z0-9]+)~i', $videoPath, $matches)) {
				$queryString = parse_url($videoUrl, PHP_URL_QUERY);
				$videoUrl = 'https://rutube.ru/play/embed/'.$matches[2].'/';
				if ($queryString) $videoUrl .= '?'.$queryString;
			}
		}
		$date = strtotime($item["DATE_ACTIVE_FROM"]);
		?>
		<li class="video-card swiper-slide">
			<div class="video-card__header">
				<span class="video-card__author"><?=$item["NAME"];?></span>
				<?if ($date !== false) {?>
					<time class="video-card__date" datetime="<?=date('c', $date);?>"><?=date("d.m.Y", $date);?></time>
				<?}?>
			</div>
			<a href="<?=htmlspecialcharsbx($videoUrl);?>" data-fancybox="video-reviews" <?if ($videoType) {?>data-type="<?=$videoType;?>"<?}?> class="video-card__embed" aria-label="<?=$item["NAME"];?>">
				<?if (!empty($item["PREVIEW_PICTURE"]["SRC"])) {?>
					<img src="<?=htmlspecialcharsbx($item["PREVIEW_PICTURE"]["SRC"]);?>" alt="" class="video-card__thumbnail" loading="lazy" />
				<?} else {?>
					<span class="reviews-video-slider__placeholder"><?=Loc::getMessage('FORS_VIDEO_WATCH');?></span>
				<?}?>
				<span class="video-card__play-icon" aria-hidden="true"></span>
			</a>
		</li>
	<?}?>
</ul>
</div>
<div class="reviews-video-slider__controls" hidden>
	<button type="button" class="reviews-video-slider__prev" aria-label="<?=Loc::getMessage('FORS_VIDEO_PREV');?>">←</button>
	<span class="reviews-video-slider__counter" aria-live="polite" aria-atomic="true"></span>
	<button type="button" class="reviews-video-slider__next" aria-label="<?=Loc::getMessage('FORS_VIDEO_NEXT');?>">→</button>
</div>
</div>
