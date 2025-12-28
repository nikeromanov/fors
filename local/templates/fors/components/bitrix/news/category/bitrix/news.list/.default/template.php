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
<?if(!empty($arResult["SECTION"])){
	$section = $arResult["SECTION"];
	?>

<section class="page-section page-section__flex category container" aria-labelledby="category-title">
	<h1 class="category__title page-section__title" id="category-title">
	  <?$APPLICATION->ShowTitle(false)?>
	</h1>
	<div class="category__container">
	  <div class="detail_content category__content">
		<?=$section["DESCRIPTION"];?>

		<div class="category__price-block">
		  <?if(!empty($arResult["PRICES"][$section["ID"]])){?><span class="category__price">от <?=CurrencyFormat($arResult["PRICES"][$section["ID"]],"RUB");?></span><?}?>
		  <a  class="btn btn--secondary btn--large" href="#consult_form" data-fancybox="" data-service="<?=$section["NAME"];?>">Записаться на курс</a>
		</div>
	  </div>

          <div class="category__media">
                <?if(!empty($section["PICTURE"])){
                        $pictureSrc = CFile::GetPath($section["PICTURE"]);
                        $hasVideo = !empty($section["UF_VIDEO"]);
                        if($hasVideo){?>
                                <a href="<?=$section["UF_VIDEO"];?>" data-fancybox class="category__video-link">
                        <?}?>
                        <figure class="category__video">
                                <img
                                  src="<?=$pictureSrc;?>"
                                  alt=""
                                  class="category__video-thumbnail"
                                  width="670"
                                  height="443"
                                  loading="eager"
                                />
                                <?if($hasVideo){?>
                                <div class="category__play-button">
                                  <svg
                                        class="category__play-icon"
                                        width="80"
                                        height="80"
                                        viewBox="0 0 80 80"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                  >
                                        <circle cx="40" cy="40" r="40" fill="#F2D502" />
                                        <path d="M32 25L55 40L32 55V25Z" fill="#1A1A1A" />
                                  </svg>
                                </div>
                                <?}?>
                        </figure>
                        <?if($hasVideo){?>
                                </a>
                        <?}
                }?>
          </div>
	</div>
  </section>
      <?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"why_we", 
		[
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => [
				0 => "",
				1 => "",
				2 => "",
			],
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "17",
			"IBLOCK_TYPE" => "data",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "20",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => [
				0 => "",
				1 => "ICO",
				2 => "",
				3 => "",
			],
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N"
		],
		false
	);?>
	<?if(!empty($arResult["VARIANTS"])||!empty($section["UF_VARIANTS_TITLE"])||!empty($section["UF_VARIANTS_TEXT"])||!empty($section["UF_YELLOW"])){?>
      <section class="category__transmission page-section container" aria-labelledby="category-transmission-title">
        <div class="transmission">
          <?if(!empty($section["UF_VARIANTS_TITLE"])){?>
			  <h2 class="transmission__title" id="category-transmission-title">
				<?=$section["UF_VARIANTS_TITLE"];?>
			  </h2>
		  <?}?>
		  <?if(!empty($section["UF_VARIANTS_TEXT"])){?>
			  <div class="transmission__subtitle">
				<?=$section["UF_VARIANTS_TEXT"];?>
			  </div>
		  <?}?>
		  <?if(!empty($arResult["VARIANTS"])){?>
          <div class="transmission__groups">
            <?foreach($arResult["VARIANTS"] as $variant){?>
            <div class="transmission__group">
              <div class="transmission__badge"><?=$variant["NAME"];?></div>

              <div class="transmission__content">
				<?if(!empty($variant["PROPERTIES"]["PLUSES"]["VALUE"])){?>
					<div class="transmission__column">
					  <h3 class="transmission__column-title">плюсы:</h3>
					  <ul class="transmission__list">
						<?foreach($variant["PROPERTIES"]["PLUSES"]["VALUE"] as $var){?>
							<li class="transmission__item">
							  <span class="transmission__bullet"></span>
							  <?=$var;?>
							</li>
						<?}?>
					  </ul>
					</div>
				<?}?>
				<?if(!empty($variant["PROPERTIES"]["MINUSES"]["VALUE"])){?>
					<div class="transmission__column transmission__column--dark">
					  <h3 class="transmission__column-title">минусы:</h3>
					  <ul class="transmission__list">
						<?foreach($variant["PROPERTIES"]["MINUSES"]["VALUE"] as $var){?>
							<li class="transmission__item">
							  <span class="transmission__bullet"></span>
							  <?=$var;?>
							</li>
						<?}?>

					  </ul>
					</div>
				<?}?>
              </div>
            </div>
			<?}?>
          </div>
		  <?}?>
		  <?if(!empty($section["UF_YELLOW"])){?>
			  <div class="transmission__warning">
				<div class="transmission__warning-text">
				  <?=$section["UF_YELLOW"];?>
				</div>
			  </div>
		  <?}?>
			 <?if(!empty($section["UF_IMAGES"])){?>
			  <div class="transmission__images">
				<?foreach($section["UF_IMAGES"] as $image){?>
				<figure class="transmission__image-wrapper">
				  <picture>
					<img
					  src="<?=CFile::GetPath($image);?>"
					  alt=""
					  class="transmission__image"
					  loading="lazy"
					  width="650"
					  height="400"
					/>
				  </picture>
				</figure>
				<?}?>
			  </div>
			 <?}?>
        </div>
      </section>
	<?}?>
	<?if(!empty($section["UF_OS_LEFT"])||!empty($section["UF_OS_RIGHT"])){?>
      <section class="page-section page-section__flex category__features-section container" aria-labelledby="category-features-title">
        <h2 class="page-section__title" id="category-features-title">Особенности курсов</h2>

        <div class="category__features-grid">
          <div class="category__features-column">
            <?=$section["~UF_OS_LEFT"];?>
          </div>
          <div class="category__features-column">
            <?=$section["~UF_OS_RIGHT"];?>
          </div>
        </div>
      </section>
	<?}?>
	<?if(!empty($arResult["WHATS"])||!empty($section["UF_WHAT_TITLE"])||!empty($section["UF_WHAT_TEXT"])){?>
      <section class="page-section page-section__flex category__badges container" aria-labelledby="category-badges-title">
        <?if(!empty($section["UF_WHAT_TITLE"])){?><h2 class="page-section__title" id="category-badges-title"><?=$section["UF_WHAT_TITLE"];?></h2><?}?>
        <?if(!empty($section["UF_WHAT_TEXT"])){?><div class="category__badges-description">
          <?=$section["~UF_WHAT_TEXT"];?>
        </div><?}?>
		<?if(!empty($arResult["WHATS"])){?>
        <ul class="badge-list category__badge-list" role="list">
			<?foreach($arResult["WHATS"] as $item){?>
			  <li class="badge-list__item">
				<div class="badge-list__container">
				  <?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?><span class="ui-icon" aria-hidden="true" style="mask-image: url('<?=CFile::GetPath($item["PROPERTIES"]["ICO"]["VALUE"]);?>');" data-icon="teacher"></span><?}?>
				</div>
				<p class="badge-list__description"><?=$item["NAME"];?></p>
			  </li>
			<?}?>
          
        </ul>
		<?}?>
      </section>
	<?}?>
	

