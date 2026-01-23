<?
global $settings;
?><header class="header header--inner" role="banner">
  <div class="header__container">
    <!-- ЛОГО -->
    <!-- bx:include:site-logo -->
    <a class="header__logo" href="/" aria-label="Автошкола Форсаж — на главную">
      <img
        class="header__logo js-site-logo"
        src="<?=SITE_TEMPLATE_PATH;?>/assets/icons/logo-forsazh.svg"
        data-logo-light="<?=SITE_TEMPLATE_PATH;?>/assets/icons/logo-forsazh.svg"
        data-logo-dark="<?=SITE_TEMPLATE_PATH;?>/assets/icons/logo-dark.svg"
        alt="Логотип Форсаж"
        width="120"
        height="28"
        loading="eager"
        decoding="async"
      />
    </a>


    <nav class="primary-nav" aria-label="Основная навигация">
    <?$APPLICATION->IncludeComponent(
		"bitrix:menu",
		"top",
		Array(
			"ALLOW_MULTI_SELECT" => "N",
			"CHILD_MENU_TYPE" => "left",
			"DELAY" => "N",
			"MAX_LEVEL" => "1",
			"MENU_CACHE_GET_VARS" => array(""),
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_TYPE" => "N",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"ROOT_MENU_TYPE" => "top",
			"USE_EXT" => "N"
		)
	);?>
    </nav>


    <div class="header__actions">

      <button
        class="header__actions-btn header__actions-btn--search"
        type="button"
        aria-label="Открыть поиск"
        data-action="open-search"
		onclick="window.location='/search/';"
      >
        <span class="header__actions-btn__icon" data-icon="search" aria-hidden="true"></span>
      </button>

      <?if($settings["PHONE"]["VALUE"]){?>
      <a class="header__actions-phone phone_alloka" href="tel:<?=str_replace(["-"," ",")","(","_"],"",$settings["PHONE"]["VALUE"]);?>">
        <?=$settings["PHONE"]["VALUE"];?>
      </a>
	  <?}?>

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
<div id="site-menu" class="site-menu" data-state="closed" hidden>
  <div class="site-menu__panel" role="dialog" aria-modal="true" aria-labelledby="site-menu-title" tabindex="-1">
    <button class="site-menu__close" type="button" aria-label="Закрыть меню" data-action="close-menu"></button>

    <div class="site-menu__container">
  <?$APPLICATION->IncludeComponent(
		'iswin:iblock_menu',
		'',
		[
			'IBLOCK_ID'  => 2,
			'CACHE_TIME' => 3600,
		],
		false
	);?>
	<div class="site-menu__info">
        <address class="site-menu__contacts">
          <ul class="site-menu__contacts-list" role="list">
            <?if($settings["ADDRESS"]["VALUE"]){?>
				<li class="site-menu__contacts-item">
				  <span aria-hidden="true" class="site-menu__contacts-icon" data-icon="map"></span>
				  <span><?=$settings["ADDRESS"]["VALUE"];?></span>
				</li>
			<?}?>
			<?if($settings["PHONE"]["VALUE"]){?>
				<li class="site-menu__contacts-item">
				  <span aria-hidden="true" class="site-menu__contacts-icon" data-icon="phone"></span>
				  <a class="site-menu__contacts-link phone_alloka" href="tel:<?=str_replace(["-"," ",")","(","_"],"",$settings["PHONE"]["VALUE"]);?>"><?=$settings["PHONE"]["VALUE"];?></a>
				</li>
			<?}?>
			<?if($settings["EMAIL"]["VALUE"]){?>
				<li class="site-menu__contacts-item">
				  <span aria-hidden="true" class="site-menu__contacts-icon" data-icon="email"></span>
				  <a class="site-menu__contacts-link" href="mailto:<?=$settings["EMAIL"]["VALUE"];?>"><?=$settings["EMAIL"]["VALUE"];?></a>
				</li>
			<?}?>
          </ul>
        </address>

        <ul class="site-menu__social" role="list" aria-label="Социальные сети">
			<?if($settings["TIKTOK"]["VALUE"]){?>
			  <li>
				<a
				  class="site-menu__social-link"
				  href="<?=$settings["TIKTOK"]["VALUE"];?>"
				  target="_blank"
				  rel="noopener"
				>
				  <span class="ui-icon ui-icon_small site-menu__social-icon" aria-hidden="true" data-icon="tiktok"></span>
				</a>
			  </li>
			<?}?>
                <?if($settings["VK"]["VALUE"]){?>
          <li>
            <a class="site-menu__social-link" href="<?=$settings["VK"]["VALUE"];?>" target="_blank" rel="noopener">
              <span class="ui-icon ui-icon_small site-menu__social-icon" aria-hidden="true" data-icon="vk"></span>
            </a>
          </li>
                <?}?>
                <?if($settings["MAX"]["VALUE"]){?>
          <li>
            <a class="site-menu__social-link" href="<?=$settings["MAX"]["VALUE"];?>" target="_blank" rel="noopener">
              <span class="ui-icon ui-icon_small site-menu__social-icon" aria-hidden="true" data-icon="max"></span>
            </a>
          </li>
                <?}?>
                <?if($settings["TELEGRAM"]["VALUE"]){?>
          <li>
            <a class="site-menu__social-link" href="<?=$settings["TELEGRAM"]["VALUE"];?>" target="_blank" rel="noopener">
              <span class="ui-icon ui-icon_small site-menu__social-icon" aria-hidden="true" data-icon="telegram"></span>
            </a>
          </li>
		<?}?>
        </ul>
      </div>
    </div>
  </div>
</div>
</header>
