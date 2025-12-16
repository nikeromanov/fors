<?php
$pageTitle = "Поиск — Автошкола Форсаж";
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, follow" />
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
      "Главная", "url" => "/"], ["title" => "Поиск"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex search-page" aria-label="Поиск по сайту">
        <form class="search-form" role="search" aria-label="Поиск по сайту">
          <!-- bx:search-form -->
          <label class="search-form__label u-visually-hidden" for="search-query">Введите запрос</label>
          <div class="search-form__controls">
            <input
              class="search-form__input"
              type="search"
              name="q"
              id="search-query"
              placeholder="Найти информацию"
              autocomplete="off"
              required
            />
            <button class="search-form__submit u-visually-hidden" type="submit">Найти</button>
          </div>
        </form>

        <nav class="search-tags" aria-label="Популярные разделы">
          <!-- bx:search-tags -->
          <ul class="search-tags__list" role="list">
            <li class="search-tags__item">
              <button class="search-tags__button" type="button">Категории</button>
            </li>
            <li class="search-tags__item">
              <button class="search-tags__button" type="button">Цены</button>
            </li>
            <li class="search-tags__item">
              <button class="search-tags__button" type="button">Отзывы</button>
            </li>
            <li class="search-tags__item">
              <button class="search-tags__button" type="button">Контакты</button>
            </li>
          </ul>
        </nav>

        <div class="search-results" aria-labelledby="search-results-title">
          <h2 class="search-results__title u-visually-hidden" id="search-results-title">Результаты поиска</h2>
          <!-- bx:search-results -->
          <ol class="search-results__list" role="list">
            <li class="search-results__item">
              <article class="search-result" aria-labelledby="search-result-1">
                <h3 class="search-result__title" id="search-result-1">
                  <a class="search-result__link" href="news.php">Результат поиска</a>
                </h3>
              </article>
            </li>
            <li class="search-results__item">
              <article class="search-result" aria-labelledby="search-result-2">
                <h3 class="search-result__title" id="search-result-2">
                  <a class="search-result__link" href="contacts.php">Результат поиска</a>
                </h3>
              </article>
            </li>
            <li class="search-results__item">
              <article class="search-result" aria-labelledby="search-result-3">
                <h3 class="search-result__title" id="search-result-3">
                  <a class="search-result__link" href="about.php">Результат поиска</a>
                </h3>
              </article>
            </li>
          </ol>
        </div>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
