<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? global $settings;

?>
<?if (!empty($arResult)):?>


 <ul class="footer-nav__list" role="list">
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
			<li class="with_parent">
				<a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7" fill="none">
<path d="M1 0.999999L6 6L11 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span></a>
				<ul class="left_menues">

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				 <li class="footer-nav__item">
					 <a class="footer-nav__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					
				</li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>


	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>

<?endif?>
