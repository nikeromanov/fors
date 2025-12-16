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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<?if(!empty($arResult['SECTIONS'])){?>
<div class="driving-layout js-schedule-tabs">
  <aside class="driving-sidebar" aria-labelledby="schedule-sidebar-title">
	<nav class="driving-sidebar__nav" aria-label="Выберите район">
	  <ul class="driving-sidebar__list" role="tablist">
		<?foreach($arResult['SECTIONS'] as $k=>$sect){?>
			<li role="presentation">
			  <button
				class="driving-sidebar__link <?if($k==0){?>driving-sidebar__link--active<?}?>"
				role="tab"
				aria-selected="true"
				aria-controls="district-<?=$sect["ID"];?>"
				data-schedule-tab="district-<?=$sect["ID"];?>"
			  >
				<?=$sect["NAME"];?>
			  </button>
			</li>
		<?}?>
		
	  </ul>
	</nav>
  </aside>

  <div class="driving-content">
	<?foreach($arResult['SECTIONS'] as $k=>$sect){?>
	<div
	  class="schedule-district"
	  role="tabpanel"
	  id="district-<?=$sect["ID"];?>"
	  aria-labelledby="district-<?=$sect["ID"];?>-title"
	>
	  <h2 class="u-visually-hidden" id="district-<?=$sect["ID"];?>-title"><?=$sect["NAME"];?></h2>
	<?if(!empty($arResult["ITEMS"][$sect["ID"]])){?>
		<?foreach($arResult["ITEMS"][$sect["ID"]] as $item){?>
		  <div class="schedule-card">
			<h3 class="schedule-card__location"><?=$item["NAME"];?></h3>
			<div class="schedule-card__body">
		
			<?if(!empty($item["PROPERTIES"]["LIST"]["VALUE"])){?>
			  <table class="schedule-table">
				<caption class="u-visually-hidden">Расписание занятий на <?=$item["NAME"];?></caption>
				<thead>
				  <tr>
					<th scope="col">Время</th>
					<th scope="col">Дата</th>
					<th scope="col">Событие</th>
				  </tr>
				</thead>
				<tbody>
					<?foreach($item["PROPERTIES"]["LIST"]["VALUE"] as $elem){?>
						  <tr>
							<td data-label="Время"><?=$elem["time"];?></td>
							<td data-label="Дата"><?=$elem["date"];?></td>
							<td data-label="Событие"><?=$elem["event"];?></td>
						  </tr>
					<?}?>
				</tbody>
			  </table>
			<?}?>
			</div>
		  </div>
		<?}?>
	<?}?>
	</div>
	<?}?>
	
  </div>
</div>

		
<?}?>