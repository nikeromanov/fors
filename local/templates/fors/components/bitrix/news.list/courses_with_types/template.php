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
<h2 class="u-visually-hidden" id="price-categories-title">Категории курсов и стоимость обучения</h2>

<div class="price-tabs js-price-tabs" data-price-tabs>
  <ul class="tabs" role="tablist">
	<?foreach($arResult["SECTIONS"] as $kid=>$sect){?>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="true"
        aria-controls="price-tab-<?=$kid;?>"
        id="price-tab-<?=$kid;?>-trigger"
        tabindex="0"
        data-price-tab="price-tab-<?=$kid;?>"
      >
        <?=$sect;?>
      </button>
    </li>
	<?}?>
  </ul>

  <div class="price-tabs__panels">
  <?foreach($arResult["SECTIONS"] as $kid=>$sect){?>
  <?if(!empty($arResult["ITEMS_SECT"][$kid])){?>
    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-<?=$kid?>"
      aria-labelledby="price-tab-<?=$kid?>-trigger"
    >
      <div class="ui-table-wrapper price__table-desktop"><table class="ui-table">
        <caption class="u-visually-hidden"><?=$sect;?></caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
			<?foreach($arResult["ITEMS_SECT"][$kid] as $item){?>
         <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
					<?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?>
						<span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="<?=$item["PROPERTIES"]["ICO"]["VALUE_XML_ID"];?>"></span>
					<?}?>
                </div>
                <span class="ui-table__text"><?=$item["NAME"];?></span>
              </th>
              <td><span class="ui-table__text"><?=CurrencyFormat($item["PROPERTIES"]["PRICE"]["VALUE"],"RUB");?></span></td>
              <td><?if(!empty($item["PROPERTIES"]["DRIVING_TIME"]["VALUE"])){?><?=implode(" ",$item["PROPERTIES"]["DRIVING_TIME"]["VALUE"]);?><?}?></td>
              <td><?=$item["PROPERTIES"]["READ_DRIVE"]["VALUE"];?></td>
            </tr>
			<?}?>
          
        </tbody>
      </table></div>

      <div class="price__table-mobile" role="list">
                        <?foreach($arResult["ITEMS_SECT"][$kid] as $item){?>
        <article class="price-card" role="listitem">
          <div class="price-card__header">
            <div class="price-card__course">
              <div class="ui-table__icon-container">
                                        <?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?>
                                                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="<?=$item["PROPERTIES"]["ICO"]["VALUE_XML_ID"];?>"></span>
                                        <?}?>
              </div>
              <span class="price-card__title"><?=$item["NAME"];?></span>
            </div>
            <span class="price-card__price"><?=CurrencyFormat($item["PROPERTIES"]["PRICE"]["VALUE"],"RUB");?></span>
          </div>

                        <?if(!empty($item["PROPERTIES"]["DRIVING_TIME"]["VALUE"])) {?>
          <div class="price-card__row">
            <span class="price-card__label">Вождение</span>
            <span class="price-card__value"><?=implode(" ",$item["PROPERTIES"]["DRIVING_TIME"]["VALUE"]);?></span>
          </div>
                        <?}?>

                        <?if(!empty($item["PROPERTIES"]["READ_DRIVE"]["VALUE"])) {?>
          <div class="price-card__row">
            <span class="price-card__label">Теория</span>
            <span class="price-card__value"><?=$item["PROPERTIES"]["READ_DRIVE"]["VALUE"];?></span>
          </div>
                        <?}?>
        </article>
                        <?}?>
      </div>
    </div>
  <?}?>
  <?}?>
   
  </div>
</div>
<?}?>