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
<section class="page-section container <?if($arParams["TITLE"]){?>fast-benefits<?}?>" aria-labelledby="driving-courses">
 <?if($arParams["TITLE"]){?><h2 class="fast-benefits__title" id="fast-pricing-title"><?=$arParams["TITLE"];?></h2><?}?>
 <?if($arParams["SUBTITLE"]){?><p class="fast-benefits__subtitle">
<?=$arParams["SUBTITLE"];?>
 </p><?}?>
 <div class="ui-table-wrapper">
        <table class="ui-table">
          <thead>
            <tr>
              <th scope="col">Курсы</th>
              <th scope="col">Стоимость</th>
              <th scope="col">Вождение</th>
              <th scope="col">Теория</th>
            </tr>
          </thead>
          <tbody>
			<?foreach($arResult["ITEMS"] as $item){?>
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
        </table>
        </div>
</section>

<?}?>