<?if(!empty($section["UF_TEXT"])){?>
	<div class=" container">
	  <div class="detail_content category__content">
		<?=html_entity_decode($section["~UF_TEXT"]);?>
	  </div>
	</div>
<?}?>

      <?if(!empty($arResult["ITEMS"])){?>
      <section class="page-section page-section__flex category__table container" aria-labelledby="category-table-title">
        <h2 id="category-table-title" class="u-visually-hidden">Таблица цен</h2>

        <div class="ui-table-wrapper category__table-desktop">
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

        <div class="category__table-mobile" role="list">
                        <?foreach($arResult["ITEMS"] as $item){?>
          <article class="category-card" role="listitem">
            <div class="category-card__header">
              <div class="category-card__course">
                <div class="ui-table__icon-container">
                                        <?if(!empty($item["PROPERTIES"]["ICO"]["VALUE"])){?>
                                                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="<?=$item["PROPERTIES"]["ICO"]["VALUE_XML_ID"];?>"></span>
                                        <?}?>
                </div>
                <span class="category-card__title"><?=$item["NAME"];?></span>
              </div>
              <span class="category-card__price"><?=CurrencyFormat($item["PROPERTIES"]["PRICE"]["VALUE"],"RUB");?></span>
            </div>

                        <?if(!empty($item["PROPERTIES"]["DRIVING_TIME"]["VALUE"])) {?>
            <div class="category-card__row">
              <span class="category-card__label">Вождение</span>
              <span class="category-card__value"><?=implode(" ",$item["PROPERTIES"]["DRIVING_TIME"]["VALUE"]);?></span>
            </div>
                        <?}?>

                        <?if(!empty($item["PROPERTIES"]["READ_DRIVE"]["VALUE"])) {?>
            <div class="category-card__row">
              <span class="category-card__label">Теория</span>
              <span class="category-card__value"><?=$item["PROPERTIES"]["READ_DRIVE"]["VALUE"];?></span>
            </div>
                        <?}?>
          </article>
                        <?}?>
        </div>
      </section>
	  <?}?>

<?}?>