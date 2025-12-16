<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Контакты автошколы Форсаж в Воронеже. Адрес: ул. Плехановская, 35. Телефон: +7 (473) 269-00-00. Режим работы, соцсети."
    />
    <meta name="robots" content="index, follow" />
    <title>Контакты — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Контакты"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex contacts" aria-labelledby="contacts-title">
        <h1 class="contacts__title page-section__title" id="contacts-title">Контакты</h1>

        <ul class="contacts__grid">
          <li class="contacts-card contacts-card--address">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="office"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Главный офис:</span>
              <address class="contacts-card__value contacts-card__value--address">ул. Плехановская, 35, 2 этаж</address>
            </div>
          </li>

          <li class="contacts-card contacts-card--phone">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="phone"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Телефон:</span>
              <a class="contacts-card__value contacts-card__link" href="tel:+74732690000">
                +7&nbsp;(473)&nbsp;269-00-00
              </a>
            </div>
          </li>

          <li class="contacts-card contacts-card--hours">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="time"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Рабочее время:</span>
              <ul class="contacts-card__list">
                <li class="contacts-card__list-item">
                  <span class="contacts-card__day">ПН–ЧТ</span>
                  <time datetime="09:00">9:00</time>
                  &nbsp;—&nbsp;
                  <time datetime="20:00">20:00</time>
                </li>
                <li class="contacts-card__list-item">
                  <span class="contacts-card__day">ПТ</span>
                  <time datetime="09:00">9:00</time>
                  &nbsp;—&nbsp;
                  <time datetime="19:00">19:00</time>
                </li>
                <li class="contacts-card__list-item">
                  <span class="contacts-card__day">СБ</span>
                  <time datetime="10:00">10:00</time>
                  &nbsp;—&nbsp;
                  <time datetime="16:00">16:00</time>
                </li>
              </ul>
            </div>
          </li>

          <li class="contacts-card contacts-card--email">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="mail"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">E-mail:</span>
              <a class="contacts-card__value contacts-card__link" href="mailto:fors36@mail.ru">fors36@mail.ru</a>
            </div>
          </li>

          <li class="contacts-card contacts-card--social">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="social"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Социальные сети:</span>
              <ul class="contacts-social">
                <li class="contacts-social__item">
                  <a
                    class="contacts-social__link"
                    href="https://www.tiktok.com/@forsazh_136?"
                    target="_blank"
                    rel="noopener"
                  >
                    <span
                      class="ui-icon ui-icon_small contacts-social__icon"
                      aria-hidden="true"
                      data-icon="tiktok"
                    ></span>
                  </a>
                </li>
                <li class="contacts-social__item">
                  <a class="contacts-social__link" href="https://vk.com/fors136" target="_blank" rel="noopener">
                    <span class="ui-icon ui-icon_small contacts-social__icon" aria-hidden="true" data-icon="vk"></span>
                  </a>
                </li>
                <li class="contacts-social__item">
                  <a class="contacts-social__link" href="https://t.me/fors36_bot" target="_blank" rel="noopener">
                    <span
                      class="ui-icon ui-icon_small contacts-social__icon"
                      aria-hidden="true"
                      data-icon="telegram"
                    ></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="contacts-card contacts-card--legal">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="info"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Юридическая информация:</span>
              <ul class="contacts-card__list contacts-card__list--legal">
                <li>ЧОУ ДПО «Форсаж»</li>
                <li>ОГРН 1033600142454</li>
                <li>ИНН 3662083356</li>
                <li>КПП 366201001</li>
                <li>ОКПО 70713664</li>
              </ul>
            </div>
          </li>
        </ul>
      </section>

      <section class="contacts-map page-section" aria-labelledby="contacts-map-title">
        <h2 class="contacts-map__title u-visually-hidden" id="contacts-map-title">Расположение офиса на карте</h2>
        <iframe
          src="https://yandex.ru/map-widget/v1/?um=constructor%3A0edc3c7ff71a4671369affa0b7ce4f7f229f8894bbc1058bf214ffb17a2ec776&amp;source=constructor"
          title="Карта расположения офиса автошколы Форсаж"
          loading="lazy"
          allowfullscreen
        ></iframe>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
