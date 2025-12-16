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
$settingsPage = getSettings(3);

?>
<?if(!empty($arResult["ITEMS"])){?>
	<section class="page-section advantages container" aria-labelledby="advantages-title">
	  <?if(!empty($settingsPage["PROPERTIES"]["BLOCK2_TITLE"]["VALUE"])){?><h2 class="advantages__title" id="advantages-title"><?=$settingsPage["PROPERTIES"]["BLOCK2_TITLE"]["VALUE"];?></h2><?}?>
	  <ul class="advantages__list">
	  <?foreach($arResult["ITEMS"] as $item){?>
		<?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){?>
			<li class="advantages__item advantages__item--image">
			  <figure class="advantages__item-figure">
				<picture>
				  <img
					src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
					alt="<?=$item["NAME"];?>"
					class="advantages__item-img"
					loading="lazy"
					width="315"
					height="315"
				  />
				</picture>
			  </figure>
			</li>
		<?}else{?>
		<li class="advantages__item advantages__item--text">
		  <?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?>
		  <span class="ui-icon" aria-hidden="true" style="mask-image: url('<?=CFile::GetPath($item["PROPERTIES"]["ICO"]["VALUE"]);?>');"></span>
		  <div class="advantages__item-content">
			<h3 class="advantages__item-title"><?=$item["NAME"];?></h3>
			<div class="advantages__item-description"><?=$item["PREVIEW_TEXT"];?></div>
		  </div>
		  <?}?>
		</li>
		<?}?>
	  <?}?>
	  </ul>
	</section>
<?}?>
