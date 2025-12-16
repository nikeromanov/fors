<?php
$pageTitle = "Дополнительная скидка 13% — как получить налоговый вычет"; ?>
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

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [
      ["title" =>
      "Главная", "url" => "/"], ["title" => "Статьи", "url" => "articles.php"], ["title" => "Дополнительная скидка
      13%"], ]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section article-detail" aria-labelledby="article-detail-heading">
        <div class="article-detail__inner u-container">
          <!-- bx:article-detail -->
          <article class="article-detail__article">
            <header class="article-detail__header">
              <h1 class="article-detail__title" id="article-detail-heading">
                Дополнительная скидка 13% — как? Читайте!
              </h1>
              <p class="article-detail__meta">
                <time class="article-detail__date" datetime="2025-04-05">5 апреля 2025</time>
              </p>
            </header>

            <div class="article-detail__content">
              <p class="article-detail__lead">
                Учащиеся автошколы, в большинстве своём, и не подозревают о том, что при получении платного образования
                можно вернуть ощутимую часть уплаченных за год налогов. Автошкола считается образовательным учреждением,
                и оплата обучения в ней подлежит социальному налоговому вычету.
              </p>
              <p>Сегодня мы расскажем 5 интересных фактов про вычет с обучения.</p>

              <figure class="article-detail__figure">
                <!-- bx:article-detail-image -->
                <picture>
                  <source type="image/webp" srcset="assets/img/news/1.webp" />
                  <img
                    class="article-detail__image"
                    src="assets/img/news/1.webp"
                    alt="Ученик автошколы на учебном мотоцикле"
                    loading="lazy"
                    decoding="async"
                    width="872"
                    height="450"
                  />
                </picture>
              </figure>

              <ol class="article-detail__list">
                <li class="article-detail__list-item">
                  <p>Возврат налога за обучение в РФ возможен не только за обучение в вузе, но и в автошколе.</p>
                </li>
                <li class="article-detail__list-item">
                  <p>Налоговый вычет за обучение можно оформить за тот год, в котором оплачивалось обучение.</p>
                </li>
                <li class="article-detail__list-item">
                  <p>До конца 2022 года декларации можно подать за 2019, 2020, 2021 год!</p>
                </li>
                <li class="article-detail__list-item">
                  <p>Имеете право на налоговый вычет за обучение если:</p>
                  <ul class="article-detail__sublist">
                    <li>
                      Вы официально трудоустроены и работодатель отчисляет в бюджет налог в размере 13% от вашей
                      заработной платы.
                    </li>
                    <li>Вы оплачивали своё обучение или очное обучение своего ребёнка (до 24 лет), брата, сестры.</li>
                  </ul>
                </li>
                <li class="article-detail__list-item">
                  <p>Сумма возврата за год:</p>
                  <ul class="article-detail__sublist">
                    <li>За своё обучение, брата и сестры максимальный возврат составляет до 15&nbsp;600&nbsp;руб.</li>
                    <li>На каждого учащегося очно ребёнка до 6&nbsp;500&nbsp;руб.</li>
                  </ul>
                </li>
              </ol>
            </div>
          </article>
        </div>
        <nav class="article-pagination">
          <a href="#" class="article-pagination__button article-pagination__button--prev">
            <span class="ui-icon article-pagination__icon" aria-hidden="true" data-icon="left-arrow"></span>
            Предыдущая статья
          </a>
          <a href="#" class="article-pagination__button article-pagination__button--next">
            Следующая статья
            <span class="ui-icon article-pagination__icon" aria-hidden="true" data-icon="right-arrow"></span>
          </a>
        </nav>
        <?php include __DIR__ . "/includes/fast-banner.php"; ?>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
