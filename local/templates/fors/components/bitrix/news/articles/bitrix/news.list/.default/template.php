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
  <?
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
  ?>
  <ul class="news-and-discount__list">
  <?foreach($arResult["ITEMS"] as $item){
		  $dateValue = (string)($item["ACTIVE_FROM"] ?? '');
		  if ($dateValue === '') {
			  $dateValue = (string)($item["DATE_ACTIVE_FROM"] ?? '');
		  }
		  $dateTs = 0;
		  if ($dateValue !== '' && function_exists('MakeTimeStamp')) {
			  $dateTs = (int)MakeTimeStamp($dateValue);
		  }
		  if ($dateTs <= 0 && !empty($item["DISPLAY_ACTIVE_FROM"])) {
			  $dateTs = strtotime((string)$item["DISPLAY_ACTIVE_FROM"]);
		  }
		  if ($dateTs <= 0 && !empty($item["DISPLAY_ACTIVE_FROM"])) {
			  $dateText = trim(mb_strtolower((string)$item["DISPLAY_ACTIVE_FROM"]));
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
    <li class="news-card">
      <div class="news-card__wrapper">
        <div class="news-card__header">
          <p class="news-card__type"><?if(!empty($arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]])){?><?=$arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]];?><?}?></p>
          <?if($dateIso !== ''){?>
		  <time class="news-card__date" datetime="<?=$dateIso;?>"><?=$item["DISPLAY_ACTIVE_FROM"];?></time>
		  <?}else{?>
		  <span class="news-card__date"><?=$item["DISPLAY_ACTIVE_FROM"];?></span>
		  <?}?>
        </div>
        <h2 class="news-card__title">
          <a class="news-card__link" href="<?=$item["DETAIL_PAGE_URL"];?>"><?=$item["NAME"];?></a>
        </h2>
        <div class="news-card__description"><?=$item["PREVIEW_TEXT"];?></div>
      </div>

      <figure class="news-card__media">
        <?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){?>
			<img
			  class="news-card__image"
			  src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
			  alt="<?=$item["NAME"];?>"
			  loading="lazy"
			  decoding="async"
			  width="427"
			  height="271"
			/>
		<?}?>
      </figure>
    </li>
  <?}?>
   
  </ul>
<?}?>
