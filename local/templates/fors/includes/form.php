<section class="page-section container" aria-labelledby="consult-title">
  <div class="consult-form">
    <h2 class="consult-form__title" id="consult-title">Получи консультацию прямо сейчас!</h2>
    <p class="consult-form__subtitle">В течение 10 минут с вами свяжется наш специалист.</p>

    <!-- bx:form-consult -->
    <form class="consult-form__form standart_form" action="#" method="post" >
		<input type="hidden" name="action" value="add_form">
		<input type="hidden" name="service" value=""><div class="answer_form"></div>
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


      <label class="consult-form__notice">
        <input class="consult-form__checkbox" type="checkbox" name="policy" value="Y" required />
        <span>Соглашаюсь с <a href="/policy/" target="_blank" rel="noopener">политикой обработки персональных данных</a></span>
      </label>

      <button class="btn btn--secondary btn--large" type="submit">Оставить заявку</button>
    </form>
  </div>
</section>
