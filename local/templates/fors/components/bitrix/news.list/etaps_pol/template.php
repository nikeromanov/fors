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
	$k=1;
	?>
	<section class="page-section about-highlights container" aria-labelledby="about-highlights-title">
	  <?if(!empty($settingsPage["PROPERTIES"]["BLOCK5_TITLE"]["VALUE"])){?><h2 class="page-section__title" id="about-highlights-title"><?=$settingsPage["PROPERTIES"]["BLOCK5_TITLE"]["VALUE"];?></h2><?}?>
	  <ul class="about-highlights__grid">
	  <?foreach($arResult["ITEMS"] as $item){?>
		
		<?if($item["PREVIEW_PICTURE"]["SRC"]){?>
		 <li class="about-highlights__card about-highlights__card--car" aria-hidden="true">
		  <picture>
			<img
			  src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
			  alt="<?=$item["NAME"];?>"
			  class="about-highlights__card-image"
			  width="315"
			  height="315"
			  loading="lazy"
			/>
		  </picture>
		</li>
		<?}else{
			?>
			<li class="about-highlights__card <?if($k==1||$k==5||$k==6||$k==7){?>about-highlights__card--accent<?}?>">
			  <h3 class="about-highlights__card-title <?if(!($k==1||$k==5||$k==6||$k==7)){?>about-highlights__card-title--accent<?}?>"><?=str_pad($k, 2, '0', STR_PAD_LEFT);?></h3>
			  <p class="about-highlights__card-text">
				<?=$item["NAME"];?>
			  </p>
			</li>
		<?
		$k++;
		}?>
	  <?}?>
		
	  </ul>
	</section>
<?}?>
