<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Инструкторы — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Инструкторы"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex instructors" aria-labelledby="instructors-title">
        <h2 class="instructors__title" id="instructors-title">Инструкторы</h2>
        <p class="instructors__subtitle">
          Инструкторы по вождению автомобиля в Воронеже предоставляют комфортное и эффективное преподавание — обратитесь
          за услугами к автоинструкторам «Форсаж» и получите быструю и качественную учёбу по доступной стоимости.
        </p>

        <!-- Слайдер инструкторов -->
        <div class="swiper instructors__slider" aria-label="Наши инструкторы">
          <div class="swiper-wrapper">
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="swiper-slide instructors__slide">
              <a href="#" class="instructors__card">
                <picture>
                  <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
                  <img
                    src="assets/img/instructors/instructor.webp"
                    alt="Инструктор автошколы"
                    class="instructors__image"
                    loading="lazy"
                    width="315"
                    height="450"
                  />
                </picture>
                <div class="instructors__info">
                  <h3 class="instructors__name">
                    Усков
                    <br />
                    Валерий
                    <br />
                    Владимирович
                  </h3>
                  <div class="instructors__meta">
                    <div class="instructors__rating">
                      <span class="ui-icon instructors__rating-icon" aria-hidden="true" data-icon="star"></span>
                      <span class="instructors__rating-value">4,0</span>
                    </div>
                    <div class="instructors__reviews">
                      <span class="ui-icon instructors__reviews-icon" aria-hidden="true" data-icon="rews"></span>
                      <span class="instructors__reviews-count">99</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <!-- Кастомная пагинация с прогресс-баром -->
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line instructors__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button class="slider__nav-btn instructors__nav-btn--prev" type="button" aria-label="Предыдущая страница">
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current instructors__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total instructors__page-total">2</span>
            </span>
            <button class="slider__nav-btn instructors__nav-btn--next" type="button" aria-label="Следующая страница">
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </section>

      <section class="page-section about-highlights" aria-labelledby="about-highlights-title">
        <h2 class="about-highlights__title" id="about-highlights-title">Преимущества нашей школы</h2>
        <ul class="about-highlights__grid">
          <li class="about-highlights__card about-highlights__card--accent">
            <h3 class="about-highlights__card-title">01.</h3>
            <p class="about-highlights__card-text">Обучение в удобное время</p>
          </li>
          <li class="about-highlights__card about-highlights__card--car" aria-hidden="true">
            <picture>
              <source type="image/webp" srcset="assets/img/advantages/car4.webp" />
              <img
                src="assets/img/advantages/car4.webp"
                alt="машина"
                class="about-highlights__card-image"
                width="315"
                height="315"
                loading="lazy"
              />
            </picture>
          </li>
          <li class="about-highlights__card">
            <h3 class="about-highlights__card-title">02.</h3>
            <p class="about-highlights__card-text">выбор графика учебы</p>
          </li>
          <li class="about-highlights__card">
            <h3 class="about-highlights__card-title about-highlights__card-title--accent">03.</h3>
            <p class="about-highlights__card-text">Возможность удаленки</p>
          </li>
          <li class="about-highlights__card">
            <h3 class="about-highlights__card-title about-highlights__card-title--accent">04.</h3>
            <p class="about-highlights__card-text">Интересные и продуктивные семинары</p>
          </li>
          <li class="about-highlights__card about-highlights__card--accent">
            <h3 class="about-highlights__card-title">05.</h3>
            <p class="about-highlights__card-text">Прозрачные цены</p>
          </li>
          <li class="about-highlights__card about-highlights__card--accent">
            <h3 class="about-highlights__card-title">06.</h3>
            <p class="about-highlights__card-text">Филиалы в любом районе города</p>
          </li>
          <li class="about-highlights__card about-highlights__card--accent">
            <h3 class="about-highlights__card-title">07.</h3>
            <p class="about-highlights__card-text">Собственный автопарк и автодром</p>
          </li>
          <li class="about-highlights__card about-highlights__card--girl" aria-hidden="true">
            <picture>
              <source type="image/webp" srcset="assets/img/advantages/wheel.webp" />
              <img
                src="assets/img/advantages/wheel.png"
                alt="Руль"
                class="about-highlights__card-image"
                width="315"
                height="315"
                loading="lazy"
              />
            </picture>
          </li>
          <li class="about-highlights__card">
            <h3 class="about-highlights__card-title about-highlights__card-title--accent">08.</h3>
            <p class="about-highlights__card-text">выбор коробки передач</p>
          </li>
        </ul>
      </section>
      <section class="page-section page-section__flex instructors__with" aria-labelledby="instructors-with-title">
        <h2 id="instructors-with-title" class="instructors__with-title">
          Занятия с инструктором по вождению машины в Воронеже
        </h2>
        <p class="instructors__with-text">
          С автошколой «Форсаж» Вы получите возможность даже без опыта смело сидеть за рулем и пройти испытание на любую
          категорию с первого раза. Всего за пять недель наши ученики обретают качественную подготовку, теоретические и
          практические знания для комфортного управления ТС.
        </p>
        <span class="ui-icon instructors__with-icon" aria-hidden="true" data-icon="down-arrow"></span>
        <h3 class="instructors__with-subtitle">Маршруты как на экзамене</h3>
        <p class="instructors__with-subtext">
          На семинарах мы отрабатываем все сложные контрольные участки для вашей уверенности при испытаниях на практике.
        </p>
        <span class="ui-icon instructors__with-icon" aria-hidden="true" data-icon="down-arrow"></span>
        <h3 class="instructors__with-subtitle">Маршруты как на экзамене</h3>
        <p class="instructors__with-subtext">
          На семинарах мы отрабатываем все сложные контрольные участки для вашей уверенности при испытаниях на практике.
        </p>
        <span class="ui-icon instructors__with-icon" aria-hidden="true" data-icon="down-arrow"></span>
        <h3 class="instructors__with-subtitle">Маршруты как на экзамене</h3>
        <p class="instructors__with-subtext">
          На семинарах мы отрабатываем все сложные контрольные участки для вашей уверенности при испытаниях на практике.
        </p>
        <span class="ui-icon instructors__with-icon" aria-hidden="true" data-icon="down-arrow"></span>
      </section>

      <section class="page-section page-section__flex instructors__consult" aria-labelledby="instructors-consult-title">
        <h2 id="instructors-consult-title " class="instructors__consult-title page-section__title">Оставьте заявку</h2>
        <p class="instructors__consult-subtitle">Чтобы приступить к учебе, нужно:</p>
        <ol class="steps__list">
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">01</p>
            <h3 class="steps__title">Выбрать категорию</h3>
            <p class="steps__description">Обучаем управлению ТС любого типа.</p>
          </li>
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">02</p>
            <h3 class="steps__title">Собрать полный пакет документов</h3>
            <p class="steps__description">Их список будет предоставлен вам заблаговременно.</p>
          </li>
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">03</p>
            <h3 class="steps__title">Подписать договор</h3>
            <p class="steps__description">В договоре указываются все условия: сроки, цены.</p>
          </li>
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">04</p>
            <h3 class="steps__title">Пройти теорию</h3>
            <p class="steps__description">
              Вы сами выбираете комфортный способ её прохождения. Учитесь в уютном классе или онлайн.
            </p>
          </li>
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">05</p>
            <h3 class="steps__title">Отработать навыки на автодроме и в городе</h3>
            <p class="steps__description">Вы совершенствуете навыки, предусмотренные программой.</p>
          </li>
          <li class="steps__item">
            <p class="steps__number" aria-hidden="true">06</p>
            <h3 class="steps__title">Сдать внутреннюю аттестацию и экзамен в ГИБДД</h3>
          </li>
        </ol>
        <div class="instructors__consult-container">
          <p class="instructors__consult-text">
            С автошколой «Форсаж» Вы получите возможность даже без опыта смело сидеть за рулем и пройти испытание на
            любую категорию с первого раза. Всего за пять недель наши ученики обретают качественную подготовку,
            теоретические и практические знания для комфортного управления ТС.
          </p>
          <p class="instructors__consult-text">
            С автошколой «Форсаж» Вы получите возможность даже без опыта смело сидеть за рулем и пройти испытание на
            любую категорию с первого раза. Всего за пять недель наши ученики обретают качественную подготовку,
            теоретические и практические знания для комфортного управления ТС.
          </p>
        </div>
      </section>
      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>

      <?php include __DIR__ . "/includes/also.php"; ?>
      <?php include __DIR__ . "/includes/office-map.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
