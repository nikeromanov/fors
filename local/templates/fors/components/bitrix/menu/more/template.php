<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? global $settings;

?>
<?if (!empty($arResult)):?>

<section class="also page-section page-section__flex">
  <h2 class="also__title page-section__title">Смотрите также</h2>

  <ul class="also__list">
<?
$previousLevel = 0;
foreach($arResult as $arItem):

?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
	<?
	?>
		<?=str_repeat("</ul>".$file."</li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
			<li class="also__item">
				<a href="<?=$arItem["LINK"]?>" class="also__link"><?=$arItem["TEXT"]?></a><span class="ui-icon also__icon" aria-hidden="true" data-icon="right-arrow"></span>
				<ul class="also__list">

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				 <li class="also__item">
					 <a href="<?=$arItem["LINK"]?>" class="also__link"><?=$arItem["TEXT"]?></a><span class="ui-icon also__icon" aria-hidden="true" data-icon="right-arrow"></span>
				</li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>


	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
</section>
<?endif?>
