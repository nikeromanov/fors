<?php
$pageTitle = "Автодром — Автошкола Форсаж"; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8"); ?></title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>

  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Автодром"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section autodrome" aria-labelledby="autodrome-title">
        <h1 id="autodrome-title" class="page-section__title">Автодром</h1>
        <div class="split-banner">
          <div class="split-banner__content autodrome-banner__content">
            <p class="split-banner__description autodrome-banner__description">
              Автошкола «Форсаж» предлагает эффективное обучение вождению в Воронеже на собственном оборудованном
              автодроме, расположенном по адресу:
            </p>

            <ul class="office-map__locations">
              <li class="office-map__locations-item">
                <span class="office-map__locations-item-wrapper">
                  <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
                  ул. Обручева, 3
                </span>
                <span class="office-map__locations-description">(Левобережный р-н)</span>
              </li>
              <li class="office-map__locations-item">
                <span class="office-map__locations-item-wrapper">
                  <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
                  ул. Антонова-Овсеенко, 22Б
                </span>

                <span class="office-map__locations-description">(авторынок, остановка Переезд)</span>
              </li>
            </ul>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/autodrome.webp" />
              <img
                src="assets/img/banners/autodrome.webp"
                alt="Баннер с девушками"
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure>
        </div>
      </section>

      <section class="page-section autodrome" aria-labelledby="autodrome-features-title">
        <h2 class="autodrome-features__title page-section__title" id="autodrome-features-title">Особенности</h2>

        <div class="autodrome-features__content">
          <article>
            <p>
              На подготовительном этапе курсанты отрабатывают все упражнения, требуемые для получения водительского
              удостоверения. Инструкторы помогают контролировать скорость манёвров, точность действий и работу с
              педалями, чтобы вы уверенно чувствовали автомобиль в любых условиях.
            </p>
            <p>
              После каждой тренировки мы анализируем ошибки и закрепляем правильные алгоритмы. Когда навыки доведены до
              автоматизма на закрытой площадке, учащиеся переходят к занятиям в городе, где продолжают практику под
              присмотром наставника.
            </p>
          </article>

          <article>
            <p>
              Автодром оборудован разметкой и элементами, полностью повторяющими экзаменационные задания. Закрытая
              территория позволяет безопасно отработать сложные манёвры и подготовиться к реальным дорожным ситуациям.
            </p>
            <p>
              Для каждого упражнения предусмотрено несколько вариаций, а освещение площадки помогает тренироваться в
              тёмное время суток. Это даёт ученикам реальную практику и уверенность перед экзаменом в ГИБДД.
            </p>
          </article>
        </div>

        <h3 class="autodrome-exercises__title" id="autodrome-exercises-title">Основные упражнения на полигоне:</h3>
        <ul class="badge-list" role="list">
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="parking"></span>
            </div>
            <p class="badge-list__description">Параллельная парковка</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="estocade"></span>
            </div>
            <p class="badge-list__description">Трогание на подъеме</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="garage"></span>
            </div>
            <p class="badge-list__description">Въезд в бокс</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="turn"></span>
            </div>
            <p class="badge-list__description">Разворот</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="snake"></span>
            </div>
            <p class="badge-list__description">«Змейка»</p>
          </li>
        </ul>
      </section>

      <section class="page-section gallery-slider" aria-labelledby="autodrome-gallery-title">
        <h2 class="gallery-slider__title" id="autodrome-gallery-title">Галерея</h2>

        <!-- bx:autodrome-gallery-slider -->
        <div class="swiper gallery-slider__slider" aria-label="Галерея автодрома">
          <div class="swiper-wrapper">
            <div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="assets/img/autodrome/1.webp"
                  data-fancybox="autodrome-gallery"
                  data-caption="Учебный автомобиль на площадке автодрома"
                >
                  <picture>
                    <source type="image/webp" srcset="assets/img/autodrome/1.webp" />
                    <img
                      src="assets/img/autodrome/1.webp"
                      alt="Учебный автомобиль на площадке автодрома"
                      width="650"
                      height="415"
                      loading="lazy"
                      decoding="async"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden">Учебный автомобиль на площадке автодрома</figcaption>
              </figure>
            </div>

            <div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="assets/img/autodrome/1.webp"
                  data-fancybox="autodrome-gallery"
                  data-caption="Практическое занятие с инструктором"
                >
                  <picture>
                    <source type="image/webp" srcset="assets/img/autodrome/1.webp" />
                    <img
                      src="assets/img/autodrome/1.webp"
                      alt="Практическое занятие с инструктором"
                      width="650"
                      height="415"
                      loading="lazy"
                      decoding="async"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden">Практическое занятие с инструктором</figcaption>
              </figure>
            </div>

            <div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="assets/img/autodrome/1.webp"
                  data-fancybox="autodrome-gallery"
                  data-caption="Группа курсантов на тренировке"
                >
                  <picture>
                    <source type="image/webp" srcset="assets/img/autodrome/1.webp" />
                    <img
                      src="assets/img/autodrome/1.webp"
                      alt="Группа курсантов на тренировке"
                      width="650"
                      height="415"
                      loading="lazy"
                      decoding="async"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden">Группа курсантов на тренировке</figcaption>
              </figure>
            </div>

            <div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="assets/img/autodrome/1.webp"
                  data-fancybox="autodrome-gallery"
                  data-caption="Учебный автомобиль на площадке автодрома"
                >
                  <picture>
                    <source type="image/webp" srcset="assets/img/autodrome/1.webp" />
                    <img
                      src="assets/img/autodrome/1.webp"
                      alt="Учебный автомобиль на площадке автодрома"
                      width="650"
                      height="415"
                      loading="lazy"
                      decoding="async"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden">Учебный автомобиль на площадке автодрома</figcaption>
              </figure>
            </div>

            <div class="swiper-slide gallery-slider__slide">
              <figure class="gallery-slider__item">
                <a
                  href="assets/img/autodrome/1.webp"
                  data-fancybox="autodrome-gallery"
                  data-caption="Практическое занятие с инструктором"
                >
                  <picture>
                    <source type="image/webp" srcset="assets/img/autodrome/1.webp" />
                    <img
                      src="assets/img/autodrome/1.webp"
                      alt="Практическое занятие с инструктором"
                      width="650"
                      height="415"
                      loading="lazy"
                      decoding="async"
                    />
                  </picture>
                </a>
                <figcaption class="u-visually-hidden">Практическое занятие с инструктором</figcaption>
              </figure>
            </div>
          </div>
        </div>
        <!-- /bx:autodrome-gallery-slider -->

        <!-- Кастомная навигация с прогресс-баром -->
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button class="slider__nav-btn slider__nav-btn--prev" type="button" aria-label="Предыдущая страница">
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total">5</span>
            </span>
            <button class="slider__nav-btn slider__nav-btn--next" type="button" aria-label="Следующая страница">
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </section>

      <section class="page-section autodrome-benefits" aria-labelledby="autodrome-benefits-title">
        <h2 class="page-section__title autodrome-benefits__title" id="autodrome-benefits-title">
          Преимущества занятий на нашем автодроме
        </h2>

        <ul class="why-list">
          <li class="why-list__item why-list__item--text autodrome-benefits__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Грамотная подготовка</h3>
              <p class="why-list__description">
                Мы ответственны за своих учеников. Вы сможете сесть за руль только после прохождения теоретических
                курсов, а выехать на городскую трассу — после оттачивания всех навыков на учебной площадке.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text autodrome-benefits__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="cars"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Собственный автодром</h3>
              <p class="why-list__description">И отличный парк автомобилей.</p>
            </div>
          </li>

          <li class="why-list__item why-list__item--image autodrome-benefits__why--item">
            <figure class="why-list__figure">
              <picture>
                <source type="image/webp" srcset="assets/img/advantages/track.webp" />
                <img
                  src="/assets/img/advantages/track.webp"
                  alt="Грузовик"
                  class="why-list__img"
                  loading="lazy"
                  width="315"
                  height="315"
                />
              </picture>
            </figure>
          </li>

          <li class="why-list__item why-list__item--text autodrome-benefits__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="network"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Филиалы в каждом районе города</h3>
              <p class="why-list__description">Ходить на лекции можно в тот, что ближе к дому или работе.</p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text autodrome-benefits__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="driver"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Профессиональные инструкторы</h3>
              <p class="why-list__description">
                Специалисты с большим опытом преподавания, успевшие обучить тысячи студентов.
              </p>
            </div>
          </li>
        </ul>
      </section>

      <section class="page-section autodrome-signup" aria-labelledby="autodrome-signup-title">
        <div class="consult-form">
          <h2 class="consult-form__title" id="consult-title">Как записаться на занятия</h2>
          <p class="consult-form__subtitle">
            Выберите интересующую категорию обучения и позвоните по номеру +7&nbsp;(473)&nbsp;269-00-00 или оформите
            заявку онлайн. Специалист автошколы свяжется с вами, чтобы подтвердить график и ответить на вопросы.
          </p>

          <!-- bx:form-consult -->
          <form class="consult-form__form" action="#" method="post" novalidate>
            <div class="consult-form__fields">
              <div class="consult-form__field">
                <label class="consult-form__label u-visually-hidden" for="consult-name">Ваше имя</label>
                <input
                  class="consult-form__input"
                  type="text"
                  id="consult-name"
                  name="name"
                  placeholder="Ваше имя"
                  autocomplete="name"
                  required
                />
              </div>
              <div class="consult-form__field">
                <label class="consult-form__label u-visually-hidden" for="consult-phone">Ваш номер телефона</label>
                <input
                  class="consult-form__input"
                  type="tel"
                  id="consult-phone"
                  name="phone"
                  placeholder="Ваш номер телефона"
                  inputmode="tel"
                  autocomplete="tel"
                  required
                />
              </div>
            </div>

            <p class="consult-form__notice">Отправляя заявку вы соглашаетесь на обработку персональных данных.</p>

            <button class="btn btn--secondary btn--large" type="submit">Оставить заявку</button>
          </form>
        </div>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script src="assets/js/fancybox.umd.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
