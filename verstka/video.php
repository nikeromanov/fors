<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Видео отзывы — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Видео отзывы"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section video" aria-labelledby="video-title">
        <h1 class="video__title page-section__title" id="video-title">Видео отзывы</h1>

        <!-- bx:video-reviews-list -->
        <ul class="video-grid">
          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Татьяна Дверцова</span>
              <time class="video-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Татьяна Дверцова"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>

          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Иван Петров</span>
              <time class="video-card__date" datetime="2024-08-01T10:20">01.08.2024 | 10:20</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Иван Петров"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>

          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Мария Сидорова</span>
              <time class="video-card__date" datetime="2024-08-15T14:45">15.08.2024 | 14:45</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Мария Сидорова"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>

          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Алексей Николаев</span>
              <time class="video-card__date" datetime="2024-09-03T09:15">03.09.2024 | 09:15</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Алексей Николаев"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>

          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Ольга Смирнова</span>
              <time class="video-card__date" datetime="2024-09-20T16:30">20.09.2024 | 16:30</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Ольга Смирнова"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>

          <li class="video-card">
            <div class="video-card__header">
              <span class="video-card__author">Дмитрий Козлов</span>
              <time class="video-card__date" datetime="2024-10-05T11:00">05.10.2024 | 11:00</time>
            </div>
            <a
              href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              data-fancybox="video-reviews"
              class="video-card__embed"
            >
              <img
                src="https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg"
                alt="Видео отзыв: Дмитрий Козлов"
                class="video-card__thumbnail"
                loading="lazy"
              />
              <span class="video-card__play-icon" aria-hidden="true"></span>
            </a>
          </li>
        </ul>
        <!-- /bx:video-reviews-list -->

        <nav class="pagination" aria-label="Навигация по страницам">
          <a href="#" class="pagination__link pagination__link--prev" aria-label="Предыдущая страница">
            <span class="ui-icon pagination__icon" aria-hidden="true" data-icon="left-arrow"></span>
          </a>

          <a href="#" class="pagination__link">1</a>
          <a href="#" class="pagination__link pagination__link--active" aria-current="page">2</a>
          <a href="#" class="pagination__link">3</a>
          <span class="pagination__ellipsis" aria-hidden="true">...</span>
          <a href="#" class="pagination__link">5</a>

          <a href="#" class="pagination__link pagination__link--next" aria-label="Следующая страница">
            <span class="ui-icon pagination__icon" aria-hidden="true" data-icon="right-arrow"></span>
          </a>
        </nav>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script src="assets/js/fancybox.umd.js"></script>
    <script defer src="assets/js/app.js"></script>
  </body>
</html>
