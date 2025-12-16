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

<?$this->SetViewTarget('date');?>
 <p class="article-detail__meta">
	<time class="article-detail__date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
  </p>
<?$this->EndViewTarget();?>        

<div class="article-detail__content detail_content content_block">
	<?=$arResult["DETAIL_TEXT"];?>
  
</div>
