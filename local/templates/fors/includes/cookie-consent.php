<div class="cookie-consent" data-cookie-consent hidden>
  <section class="cookie-consent__banner" aria-labelledby="cookie-consent-title">
    <div class="cookie-consent__content">
      <h2 class="cookie-consent__title" id="cookie-consent-title">Настройки cookie</h2>
      <p class="cookie-consent__text">
        Мы используем необходимые cookie для работы сайта, а с вашего согласия — аналитику и маркетинговые технологии.
        Подробнее — в <a href="/policy/">политике</a> и
        <a href="/analytics-consent/">согласии на аналитические и маркетинговые технологии</a>.
      </p>
    </div>
    <div class="cookie-consent__actions">
      <button class="cookie-action cookie-action--primary" type="button" data-cookie-accept-all>Принять все</button>
      <button class="cookie-action cookie-action--secondary" type="button" data-cookie-reject>Только необходимые</button>
      <button class="cookie-consent__settings-button" type="button" data-cookie-settings>Настроить</button>
    </div>
  </section>
</div>

<div class="cookie-settings" data-cookie-settings-dialog hidden>
  <div class="cookie-settings__backdrop" aria-hidden="true" data-cookie-settings-close></div>
  <section class="cookie-settings__dialog" role="dialog" aria-modal="true" aria-labelledby="cookie-settings-title">
    <button class="cookie-settings__close" type="button" aria-label="Закрыть настройки cookie" data-cookie-settings-close>×</button>
    <h2 class="cookie-settings__title" id="cookie-settings-title">Управление cookie</h2>
    <p class="cookie-settings__text">Вы можете изменить выбор в любое время. Необходимые cookie отключить нельзя.</p>
    <div class="cookie-settings__options">
      <label class="cookie-settings__option cookie-settings__option--disabled">
        <input type="checkbox" checked disabled />
        <span><strong>Необходимые</strong><small>Обеспечивают работу, безопасность и сохранение выбранных настроек.</small></span>
      </label>
      <label class="cookie-settings__option">
        <input type="checkbox" data-cookie-category="analytics" />
        <span><strong>Аналитические</strong><small>Яндекс.Метрика, Top.Mail.Ru и сервис коллтрекинга.</small></span>
      </label>
      <label class="cookie-settings__option">
        <input type="checkbox" data-cookie-category="marketing" />
        <span><strong>Маркетинговые</strong><small>VK Pixel и другие рекламные технологии при их подключении.</small></span>
      </label>
    </div>
    <div class="cookie-settings__actions">
      <button class="cookie-action cookie-action--primary" type="button" data-cookie-save>Сохранить выбор</button>
      <button class="cookie-action cookie-action--secondary" type="button" data-cookie-settings-reject>Только необходимые</button>
    </div>
  </section>
</div>
