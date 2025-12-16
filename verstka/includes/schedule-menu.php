<?php
// Боковая навигация по расписанию (подключается как include в Битрикс)
?>
<nav class="schedule-nav" aria-label="Выберите район автошколы">
  <!-- bx:schedule-menu -->
  <ul class="schedule-nav__list" role="tablist">
    <li class="schedule-nav__item" role="presentation">
      <button
        class="schedule-nav__link"
        role="tab"
        aria-selected="true"
        aria-controls="district-central"
        data-schedule-tab="district-central"
        tabindex="0"
      >
        Центральный
      </button>
    </li>
    <li class="schedule-nav__item" role="presentation">
      <button
        class="schedule-nav__link"
        role="tab"
        aria-selected="false"
        aria-controls="district-left-bank"
        data-schedule-tab="district-left-bank"
        tabindex="-1"
      >
        Левобережный
      </button>
    </li>
    <li class="schedule-nav__item" role="presentation">
      <button
        class="schedule-nav__link"
        role="tab"
        aria-selected="false"
        aria-controls="district-komintern"
        data-schedule-tab="district-komintern"
        tabindex="-1"
      >
        Коминтерновский
      </button>
    </li>
    <li class="schedule-nav__item" role="presentation">
      <button
        class="schedule-nav__link"
        role="tab"
        aria-selected="false"
        aria-controls="district-sovetsky"
        data-schedule-tab="district-sovetsky"
        tabindex="-1"
      >
        Советский
      </button>
    </li>
    <li class="schedule-nav__item" role="presentation">
      <button
        class="schedule-nav__link"
        role="tab"
        aria-selected="false"
        aria-controls="district-railway"
        data-schedule-tab="district-railway"
        tabindex="-1"
      >
        Железнодорожный
      </button>
    </li>
  </ul>
</nav>
