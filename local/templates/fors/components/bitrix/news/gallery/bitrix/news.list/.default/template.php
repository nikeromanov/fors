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

         
	<div class="gallery-grid">
  <?foreach($arResult["ITEMS"] as $k=>$item){
	  ?>
	  
	   <div class="gallery-card <?if($k!=2){?>gallery-card--driving<?}else{?>gallery-card--classrooms<?}?>">
            <a href="<?=$item["DETAIL_PAGE_URL"];?>" class="gallery-card__link" data-gallery-item>
              <figure class="gallery-card__figure">
                <?if(!empty($item["PREVIEW_PICTURE"]["SRC"])){?><picture>
                  <img
                    class="gallery-card__image"
                    src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
                    alt="<?=$item["NAME"];?>"
                    loading="lazy"
                    decoding="async"
                    width="650"
                    height="400"
                  />
                </picture><?}?>
                <figcaption class="gallery-card__caption"><?=$item["NAME"];?></figcaption>
              </figure>
            </a>
          </div>
	  

  <?}?>
   
  </div>
<?}?>