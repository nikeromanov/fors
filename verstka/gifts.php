<?php
$pageTitle = "Автошкола Форсаж — Подарочные сертификаты";
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
      "Главная", "url" => "/"], ["title" => "Подарочные сертификаты"]]; include __DIR__ . "/includes/breadcrumbs.php";
      ?>

      <section class="page-section page-section__flex" aria-labelledby="gifts-title">
        <div class="split-banner">
          <div class="split-banner__content driving__banner-content">
            <h1 class="driving__title" id="driving-title">Подарочные сертификаты</h1>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/gifts.webp" />
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

        <p class="gifts__subtitle">
          В нашей школе в Воронеже у вас есть возможность приобрести подарочные сертификаты на обучение по категориям A,
          B, C, D, E на любую сумму. Он действует в течение года с момента приобретения. Такой подарок точно
          не останется без внимания инадолго запомнится.
        </p>
      </section>

      <section class="page-section page-section__flex gifts__why" aria-labelledby="gifts__why-title">
        <h2 class="page-section__title" id="gifts__why-title">Почему именно мы</h2>

        <ul class="why-list">
          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="cars"></span>

            <h3 class="why-list__title">Собственный автопарк, где более 50 машин</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="race"></span>

            <h3 class="why-list__title">Свой автодром</h3>
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
            <span class="ui-icon" aria-hidden="true" data-icon="network"></span>

            <h3 class="why-list__title">Учебные классы в каждом районе города</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="fast"></span>

            <h3 class="why-list__title">Есть возможность пройти ускоренные автокурсы</h3>
          </li>

          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor"></span>

            <h3 class="why-list__title">Изучение теории онлайн</h3>
          </li>
          <li class="why-list__item why-list__item--text gifts__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="pad"></span>

            <h3 class="why-list__title">индивидуальный график Вождения</h3>
          </li>
        </ul>

        <div class="ui-table-wrapper">
          <table class="ui-table">
            <thead>
              <tr>
                <th scope="col">название</th>
                <th scope="col">описание</th>
                <th scope="col">цена</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  <span class="ui-table__text">Стартовый</span>
                </th>
                <td>10 часов вождения</td>
                <td><span class="ui-table__text">от 8 000₽</span></td>

                <td><a class="btn btn--secondary btn--small">Оформить</a></td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="ui-table__text">Базовый</span>
                </th>
                <td>Полное обучение</td>
                <td><span class="ui-table__text">от 12 000₽</span></td>

                <td><a class="btn btn--secondary btn--small">Оформить</a></td>
              </tr>
              <tr>
                <th scope="row">
                  <span class="ui-table__text">Максимальный</span>
                </th>
                <td>Полное обучение + 20 часов дополнительного вождения</td>
                <td><span class="ui-table__text">от 20 000₽</span></td>

                <td><a class="btn btn--secondary btn--small">Оформить</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="page-section page-section__flex">
        <h2 class="section-title section-title--center" id="steps-title">Как работает подарочный сертификат</h2>
        <?php include __DIR__ . "/includes/steps.php"; ?>
      </section>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/swiper-bundle.min.js"></script>
    <script defer src="assets/js/app.js"></script>
  </body>
</html>
