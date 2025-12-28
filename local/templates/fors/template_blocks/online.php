
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
          <h2 class="driving-sidebar__title" id="online-sidebar-title">Курсантам:</h2>
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
          <section aria-labelledby="online-intro-title online-section">
            <h2 class="u-visually-hidden" id="online-intro-title">Введение</h2>
            <p class="driving-content__intro-text">
              В современном мире практически невозможно обойтись без машины, но с таким интенсивным ритмом жизни очень
              сложно выделить время на подготовку. Именно поэтому автошкола вождения«Форсаж» в Воронеже предоставляет
              всем своим ученикам возможность обучения на онлайн-автокурсах для получения водительских прав.
              Также мы организуем проведение как теоретических,так и практических занятий по повышению и подтверждению
              квалификации для различных организаций.
            </p>
          </section>

          <section aria-labelledby="online-features-title online-section">
            <h2 id="online-features-title">ПОПУЛЯРНОСТЬ УДАЛЕННЫХ ФОРМАТОВ</h2>
            <p class="driving-content__text">
              Все актуальнее становится посещение школ, вузов и других учебных заведений без личного контакта. Многие
              зарубежные университеты выбирают подобный вариант для удобства учащихся, приэтом такие дипломы ценятся
              так же, как и при очных уроках.
            </p>
            <p class="driving-content__text">
              У нас вы получите все необходимые знания для управления автомобилем любой категории. Вам выгодно изучать
              теорию в домашних условиях, если:
            </p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                Должность предполагает плавающий график, и сложно подстроиться под лекции.
              </li>
              <li class="driving-content__list-item">
                Являетесь студентом, который совмещает учёбу и трудовую деятельность.
              </li>
              <li class="driving-content__list-item">Очень заняты своей работой и не можете посещать уроки лично.</li>
              <li class="driving-content__list-item">
                Находитесь в декрете по уходу за ребёнком, но очень хотите получить автомобильное удостоверение
                для удобства передвижений по поликлиникам, садикам и кружкам.
              </li>
            </ul>
            <p class="driving-content__text">
              Посещение будет не по строгому графику, как в обычном формате, а в удобное для вас время. Ученик
              составляет индивидуальное расписание — начало и продолжительность урока, количество перерывов,объём
              ежедневного изучения и так далее. Главный плюс — вы не будете от кого‑то зависеть и сможете выработать
              индивидуальный режим.
            </p>
          </section>

          <section aria-labelledby="online-useful-title online-section">
            <h2 id="online-useful-title">ЧТО НУЖНО ДЛЯ ОНЛАЙН-ОбуЧЕНИЯ В АВТОШКОЛЕ</h2>
            <p class="driving-content__text">
              Для прохождения занятий потребуются лишь ноутбук, ПК, телефон или планшет с интернетом и несколько часов
              в неделю. Мы, в свою очередь, предоставляем вам электронные материалы для проработки ивозможность контакта
              с учителями, которые всегда дают обратную связь, делятся знаниями и внимательно проверяют выполненные
              задания.
            </p>
          </section>

          <section aria-labelledby="driving-benefits-title driving-section">
            <h2 id="driving-benefits-title">ПОРЯДОК ПОДГОТОВКИ</h2>

            <p class="driving-content__text">
              После заключения договора вы регистрируетесь на обучающей платформе (по полученным на почту данным)
              и получаете неограниченный доступ к видеоурокам.
            </p>

            <p class="driving-content__text">
              Для самоконтроля после каждого блока с материалами есть билеты ПДД и пример финального тестирования.
            </p>
            <p class="driving-content__text">
              Далее сдаёте внутренний экзамен по теории. При успешном результате — практику на автодроме, а после —
              в ГИБДД.
            </p>
          </section>

          <section aria-labelledby="driving-why-title driving-section">
            <h2 id="driving-why-title">КАК ЗАПИСАТЬСЯ НА ОНЛАЙН-АВТОКУРСЫ В ВОРОНЕЖЕ</h2>
            <p class="driving-content__text">
              Чтобы оставить заявку, достаточно прийти к нам в офис по адресу улица Плехановская, дом. 35, 2 этаж.
            </p>
            <p class="driving-content__text">
              С собой требуется иметь паспорт и 1 тыс. рублей для авансового платежа. Оплатить занятия можно с помощью
              внутренней рассрочки, без переплат.
            </p>
            <p class="driving-content__text">
              Также в течение 2 недель после начала уроков вам будет нужно предоставить медицинскую справку.
            </p>
            <p class="driving-content__text">
              С 2003 года наша школа открывает свои двери будущим водителям. Занятия проводят профессиональные
              преподаватели и инструкторы, обладающие огромным практическим опытом в наставничестве иуправлении
              ТС в различных условиях. В нашей онлайн-автошколе вы сможете учиться на курсах с дистанционным обучением
              для подготовки автомобилистов любых категорий по выгодным ценам. Набор напрограммы идёт круглый год.
              Всю дополнительную информацию вы можете получить по телефону: 8 (473) 269–00–00.
            </p>
          </section>
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
      <section class="page-section remote container">
        <h2 class="remote__title">Дистанционное обучение</h2>
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
