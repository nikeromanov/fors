<?php
$pageTitle = "Автошкола Форсаж — Машины учебные";
?>
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

    <main tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Машины учебные"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section cars" aria-labelledby="cars-title">
        <h1 class="page-section__title cars__title" id="cars-title">Машины учебные</h1>
        <p class="cars__text cars__intro">
          Обращаясь в «Форсаж», вы гарантированно сможете получить права любой категории. Для качественной отработки
          навыков для вас подготовлены два оборудованных и безопасных автодрома и современные учебные машины автошколы
          отечественных и иностранных моделей с автоматической и механической коробкой передач.
        </p>
      </section>

      <section class="cars-gallery" aria-labelledby="cars-gallery-title">
        <h2 class="page-section__title cars-gallery__title" id="cars-gallery-title">
          Выбери машину на которой хочешь практиковать
        </h2>
        <span class="ui-icon cars-gallery__icon" aria-hidden="true" data-icon="down-arrow"></span>

        <ul class="cars-gallery__list">
          <!-- Car 1: VOLKSWAGEN POLO -->
          <li class="cars-gallery__item">
            <div class="cars-gallery__card">
              <figure class="cars-gallery__image-wrapper">
                <img
                  class="cars-gallery__image"
                  src="./assets/img/cars/1.webp"
                  alt="VOLKSWAGEN POLO"
                  loading="lazy"
                  decoding="async"
                  width="650"
                  height="400"
                />
              </figure>
              <div class="cars-gallery__form" data-car-form>
                <button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
                  <h3 class="cars-gallery__car-name">VOLKSWAGEN POLO</h3>
                  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
                </button>
                <div class="cars-gallery__form-content">
                  <dl class="cars-gallery__specs">
                    <div class="cars-gallery__spec-item">
                      <dt>Объем двигателя:</dt>
                      <dd>1,1/1,5</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Коробка передач:</dt>
                      <dd>МКПП/АКПП</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Год выпуска:</dt>
                      <dd>2014–2019</dd>
                    </div>
                  </dl>
                  <div class="cars-gallery__divider"></div>
                  <form class="cars-gallery__contact-form" action="/submit" method="post">
                    <label class="cars-gallery__form-label" for="car-phone-1">
                      Оставьте свой номер телефона
                      <br />
                      и мы скоро вам перезвоним!
                    </label>
                    <input
                      class="cars-gallery__input"
                      type="tel"
                      id="car-phone-1"
                      name="phone"
                      placeholder="Ваш номер телефона"
                      inputmode="tel"
                      autocomplete="tel"
                      required
                    />
                    <span class="cars-gallery__privacy">
                      Отправляя заявку вы соглашаетесь на обработку персональных данных
                    </span>
                    <button class="btn btn--primary btn--large" type="submit">Практиковать на Volkswagen Polo</button>
                  </form>
                </div>
              </div>
            </div>
          </li>

          <!-- Car 2: Suzuki Van Van -->
          <li class="cars-gallery__item">
            <div class="cars-gallery__card">
              <figure class="cars-gallery__image-wrapper">
                <img
                  class="cars-gallery__image"
                  src="./assets/img/cars/2.webp"
                  alt="Suzuki Van Van"
                  loading="lazy"
                  decoding="async"
                  width="650"
                  height="400"
                />
              </figure>
              <div class="cars-gallery__form" data-car-form>
                <button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
                  <h3 class="cars-gallery__car-name">Suzuki Van Van</h3>
                  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
                </button>
                <div class="cars-gallery__form-content">
                  <dl class="cars-gallery__specs">
                    <div class="cars-gallery__spec-item">
                      <dt>Объем двигателя:</dt>
                      <dd>0,2</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Коробка передач:</dt>
                      <dd>МКПП</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Год выпуска:</dt>
                      <dd>2018–2022</dd>
                    </div>
                  </dl>
                  <div class="cars-gallery__divider"></div>
                  <form class="cars-gallery__contact-form" action="/submit" method="post">
                    <label class="cars-gallery__form-label" for="car-phone-2">
                      Оставьте свой номер телефона
                      <br />
                      и мы скоро вам перезвоним!
                    </label>
                    <input
                      class="cars-gallery__input"
                      type="tel"
                      id="car-phone-2"
                      name="phone"
                      placeholder="Ваш номер телефона"
                      inputmode="tel"
                      autocomplete="tel"
                      required
                    />
                    <span class="cars-gallery__privacy">
                      Отправляя заявку вы соглашаетесь на обработку персональных данных
                    </span>
                    <button class="btn btn--primary btn--large" type="submit">Практиковать на Suzuki Van Van</button>
                  </form>
                </div>
              </div>
            </div>
          </li>

          <!-- Car 3: Hyundai HD78 -->
          <li class="cars-gallery__item">
            <div class="cars-gallery__card">
              <figure class="cars-gallery__image-wrapper">
                <img
                  class="cars-gallery__image"
                  src="./assets/img/cars/3.webp"
                  alt="Hyundai HD78"
                  loading="lazy"
                  decoding="async"
                  width="650"
                  height="400"
                />
              </figure>
              <div class="cars-gallery__form" data-car-form>
                <button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
                  <h3 class="cars-gallery__car-name">Hyundai HD78</h3>
                  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
                </button>
                <div class="cars-gallery__form-content">
                  <dl class="cars-gallery__specs">
                    <div class="cars-gallery__spec-item">
                      <dt>Объем двигателя:</dt>
                      <dd>3,9</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Коробка передач:</dt>
                      <dd>МКПП</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Год выпуска:</dt>
                      <dd>2015–2020</dd>
                    </div>
                  </dl>
                  <div class="cars-gallery__divider"></div>
                  <form class="cars-gallery__contact-form" action="/submit" method="post">
                    <label class="cars-gallery__form-label" for="car-phone-3">
                      Оставьте свой номер телефона
                      <br />
                      и мы скоро вам перезвоним!
                    </label>
                    <input
                      class="cars-gallery__input"
                      type="tel"
                      id="car-phone-3"
                      name="phone"
                      placeholder="Ваш номер телефона"
                      inputmode="tel"
                      autocomplete="tel"
                      required
                    />
                    <span class="cars-gallery__privacy">
                      Отправляя заявку вы соглашаетесь на обработку персональных данных
                    </span>
                    <button class="btn btn--primary btn--large" type="submit">Практиковать на Hyundai HD78</button>
                  </form>
                </div>
              </div>
            </div>
          </li>

          <!-- Car 4: Ford Transit -->
          <li class="cars-gallery__item">
            <div class="cars-gallery__card">
              <figure class="cars-gallery__image-wrapper">
                <img
                  class="cars-gallery__image"
                  src="./assets/img/cars/4.webp"
                  alt="Ford Transit"
                  loading="lazy"
                  decoding="async"
                  width="650"
                  height="400"
                />
              </figure>
              <div class="cars-gallery__form" data-car-form>
                <button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
                  <h3 class="cars-gallery__car-name">Ford Transit</h3>
                  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
                </button>
                <div class="cars-gallery__form-content">
                  <dl class="cars-gallery__specs">
                    <div class="cars-gallery__spec-item">
                      <dt>Объем двигателя:</dt>
                      <dd>2,2</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Коробка передач:</dt>
                      <dd>МКПП</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Год выпуска:</dt>
                      <dd>2012–2018</dd>
                    </div>
                  </dl>
                  <div class="cars-gallery__divider"></div>
                  <form class="cars-gallery__contact-form" action="/submit" method="post">
                    <label class="cars-gallery__form-label" for="car-phone-4">
                      Оставьте свой номер телефона
                      <br />
                      и мы скоро вам перезвоним!
                    </label>
                    <input
                      class="cars-gallery__input"
                      type="tel"
                      id="car-phone-4"
                      name="phone"
                      placeholder="Ваш номер телефона"
                      inputmode="tel"
                      autocomplete="tel"
                      required
                    />
                    <span class="cars-gallery__privacy">
                      Отправляя заявку вы соглашаетесь на обработку персональных данных
                    </span>
                    <button class="btn btn--primary btn--large" type="submit">Практиковать на Ford Transit</button>
                  </form>
                </div>
              </div>
            </div>
          </li>

          <!-- Car 5: Hyundai HD78 с прицепом -->
          <li class="cars-gallery__item">
            <div class="cars-gallery__card">
              <figure class="cars-gallery__image-wrapper">
                <img
                  class="cars-gallery__image"
                  src="./assets/img/cars/5.webp"
                  alt="Hyundai HD78 с прицепом"
                  loading="lazy"
                  decoding="async"
                  width="650"
                  height="400"
                />
              </figure>
              <div class="cars-gallery__form" data-car-form>
                <button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
                  <h3 class="cars-gallery__car-name">Hyundai HD78 с прицепом</h3>
                  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
                </button>
                <div class="cars-gallery__form-content">
                  <dl class="cars-gallery__specs">
                    <div class="cars-gallery__spec-item">
                      <dt>Объем двигателя:</dt>
                      <dd>3,9</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Коробка передач:</dt>
                      <dd>МКПП</dd>
                    </div>
                    <div class="cars-gallery__spec-item">
                      <dt>Год выпуска:</dt>
                      <dd>2016–2021</dd>
                    </div>
                  </dl>
                  <div class="cars-gallery__divider"></div>
                  <form class="cars-gallery__contact-form" action="/submit" method="post">
                    <label class="cars-gallery__form-label" for="car-phone-5">
                      Оставьте свой номер телефона
                      <br />
                      и мы скоро вам перезвоним!
                    </label>
                    <input
                      class="cars-gallery__input"
                      type="tel"
                      id="car-phone-5"
                      name="phone"
                      placeholder="Ваш номер телефона"
                      inputmode="tel"
                      autocomplete="tel"
                      required
                    />
                    <span class="cars-gallery__privacy">
                      Отправляя заявку вы соглашаетесь на обработку персональных данных
                    </span>
                    <button class="btn btn--primary btn--large" type="submit">Практиковать на Hyundai HD78</button>
                  </form>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
