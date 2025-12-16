<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Фотогалерея автошколы Форсаж: учебные классы, автомобили, автодром, команда инструкторов."
    />
    <meta name="robots" content="index, follow" />
    <title>Фотогалерея — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Фотогалерея"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex gallery" aria-labelledby="gallery-title">
        <h1 class="gallery__title page-section__title" id="gallery-title">Фотогалерея</h1>

        <div class="gallery-grid">
          <div class="gallery-card gallery-card--driving">
            <a href="#" class="gallery-card__link" data-gallery-item>
              <figure class="gallery-card__figure">
                <picture>
                  <source type="image/webp" srcset="assets/img/gallery/1.webp" />
                  <img
                    class="gallery-card__image"
                    src="assets/img/gallery/1.webp"
                    alt="Учебный автомобиль автошколы Форсаж"
                    loading="lazy"
                    decoding="async"
                    width="650"
                    height="400"
                  />
                </picture>
                <figcaption class="gallery-card__caption">Вождение</figcaption>
              </figure>
            </a>
          </div>

          <div class="gallery-card gallery-card--team">
            <a href="#" class="gallery-card__link" data-gallery-item>
              <figure class="gallery-card__figure">
                <picture>
                  <!-- bx:gallery-image:team -->

                  <source type="image/webp" srcset="assets/img/gallery/2.webp" />
                  <img
                    class="gallery-card__image"
                    src="assets/img/gallery/2.webp"
                    alt="Администраторы автошколы Форсаж"
                    loading="lazy"
                    decoding="async"
                    width="650"
                    height="400"
                  />
                </picture>
                <figcaption class="gallery-card__caption">Наши администраторы</figcaption>
              </figure>
            </a>
          </div>

          <div class="gallery-card gallery-card--classrooms">
            <a href="#" class="gallery-card__link" data-gallery-item>
              <figure class="gallery-card__figure">
                <picture>
                  <!-- bx:gallery-image:classrooms -->

                  <source type="image/webp" srcset="assets/img/gallery/3.webp" />
                  <img
                    class="gallery-card__image"
                    src="assets/img/gallery/3.webp"
                    alt="Преподаватели и студенты в классах автошколы"
                    loading="lazy"
                    decoding="async"
                    width="1320"
                    height="400"
                  />
                </picture>
                <figcaption class="gallery-card__caption">Офисы и классы</figcaption>
              </figure>
            </a>
          </div>
        </div>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
