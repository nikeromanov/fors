<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
if (empty($arResult["ITEMS"])) return;
?>
<ul class="video-grid">
	<?foreach ($arResult["ITEMS"] as $item) {
		$videoUrl = trim((string)$item["PROPERTIES"]["VIDEO"]["VALUE"]);
		$videoType = '';
		$videoHost = strtolower((string)parse_url($videoUrl, PHP_URL_HOST));
		$videoScheme = strtolower((string)parse_url($videoUrl, PHP_URL_SCHEME));
		if (!in_array($videoScheme, ['https', 'http'], true) || empty($item["PREVIEW_PICTURE"])) continue;
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
		<li class="video-card">
			<div class="video-card__header">
				<span class="video-card__author"><?=$item["NAME"];?></span>
				<?if ($date !== false) {?>
					<time class="video-card__date" datetime="<?=date('c', $date);?>"><?=date("d.m.Y", $date);?> | <?=date("H:i:s", $date);?></time>
				<?}?>
			</div>
			<a href="<?=htmlspecialcharsbx($videoUrl);?>" data-fancybox="video-reviews" <?if ($videoType) {?>data-type="<?=$videoType;?>"<?}?> class="video-card__embed" aria-label="<?=$item["NAME"];?>">
				<img src="<?=htmlspecialcharsbx($item["PREVIEW_PICTURE"]["SRC"]);?>" alt="" class="video-card__thumbnail" loading="lazy" />
				<span class="video-card__play-icon" aria-hidden="true"></span>
			</a>
		</li>
	<?}?>
</ul>
