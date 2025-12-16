<?php
$pageTitle = "Цены на обучение в автошколе Форсаж";
$pageDescription = "Цены на курсы вождения в автошколе Форсаж Воронеж. Категории A, B, C, D, E, M. Рассрочка, скидки, акции.";
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>" />
    <meta name="robots" content="index, follow" />
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
      "Главная", "url" => "/"], ["title" => "Цены"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section price-intro" aria-labelledby="price-title">
        <h1 class="price-intro__title u-text-center" id="price-title">Цены на курсы в автошколе</h1>
        <div class="split-banner">
          <div class="split-banner__content">
            <h4 class="split-banner__title">Приведи друга — получи деньги</h4>
            <p class="split-banner__subtitle">Приведи в нашу школу друга и получи 500 ₽!</p>
            <a href="#" class="btn btn--secondary btn--large">Записаться на курс</a>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/girls.webp" />
              <img
                src="assets/img/banners/girls.webp"
                alt="Баннер с девушками"
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure>
        </div>
        <?php include __DIR__ . "/includes/prices-table.php"; ?>
      </section>

      <?php include __DIR__ . "/includes/price-includes.php"; ?>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>

      <?php include __DIR__ . "/includes/price-directions.php"; ?>

      <?php include __DIR__ . "/includes/price-advantages.php"; ?>

      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/swiper-bundle.min.js"></script>
    <script defer src="assets/js/app.js"></script>
  </body>
</html>
