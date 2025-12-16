<?php
// Футер сайта, подготовлен для интеграции в шаблон Битрикс
?>
<footer class="footer" role="contentinfo">
  <div class="footer__container">
    <div class="footer__nav-wrapper">
      <nav class="footer-nav">
        <!-- bx:footer-menu-primary -->
        <ul class="footer-nav__list" role="list">
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/about/">Автошкола</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/prices/">Категории и цены</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/schedule/">Расписание занятий</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/cars/">Машины</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/reviews/">Отзывы</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/online/">Онлайн обучение</a>
          </li>
        </ul>
        <ul class="footer-nav__list" role="list">
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/gallery/">Галерея</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/branches/">Филиалы</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/promotions/">Акции</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/duties-payment/">Оплата госпошлины</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/contacts/">Контакты</a>
          </li>
          <li class="footer-nav__item">
            <a class="footer-nav__link" href="/gifts/">Подарочные сертификаты</a>
          </li>
        </ul>
      </nav>
      <div class="footer__legal">
        <p class="footer__copyright">
          ©
          <?= date('Y') ?>
          Автошкола ФОРСАЖ в Воронеже, лицензия А № 301751, автошкола «Сигнал» лицензия А № 209421
        </p>
        <p>
          Правовая информация Форсаж
          <br />
          Правовая информация Сигнал
        </p>
      </div>
    </div>

    <div class="footer__info">
      <div class="footer__info-wrapper">
        <a class="btn btn--secondary btn--medium" href="/enroll/">Записаться на курс</a>
        <!-- bx:footer-contacts -->
        <address class="footer__contacts">
          <ul class="footer__contacts-list" role="list">
            <li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="map"></span>
              <span>ул. Плехановская, 35, 2 этаж</span>
            </li>
            <li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="phone"></span>
              <a class="footer__contacts-link" href="tel:+74732690000">+7&nbsp;(473)&nbsp;269-00-00</a>
            </li>
            <li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="email"></span>
              <a class="footer__contacts-link" href="mailto:fors36@mail.ru">fors36@mail.ru</a>
            </li>
          </ul>
        </address>
      </div>

      <ul class="footer__social" role="list" aria-label="Социальные сети">
        <li>
          <a class="footer__social-link" href="https://www.tiktok.com/@forsazh_136?" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="tiktok"></span>
          </a>
        </li>
        <li>
          <a class="footer__social-link" href="https://vk.com/fors136" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="vk"></span>
          </a>
        </li>
        <li>
          <a class="footer__social-link" href="https://t.me/fors36_bot" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="telegram"></span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</footer>
