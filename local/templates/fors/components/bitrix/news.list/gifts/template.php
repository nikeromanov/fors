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
	$k=1;
	?>
	  <section class="page-section page-section__flex gifts__why container" aria-labelledby="gifts__why-title">
	<div class="ui-table-wrapper">
          <table class="ui-table">
            <thead>
              <tr>
                <th scope="col">название</th>
                <th scope="col">описание</th>
                <th scope="col">цена</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
			<?foreach($arResult["ITEMS"] as $item){?>
              <tr>
                <th scope="row">
                  <span class="ui-table__text"><?=$item["NAME"]?></span>
                </th>
                <td><?=$item["PREVIEW_TEXT"]?></td>
                <td><span class="ui-table__text"><?=$item["PROPERTIES"]["PRICE"]["VALUE"]?></span></td>

                <td><a href="#consult_form" class="btn btn--secondary btn--small" data-fancybox data-service="Подарочный сертификат: <?=$arResult["NAME"];?>">Оформить</a></td>
              </tr>
			<?}?>
            </tbody>
          </table>
        </div>
	</section>

	
	
<?}?>
