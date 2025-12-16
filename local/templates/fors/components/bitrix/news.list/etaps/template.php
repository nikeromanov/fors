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
<?if(!empty($arResult["ITEMS"])){
	$settingsPage = getSettings(3);
	?>
	<div class="u-container">
		<?if(!empty($settingsPage["PROPERTIES"]["BLOCK4_TITLE"]["VALUE"])){?><h2 class="section-title section-title--center" id="steps-title"><?=$settingsPage["PROPERTIES"]["BLOCK4_TITLE"]["VALUE"];?></h2><?}?>
		<div class="steps" role="group" aria-labelledby="steps-title">
		  <ol class="steps__list">
			 <?foreach($arResult["ITEMS"] as $k=>$item){?>
				<li class="steps__item">
				  <p class="steps__number" aria-hidden="true"><?=str_pad(($k+1), 2, '0', STR_PAD_LEFT);?></p>
				  <h3 class="steps__title"><?=$item["NAME"];?></h3>
				  <div class="steps__description"><?=$item["PREVIEW_TEXT"];?></div>
				</li>
			 <?}?>
		  </ol>
		</div>
	</div>
<?}?>
