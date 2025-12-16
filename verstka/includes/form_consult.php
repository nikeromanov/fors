<?php
// Форма консультации, подготовлена для подключения на страницах сайта
?>
<section class="page-section" aria-labelledby="consult-title">
  <div class="consult-form">
    <h2 class="consult-form__title" id="consult-title">Получи консультацию прямо сейчас!</h2>
    <p class="consult-form__subtitle">В течение 10 минут с вами свяжется наш специалист.</p>

    <!-- bx:form-consult -->
    <form class="consult-form__form" action="#" method="post" novalidate>
      <div class="consult-form__fields">
        <div class="consult-form__field">
          <label class="consult-form__label u-visually-hidden" for="consult-name">Ваше имя</label>
          <input
            class="consult-form__input"
            type="text"
            id="consult-name"
            name="name"
            placeholder="Ваше имя"
            autocomplete="name"
            required
          />
        </div>
        <div class="consult-form__field">
          <label class="consult-form__label u-visually-hidden" for="consult-phone">Ваш номер телефона</label>
          <input
            class="consult-form__input"
            type="tel"
            id="consult-phone"
            name="phone"
            placeholder="Ваш номер телефона"
            inputmode="tel"
            autocomplete="tel"
            required
          />
        </div>
      </div>

      <p class="consult-form__notice">Отправляя заявку вы соглашаетесь на обработку персональных данных.</p>

      <button class="btn btn--secondary btn--large" type="submit">Оставить заявку</button>
    </form>
  </div>
</section>
