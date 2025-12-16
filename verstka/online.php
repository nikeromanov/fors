<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Обучение онлайн — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Обучение онлайн"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex online" aria-labelledby="online-title">
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
              <source type="image/webp" srcset="assets/img/banners/online.webp" />
              <img
                src="assets/img/banners/online.webp"
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

      <?php include __DIR__ . "/includes/advantages.php"; ?>

      <div class="driving-layout">
        <aside class="driving-sidebar" aria-labelledby="online-sidebar-title">
          <h2 class="driving-sidebar__title" id="online-sidebar-title">Курсантам:</h2>
          <nav class="driving-sidebar__nav" aria-label="Навигация для курсантов">
            <ul class="driving-sidebar__list">
              <li><a href="/autodrome.php" class="driving-sidebar__link">Автодром</a></li>
              <li><a href="#" class="driving-sidebar__link">Отзывы</a></li>
              <li><a href="/price.php" class="driving-sidebar__link">Категории и цены</a></li>
              <li><a href="#" class="driving-sidebar__link">Наши документы</a></li>
              <li><a href="#" class="driving-sidebar__link">Инструкторы по вождению</a></li>
            </ul>
          </nav>
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

      <?php include __DIR__ . "/includes/driving_courses_table.php"; ?>
      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <section class="page-section remote">
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
              <source type="image/webp" srcset="assets/img/banners/online.webp" />
              <img
                src="assets/img/banners/online.webp"
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

      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
