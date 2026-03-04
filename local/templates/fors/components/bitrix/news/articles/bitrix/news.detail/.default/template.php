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

<?$this->SetViewTarget('date');?>
<?
$dateValue = (string)($arResult["ACTIVE_FROM"] ?? '');
if ($dateValue === '') {
	$dateValue = (string)($arResult["DATE_ACTIVE_FROM"] ?? '');
}
$dateTs = 0;
if ($dateValue !== '' && function_exists('MakeTimeStamp')) {
	$dateTs = (int)MakeTimeStamp($dateValue);
}
if ($dateTs <= 0 && !empty($arResult["DISPLAY_ACTIVE_FROM"])) {
	$dateText = trim(mb_strtolower((string)$arResult["DISPLAY_ACTIVE_FROM"]));
	$monthMap = [
		'января' => '01',
		'февраля' => '02',
		'марта' => '03',
		'апреля' => '04',
		'мая' => '05',
		'июня' => '06',
		'июля' => '07',
		'августа' => '08',
		'сентября' => '09',
		'октября' => '10',
		'ноября' => '11',
		'декабря' => '12',
	];
	if (preg_match('/^(\d{1,2})\s+([а-яё]+)\s+(\d{4})$/u', $dateText, $matches)) {
		$day = str_pad((string)((int)$matches[1]), 2, '0', STR_PAD_LEFT);
		$month = $monthMap[$matches[2]] ?? '';
		$year = $matches[3];
		if ($month !== '') {
			$dateTs = strtotime($year . '-' . $month . '-' . $day . ' 00:00:00');
		}
	}
}
$dateIso = $dateTs > 0 ? date('c', $dateTs) : '';
?>
 <p class="article-detail__meta">
	<?if($dateIso !== ''){?>
		<time class="article-detail__date" datetime="<?=$dateIso;?>"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
	<?}else{?>
		<span class="article-detail__date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?}?>
	  </p>
<?$this->EndViewTarget();?>        

<div class="article-detail__content detail_content content_block">
	<?=$arResult["DETAIL_TEXT"];?>
  
</div>
