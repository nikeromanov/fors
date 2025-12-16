<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Оплата — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Оплата"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex payment" aria-labelledby="payment-title">
        <div class="split-banner">
          <div class="split-banner__content online__banner-content">
            <h1 class="online__title" id="payment-title">Оплата</h1>
          </div>
          <figure class="split-banner__image-wrapper">
            <picture>
              <source type="image/webp" srcset="assets/img/banners/payment.webp" />
              <img
                src="assets/img/banners/payment.webp"
                alt="Оплата"
                class="split-banner__image"
                loading="lazy"
                width="646"
                height="447"
              />
            </picture>
          </figure>
        </div>
      </section>
      <section class="page-section page-section__flex payment-info" aria-labelledby="payment-info-title">
        <h2 class="page-section__title" id="payment-info-title">Оплата обучения</h2>
        <p class="payment-info__text">
          При заключении договора вы можете внести любую сумму, но не менее 1 000 ₽, так же вы можете полностью оплатить
          обучение.
        </p>
        <p class="payment-info__text">
          При внесении частичной оплаты/минимального платежа у вас есть 21 день с момента заключения договора,
          чтобы оплатить остаток суммы.
        </p>
        <p class="payment-info__text">Каким способом можно оплатить обучение?</p>
        <ul class="payment-info__list">
          <li class="payment-info__item">Наличными, в офисе автошколы на ул. Плехановской, 35 (ост. Кольцовская)</li>
          <li class="payment-info__item">На расчетный счет организации, реквизиты можно получить в офисе.</li>
        </ul>
      </section>
      <section class="page-section page-section__flex payment-methods" aria-labelledby="payment-methods-title">
        <h2 class="page-section__title" id="payment-methods-title">Оплата обучения</h2>
        <p class="payment-info__text">
          Возврат, в каждом случае, рассматривается индивидуально. Для этого нужно обратиться в главный офис(ул.
          Плехановская, 35) и написать заявление.
        </p>
        <p class="payment-info__text">Заявление рассматривается 10 рабочих дней.</p>
      </section>
      <?php include __DIR__ . "/includes/form_consult.php"; ?>
      <?php include __DIR__ . "/includes/categories_and_prices.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
