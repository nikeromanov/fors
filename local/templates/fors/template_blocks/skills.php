

      <section class="page-section__flex skills " aria-labelledby="skills-title">
        <h1 class="skills__title page-section__title" id="skills-title"><? $APPLICATION->ShowTitle(false); ?></h1>

        <div class="driving-layout">
          <aside class="driving-sidebar" aria-labelledby="skills-sidebar-title">
            <h2 class="driving-sidebar__title" id="skills-sidebar-title">Курсантам:</h2>
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
            <div class="driving-content__intro">
              <p class="driving-content__intro-text">
                Продолжительное отсутствие практики может создать определённые неудобства для тех, кто планирует вновь
                использовать транспортное средство. Перед тем как сесть за руль после долгого перерыва,стоит освежить
                знания и вернуть рефлексы, позволяющие водителям быстро принимать решения в условиях повышенной
                опасности на дорогах. В противном случае высока вероятность совершенияэлементарных ошибок, следствием
                которых может стать ДТП.
              </p>
              <p class="driving-content__intro-text">
                Оптимальный вариант — прохождение специальной ускоренной программы с инструктором. Автошкола «Форсаж»
                в Воронеже предлагает курсвосстановления утраченных навыков вождения автомобиля, благодаря которой можно
                быстро выйти на привычный уровень.
              </p>
            </div>

            <div class="driving-section" aria-labelledby="skills-features-title">
              <h2 id="skills-features-title">Общее представление</h2>
              <p class="driving-content__text">
                Обычно водители, долгое время остававшиеся без практики по тем или иным причинам, обращаются за помощью
                к знакомым автовладельцам. Однако подобные пробные поездки менее эффективны, чемработа с опытным
                автоинструктором. Профессионал предоставит объективную характеристику текущей готовности, поможет
                выявить типичные ошибки, допускаемые в процессе управления, и дастполезные советы по их устранению.
              </p>
              <p class="driving-content__text">
                Разумеется, проходить с самого начала весь курс обучения на права не нужно. Для восстановления
                водительских навыков после длительного перерыва достаточно нескольких уроков, за время которыхможно
                вспомнить основные нюансы вождения, почувствовать габариты и отработать базовые приёмы. Количество
                занятий зависит от личных ощущений водителя.
              </p>
            </div>

            <div class="driving-section" aria-labelledby="skills-useful-title">
              <h2 id="skills-useful-title">Что входит в программу</h2>
              <p class="driving-content__text">
                Работа строится исходя из индивидуальных пожеланий: в одних случаях нужно восстановить механику
                взаимодействия с педалями газа и сцепления, в других — повторно адаптироваться к маневрированию
                в ограниченном пространстве. Основная задача — вернуть внутреннюю уверенность в собственных действиях.
                При необходимости можно организовать уроки как на специальномавтодроме, так и в городских условиях,
                устранив пробелы первоначального обучения и закрепив наиболее сложные участки.
              </p>
            </div>

            <div class="driving-section" aria-labelledby="skills-benefits-title">
              <h2 id="skills-benefits-title">МКПП и АКПП</h2>

              <p class="driving-content__text">
                В автопарке школы «Форсаж» представлены модели на механике и автомате, что позволяет найти подходящий
                вариант для каждого обучающегося. Стандартная программа предусматривает следующиеблоки:
              </p>
              <ul class="driving-content__list">
                <li class="driving-content__list-item">Правильная посадка и настройка обзора по зеркалам.</li>
                <li class="driving-content__list-item">Начало движения и торможение.</li>
                <li class="driving-content__list-item">Отработка способов управления.</li>
                <li class="driving-content__list-item">Перестроение между рядами и развороты.</li>
                <li class="driving-content__list-item">Езда в различных режимах: магистраль, обгон, парковка.</li>
              </ul>
              <p class="driving-content__text">
                План составляется с учетом текущих умений, оцениваемых наставником в индивидуальном порядке.
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="page-section page-section__flex skills container" aria-labelledby="skills-restoration-title">
        <h2 class="skills__title page-section__title" id="skills-restoration-title">
          Цены на курсы по восстановлению навыков вождения
        </h2>
        <div class="skills__container">
          <p class="skills__description">
            Итоговая стоимость будет определяться исходя из количества практических занятий, пройденных вами
            на специально оборудованной площадке. Прозрачное ценообразование и оформлениеофициального договора исключают
            какие‑либо доплаты в будущем.
          </p>
          <p class="skills__description">
            Для получения дополнительной информации звоните по телефону +7 (473) 269–00–00, либо оставьте заявку
            на сайте через форму обратной связи. Специалисты автошколы «Форсаж» подробнопроконсультируют и помогут
            вам выбрать подходящий курс восстановления навыков вождения автомобиля
          </p>
        </div>
      </section>
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
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"main_prices", 
	[
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => [
			0 => "NAME",
			1 => "",
		],
		"SECTION_ID" => "",
		"SECTION_URL" => "",
                "SECTION_USER_FIELDS" => [
                        0 => "UF_NAME",
                        1 => "UF_LETTER",
                        2 => "UF_ANONCE",
                        3 => "UF_SROK",
                        4 => "UF_FORMAT",
                        5 => "UF_SECTION_ICON",
                        6 => "",
                ],
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	],
	false
);?>