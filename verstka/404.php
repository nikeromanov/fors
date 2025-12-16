<?php
http_response_code(404);
$pageTitle = "Страница не найдена — Автошкола Форсаж";
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8"); ?></title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <section class="page-section error-hero" aria-labelledby="error-title">
        <figure class="error-hero__icon" aria-hidden="true">
          <img src="assets/icons/block.svg" alt="" width="315" height="316" loading="eager" decoding="async" />
        </figure>
        <div class="error-hero__content">
          <h1 class="error-hero__title" id="error-title">Урок 404:</h1>
          <p class="error-hero__subtitle">Даже опытные водители иногда теряются.</p>
          <p class="error-hero__text">
            Но мы знаем, как найти дорогу обратно —
            <a class="error-hero__link" href="/">
              нажмите сюда
              <svg
                class="error-hero__link-icon"
                aria-hidden="true"
                width="22"
                height="12"
                viewBox="0 0 22 12"
                focusable="false"
              >
                <path
                  d="M1 6h18M14 1l6 5-6 5"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
          </p>
        </div>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
