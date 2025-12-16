<?php
$pageTitle = "Автошкола Форсаж — Экзамены";
?>
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

    <main tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Экзамены"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="page-section exams" aria-labelledby="exams-title">
        <div class="exams__intro">
          <h1 class="exams__title" id="exams-title">Экзамены</h1>
          <p class="exams__description">
            Автошкола «Форсаж» в Воронеже предлагает пройти курс обучения для получения водительского удостоверения и
            сдать экзамен по вождению с первого раза.
          </p>
        </div>

        <div class="exams__content">
          <h2 class="exams__section-title" id="exams-subtitle">Что необходимо усвоить</h2>
          <p class="exams__text">
            В связи с повышенной загруженностью дорог, для обеспечения безопасности движения ГИБДД, в соответствии с
            нормативными документами, выдвигает высокие требования к кандидатам в водители.
          </p>
          <p class="exams__text">На сегодняшний день итоговая квалификационная проверка проводится в два этапа:</p>

          <div class="exams__details">
            <div class="exams__detail-container">
              <div class="exams__stage-badge">
                <span class="exams__stage-name">Теория</span>
              </div>
              <div class="exams__detail-card exams__detail-card--theory">
                <p class="exams__detail-text">
                  Контроль знаний теоретической части. Осуществляется в тестовой форме, вы решаете 1 билет — 20 вопросов
                  за 20 минут, максимально допустимо 2 ошибки. При допущении одной ошибки дополнительно добавляется 5
                  вопросов по тематическому блоку, в котором дан неверный ответ. Экзамен контролируется представителем
                  ГИБДД.
                </p>
              </div>
            </div>
            <div class="exams__detail-container">
              <div class="exams__stage-badge">
                <span class="exams__stage-name">Практика</span>
              </div>
              <div class="exams__detail-card exams__detail-card--practice">
                <p class="exams__detail-text">
                  После успешной сдачи теории, вы допускаетесь к практической части на площадке в тот же день. Если
                  упражнения пройдены без замечаний, инспектор допускает вас к проверке уровня вождения в городе.
                </p>
              </div>
            </div>
          </div>

          <figure class="exams__figure">
            <picture>
              <source type="image/webp" srcset="assets/img/exams/cars.webp" />
              <img
                src="assets/img/exams/cars.webp"
                alt="Учебные автомобили автошколы Форсаж"
                class="exams__figure-img"
                loading="lazy"
                width="1320"
                height="514"
              />
            </picture>
          </figure>

          <p class="exams__description">
            При этом многие ученики испытывают волнение, которое часто возникает из-за плохой подготовки именно
            практического плана. Но записавшись к нам, вы избежите лишних тревог и сможете сдать на права с первого
            раза. Все потому, что наша школа имеет оборудованный автодром, который максимально приближен к условиям
            городской езды, а также количество уроков езды, необходимое для закрепления навыков и успешного прохождения
            упражнений.
          </p>
        </div>

        <div class="exams__why">
          <h2 class="exams__section-title" id="exams-subtitle-2">
            Почему «Форсаж» — лучшая автошкола, где можно сдать экзамен по вождению
          </h2>
          <p class="exams__text">
            Мы предлагаем для вас обучение всех категорий, а также гарантируем получение водительского удостоверения без
            лишних хлопот. Для этого обеспечены все необходимые условия:
          </p>

          <ul class="why-list">
            <li class="why-list__item why-list__item--text exams__why--item">
              <span class="ui-icon" aria-hidden="true" data-icon="network"></span>
              <div class="why-list__content">
                <h3 class="why-list__title">17 филиалов</h3>
                <p class="why-list__description">
                  Каждый может выбрать подходящий вариант, без траты вашего драгоценного времени на дорогу.
                </p>
              </div>
            </li>

            <li class="why-list__item why-list__item--text exams__why--item">
              <span class="ui-icon" aria-hidden="true" data-icon="driver"></span>
              <div class="why-list__content">
                <h3 class="why-list__title">Штат преподавателей</h3>
                <p class="why-list__description">
                  Учителя по теории и практике имеет высокий уровень профессионализма и регулярно проходят программы
                  повышения квалификации.
                </p>
              </div>
            </li>
            <li class="why-list__item why-list__item--text exams__why--item">
              <span class="ui-icon" aria-hidden="true" data-icon="cars"></span>
              <div class="why-list__content">
                <h3 class="why-list__title">Современный автопарк</h3>
                <p class="why-list__description">
                  Предлагаем большой парк современных авто, опробовать которые можно сразу с начала занятий.
                </p>
              </div>
            </li>

            <li class="why-list__item why-list__item--text exams__why--item">
              <span class="ui-icon" aria-hidden="true" data-icon="wallet"></span>
              <div class="why-list__content">
                <h3 class="why-list__title">Оптимальные цены</h3>
                <p class="why-list__description">Постоянные акции и выгодные скидки, а также возможность рассрочки.</p>
              </div>
            </li>

            <li class="why-list__item why-list__item--image exams__why--item">
              <figure class="why-list__figure">
                <picture>
                  <source type="image/webp" srcset="assets/img/advantages/car3.webp" />
                  <img
                    src="/assets/img/advantages/car3.webp"
                    alt="Грузовик"
                    class="why-list__img"
                    loading="lazy"
                    width="315"
                    height="315"
                  />
                </picture>
              </figure>
            </li>
          </ul>

          <figure class="exams__figure">
            <picture>
              <source type="image/webp" srcset="assets/img/exams/cars2.webp" />
              <img
                src="assets/img/exams/cars2.webp"
                alt="Учебные грузовики и автобусы автошколы"
                class="exams__figure-img"
                loading="lazy"
                width="1320"
                height="514"
              />
            </picture>
          </figure>
        </div>
      </section>

      <?php include __DIR__ . "/includes/form_consult.php"; ?>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
