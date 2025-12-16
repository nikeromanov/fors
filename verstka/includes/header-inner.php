<?php
// Вариант шапки для внутренних страниц (белая тема), подготовлен для Битрикс
?>
<header class="header header--inner" role="banner">
  <div class="header__container">
    <!-- ЛОГО -->
    <!-- bx:include:site-logo -->
    <a class="header__logo" href="/" aria-label="Автошкола Форсаж — на главную">
      <img
        class="header__logo js-site-logo"
        src="assets/icons/logo-forsazh.svg"
        data-logo-light="assets/icons/logo-forsazh.svg"
        data-logo-dark="assets/icons/logo-dark.svg"
        alt="Форсаж — автошкола"
        width="120"
        height="28"
        loading="eager"
        decoding="async"
      />
    </a>

    <!-- ОСНОВНАЯ НАВИГАЦИЯ -->
    <nav class="primary-nav" aria-label="Основная навигация">
      <!-- bx:main-menu -->
      <ul class="primary-nav__list" role="list">
        <li class="primary-nav__item">
          <a class="primary-nav__link" href="/prices/">Категории и цены</a>
        </li>
        <li class="primary-nav__item">
          <a class="primary-nav__link" href="/exams-driving/">Экзамены и вождение</a>
        </li>
        <li class="primary-nav__item">
          <a class="primary-nav__link" href="/reviews/">Отзывы</a>
        </li>
        <li class="primary-nav__item">
          <a class="primary-nav__link" href="/payment/">Оплата</a>
        </li>
      </ul>
    </nav>

    <!-- БЛОК ДЕЙСТВИЙ -->
    <div class="header__actions">
      <!-- ПОИСК -->
      <button
        class="header__actions-btn header__actions-btn--search"
        type="button"
        aria-label="Открыть поиск"
        data-action="open-search"
      >
        <span class="header__actions-btn__icon" data-icon="search" aria-hidden="true"></span>
      </button>
      <!-- bx:search-title -->

      <!-- ТЕЛЕФОН -->
      <!-- bx:include:header-phone -->
      <a class="header__actions-phone" href="tel:+74732690000" aria-label="Позвонить по номеру +7 473 269-00-00">
        +7&nbsp;473&nbsp;269-00-00
      </a>

      <!-- ПЕРЕКЛЮЧАТЕЛЬ ТЕМЫ -->
      <button
        class="theme-toggle"
        type="button"
        role="switch"
        aria-checked="false"
        aria-label="Переключить тему"
        data-action="toggle-theme"
      >
        <span class="theme-toggle__track">
          <span class="theme-toggle__icon theme-toggle__icon--sun" data-icon="sun" aria-hidden="true"></span>
          <span class="theme-toggle__icon theme-toggle__icon--moon" data-icon="moon" aria-hidden="true"></span>
          <span class="theme-toggle__thumb"></span>
        </span>
        <span class="u-visually-hidden">Тёмная тема</span>
      </button>

      <!-- ГАМБУРГЕР (моб. меню) -->
      <button
        class="header__burger"
        type="button"
        aria-label="Открыть меню"
        aria-controls="site-menu"
        aria-expanded="false"
        data-action="toggle-menu"
      >
        <span class="header__burger-icon" data-icon="menu" aria-hidden="true"></span>
      </button>
    </div>
  </div>
  <?php include __DIR__ . "/site-menu.php"; ?>
</header>
