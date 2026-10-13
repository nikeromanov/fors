<?php
use Bitrix\Main\Loader;

$onlineMainContentHtml = '';

if (Loader::includeModule('iblock')) {
    $res = CIBlockElement::GetList(
        [],
        [
            'IBLOCK_ID' => 41,
            'ACTIVE' => 'Y',
            'CODE' => 'online-traning-main',
        ],
        false,
        ['nTopCount' => 1],
        ['ID', 'IBLOCK_ID', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE']
    );

    if ($ob = $res->GetNextElement()) {
        $fields = $ob->GetFields();
        $detailText = (string)($fields['~DETAIL_TEXT'] ?? '');
        $detailTextType = (string)($fields['DETAIL_TEXT_TYPE'] ?? 'html');

        if ($detailText !== '') {
            $onlineMainContentHtml = $detailTextType === 'text'
                ? nl2br(htmlspecialcharsbx($detailText))
                : $detailText;
        }
    }
}

if ($onlineMainContentHtml !== '') {
    $onlineMainContentHtml = str_replace(
        [
            '<h2>Актуальность удаленных форматов</h2>',
            '<h2>Что нужно для дистанционного обучения в автошколе на водительские права</h2>',
            '<h3>Порядок подготовки</h3>',
            '<h2>Как записаться на курс обучения вождению автомобиля онлайн для начинающих</h2>',
        ],
        [
            '<h2>ПОПУЛЯРНОСТЬ УДАЛЕННЫХ ФОРМАТОВ</h2>',
            '<h2>ЧТО НУЖНО ДЛЯ ОНЛАЙН-ОБУЧЕНИЯ В АВТОШКОЛЕ</h2>',
            '<h2>ПОРЯДОК ПОДГОТОВКИ</h2>',
            '<h2>КАК ЗАПИСАТЬСЯ НА ОНЛАЙН-АВТОКУРСЫ В ВОРОНЕЖЕ</h2>',
        ],
        $onlineMainContentHtml
    );
}
?>

      <section class="page-section page-section__flex online container" aria-labelledby="online-title">
        <div class="split-banner">
          <div class="split-banner__content online__banner-content">
            <h1 class="online__title" id="online-title">
              Обучение
              <br />
              онлайн
            </h1>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="<?=SITE_TEMPLATE_PATH;?>/assets/img/banners/online.webp" />
              <img
                src="<?=SITE_TEMPLATE_PATH;?>/assets/img/banners/online.webp"
                alt="Обучение онлайн"
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure>
        </div>
      </section>

      <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"advantages", 
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
		],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
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
		],
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	],
	false
);?>

      <div class="driving-layout">
        <aside class="driving-sidebar" aria-labelledby="online-sidebar-title">
          <p class="driving-sidebar__title" id="online-sidebar-title">Курсантам:</p>
          <?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"left",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(""),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "left",
				"USE_EXT" => "N"
			)
		);?>
        </aside>

        <div class="driving-content">
		  <?if($onlineMainContentHtml !== ''){?>
			  <div class="content_block detail_content">
				<?=$onlineMainContentHtml;?>
			  </div>
		  <?}?>
        </div>
      </div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"courses", 
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
		],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
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
			0 => "PRICE",
			1 => "PRICE_AUTO",
			2 => "DRIVING_TIME",
			3 => "READ_DRIVE",
			4 => "TYPE_DRIVING",
			5 => "ICO",
			6 => "",
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
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "preims"
	],
	false
);?>
      <? include $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/includes/form.php";?>
      <section class="page-section remote container" aria-labelledby="remote-title">
        <h2 class="remote__title" id="remote-title">Дистанционное обучение</h2>
        <div class="remote-banner">
          <ul class="remote-banner__content">
            <li class="remote-banner__item">
              <span class="remote-banner__item-icon remote-banner__item-icon--hat" aria-hidden="true"></span>
              Школа у вас дома
            </li>
            <li class="remote-banner__item">
              <span class="remote-banner__item-icon remote-banner__item-icon--refresh" aria-hidden="true"></span>
              Возможность повторного просмотра занятий
            </li>
            <li class="remote-banner__item">
              <span class="remote-banner__item-icon remote-banner__item-icon--online" aria-hidden="true"></span>
              Интернет-обучение в любой точке мира
            </li>
            <li class="remote-banner__item">
              <span class="remote-banner__item-icon remote-banner__item-icon--percent" aria-hidden="true"></span>
              Экономия ваших средств, скидка до 60%
            </li>
            <li class="remote-banner__item">
              <span class="remote-banner__item-icon remote-banner__item-icon--teacher" aria-hidden="true"></span>
              Общение с преподавателем в реальном времени
            </li>
          </ul>
          <figure class="remote-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="<?=SITE_TEMPLATE_PATH;?>/assets/img/banners/online.webp" />
              <img
                src="<?=SITE_TEMPLATE_PATH;?>/assets/img/banners/online.webp"
                alt="Баннер удалённого обучения"
                class="remote-banner__image"
                loading="lazy"
                width="646"
                height="558"
              />
            </picture>
          </figure>
        </div>
      </section>
