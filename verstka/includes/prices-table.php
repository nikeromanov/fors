<?php
// Таблица цен с табами по категориям
?>

<h2 class="u-visually-hidden" id="price-categories-title">Категории курсов и стоимость обучения</h2>

<div class="price-tabs js-price-tabs" data-price-tabs>
  <ul class="tabs" role="tablist" aria-label="Районы города">
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="true"
        aria-controls="price-tab-a"
        id="price-tab-a-trigger"
        tabindex="0"
        data-price-tab="price-tab-a"
      >
        Категория A, A1
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-b"
        id="price-tab-b-trigger"
        tabindex="-1"
        data-price-tab="price-tab-b"
      >
        Категория B
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-quad"
        id="price-tab-quad-trigger"
        tabindex="-1"
        data-price-tab="price-tab-quad"
      >
        Квадроциклы
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-c"
        id="price-tab-c-trigger"
        tabindex="-1"
        data-price-tab="price-tab-c"
      >
        Категории C, C1
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-d"
        id="price-tab-d-trigger"
        tabindex="-1"
        data-price-tab="price-tab-d"
      >
        Категория D, D1
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-m"
        id="price-tab-m-trigger"
        tabindex="-1"
        data-price-tab="price-tab-m"
      >
        Категория M
      </button>
    </li>
    <li class="tabs__item" role="presentation">
      <button
        class="tabs__button js-price-tab"
        role="tab"
        aria-selected="false"
        aria-controls="price-tab-e"
        id="price-tab-e-trigger"
        tabindex="-1"
        data-price-tab="price-tab-e"
      >
        Категория E
      </button>
    </li>
  </ul>

  <div class="price-tabs__panels">
    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-a"
      aria-labelledby="price-tab-a-trigger"
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категории A и A1</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="moto-table"></span>
              </div>
              <span class="ui-table__text">Категория A</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">12&nbsp;500&nbsp;₽</span>
            </td>
            <td data-label="Вождение">400&nbsp;₽/час вождения</td>
            <td data-label="Теория">104 часа включены</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="moto-table"></span>
              </div>
              <span class="ui-table__text">Категория A1</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">11&nbsp;200&nbsp;₽</span>
            </td>
            <td data-label="Вождение">380&nbsp;₽/час вождения</td>
            <td data-label="Теория">96 часов включены</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-b"
      aria-labelledby="price-tab-b-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категории B</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="car-table"></span>
              </div>
              <span class="ui-table__text">Категория B (МКПП)</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">15&nbsp;990&nbsp;₽</span>
            </td>
            <td data-label="Вождение">450&nbsp;₽/час вождения</td>
            <td data-label="Теория">130 часов входят в стоимость</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="car-table"></span>
              </div>
              <span class="ui-table__text">Категория B (АКПП)</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">17&nbsp;990&nbsp;₽</span>
            </td>
            <td data-label="Вождение">500&nbsp;₽/час вождения</td>
            <td data-label="Теория">130 часов входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-quad"
      aria-labelledby="price-tab-quad-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы для квадроциклов</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="quad-table"></span>
              </div>
              <span class="ui-table__text">Квадроциклы (UTV)</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">13&nbsp;400&nbsp;₽</span>
            </td>
            <td data-label="Вождение">420&nbsp;₽/час вождения</td>
            <td data-label="Теория">90 часов входят в стоимость</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="quad-table"></span>
              </div>
              <span class="ui-table__text">Квадроциклы (ATV)</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">12&nbsp;900&nbsp;₽</span>
            </td>
            <td data-label="Вождение">400&nbsp;₽/час вождения</td>
            <td data-label="Теория">90 часов входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-c"
      aria-labelledby="price-tab-c-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категорий C и C1</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="truck-table"></span>
              </div>
              <span class="ui-table__text">Категория C</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">24&nbsp;500&nbsp;₽</span>
            </td>
            <td data-label="Вождение">600&nbsp;₽/час вождения</td>
            <td data-label="Теория">150 часов входят в стоимость</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="truck-table"></span>
              </div>
              <span class="ui-table__text">Категория C1</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">21&nbsp;900&nbsp;₽</span>
            </td>
            <td data-label="Вождение">560&nbsp;₽/час вождения</td>
            <td data-label="Теория">140 часов входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-d"
      aria-labelledby="price-tab-d-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категорий D и D1</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="bus-table"></span>
              </div>
              <span class="ui-table__text">Категория D</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">28&nbsp;700&nbsp;₽</span>
            </td>
            <td data-label="Вождение">680&nbsp;₽/час вождения</td>
            <td data-label="Теория">180 часов входят в стоимость</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="bus-table"></span>
              </div>
              <span class="ui-table__text">Категория D1</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">25&nbsp;900&nbsp;₽</span>
            </td>
            <td data-label="Вождение">640&nbsp;₽/час вождения</td>
            <td data-label="Теория">160 часов входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-m"
      aria-labelledby="price-tab-m-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категории M</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="scooter-table"></span>
              </div>
              <span class="ui-table__text">Категория M</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">9&nbsp;700&nbsp;₽</span>
            </td>
            <td data-label="Вождение">350&nbsp;₽/час вождения</td>
            <td data-label="Теория">72 часа входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>

    <div
      class="price-tabs__panel js-price-panel"
      role="tabpanel"
      id="price-tab-e"
      aria-labelledby="price-tab-e-trigger"
      hidden
    >
      <div class="ui-table-wrapper"><table class="ui-table">
        <caption class="u-visually-hidden">Курсы категории E</caption>
        <thead>
          <tr>
            <th scope="col">Курсы</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Вождение</th>
            <th scope="col">Теория</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="truck-table"></span>
              </div>
              <span class="ui-table__text">Категория E</span>
            </th>
            <td data-label="Стоимость">
              <span class="ui-table__text">18&nbsp;900&nbsp;₽</span>
            </td>
            <td data-label="Вождение">520&nbsp;₽/час вождения</td>
            <td data-label="Теория">110 часов входят в стоимость</td>
          </tr>
          <tr>
            <th scope="row" class="ui-table__cell">
              <div class="ui-table__icon-container">
                <span class="ui-icon ui-icon_small" aria-hidden="true" data-icon="truck-table"></span>
              </div>
              <span class="ui-table__text">Категория BE</span>
            </th>
            <td class="fast-pricing__cell fast-pricing__cell--price" data-label="Стоимость">
              <span class="ui-table__text">19&nbsp;700&nbsp;₽</span>
            </td>
            <td data-label="Вождение">520&nbsp;₽/час вождения</td>
            <td data-label="Теория">110 часов входят в стоимость</td>
          </tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>
