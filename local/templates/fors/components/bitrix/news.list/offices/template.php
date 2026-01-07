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
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Web\Json;
$this->setFrameMode(true);
?>
<?if(!empty($arResult["ITEMS"])){?>
<?Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU');?>
<?$markerIcon = SITE_TEMPLATE_PATH . '/assets/icons/marker.png';?>

<section class="page-section container" aria-labelledby="map-title">
  <h2 class="page-section__title u-visually-hidden" id="map-title">Наши офисы и автодромы в Воронеже</h2>
  <div class="office-map js-district-tabs">
    <ul class="tabs" role="tablist" aria-label="Районы города">
		<?foreach($arResult["ITEMS"] as $item){?>
			<li class="tabs__item" role="presentation">
				<button
				  class="tabs__button tabs__button--active"
				  role="tab"
				  aria-selected="true"
				  aria-controls="district-<?=$item["ID"];?>"
				  data-district-tab="district-<?=$item["ID"];?>"
				  tabindex="0"
				>
				  <?=$item["NAME"];?>
				</button>
		  </li>
		<?}?>
    </ul>

    <div class="office-map__wrapper">
      <?foreach($arResult["ITEMS"] as $item){?>
      <div
        class="office-map__content js-district-panel"
        id="district-<?=$item["ID"];?>"
        role="tabpanel"
        aria-labelledby="district-<?=$item["ID"];?>"
        tabindex="0"
      >
        <?if(!empty($item["PROPERTIES"]["SUBTITLE"]["VALUE"])){?><h2 class="office-map__title"><?=$item["PROPERTIES"]["SUBTITLE"]["VALUE"];?></h2><?}?>
		 <?if(!empty($item["PROPERTIES"]["LIST"]["VALUE"])){?>
        <ul class="office-map__benefits">
          <?foreach($item["PROPERTIES"]["LIST"]["VALUE"] as $el){?><li class="office-map__benefits-item"><?=$el;?></li><?}?>
        </ul>
		 <?}?>
        <?if(!empty($item["PROPERTIES"]["BIG_TITLE"]["VALUE"])){?><h3 class="office-map__label"><?=$item["PROPERTIES"]["BIG_TITLE"]["VALUE"];?></h3><?}?>
		<?if(!empty($item["PROPERTIES"]["AUTOS"]["VALUE"])){?>
			<ul class="office-map__locations">
				<?foreach($item["PROPERTIES"]["AUTOS"]["VALUE"] as $elem){?>
				  <li class="office-map__locations-item">
					<img src="<?=SITE_TEMPLATE_PATH;?>/assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
					<?=$elem["title"];?>
					<span class="office-map__locations-description"><?=$elem["subtitle"];?></span>
					<button class="btn btn--secondary btn--small js-build-route" data-coords="<?=$elem["coords"];?>">
					  Построить маршрут
					</button>
				  </li>
				<?}?>
			</ul>
		<?}?>
      </div>
	  <?}?>
     

      <div
        class="office-map__map js-district-map"
        data-marker-icon="<?=$markerIcon;?>"
		<?foreach($arResult["ITEMS"] as $item){
			$mapPoints = [];
			if(!empty($item["PROPERTIES"]["AUTOS"]["VALUE"])){
				foreach($item["PROPERTIES"]["AUTOS"]["VALUE"] as $elem){
					if(!empty($elem["coords"])){
						$mapPoints[] = [
							'coords' => $elem["coords"],
							'title' => $elem["title"],
							'subtitle' => $elem["subtitle"],
						];
					}
				}
			}
			if(!empty($mapPoints)){?>
				data-map-<?=$item["ID"];?>="<?=htmlspecialcharsbx(Json::encode(['points' => $mapPoints]));?>"
			<?}?>
		<?}?>
      ></div>
    </div>
  </div>
</section>
<?}?>
