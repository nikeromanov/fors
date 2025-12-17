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
	$k=1;
	?>
	<br><br>
	<section class="about-highlights" aria-labelledby="about-highlights-title">
        <h2 class="about-highlights__title" id="about-highlights-title">Преимущества нашей школы</h2>
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
					  <div class="about-highlights__card-title <?if(!($k==1||$k==5||$k==6||$k==7)){?>about-highlights__card-title--accent<?}?>"><?=str_pad($k, 2, '0', STR_PAD_LEFT);?></div>
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
