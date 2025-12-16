<?php
$pageTitle = "Автошкола Форсаж — Курс экстремального вождения";
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
      "Главная", "url" => "/"], ["title" => "Курс экстремального вождения"]]; include __DIR__ .
      "/includes/breadcrumbs.php"; ?>

      <section class="page-section driving" aria-labelledby="driving-title">
        <div class="split-banner">
          <div class="split-banner__content driving__banner-content">
            <h1 class="driving__title" id="driving-title">Курс экстремального вождения</h1>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/extreme.webp" />
              <img
                src="assets/img/banners/driving.webp"
                alt="Вождение"
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure>
        </div>
      </section>

      <div class="driving-layout">
        <aside class="driving-sidebar" aria-labelledby="driving-sidebar-title">
          <h2 class="driving-sidebar__title" id="driving-sidebar-title">Курсантам:</h2>
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
          <section aria-labelledby="driving-intro-title driving-section">
            <h2 class="u-visually-hidden" id="driving-intro-title">Введение</h2>
            <p class="driving-content__text">
              Автошкола «Форсаж» предлагает пройти курсы экстремального вождения в Воронеже по выгодной цене.
              Это позволит вам чувствовать себя более уверенными за рулём, быть готовыми к различным экстренным случаям
              на дороге.
            </p>
          </section>

          <section aria-labelledby="extreme-features-title">
            <h2 id="extreme-features-title">Особенности</h2>
            <p class="driving-content__intro-text">
              Стандартное обучение управлению автомобилем даёт базовые навыки и знания, которые необходимы для езды
              в безаварийном режиме в нормальной дорожной обстановке. Однако придвижении могут возникать разные опасные
              ситуации, от которых, к сожалению, никто не застрахован. К ним следует быть готовыми. Надо уметь вовремя
              сориентироваться, выполнитьправильные действия, которые позволят уйти от опасности.
            </p>
            <p class="driving-content__text">
              Конечно, этому можно научиться и самостоятельно, но нужно будет проехать десятки тысяч километров.
              Мы же предлагаем водителям получить опыт и навыки быстрее под чутким контролем инструкторов нашей
              автошколы.
            </p>
            <p class="driving-content__text">
              Они искусственным образом создадут экстремальные ситуации, которые достаточно часто происходят в реальной
              жизни, и покажут, как из них выходить. Вы можете обучаться только на своеймашине. Этот вариант
              предпочтительнее, так как каждое транспортное средство ведёт себя по‑разному, а вам нужно почувствовать
              именно собственный автомобиль.
            </p>
          </section>

          <section aria-labelledby="extreme-useful-title driving-section">
            <h2 id="extreme-useful-title">Чему научитесь на курсах экстрим-вождения</h2>
            <p class="driving-content__text">
              После обучения, которое проводится преимущественно в зимнее время, вы сможете:
            </p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">спокойно двигаться по мокрой или обледенелой дороге;</li>
              <li class="driving-content__list-item">соблюдать безопасную дистанцию;</li>
              <li class="driving-content__list-item">
                выбирать подходящий для времени года скоростной режим, не подвергая себя и окружающих опасности;
              </li>
              <li class="driving-content__list-item">оперативно реагировать на текущую дорожную обстановку;</li>
              <li class="driving-content__list-item">
                следить за сцеплением с трассой, сразу же определять занос и возвращаться в стабильное состояние;
              </li>
              <li class="driving-content__list-item">
                подбирать правильную технику поворотов и торможения на заледенелых магистралях;
              </li>
              <li class="driving-content__list-item">беспроблемно проходить неровности на пути;</li>
              <li class="driving-content__list-item">
                чувствовать себя значительно увереннее за рулем, что снизит риск ДТП.
              </li>
            </ul>
            <p class="driving-content__text">
              Кроме того, во время обучения вы испытаете острые ощущения. Таким образом, приобретете не только навыки,
              но и сможете получить яркие впечатления.
            </p>
          </section>

          <section aria-labelledby="extreme-price-title driving-section">
            <h2 id="extreme-price-title">Стоимость</h2>

            <p class="driving-content__text">
              Мы предлагаем курсантам честные цены. Нет скрытых платежей и комиссий. После подписания договора ничего не
              придется оплачивать дополнительно. Наши расценки:
            </p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                Персональный урок 60 минут — 2 тыс. ₽ (автоинструктор сидит в машине с обучающимся).
              </li>
              <li class="driving-content__list-item">
                Комплексный курс по контраварийной подготовке — 8 тыс. ₽ (теория и 2 дня индивидуальной практики
                автодроме с инструктором по 2 часа).
              </li>
              <li class="driving-content__list-item">
                Стоимость одного занятия на своём автомобиле — 1 час руления 2 000 ₽.
              </li>
            </ul>
          </section>

          <section aria-labelledby="extreme-why-title driving-section">
            <h2 id="extreme-why-title">Почему стоит записаться в нашу автошколу</h2>
            <p>Мы имеем следующие преимущества:</p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                Существуем более 20 лет — компания основана в 2003 г.. Обучили около 70 000 водителей. У нас учатся
                поколениями: родители, которые пользовались услугами, приводят потом своих детей.Это говорит о высоком
                качестве занятий, надёжности и добропорядочности.
              </li>
              <li class="driving-content__list-item">
                Предлагаем адекватные расценки. Мы стараемся держать их на конкурентоспособном уровне. Сделать стоимость
                ещё более выгодной возможно при помощи налогового вычета.Предоставим для него все необходимые документы.
              </li>
              <li class="driving-content__list-item">
                У нас работают лучшие инструкторы с многолетним опытом преподавания. Вы можете быть уверены,
                что находитесь в надёжных руках.
              </li>
            </ul>
            <p class="driving-content__text">
              Чтобы пройти курс контраварийного вождения в нашей школе в Воронеже, заполните электронную форму
              для обратной связи на сайте. Менеджер свяжется с вами в течение рабочего дня ирасскажем обо всем
              подробнее.
            </p>
          </section>
        </div>
      </div>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/swiper-bundle.min.js"></script>
    <script defer src="assets/js/app.js"></script>
  </body>
</html>
