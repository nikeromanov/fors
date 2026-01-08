<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Web\Json;
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
<?if(!empty($arResult["ITEMS"])){?>
<?
$defaultMapSrc = '';
$districtCoords = [];
foreach($arResult["ITEMS"] as $item){
	$mapValue = $item["PROPERTIES"]["MAP"]["~VALUE"] ?? '';
	$mapRaw = is_array($mapValue) ? ($mapValue["TEXT"] ?? '') : $mapValue;
	$mapRaw = trim((string)$mapRaw);
	if($mapRaw !== '' && $defaultMapSrc === ''){
		if(stripos($mapRaw, '<iframe') !== false && preg_match('/src=["\']([^"\']+)["\']/', $mapRaw, $matches)){
			$mapRaw = $matches[1];
		}
		$defaultMapSrc = $mapRaw;
	}
	$autos = $item["PROPERTIES"]["AUTOS"]["VALUE"] ?? [];
	$coordsList = [];
	foreach($autos as $auto){
		$coords = trim((string)($auto["coords"] ?? ''));
		if($coords !== ''){
			$coordsList[] = [
				"coords" => $coords,
				"title" => (string)($auto["title"] ?? ''),
				"subtitle" => (string)($auto["subtitle"] ?? ''),
			];
		}
	}
	$districtCoords[$item["ID"]] = $coordsList;
}
$markerIcon = SITE_TEMPLATE_PATH.'/assets/icons/marker.png';
?>

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
		data-marker-icon="<?=htmlspecialcharsbx($markerIcon);?>"
		data-map-default="<?=htmlspecialcharsbx($defaultMapSrc);?>"
		<?foreach($arResult["ITEMS"] as $item){
			$mapValue = $item["PROPERTIES"]["MAP"]["~VALUE"] ?? '';
			$mapRaw = is_array($mapValue) ? ($mapValue["TEXT"] ?? '') : $mapValue;
			$mapRaw = trim((string)$mapRaw);
			if($mapRaw !== '' && stripos($mapRaw, '<iframe') !== false && preg_match('/src=["\']([^"\']+)["\']/', $mapRaw, $matches)){
				$mapRaw = $matches[1];
			}
			if($mapRaw !== ''){?>
				data-map-<?=$item["ID"];?>="<?=htmlspecialcharsbx($mapRaw);?>"
			<?}?>
			data-coords-<?=$item["ID"];?>="<?=htmlspecialcharsbx(Json::encode($districtCoords[$item["ID"]] ?? []));?>"
		<?}?>
      ><?if(!empty($defaultMapSrc)){?>
		  <iframe src="<?=htmlspecialcharsbx($defaultMapSrc);?>" loading="lazy" allowfullscreen></iframe>
		<?}?></div>
    </div>
  </div>
</section>
<?}?>
