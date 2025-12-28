<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
global $settings;
?><?

if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {
}else{ ?>
<? if (!CSite::InDir('/shares/')&&!($dir != "/articles/"&&CSite::InDir('/articles/'))&&!CSite::InDir('/category/')&&!($dir != "/instructors/"&&CSite::InDir('/instructors/'))&&!($dir != "/news/"&&CSite::InDir('/news/'))) { ?></div>
</section><?}?>
</main>
<?}?>

<footer class="footer" role="contentinfo">
  <div class="footer__container container">
    <div class="footer__nav-wrapper">
      <nav class="footer-nav">
       <?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"bottom",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "bottom",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(""),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "bottom",
				"USE_EXT" => "N"
			)
		);?>
        <?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"bottom",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "bottom2",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(""),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "bottom2",
				"USE_EXT" => "N"
			)
		);?>
      </nav>
      <div class="footer__legal">
        <p class="footer__copyright">
          ©
          <?= date('Y') ?>
          <?=$settings["COPY"]["VALUE"];?>
        </p>
        <div>
		<?if(!empty($settings["FOOTER"]["~VALUE"]["TEXT"])){?>
          <?=$settings["FOOTER"]["~VALUE"]["TEXT"];?>
		<?}?>
        </div>
      </div>
    </div>

    <div class="footer__info">
      <div class="footer__info-wrapper">
        <a class="btn btn--secondary btn--medium" data-fancybox data-service="Записаться на курс" href="#consult_form">Записаться на курс</a>
        <!-- bx:footer-contacts -->
        <address class="footer__contacts">
          <ul class="footer__contacts-list" role="list">
            <?if($settings["ADDRESS"]["VALUE"]){?><li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="map"></span>
              <span><?=$settings["ADDRESS"]["VALUE"];?></span>
            </li><?}?>
            <?if($settings["PHONE"]["VALUE"]){?><li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="phone"></span>
              <a class="footer__contacts-link" href="tel:<?=str_replace(["-"," ",")","(","_"],"",$settings["PHONE"]["VALUE"]);?>"><?=$settings["PHONE"]["VALUE"];?></a>
            </li><?}?>
            <?if($settings["EMAIL"]["VALUE"]){?><li class="footer__contacts-item">
              <span aria-hidden="true" class="footer__contacts-icon" data-icon="email"></span>
              <a class="footer__contacts-link" href="mailto:<?=$settings["EMAIL"]["VALUE"];?>"><?=$settings["EMAIL"]["VALUE"];?></a>
            </li><?}?>
          </ul>
        </address>
      </div>

      <ul class="footer__social" role="list" aria-label="Социальные сети">
        <?if($settings["TIKTOK"]["VALUE"]){?><li>
          <a class="footer__social-link" href="<?=$settings["TIKTOK"]["VALUE"];?>" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="tiktok"></span>
          </a>
        </li>
                <?}?>
       <?if($settings["VK"]["VALUE"]){?><li>
          <a class="footer__social-link" href="<?=$settings["VK"]["VALUE"];?>" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="vk"></span>
          </a>
        </li>
           <?}?>
        <?if($settings["MAX"]["VALUE"]){?><li>
          <a class="footer__social-link" href="<?=$settings["MAX"]["VALUE"];?>" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="max"></span>
          </a>
        </li>
               <?}?>
        <?if($settings["TELEGRAM"]["VALUE"]){?><li>
          <a class="footer__social-link" href="<?=$settings["TELEGRAM"]["VALUE"];?>" target="_blank" rel="noopener">
            <span class="ui-icon ui-icon_small footer__social-icon" aria-hidden="true" data-icon="telegram"></span>
          </a>
        </li>
		<?}?>
      </ul>
    </div>
  </div>
</footer>
<section class="page-section" style="display:none" id="consult_form">
  <div class="consult-form">
    <h2 class="consult-form__title" id="consult-title">Получи консультацию прямо сейчас!</h2>
    <p class="consult-form__subtitle">В течение 10 минут с вами свяжется наш специалист.</p>
    <div class="consult-form__success" aria-hidden="true">
      <p class="consult-form__title consult-form__success-message">Спасибо, ваша заявка отправлена!</p>
      <p class="consult-form__success-countdown" aria-live="polite">
        Окно закроется через <span class="consult-form__success-countdown-value">3</span> секунды
      </p>
    </div>

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
</body>
</html>