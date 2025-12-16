<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Скидка — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Скидка"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>
      <section class="page-section page-section__flex discount" aria-labelledby="discount-title">
        <h1 class="discount__title page-section__title" id="discount-title">Акция для студентов!</h1>
        <div class="discount__content">
          <p class="discount__text">
            Получи выгоду до 4500 руб при покупке нескольких категорий! И будь с правами уже через 5 недель! Скидка на
            одну категорию 1000 руб! От 2-х категорий скидка до 4500 руб!
          </p>
        </div>
        <nav class="article-pagination">
          <a href="#" class="article-pagination__button article-pagination__button--prev">
            <span class="ui-icon article-pagination__icon" aria-hidden="true" data-icon="left-arrow"></span>
            Предыдущая акция
          </a>
          <a href="#" class="article-pagination__button article-pagination__button--next">
            Следующая акция
            <span class="ui-icon article-pagination__icon" aria-hidden="true" data-icon="right-arrow"></span>
          </a>
        </nav>
      </section>
      <?php include __DIR__ . "/includes/form_consult.php"; ?>

      <section class="page-section page-section__flex discount" aria-labelledby="discount-element-bonus">
        <h2 class="page-section__title" id="discount-element-bonus">Бонусы для обучающихся</h2>
        <div class="discount__container">
          <p class="discount__text">
            Всеми акциями могут пользоваться как все ученики, так и те, кто состоит в какой‑либо социальной группе
            (например, студенты). Условия льгот зависят от длительности программы обучения и ограничений.
          </p>
          <p class="discount__text">
            Для того чтобы больше узнать о преимуществах учёбы и бонусах — оставьте заявку на сайте или позвоните
            по контактному номеру телефона. Наши специалисты ответят на все возникшие вопросы и сориентируют
            по стоимости.
          </p>
        </div>
      </section>

      <section class="page-section page-section__flex discount__badges" aria-labelledby="discount-element-badges-title">
        <h2 class="page-section__title" id="discount-element-badges-title">Скидки в автошколе «Форсаж» в Воронеже</h2>
        <p class="discount__badges-description">В нашей школе действуют следующие бонусы:</p>

        <ul class="badge-list" role="list">
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="student"></span>
            </div>
            <p class="badge-list__description">Для студентов и школьников</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="leaves"></span>
            </div>
            <p class="badge-list__description">Акции в определённый сезон</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="party"></span>
            </div>
            <p class="badge-list__description">В дни праздников</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="gift"></span>
            </div>
            <p class="badge-list__description">Регулярные розыгрыши подарочных сертификатов</p>
          </li>
          <li class="badge-list__item">
            <div class="badge-list__container">
              <span class="ui-icon" aria-hidden="true" data-icon="friends"></span>
            </div>
            <p class="badge-list__description">Акция «Приведи друга»</p>
          </li>
        </ul>
      </section>
      <section class="page-section page-section__flex discount__why">
        <h2 class="discount__section-title page-section__title" id="discount-element-why-title">
          Преимущества обращения к нам
        </h2>

        <ul class="why-list">
          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="hands"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Опыт работы</h3>
              <p class="why-list__description">
                Мы существуем уже 18 лет, поэтому успели завоевать доверие и лояльность наших учеников и зарекомендовать
                себя в городе.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="wallet"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Прозрачность ценообразования</h3>
              <p class="why-list__description">
                Никаких скрытых комиссий и переплат — вы заплатите ровно ту цену, которая была указана в договоре.
                В стоимость уже включена теория, практические занятия, ГСМ и так далее.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="monitor"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">Возможность онлайн-обучения</h3>
              <p class="why-list__description">
                Вы можете проходить теоретические уроки в дистанционном формате в реальном времени.
              </p>
            </div>
          </li>

          <li class="why-list__item why-list__item--text discount__why--item">
            <span class="ui-icon" aria-hidden="true" data-icon="cars"></span>
            <div class="why-list__content">
              <h3 class="why-list__title">автопарк и автодром</h3>
              <p class="why-list__description">Собственный автодром и автопарк с современными автомобилями.</p>
            </div>
          </li>

          <li class="why-list__item why-list__item--image discount__why--item">
            <figure class="why-list__figure">
              <picture>
                <source type="image/webp" srcset="assets/img/advantages/girl2.webp" />
                <img
                  src="/assets/img/advantages/girl2.webp"
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
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
