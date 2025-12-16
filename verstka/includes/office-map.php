<?php
// Блок «карта офисов», подготовлен для подключения на страницах сайта
?>

<section class="page-section" aria-labelledby="map-title">
  <h2 class="page-section__title u-visually-hidden" id="map-title">Наши офисы и автодромы в Воронеже</h2>
  <div class="office-map js-district-tabs">
    <ul class="tabs" role="tablist" aria-label="Районы города">
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button tabs__button--active"
          role="tab"
          aria-selected="true"
          aria-controls="district-home"
          data-district-tab="district-home"
          tabindex="0"
        >
          У вас дома
        </button>
      </li>
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button"
          role="tab"
          aria-selected="false"
          aria-controls="district-central"
          data-district-tab="district-central"
          tabindex="-1"
        >
          Центральный
        </button>
      </li>
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button"
          role="tab"
          aria-selected="false"
          aria-controls="district-left"
          data-district-tab="district-left"
          tabindex="-1"
        >
          Левобережный
        </button>
      </li>
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button"
          role="tab"
          aria-selected="false"
          aria-controls="district-komintern"
          data-district-tab="district-komintern"
          tabindex="-1"
        >
          Коминтерновский
        </button>
      </li>
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button"
          role="tab"
          aria-selected="false"
          aria-controls="district-soviet"
          data-district-tab="district-soviet"
          tabindex="-1"
        >
          Советский
        </button>
      </li>
      <li class="tabs__item" role="presentation">
        <button
          class="tabs__button"
          role="tab"
          aria-selected="false"
          aria-controls="district-railway"
          data-district-tab="district-railway"
          tabindex="-1"
        >
          Железнодорожный
        </button>
      </li>
    </ul>

    <div class="office-map__wrapper">
      <!-- Панель: У вас дома -->
      <div
        class="office-map__content js-district-panel"
        id="district-home"
        role="tabpanel"
        aria-labelledby="district-home"
        tabindex="0"
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__label">Автодромы</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Обручева, 3
            <span class="office-map__locations-description">(Левобережный р-н)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.700123,39.220456">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Антонова-Овсеенко, 22Б
            <span class="office-map__locations-description">(авторынок, остановка Переезд)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.645234,39.215678">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <!-- Панель: Центральный -->
      <div
        class="office-map__content js-district-panel"
        id="district-central"
        role="tabpanel"
        aria-labelledby="district-central"
        tabindex="0"
        hidden
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__title">Центральный</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            пр-т Революции, 58
            <span class="office-map__locations-description">(Центр города)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.660781,39.200269">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Кольцовская, 23
            <span class="office-map__locations-description">(рядом с площадью Ленина)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.667890,39.205432">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <!-- Панель: Левобережный -->
      <div
        class="office-map__content js-district-panel"
        id="district-left"
        role="tabpanel"
        aria-labelledby="district-left"
        tabindex="0"
        hidden
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__title">Левобережный</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            Ленинский пр-т, 174
            <span class="office-map__locations-description">(ост. «Олимпик»)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.698765,39.223456">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Патриотов, 45
            <span class="office-map__locations-description">(микрорайон Придонской)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.705432,39.234567">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <!-- Панель: Коминтерновский -->
      <div
        class="office-map__content js-district-panel"
        id="district-komintern"
        role="tabpanel"
        aria-labelledby="district-komintern"
        tabindex="0"
        hidden
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__title">Коминтерновский</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Владимира Невского, 38
            <span class="office-map__locations-description">(ост. «Политехнический институт»)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.640123,39.270456">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Южно-Моравская, 16
            <span class="office-map__locations-description">(мкр. Подклетное)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.635678,39.275123">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <!-- Панель: Советский -->
      <div
        class="office-map__content js-district-panel"
        id="district-soviet"
        role="tabpanel"
        aria-labelledby="district-soviet"
        tabindex="0"
        hidden
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__title">Советский</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Димитрова, 112
            <span class="office-map__locations-description">(рядом с ТЦ «Московский проспект»)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.680234,39.150567">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. Беговая, 201
            <span class="office-map__locations-description">(микрорайон Берёзовая роща)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.675123,39.145678">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <!-- Панель: Железнодорожный -->
      <div
        class="office-map__content js-district-panel"
        id="district-railway"
        role="tabpanel"
        aria-labelledby="district-railway"
        tabindex="0"
        hidden
      >
        <h2 class="office-map__title">Дистанционное обучение</h2>
        <ul class="office-map__benefits">
          <li class="office-map__benefits-item">Экономия минимум 52 часа на дорогу.</li>
          <li class="office-map__benefits-item">Не придётся тратить деньги на проезд.</li>
          <li class="office-map__benefits-item">Вся теория — онлайн, бесплатно!</li>
          <li class="office-map__benefits-item">Вы не пропустите ни одного занятия.</li>
        </ul>
        <h3 class="office-map__title">Железнодорожный</h3>
        <ul class="office-map__locations">
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            ул. 9 Января, 254
            <span class="office-map__locations-description">(ост. «Застава»)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.620456,39.230123">
              Построить маршрут
            </button>
          </li>
          <li class="office-map__locations-item">
            <img src="assets/icons/map.svg" alt="" class="office-map__icon" aria-hidden="true" />
            пер. Здоровья, 12
            <span class="office-map__locations-description">(рядом с рынком)</span>
            <button class="btn btn--secondary btn--small js-build-route" data-coords="51.615234,39.235678">
              Построить маршрут
            </button>
          </li>
        </ul>
      </div>

      <iframe
        class="office-map__map js-district-map"
        src="https://yandex.ru/map-widget/v1/?um=constructor%3A0de65d926cb4ed7ff8610dc96b0f710b5b72b28944cdaf3426e1fe0588420c1d&amp;source=constructor"
        width="619"
        height="658"
        frameborder="0"
        data-map-home="https://yandex.ru/map-widget/v1/?um=constructor%3A0de65d926cb4ed7ff8610dc96b0f710b5b72b28944cdaf3426e1fe0588420c1d&amp;source=constructor"
        data-map-central="https://yandex.ru/map-widget/v1/?ll=39.200269%2C51.660781&z=13"
        data-map-left="https://yandex.ru/map-widget/v1/?ll=39.220000%2C51.700000&z=13"
        data-map-komintern="https://yandex.ru/map-widget/v1/?ll=39.270000%2C51.640000&z=13"
        data-map-soviet="https://yandex.ru/map-widget/v1/?ll=39.150000%2C51.680000&z=13"
        data-map-railway="https://yandex.ru/map-widget/v1/?ll=39.230000%2C51.620000&z=13"
      ></iframe>
    </div>
  </div>
</section>
