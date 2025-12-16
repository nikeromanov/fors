<?php
$pageTitle = "Автошкола Форсаж — О нас";
$pageDescription = "Автошкола Форсаж в Воронеже — 20 лет опыта, 17 филиалов, современный автопарк Volkswagen Polo, собственный автодром. Более 35 000 выпускников.";
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
      "Главная", "url" => "/"], ["title" => "О нас"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section page-section__flex about-intro" aria-labelledby="about-title">
        <h1 class="about-intro__title" id="about-title">О нас</h1>
        <div class="about-intro__text">
          <p>
            Автошкола «Форсаж» уже 20 лет проводит обучение на права по всем категориям среди жителей Воронежа.
            Также у нас есть специальные курсы по развитию водительского мастерства, ускоренные автокурсы и занятия
            по экстремальному вождению. Сегодня у нас работают 17 оборудованных учебных кабинетов во всех районах
            города, каждый из вас сможет выбрать более комфортный для себя по месторасположению. Теоретические уроки
            можно посещать повторно в любом понравившимся филиале или подключиться к ним онлайн. Главный офис расположен
            в самом центре, в нем присутствует компьютеры, на которых наши ученики могут готовиться там к экзамену
            бесплатно и в любое время. Наши педагоги и автоинструкторы постоянно повышают своё мастерство.
          </p>
          <p>
            На практических занятиях мы не используем тренажёры, а сразу же практикуемся на машине под чутким
            руководством инструкторов. В нашей школе есть современный автопарк, преимущественно легковые автомобили
            марки Volkswagen Polo (МКПП и АКПП). Все авто не позднее 2020 года выпуска. Также у нас есть свой автодром.
            В цену обучения в автошколе входит все вышеперечисленное, ничего доплачивать не нужно. У нас уже более 35
            000 довольных выпускников. Присоединяйся!
          </p>
        </div>
      </section>

      <?php include __DIR__ . "/includes/about_highlights.php"; ?>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
