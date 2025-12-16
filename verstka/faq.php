<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Частые вопросы об обучении в автошколе Форсаж. Документы, возраст, оплата, экзамены ГИБДД, восстановление на курс."
    />
    <meta name="robots" content="index, follow" />
    <title>Вопросы и ответы — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Вопросы и ответы"]]; include __DIR__ . "/includes/breadcrumbs.php";
      $faqItems = [ [ "author" => "Аня", "question" => "Здравствуйте! Подскажите, пожалуйста, могу ли я восстановиться
      на занятия, если по личным причинам не завершила курс: ни теорию, ни практику (50 часов вождения)? Нужно ли
      доплачивать и сколько?", "expert" => "Юрист", "answer" => "Добрый день, всё зависит от срока действия вашего
      договора. Обратитесь, пожалуйста, в центральный офис на ул. Плехановская, 35, чтобы менеджеры подсказали путь
      восстановления.", ], [ "author" => "Аня", "question" => "Здравствуйте! Подскажите, пожалуйста, могу ли я
      восстановиться на занятия, если по личным причинам не завершила курс: ни теорию, ни практику (50 часов вождения)?
      Нужно ли доплачивать и сколько?", "expert" => "Юрист", "answer" => "Здравствуйте! Первым делом проверьте срок
      договора. Если он ещё действует, мы восстановим вас на ближайший поток. Для уточнения условий подходите в офис на
      ул. Плехановская, 35.", ], [ "author" => "Аня", "question" => "Здравствуйте! Подскажите, пожалуйста, могу ли я
      восстановиться на занятия, если по личным причинам не завершила курс: ни теорию, ни практику (50 часов вождения)?
      Нужно ли доплачивать и сколько?", "expert" => "Юрист", "answer" => "Добрый день! Возможность восстановления
      зависит от того, истёк ли договор и сколько занятий осталось пройти. Подробно расскажем при личном визите в офис
      на ул. Плехановская, 35.", ], [ "author" => "Аня", "question" => "Здравствуйте! Подскажите, пожалуйста, могу ли я
      восстановиться на занятия, если по личным причинам не завершила курс: ни теорию, ни практику (50 часов вождения)?
      Нужно ли доплачивать и сколько?", "expert" => "Юрист", "answer" => "Здравствуйте! После проверки договора менеджер
      предложит возможный график возврата и рассчитает, потребуется ли доплата. Ждём вас в центральном офисе на ул.
      Плехановская, 35.", ], [ "author" => "Аня", "question" => "Здравствуйте! Подскажите, пожалуйста, могу ли я
      восстановиться на занятия, если по личным причинам не завершила курс: ни теорию, ни практику (50 часов вождения)?
      Нужно ли доплачивать и сколько?", "expert" => "Юрист", "answer" => "Добрый день! Чаще всего требуется только
      заявление и согласование новой программы. Приходите в офис на ул. Плехановская, 35 — специалисты помогут оформить
      восстановление.", ], ]; ?>

      <section class="page-section page-section__flex faq" aria-labelledby="faq-title">
        <h1 class="page-section__title faq__title" id="faq-title">Вопросы и ответы</h1>

        <ul class="faq__list" role="list">
          <?php foreach ($faqItems as $index =>
          $faqItem): ?>
          <?php
            $questionId = "faq-question-" . ($index + 1);
            $answerId = "faq-answer-" . ($index + 1);
            ?>
          <li class="faq__item" role="listitem">
            <article
              class="faq-card"
              aria-labelledby="<?php echo $questionId; ?>"
              aria-describedby="<?php echo $answerId; ?>"
            >
              <header class="faq-card__header">
                <h2 class="faq-card__author">
                  <?php echo htmlspecialchars($faqItem["author"], ENT_QUOTES, "UTF-8"); ?>
                </h2>
                <p class="faq-card__question" id="<?php echo $questionId; ?>">
                  <?php echo htmlspecialchars($faqItem["question"], ENT_QUOTES, "UTF-8"); ?>
                </p>
              </header>
              <div class="faq-card__divider" aria-hidden="true">
                <span class="ui-icon faq-card__icon" aria-hidden="true" data-icon="down-arrow"></span>
              </div>
              <footer class="faq-card__footer">
                <p class="faq-card__expert">
                  <?php echo htmlspecialchars($faqItem["expert"], ENT_QUOTES, "UTF-8"); ?>
                </p>
                <p class="faq-card__answer" id="<?php echo $answerId; ?>">
                  <?php echo htmlspecialchars($faqItem["answer"], ENT_QUOTES, "UTF-8"); ?>
                </p>
              </footer>
            </article>
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
