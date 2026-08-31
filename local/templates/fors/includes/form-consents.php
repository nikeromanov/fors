<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$consentPrefix = preg_replace('/[^a-zA-Z0-9_-]/', '-', (string)($formConsentPrefix ?? 'consult'));
?>
<div class="form-consents">
  <label class="consult-form__notice form-consents__item" for="<?=$consentPrefix;?>-personal-data">
    <input class="consult-form__checkbox" type="checkbox" id="<?=$consentPrefix;?>-personal-data" name="personal_data_consent" value="Y" required />
    <span>
      Даю <a href="/personal-data-consent/" target="_blank" rel="noopener">согласие на обработку персональных данных</a>
      и ознакомлен(а) с <a href="/policy/" target="_blank" rel="noopener">политикой обработки персональных данных</a>
    </span>
  </label>
  <label class="consult-form__notice form-consents__item" for="<?=$consentPrefix;?>-advertising">
    <input class="consult-form__checkbox" type="checkbox" id="<?=$consentPrefix;?>-advertising" name="advertising_consent" value="Y" />
    <span>
      Согласен(на) получать рекламные и специальные предложения по телефону, SMS и в мессенджерах.
      <a href="/advertising-consent/" target="_blank" rel="noopener">Условия согласия</a>
    </span>
  </label>
</div>
