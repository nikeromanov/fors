<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Иванов Иван Иванович — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Карточка инструктора"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section instructor-detail" aria-labelledby="instructor-title">
        <div class="instructor-detail__header">
          <div class="instructor-detail__photo">
            <picture>
              <source type="image/webp" srcset="assets/img/instructors/instructor.webp" />
              <img
                src="assets/img/instructors/instructor.webp"
                alt="Иванов Иван Иванович"
                class="instructor-detail__image"
                width="538"
                height="650"
                loading="eager"
              />
            </picture>
            <a href="#" class="btn btn--primary btn--medium">Записаться к этому инструктору</a>
          </div>

          <div class="instructor-detail__info">
            <h1 class="instructor-detail__title" id="instructor-title">
              Иванов
              <br />
              Иван Иванович
            </h1>

            <div class="instructor-detail__content">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
              </p>

              <p>
                deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>

            <div class="instructor-detail__specs">
              <h2 class="instructor-detail__specs-title">Информация</h2>
              <dl class="instructor-detail__specs-list">
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Стаж вождения:</dt>
                  <dd class="instructor-detail__spec-value">25 лет</dd>
                </div>
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Стаж преподавания:</dt>
                  <dd class="instructor-detail__spec-value">10 лет</dd>
                </div>
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Категории обучения:</dt>
                  <dd class="instructor-detail__spec-value">A, B, C</dd>
                </div>
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Автомобиль:</dt>
                  <dd class="instructor-detail__spec-value">VW Polo</dd>
                </div>
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Средняя оценка:</dt>
                  <dd class="instructor-detail__spec-value">4,7</dd>
                </div>
                <div class="instructor-detail__spec">
                  <dt class="instructor-detail__spec-label">Филиалы:</dt>
                  <dd class="instructor-detail__spec-value">Центральный</dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </section>

      <!-- Секция отзывов -->
      <section class="page-section reviews-section" aria-labelledby="reviews-title">
        <h2 class="reviews-section__title" id="reviews-title">Отзывы учеников</h2>

        <div class="swiper reviews-slider" aria-label="Отзывы учеников">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Татьяна Дверцова</span>
                <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
                <p class="reviews-card__review-text">
                  Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
                  слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
                  оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Татьяна Дверцова</span>
                <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
                <p class="reviews-card__review-text">
                  В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Татьяна Дверцова</span>
                <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
                <p class="reviews-card__review-text">
                  Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
                  слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
                  оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Татьяна Дверцова</span>
                <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
                <p class="reviews-card__review-text">
                  В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Иван Петров</span>
                <time class="reviews-card__date" datetime="2024-08-01T10:20">01.08.2024 | 10:20</time>
                <p class="reviews-card__review-text">
                  Отличная автошкола! Все преподаватели профессионалы своего дела. Сдал экзамен с первого раза благодаря
                  качественному обучению.
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Мария Сидорова</span>
                <time class="reviews-card__date" datetime="2024-08-15T14:45">15.08.2024 | 14:45</time>
                <p class="reviews-card__review-text">
                  Очень довольна обучением! Инструктор терпеливый и внимательный. Все объяснял понятно и доходчиво.
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Алексей Николаев</span>
                <time class="reviews-card__date" datetime="2024-09-03T09:15">03.09.2024 | 09:15</time>
                <p class="reviews-card__review-text">
                  Рекомендую всем! Удобный график занятий, современные автомобили, опытные инструкторы. Все на высшем
                  уровне!
                </p>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="reviews-card">
                <span class="reviews-card__author">Ольга Смирнова</span>
                <time class="reviews-card__date" datetime="2024-09-20T16:30">20.09.2024 | 16:30</time>
                <p class="reviews-card__review-text">
                  Прекрасная автошкола! Получила права с первого раза. Спасибо всей команде за профессионализм и
                  поддержку на всех этапах обучения.
                </p>
              </article>
            </div>
          </div>
        </div>

        <!-- Пагинация отзывов -->
        <div class="slider__navigation">
          <div class="slider__progress-bar">
            <div class="slider__progress-line reviews-slider__progress-line"></div>
          </div>
          <div class="slider__page-info">
            <button
              class="slider__nav-btn reviews-slider__nav-btn--prev"
              type="button"
              aria-label="Предыдущая страница"
            >
              <span class="ui-icon slider__nav-icon" data-icon="left-arrow" aria-hidden="true"></span>
            </button>
            <span class="slider__page-counter">
              <span class="slider__page-current reviews-slider__page-current">1</span>
              <span class="slider__page-divider">/</span>
              <span class="slider__page-total reviews-slider__page-total">3</span>
            </span>
            <button class="slider__nav-btn reviews-slider__nav-btn--next" type="button" aria-label="Следующая страница">
              <span class="ui-icon slider__nav-icon" data-icon="right-arrow" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </section>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
