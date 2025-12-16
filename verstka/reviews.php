<?php
$pageTitle = "Отзывы — Автошкола Форсаж";
$pageDescription = "Отзывы учеников автошколы Форсаж в Воронеже. Реальные истории выпускников о процессе обучения и сдаче экзаменов.";
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
      "Главная", "url" => "/"], ["title" => "Отзывы"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section reviews" aria-labelledby="reviews-title">
        <h1 class="reviews__title" id="reviews-title">Отзывы</h1>

        <ul class="reviews__list">
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              Благодарю всю командуавтошколы «Форсаж», отменеджера в офисе доруководителей!Очень грамотно с
              слаженноработают. Особеннаяблагодарность инструкторупо вождению БондаревуДмитрию Васильевичу,который
              оченьответственно, терпеливо,грамотно обучает и находит подход к каждому ученику.
            </p>
          </li>
          <li class="reviews-card">
            <span class="reviews-card__author">Татьяна Дверцова</span>
            <time class="reviews-card__date" datetime="2024-07-18T16:38">18.07.2024 | 16:38</time>
            <p class="reviews-card__review-text">
              В июне учился на категорию А. Сдал с первого раза! Обучение на уровне! И крутой мотик для практики!
            </p>
          </li>
        </ul>

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

    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
