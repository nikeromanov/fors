<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Расписание занятий — Автошкола Форсаж</title>
    <link rel="preload" as="style" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/media.css" />
  </head>
  <body>
    <?php include __DIR__ . "/includes/header-inner.php"; ?>

    <main id="main" tabindex="-1">
      <?php
    $breadcrumbItems = [["title" =>
      "Главная", "url" => "/"], ["title" => "Расписание занятий"]]; include __DIR__ . "/includes/breadcrumbs.php"; ?>

      <section class="driving" aria-labelledby="schedule-title">
        <h1 class="driving__title page-section__title" id="schedule-title">Расписание</h1>

        <div class="driving-layout js-schedule-tabs">
          <aside class="driving-sidebar" aria-labelledby="schedule-sidebar-title">
            <nav class="driving-sidebar__nav" aria-label="Выберите район">
              <ul class="driving-sidebar__list" role="tablist">
                <li role="presentation">
                  <button
                    class="driving-sidebar__link driving-sidebar__link--active"
                    role="tab"
                    aria-selected="true"
                    aria-controls="district-central"
                    data-schedule-tab="district-central"
                  >
                    Центральный
                  </button>
                </li>
                <li role="presentation">
                  <button
                    class="driving-sidebar__link"
                    role="tab"
                    aria-selected="false"
                    aria-controls="district-left-bank"
                    data-schedule-tab="district-left-bank"
                  >
                    Левобережный
                  </button>
                </li>
                <li role="presentation">
                  <button
                    class="driving-sidebar__link"
                    role="tab"
                    aria-selected="false"
                    aria-controls="district-komintern"
                    data-schedule-tab="district-komintern"
                  >
                    Коминтерновский
                  </button>
                </li>
                <li role="presentation">
                  <button
                    class="driving-sidebar__link"
                    role="tab"
                    aria-selected="false"
                    aria-controls="district-sovetsky"
                    data-schedule-tab="district-sovetsky"
                  >
                    Советский
                  </button>
                </li>
                <li role="presentation">
                  <button
                    class="driving-sidebar__link"
                    role="tab"
                    aria-selected="false"
                    aria-controls="district-railway"
                    data-schedule-tab="district-railway"
                  >
                    Железнодорожный
                  </button>
                </li>
              </ul>
            </nav>
          </aside>

          <div class="driving-content">
            <!-- Центральный район -->
            <div
              class="schedule-district"
              role="tabpanel"
              id="district-central"
              aria-labelledby="district-central-title"
            >
              <h2 class="u-visually-hidden" id="district-central-title">Центральный район</h2>

              <div class="schedule-card">
                <h3 class="schedule-card__location">пр-т Революции, 58 (Центр города)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на пр-т Революции, 58</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">10:00</td>
                        <td data-label="Дата">02.12.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по пн, ср, пт с 10:00–13:00)</td>
                      </tr>
                      <tr>
                        <td data-label="Время">18:00</td>
                        <td data-label="Дата">05.12.2025</td>
                        <td data-label="Событие">Вечерняя группа (занятия по вт, чт с 18:00–21:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Кольцовская, 23 (рядом с площадью Ленина)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Кольцовская, 23</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">14:00</td>
                        <td data-label="Дата">08.12.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по сб, вс с 14:00–17:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Левобережный район -->
            <div
              class="schedule-district"
              role="tabpanel"
              id="district-left-bank"
              aria-labelledby="district-left-bank-title"
              hidden
            >
              <h2 class="u-visually-hidden" id="district-left-bank-title">Левобережный район</h2>

              <div class="schedule-card">
                <h3 class="schedule-card__location">Ленинский пр-т, 174 (ост. «Олимпик»)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на Ленинский пр-т, 174</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">09:00</td>
                        <td data-label="Дата">01.12.2025</td>
                        <td data-label="Событие">Утренняя группа (занятия по пн, ср, пт с 09:00–12:00)</td>
                      </tr>
                      <tr>
                        <td data-label="Время">19:00</td>
                        <td data-label="Дата">03.12.2025</td>
                        <td data-label="Событие">Вечерняя группа (занятия по вт, чт с 19:00–22:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Патриотов, 45 (микрорайон Придонской)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Патриотов, 45</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">16:00</td>
                        <td data-label="Дата">07.12.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по сб с 16:00–19:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Коминтерновский район -->
            <div
              class="schedule-district"
              role="tabpanel"
              id="district-komintern"
              aria-labelledby="district-komintern-title"
              hidden
            >
              <h2 class="u-visually-hidden" id="district-komintern-title">Коминтерновский район</h2>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Владимира Невского, 38 (ост. «Политехнический институт»)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Владимира Невского, 38</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">11:00</td>
                        <td data-label="Дата">04.12.2025</td>
                        <td data-label="Событие">Дневная группа (занятия по пн, ср с 11:00–14:00)</td>
                      </tr>
                      <tr>
                        <td data-label="Время">20:00</td>
                        <td data-label="Дата">06.12.2025</td>
                        <td data-label="Событие">Поздняя вечерняя группа (занятия по вт, пт с 20:00–22:30)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Южно-Моравская, 16 (мкр. Подклетное)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Южно-Моравская, 16</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">15:00</td>
                        <td data-label="Дата">10.12.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по сб, вс с 15:00–18:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Советский район -->
            <div
              class="schedule-district"
              role="tabpanel"
              id="district-sovetsky"
              aria-labelledby="district-sovetsky-title"
              hidden
            >
              <h2 class="u-visually-hidden" id="district-sovetsky-title">Советский район</h2>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Димитрова, 112 (рядом с ТЦ «Московский проспект»)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Димитрова, 112</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">12:00</td>
                        <td data-label="Дата">02.12.2025</td>
                        <td data-label="Событие">Дневная группа (занятия по пн, чт с 12:00–15:00)</td>
                      </tr>
                      <tr>
                        <td data-label="Время">17:00</td>
                        <td data-label="Дата">05.12.2025</td>
                        <td data-label="Событие">Вечерняя группа (занятия по ср, пт с 17:00–20:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="schedule-card">
                <h3 class="schedule-card__location">ул. Беговая, 201 (микрорайон Берёзовая роща)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Беговая, 201</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">10:30</td>
                        <td data-label="Дата">09.12.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по вт, пт с 10:30–13:30)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Железнодорожный район -->
            <div
              class="schedule-district"
              role="tabpanel"
              id="district-railway"
              aria-labelledby="district-railway-title"
              hidden
            >
              <h2 class="u-visually-hidden" id="district-railway-title">Железнодорожный район</h2>

              <div class="schedule-card">
                <h3 class="schedule-card__location">Ул. Плехановская, 35 (ост. Кольцовская, 2 этаж)</h3>
                <div class="schedule-card__body">
                  <table class="schedule-table">
                    <caption class="u-visually-hidden">Расписание занятий на ул. Плехановская, 35</caption>
                    <thead>
                      <tr>
                        <th scope="col">Время</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Событие</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-label="Время">13:00</td>
                        <td data-label="Дата">17.05.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по сб с 13:00–16:00)</td>
                      </tr>
                      <tr>
                        <td data-label="Время">13:00</td>
                        <td data-label="Дата">17.05.2025</td>
                        <td data-label="Событие">Первое занятие новой группы (занятия по сб с 13:00–16:00)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </в>
      </section>
    </main>

    <?php include __DIR__ . "/includes/footer.php"; ?>

    <script defer src="assets/js/app.js"></script>
  </body>
</html>
