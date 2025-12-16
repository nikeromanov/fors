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
?>
 <section class="">

  
  <ul class="about-us__list">

		<?foreach($arResult["ITEMS"] as $item){
			$date = strtotime($item["DATE_ACTIVE_FROM"]);
			?>
		
			<li class="reviews-card">
				<span class="reviews-card__author"><?=$item["NAME"];?></span>
				<time class="reviews-card__date" ><?=date("d.m.Y",$date);?> | <?=date("H:i:s",$date);?></time>
				<div class="reviews-card__review-text">
					<?=$item["PREVIEW_TEXT"];?>
				</div>
			  </li>
		<?}?>
	
</ul>
</section>

<?}?>