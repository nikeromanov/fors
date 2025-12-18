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
  <ul class="news-and-discount__list">
  <?foreach($arResult["ITEMS"] as $item){
	  ?>
    <li class="news-card">
      <div class="news-card__wrapper">
        <div class="news-card__header">
          <p class="news-card__type"><?if(!empty($arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]])){?><?=$arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]];?><?}?></p>
          <time class="news-card__date" ><?=$item["DISPLAY_ACTIVE_FROM"];?></time>
        </div>
        <h3 class="news-card__title">
          <a class="news-card__link" href="<?=$item["DETAIL_PAGE_URL"];?>"><?=$item["NAME"];?></a>
        </h3>
        <p class="news-card__description"><?=$item["PREVIEW_TEXT"];?></p>
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