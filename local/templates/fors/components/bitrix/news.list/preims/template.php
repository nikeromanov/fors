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
<section class="page-section page-section__flex discount__why container">
	<h2 class="discount__section-title page-section__title" id="discount-why-title">
	  <?if($arParams["TITLE"]){?><?=$arParams["TITLE"];?><?}else{?>Преимущества обращения к нам<?}?>
	</h2>
	<?if(!empty($arParams["SEO_TEXT_ADVANTAGES"])){?>
	<div class="content_block detail_content">
		<?=htmlspecialcharsback($arParams["SEO_TEXT_ADVANTAGES"]);?>
	</div>
	<?}?>
	<?if($arParams["SUBTITLE"]){?><p class="exams__text">
           <?=$arParams["SUBTITLE"];?>
	</p><?}?>
	<ul class="why-list">
	<?foreach($arResult["ITEMS"] as $item){?>
		<?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){?>
			<li class="why-list__item why-list__item--image discount__why--item">
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
			<li class="why-list__item why-list__item--text discount__why--item">
			<?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?><span class="ui-icon" aria-hidden="true" style="mask-image: url('<?=CFile::GetPath($item["PROPERTIES"]["ICO"]["VALUE"]);?>');" data-icon="hands"></span><?}?>
			<div class="why-list__content">
			  <h3 class="why-list__title"><?=$item["NAME"];?></h3>
			  <div class="why-list__description">
				<?=$item["PREVIEW_TEXT"];?>
			  </div>
			</div>
		  </li>
		<?}?>
	<?}?>
	
	 
	</ul>
	<?if($arParams["IMAGE"]){?>
          <figure class="exams__figure">
            <picture>
              <img
                src="<?=$arParams["IMAGE"];?>"
                alt=""
                class="exams__figure-img"
                loading="lazy"
                width="1320"
                height="514"
              />
            </picture>
          </figure>
		<?}?>  
  </section>
<?}?>
