<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Новости и акции автошколы Форсаж в Воронеже. Скидки на обучение, новые филиалы, специальные предложения." />
    <meta name="robots" content="index, follow" />
    <title>Новости — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Новости"]]; include __DIR__ . "/includes/breadcrumbs.php"; $newsItems = [ [
      "title" => "Скидка 50 % на обучение квадроциклу", "date" => "5 апреля 2025", "datetime" => "2025-04-05", "type" =>
      "Новость", "excerpt" => "6 000 ₽ вместо 12 000 ₽ (количество мест ограничено)", "link" => "#", "image" => [ "alt"
      => "Учебный квадроцикл на площадке автошколы", "width" => 315, "height" => 192, "fallback" =>
      "assets/img/news/news-quadbike.png", ], ], [ "title" => "Ускоренные курсы", "date" => "18 марта 2025", "datetime"
      => "2025-03-18", "type" => "Новость", "excerpt" => "Получение прав за 35 дней, с онлайн-теорией и без сокращения
      практики", "link" => "#", "image" => [ "alt" => "Инструктор объясняет программу ускоренного курса", "width" =>
      315, "height" => 192, "fallback" => "assets/img/news/news-fast-course.png", ], ], [ "title" => "Категория «А»
      (мотоциклы)", "date" => "7 марта 2025", "datetime" => "2025-03-07", "type" => "Новость", "excerpt" => "От 4 990 ₽
      (спец-акция)", "link" => "#", "image" => [ "alt" => "Учебный мотоцикл на стоянке", "width" => 315, "height" =>
      192, "fallback" => "assets/img/news/news-moto.png", ], ], [ "title" => "Новый филиал на Юго-Западе открылся",
      "date" => "22 февраля 2025", "datetime" => "2025-02-22", "type" => "Событие", "excerpt" => "Офис рядом с метро,
      теория и практика в пешей доступности — уже принимаем учеников", "link" => "#", "image" => [ "alt" =>
      "Администратор нового филиала автошколы", "width" => 315, "height" => 192, "fallback" =>
      "assets/img/news/news-students.png", ], ], [ "title" => "Бесплатный вебинар по экзамену ГИБДД", "date" => "14
      февраля 2025", "datetime" => "2025-02-14", "type" => "Вебинар", "excerpt" => "Разберем топ-10 вопросов билетов и
      последние изменения в ПДД", "link" => "#", "image" => [ "alt" => "Преподаватель автошколы проводит вебинар",
      "width" => 315, "height" => 192, "fallback" => "assets/img/news/news-city-drive.png", ], ], [ "title" => "Зимний
      курс контраварийного вождения", "date" => "30 января 2025", "datetime" => "2025-01-30", "type" => "Обучение",
      "excerpt" => "Практика на закрытой площадке и обучение работе с системой стабилизации", "link" => "#", "image" =>
      [ "alt" => "Ученица проходит зимнее контраварийное упражнение", "width" => 315, "height" => 192, "fallback" =>
      "assets/img/news/news-winter-drive.png", ], ], ]; ?>

      <section class="page-section page-section__flex news" aria-labelledby="news-title">

            <h1 class="news__title" id="news-title">Новости</h1>


          <ul class="news-grid">
            <!-- bx:news-list -->
            <?php foreach ($newsItems as $index =>
            $newsItem): ?>
            <li class="news-card">
              <div class="news-card__wrapper">
                <div class="news-card__header">
                  <p class="news-card__type"><?php echo htmlspecialchars($newsItem["type"], ENT_QUOTES, "UTF-8"); ?></p>
                  <time class="news-card__date" datetime="<?php echo htmlspecialchars(
                    $newsItem["datetime"],
                    ENT_QUOTES,
                    "UTF-8",
                  ); ?>"><?php echo htmlspecialchars($newsItem["date"], ENT_QUOTES, "UTF-8"); ?></time>
                </div>
                <h2 class="news-card__title">
                  <a class="news-card__link" href="#"><?php echo htmlspecialchars($newsItem["title"], ENT_QUOTES, "UTF-8"); ?></a>
                </h2>
                <p class="news-card__description"><?php echo htmlspecialchars($newsItem["excerpt"], ENT_QUOTES, "UTF-8"); ?></p>
              </div>

              <figure class="news-card__media">
                <img class="news-card__image" src="
                <?php echo htmlspecialchars($newsItem["image"]["fallback"], ENT_QUOTES, "UTF-8"); ?>
                " alt="
                <?php echo htmlspecialchars($newsItem["image"]["alt"], ENT_QUOTES, "UTF-8"); ?>
                " loading="lazy" decoding="async" width="427" height="271" />
              </figure>
            </li>
            <?php endforeach; ?>
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

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
