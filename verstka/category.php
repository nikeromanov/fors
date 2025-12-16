<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Категория — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Категория"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex category" aria-labelledby="category-title">
        <h1 class="category__title page-section__title" id="category-title">
          Получите права категории B, B1 за 35 дней — с комфортом и уверенностью!
        </h1>
        <div class="category__container">
          <div class="category__content">
            <ul class="category__features">
              <li class="category__feature">
                <span class="category__bullet"></span>
                Современные учебные авто
              </li>
              <li class="category__feature">
                <span class="category__bullet"></span>
                Профессиональные инструкторы
              </li>
              <li class="category__feature">
                <span class="category__bullet"></span>
                Теория, очно или онлайн
              </li>
              <li class="category__feature">
                <span class="category__bullet"></span>
                Рассрочка, бонусы, экзамен с первого раза
              </li>
            </ul>

            <p class="category__description">
              В автошколе «Форсаж» вы сможете пройти обучение и получить права категории B по выгодной стоимости. Мы
              работаем с 2003 года. Подготовили более 70 000 водителей.
            </p>

            <div class="category__price-block">
              <span class="category__price">9 900 ₽</span>
              <a href="#" class="btn btn--secondary btn--large">Записаться на курс</a>
            </div>
          </div>

          <div class="category__media">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-fancybox class="category__video-link">
              <figure class="category__video">
                <img
                  src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                  alt="Обучение вождению в автошколе Форсаж"
                  class="category__video-thumbnail"
                  width="670"
                  height="443"
                  loading="eager"
                />
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
              </figure>
            </a>
          </div>
        </div>
      </section>
      <section class="page-section page-section__flex gifts__why" aria-labelledby="gifts__why-title">
        <h2 class="page-section__title" id="gifts__why-title">Почему именно мы</h2>

        <ul class="why-list">
          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="hands"></span>

            <h3 class="why-list__title">Официальное обучение в лицензированной автошколе</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="pad"></span>

            <h3 class="why-list__title">Организованная сдача экзамена в ГИБДД практического вождения</h3>
          </li>
          <li class="why-list__item why-list__item--image gifts__why--item">
            <figure class="why-list__figure">
              <picture>
                <source type="image/webp" srcset="assets/img/advantages/car.webp" />
                <img
                  src="assets/img/advantages/car.webp"
                  alt="Грузовик"
                  class="why-list__img"
                  loading="lazy"
                  width="315"
                  height="315"
                />
              </picture>
            </figure>
          </li>
          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="cloud"></span>

            <h3 class="why-list__title">Программы расчитаны на людей с разным уровнем подготовки</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor"></span>

            <h3 class="why-list__title">Больше свободы! График занятий вы составляете сами</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="wallet"></span>

            <h3 class="why-list__title">Поэтапная оплата! Рассрочка оплаты без %</h3>
          </li>
          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="learn"></span>

            <h3 class="why-list__title">Полный комплект качественной экипировки и учебников</h3>
          </li>
        </ul>
        </table>
      </section>
      <section class="category__transmission page-section" aria-labelledby="category-transmission-title">
        <div class="transmission">
          <h2 class="transmission__title" id="category-transmission-title">
            Что выбрать: механическую или автоматическую коробку передач
          </h2>
          <p class="transmission__subtitle">
            У нас возможно отучиться как на МКПП, так и на АКПП. Сказать наверняка, что будет лучше, нельзя. Каждый сам
            выбирает для себя подходящий вариант. Чтобы было проще определиться, перечислим плюсы и минусы обоих видов.
          </p>

          <div class="transmission__groups">
            <!-- АВТОМАТ -->
            <div class="transmission__group">
              <div class="transmission__badge">Автомат</div>

              <div class="transmission__content">
                <div class="transmission__column">
                  <h3 class="transmission__column-title">плюсы:</h3>
                  <ul class="transmission__list">
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      простое управление — подходит даже новичкам, так как нет педали сцепления, её не нужно постоянно
                      выжимать;
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      сокращённый временной отрезок между переключением передач;
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      отсутствие необходимости постоянно переключать скорости вручную — всё происходит плавно и быстро;
                    </li>
                  </ul>
                </div>

                <div class="transmission__column transmission__column--dark">
                  <h3 class="transmission__column-title">минусы:</h3>
                  <ul class="transmission__list">
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      дороже всё: и ремонт, и запчасти; и приобретение набольшая ценовых слабости;
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      отсутствие при необходимости двигателя — клевать сцепу не на состоянии (нужно возить с собой);
                    </li>

                  </ul>
                </div>
              </div>
            </div>

            <!-- МЕХАНИКА -->
            <div class="transmission__group">
              <div class="transmission__badge">Механика</div>

              <div class="transmission__content">
                <div class="transmission__column">
                  <h3 class="transmission__column-title">плюсы:</h3>
                  <ul class="transmission__list">
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      возможность завязать движение всей мощности мотора и игру ускорения;
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      есть шансы при передвижении необходимо — успеть того не за состоянии (надо возит с собой);
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      потери мощности при переключение педалей — клегиот сбавку на всяких дистанции;
                    </li>
                  </ul>
                </div>

                <div class="transmission__column transmission__column--dark">
                  <h3 class="transmission__column-title">минусы:</h3>
                  <ul class="transmission__list">
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      дороже ремонт и запчасти, и приобретение ссылается ценой свиски;
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      отсутствие при необходимости движения — клещена сцепы на соединение (надо взять собой);
                    </li>
                    <li class="transmission__item">
                      <span class="transmission__bullet"></span>
                      потеря доброты при переключении педалью — идёт свободно соединения упорне;
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="transmission__warning">
            <p class="transmission__warning-text">
              Обратите внимание! Если вы предпочтёте обучение на АКПП, полученное водительское удостоверение не позволит
              вам в дальнейшем сесть за авто на механике.
            </p>
          </div>

          <div class="transmission__images">
            <figure class="transmission__image-wrapper">
              <picture>
                <source type="image/webp" srcset="assets/img/category/bike.webp" />
                <img
                  src="assets/img/category/bike.webp"
                  alt="Мотоцикл для обучения"
                  class="transmission__image"
                  loading="lazy"
                  width="650"
                  height="400"
                />
              </picture>
            </figure>
            <figure class="transmission__image-wrapper">
              <picture>
                <source type="image/webp" srcset="assets/img/category/car.webp" />
                <img
                  src="assets/img/category/car.webp"
                  alt="Учебный автомобиль Форсаж"
                  class="transmission__image"
                  loading="lazy"
                  width="650"
                  height="400"
                />
              </picture>
            </figure>
          </div>
        </div>
      </section>

      <section class="page-section page-section__flex category__features-section" aria-labelledby="category-features-title">
        <h2 class="page-section__title" id="category-features-title">Особенности курсов</h2>

        <div class="category__features-grid">
          <div class="category__features-column">
            <p>Они состоят из теоретической и практической части.</p>
            <p>Во время семинаров преподаватель изучит с вами правила дорожного движения. Разберёт нюансы, которые помогут вам лучше и быстрее их запомнить.</p>
            <p>При прохождении практики инструктор научит, как применять полученные знания, сидя за рулём транспортного средства. Покажет вам базовые упражнения, а также манёвры, которые повысят безопасность на дороге.</p>
          </div>
          <div class="category__features-column">
            <p>При открытии категории B в нашей автошколе вы получаете возможность стать водителем легковых автомобилей с разрешённой массой до 3,5 тонн. Кроме того, автоматически у вас откроется подкатегория B1 (трициклы и квадрициклы с автомобильным рулём) и M (мопеды).</p>
            <p>При желании в будущем вы можете обучиться у нас вождению и других транспортных средств: мотоциклов, грузовых машин, автобусов и так далее. У нас возможно учиться с нуля или пройти переквалификацию. Чтобы получить профессиональную консультацию, оставьте заявку на обратный звонок на нашем сайте.</p>
          </div>
        </div>
      </section>

      <section class="page-section page-section__flex category__badges" aria-labelledby="category-badges-title">
        <h2 class="page-section__title" id="category-badges-title">Что входит в обучение на категорию B</h2>
        <p class="category__badges-description">
          У нас прозрачная ценовая политика. В таблице внизу страницы указана полная стоимость. Дополнительные платежи
          отсутствуют. Отдельно вам нужно будет оплатить только прохождение медицинской комиссии и госпошлину.
        </p>

        <ul class="badge-list category__badge-list" role="list">
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="teacher"></span>
            </div>
            <p class="badge-list__description">Лекции</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="catcar"></span>
            </div>
            <p class="badge-list__description">Практика</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="blank"></span>
            </div>
            <p class="badge-list__description">Внутренняя проверка знаний</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="gai"></span>
            </div>
            <p class="badge-list__description">Сдача экзамена в ГИБДД</p>
          </li>
        </ul>
      </section>
      <section class="page-section page-section__flex discount__why">
        <h2 class="discount__section-title page-section__title" id="discount-why-title">
          Преимущества обращения к нам
        </h2>

        <ul class="why-list">
          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="hands"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Опыт работы</h3>
              <p class="why-list__description">
                Мы существуем уже 18 лет, поэтому успели завоевать доверие и лояльность наших учеников и зарекомендовать
                себя в городе.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="wallet"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Прозрачность ценообразования</h3>
              <p class="why-list__description">
                Никаких скрытых комиссий и переплат — вы заплатите ровно ту цену, которая была указана в договоре.
                В стоимость уже включена теория, практические занятия, ГСМ и так далее.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Возможность онлайн-обучения</h3>
              <p class="why-list__description">
                Вы можете проходить теоретические уроки в дистанционном формате в реальном времени.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="cars"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">автопарк и автодром</h3>
              <p class="why-list__description">Собственный автодром и автопарк с современными автомобилями.</p>
            </div>
          </li>

          <li class="why-list__item why-list__item--image discount__why--item">
            <figure class="why-list__figure">
              <picture>
                <source type="image/webp" srcset="assets/img/advantages/girl2.webp" />
                <img
                  src="/assets/img/advantages/girl2.webp"
                  alt="Грузовик"
                  class="why-list__img"
                  loading="lazy"
                  width="315"
                  height="315"
                />
              </picture>
            </figure>
          </li>
        </ul>
      </section>
      <section class="page-section page-section__flex category__table" aria-labelledby="category-table-title">
        <h2 id="category-table-title" class="u-visually-hidden">Таблица цен</h2>

        <div class="ui-table-wrapper">
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
            <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
                  <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="moto-table"></span>
                </div>
                <span class="ui-table__text">Категория A, A1</span>
              </th>
              <td><span class="ui-table__text">7 990 ₽</span></td>
              <td>400 ₽/час вождения</td>
              <td>108 часов входят в стоимость</td>
            </tr>
            <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
                  <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="car-table"></span>
                </div>
                <span class="ui-table__text">Категория B, B1</span>
              </th>
              <td><span class="ui-table__text">10 990 ₽</span></td>
              <td>450 ₽/час вождения</td>
              <td>130 часов входят в стоимость</td>
            </tr>
            <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
                  <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="car-table"></span>
                </div>
                <span class="ui-table__text">Категория B, (АКПП)</span>
              </th>
              <td><span class="ui-table__text">10 990 ₽</span></td>
              <td>500 ₽/час вождения</td>
              <td>130 часов входят в стоимость</td>
            </tr>
            <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
                  <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="truck-table"></span>
                </div>
                <span class="ui-table__text">Категории C, C1</span>
              </th>
              <td><span class="ui-table__text">10 990 ₽</span></td>
              <td>750 ₽/час вождения</td>
              <td>168 часов входят в стоимость</td>
            </tr>
            <tr>
              <th scope="row" class="ui-table__cell">
                <div class="ui-table__icon-container">
                  <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="bus-table"></span>
                </div>
                <span class="ui-table__text">Категория D, D1</span>
              </th>
              <td><span class="ui-table__text">10 990 ₽</span></td>
              <td>800 ₽/час вождения</td>
              <td>192 часа входят в стоимость</td>
            </tr>
          </tbody>
        </table>
        </div>
      </section>

      <?php include __DIR__ . "/includes/also.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>

      <section class="page-section gallery-slider" aria-labelledby="category-gallery-title">
        <h2 class="gallery-slider__title" id="category-gallery-title">Галерея</h2>

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
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script src="assets/js/fancybox.umd.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
