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



	<ul class="faq__list" role="list">
	  <?foreach($arResult["ITEMS"] as $item){?>
	  <?php
		$questionId = "faq-question-" . ($index + 1);
		$answerId = "faq-answer-" . ($index + 1);
		?>
	  <li class="faq__item" role="listitem">
		<article
		  class="faq-card"
		  aria-labelledby="<?php echo $questionId; ?>"
		  aria-describedby="<?php echo $answerId; ?>"
		>
		  <header class="faq-card__header">
			<h2 class="faq-card__author">
			  <?php echo $item["NAME"]; ?>
			</h2>
			<div class="faq-card__question" id="<?php echo $questionId; ?>">
			  <?php echo $item["PREVIEW_TEXT"]; ?>
			</div>
		  </header>
		  <div class="faq-card__divider" aria-hidden="true">
			<span class="ui-icon faq-card__icon" aria-hidden="true" data-icon="down-arrow"></span>
		  </div>
		  <footer class="faq-card__footer">
			<p class="faq-card__expert">
			  <?php echo $item["PROPERTIES"]["WHO"]["VALUE"]; ?>
			</p>
			<div class="faq-card__answer" id="<?php echo $answerId; ?>">
			  <?php echo $item["DETAIL_TEXT"]; ?>
			</div>
		  </footer>
		</article>
	  </li>
	  <?}?>
	</ul>



<?}?>