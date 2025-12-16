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
<section class="page-section page-section__flex gifts__why container" aria-labelledby="gifts__why-title">
	<h2 class="page-section__title" id="gifts__why-title">Почему именно мы</h2>

	<ul class="why-list">
	  
		<?foreach($arResult["ITEMS"] as $item){?>
			<?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){?>
				<li class="why-list__item why-list__item--image gifts__why--item">
					<figure class="why-list__figure">
					  <picture>
						<img
						  src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
						  alt=""
						  class="why-list__img"
						  loading="lazy"
						  width="315"
						  height="315"
						/>
					  </picture>
					</figure>
				  </li>
			<?}else{?>
				<li class="why-list__item why-list__item--text gifts__why--item">
					<?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?><span class="ui-icon" aria-hidden="true" data-icon="hands" style="mask-image: url('<?=CFile::GetPath($item["PROPERTIES"]["ICO"]["VALUE"]);?>');"></span><?}?>

					<h3 class="why-list__title"><?=$item["NAME"];?></h3>
				</li>
			<?}?>
		<?}?>
	  
	</ul>
  </section>	
<?}?>