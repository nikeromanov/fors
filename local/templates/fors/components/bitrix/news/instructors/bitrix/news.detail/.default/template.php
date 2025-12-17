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

<section class="page-section instructor-detail container" aria-labelledby="instructor-title">
<div class="instructor-detail__header">
  <div class="instructor-detail__photo">
  <?if(!empty($arResult["PREVIEW_PICTURE"]["SRC"])){ $file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>950, 'height'=>950), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
	<picture>
	  <img
		src="<?=$file["src"];?>"
		alt=""
		class="instructor-detail__image"
		width="538"
		height="650"
		loading="eager"
	  />
	</picture><?}?>
	<a href="#consult_form" class="btn btn--primary btn--medium" data-fancybox data-service="Записаться к этому инструктору: <?=$arResult["NAME"];?>">Записаться к этому инструктору</a>
  </div>

  <div class="instructor-detail__info">
	<h1 class="instructor-detail__title" id="instructor-title">
	  <? $APPLICATION->ShowTitle(false); ?>
	</h1>

	<div class="instructor-detail__content detail_content content_block">
	  <?=$arResult["DETAIL_TEXT"];?>
	</div>

	<div class="instructor-detail__specs">
	  <h2 class="instructor-detail__specs-title">Информация</h2>
	  <dl class="instructor-detail__specs-list">
		<?if(!empty($arResult["PROPERTIES"]["STAZH_V"]["VALUE"])){?>
			<div class="instructor-detail__spec">
			  <dt class="instructor-detail__spec-label">Стаж вождения:</dt>
			  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["STAZH_V"]["VALUE"];?></dd>
			</div>
		<?}?>
		<?if(!empty($arResult["PROPERTIES"]["STAZH_P"]["VALUE"])){?>
		<div class="instructor-detail__spec">
		  <dt class="instructor-detail__spec-label">Стаж преподавания:</dt>
		  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["STAZH_P"]["VALUE"];?></dd>
		</div><?}?>
		<?if(!empty($arResult["PROPERTIES"]["CATEGORY"]["VALUE"])){?>
		<div class="instructor-detail__spec">
		  <dt class="instructor-detail__spec-label">Категории обучения:</dt>
		  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["CATEGORY"]["VALUE"];?></dd>
		</div><?}?>
		<?if(!empty($arResult["PROPERTIES"]["AUTO"]["VALUE"])){?>
		<div class="instructor-detail__spec">
		  <dt class="instructor-detail__spec-label">Автомобиль:</dt>
		  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["AUTO"]["VALUE"];?></dd>
		</div><?}?>
		<?if(!empty($arResult["PROPERTIES"]["NUMBER"]["VALUE"])){?>
		<div class="instructor-detail__spec">
		  <dt class="instructor-detail__spec-label">Средняя оценка:</dt>
		  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["NUMBER"]["VALUE"];?></dd>
		</div><?}?>
		<?if(!empty($arResult["PROPERTIES"]["BRANCHES"]["VALUE"])){?>
		<div class="instructor-detail__spec">
		  <dt class="instructor-detail__spec-label">Филиалы:</dt>
		  <dd class="instructor-detail__spec-value"><?=$arResult["PROPERTIES"]["NUMBER"]["VALUE"];?></dd>
		</div><?}?>
	  </dl>
	</div>
  </div>
</div>
</section>



