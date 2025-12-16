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


<?if(!empty($arResult["PROPERTIES"]["PHOTOS"]["VALUE"])){?>


         
	<div class="gallery-grid">
  <?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $k=>$item){
	  $file = CFile::ResizeImageGet($item, array('width'=>500, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	  
	  ?>
	  
	   <div class="gallery-card ">
            <a href="<?=CFile::GetPath($item);?>" data-fancybox="gallery" class="gallery-card__link">
              <figure class="gallery-card__figure">
                <picture>
                  <img
                    class="gallery-card__image"
                    src="<?=$file["src"];?>"
                    alt=""
                    
                    width="650"
                    height="400"
                  />
                </picture>
              </figure>
            </a>
          </div>
	  

  <?}?>
   
  </div>

<?}?>
