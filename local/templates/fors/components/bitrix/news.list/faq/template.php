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
	$settingsPage = getSettings(3);?>
<section class="page-section faq-accordion container" itemscope itemtype="https://schema.org/FAQPage">
  <?if(!empty($settingsPage["PROPERTIES"]["BLOCK9_TITLE"]["VALUE"])){?><h2 class="faq-accordion__title"><?=$settingsPage["PROPERTIES"]["BLOCK9_TITLE"]["VALUE"];?></h2><?}?>
  <ul class="faq-accordion__list">
	<?foreach($arResult["ITEMS"] as $item){
		if(!empty($item["PROPERTIES"]["LIST"]["VALUE"])){?>
			<li class="faq-accordion__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
			  <button class="faq-accordion__question" aria-expanded="false">
				<span itemprop="name"><?=$item["NAME"];?></span>
				<span class="faq-accordion__icon" aria-hidden="true">
				  <span class="ui-icon faq-accordion__icon-down" data-icon="down-arrow"></span>
				  <span class="ui-icon faq-accordion__icon-up" data-icon="up-arrow"></span>
				</span>
			  </button>
			  <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
				<ul class="faq-accordion__answers" itemprop="text">
				<?foreach($item["PROPERTIES"]["LIST"]["VALUE"] as $answer){?>
					<li><?=$answer;?></li>
				<?}?>
				</ul>
			  </div>
			</li>
		<?}?>
	<?}?>
  </ul>
</section>

<?}?>
