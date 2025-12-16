<?php
$pageTitle = "Автошкола Форсаж — Вождение";
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
      "Главная", "url" => "/"], ["title" => "Вождение"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section driving" aria-labelledby="driving-title">
        <div class="split-banner">
          <div class="split-banner__content driving__banner-content">
            <h1 class="driving__title" id="driving-title">Вождение</h1>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/driving.webp" />
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
            <p class="driving-content__intro-text">
              Практика вождения в автошколе «Форсаж» начинается спустя 3 недели после начала обучения по теории. Сначала
              вы будете отрабатывать навыки на специально оборудованной площадке, а когда почувствуете себя увереннее
              за рулём — поедете в город.
            </p>
            <p class="driving-content__intro-text">
              Каждый человек индивидуален. Одному, чтобы освоить управление автомобилем, требуется несколько уроков.
              Другим не хватает практических часов, которые предусматривает курс. Если вы относитесь ко второму типу,
              мы можем предложить дополнительные занятия. Благодаря им на экзамене и при самостоятельных поездках вы
              будете полностью уверены в своих силах.
            </p>
          </section>

          <section aria-labelledby="driving-features-title driving-section">
            <h2 id="driving-features-title">Особенности прохождения практики в автошколе</h2>
            <p class="driving-content__text">
              Обучение вождению — непростой процесс. Далеко не все курсанты даже при успешном получении водительского
              удостоверения сразу комфортно чувствуют себя за рулём, поэтому просят, чтобы первоевремя с ними рядом
              ездили друзья и родственники. Однако куда результативнее будут тренировки вместе с опытным инструктором
              школы «Форсаж».
            </p>
          </section>

          <section aria-labelledby="driving-useful-title driving-section">
            <h2 id="driving-useful-title">Кому будут полезны дополнительные занятия</h2>
            <p class="driving-content__text">Практические уроки рекомендуется взять:</p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                если в процессе обучения поняли, что ранее купленных часов вам недостаточно;
              </li>
              <li class="driving-content__list-item">
                перед сдачей/пересдачей экзамена в ГИБДД при сомнениях в своих силах.
              </li>
            </ul>
            <p class="driving-content__text">
              Расписание вождения выбираете сами, программа составляется индивидуально. Вы можете отточить свои навыки
              на площадке, выполняя упражнения. Для каждой категории они будут различаться.
            </p>
            <p class="driving-content__text">
              Например, если вы учитесь водить легковой автомобиль, то необходимо освоить «Разворот в ограниченном
              пространстве», «Гараж», «Параллельную парковку», «Эстакаду». Также возможно сразу же отправиться в город,
              чтобы увереннее себя чувствовать в автомобильном потоке. План занятий обговаривается заранее с
              инструктором.
            </p>
          </section>

          <section aria-labelledby="driving-benefits-title driving-section">
            <h2 id="driving-benefits-title">Преимущества дополнительной практики</h2>

            <p class="driving-content__text">Добавочные часы при обучении вождению имеют следующие достоинства:</p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">обеспечивают более результативную отработку навыков;</li>
              <li class="driving-content__list-item">
                дают возможность отточить именно те моменты, которые у вас не получаются;
              </li>
              <li class="driving-content__list-item">
                можете научиться ездить по наиболее актуальным для вас направлениям: дом-работа/учёба, экзаменационные
                маршруты ГИБДД и др.
              </li>
            </ul>
            <p class="driving-content__text">
              Чем больше времени проводите за рулём, тем лучше чувствуете автомобиль. С каждой новой поездкой вы
              становитесь более уверенными, перестаёте нервничать.
            </p>
          </section>

          <section aria-labelledby="driving-why-title driving-section">
            <h2 id="driving-why-title">Почему стоит обратиться именно к нам</h2>
            <p class="driving-content__text">Школа «Форсаж» имеет следующие преимущества:</p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                Доступные расценки. Всегда стараемся держать цены на оптимальном уровне, чтобы все желающие могли
                обучиться вождению.
              </li>
              <li class="driving-content__list-item">
                Высокое качество предоставляемых услуг. Это подтверждается доверием курсантов. Пройдя обучение, потом
                приводят своих детей, так как смогли лично убедиться в нашей надёжности и профессионализме.
              </li>
              <li class="driving-content__list-item">
                Налоговый вычет. Позволит сделать стоимость ещё более привлекательной. Мы предоставим все необходимые
                документы для подачи в ФНС.
              </li>
              <li class="driving-content__list-item">Собственный автопарк. В нем преобладают Volkswagen Polo.</li>
            </ul>
            <p class="driving-content__text">
              Если вы хотите взять дополнительные часы практики, заполните электронную форму для обратной связи на сайте
              нашей автошколы. Мы свяжемся с вами в течение рабочего дня и расскажем обо всемподробнее. Кроме того,
              можете позвонить по номеру +7 (473) 269–00–00 или обратиться к нам в офис по адресу: Воронеж, ул.
              Плехановская, д. 35, 2 этаж.
            </p>
          </section>
        </div>
      </div>

      <?php include __DIR__ . "/includes/driving_courses_table.php"; ?>
      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
