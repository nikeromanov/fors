<?
use Bitrix\Main\Localization\Loc;
global $settings;
global $APPLICATION;
$set = getSettings(20);
$settingsPage = $set["PROPERTIES"];
?>

<section class="page-section page-section__flex contacts container" aria-labelledby="contacts-title">
        <h1 class="contacts__title page-section__title" id="contacts-title"><? $APPLICATION->ShowTitle(false); ?></h1>

        <ul class="contacts__grid">
			<?if($settings["ADDRESS"]["VALUE"]){?>
			  <li class="contacts-card contacts-card--address">
				<span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="office"></span>
				<div class="contacts-card__body">
				  <span class="contacts-card__label">Главный офис:</span>
				  <address class="contacts-card__value contacts-card__value--address"><?=$settings["ADDRESS"]["VALUE"];?></address>
				</div>
			  </li>
			<?}?>
			<?if($settings["PHONE"]["VALUE"]){?>
			  <li class="contacts-card contacts-card--phone">
				<span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="phone"></span>
				<div class="contacts-card__body">
				  <span class="contacts-card__label">Телефон:</span>
				  <a class="contacts-card__value contacts-card__link phone_alloka" href="tel:<?=str_replace(["-"," ",")","(","_"],"",$settings["PHONE"]["VALUE"]);?>">
					<?=$settings["PHONE"]["VALUE"];?>
				  </a>
				</div>
			  </li>
			<?}?>
			<?if(!empty($settingsPage["TIME"]["~VALUE"])){?>
          <li class="contacts-card contacts-card--hours">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="time"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Рабочее время:</span>
              <ul class="contacts-card__list">
                <?foreach($settingsPage["TIME"]["~VALUE"] as $k=>$el){?>
					<li class="contacts-card__list-item">
					  <span class="contacts-card__day"><?=$settingsPage["TIME"]["DESCRIPTION"][$k];?></span>
					 <?=$el;?>
					</li>
				<?}?>
                
              </ul>
            </div>
          </li>
			<?}?>
		<?if($settings["EMAIL"]["VALUE"]){?>
          <li class="contacts-card contacts-card--email">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="mail"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">E-mail:</span>
              <a class="contacts-card__value contacts-card__link" href="mailto:<?=$settings["EMAIL"]["VALUE"];?>"><?=$settings["EMAIL"]["VALUE"];?></a>
            </div>
          </li>
		<?}?>
          <li class="contacts-card contacts-card--social">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="social"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Социальные сети:</span>
              <ul class="contacts-social">
                <?if($settings["TIKTOK"]["VALUE"]){?><li class="contacts-social__item">
                  <a
                    class="contacts-social__link"
                    href="<?=$settings["TIKTOK"]["VALUE"];?>"
                    target="_blank"
                    rel="noopener"
                  >
                    <span
                      class="ui-icon ui-icon_small contacts-social__icon"
                      aria-hidden="true"
                      data-icon="tiktok"
                    ></span>
                  </a>
                </li><?}?>
                 <?if($settings["VK"]["VALUE"]){?><li class="contacts-social__item">
                 <a class="contacts-social__link" href="<?=$settings["VK"]["VALUE"];?>" target="_blank" rel="noopener">
                    <span class="ui-icon ui-icon_small contacts-social__icon" aria-hidden="true" data-icon="vk"></span>
                  </a>
                                 </li><?}?>
                <?if($settings["MAX"]["VALUE"]){?><li class="contacts-social__item">
                  <a class="contacts-social__link" href="<?=$settings["MAX"]["VALUE"];?>" target="_blank" rel="noopener">
                    <span class="ui-icon ui-icon_small contacts-social__icon" aria-hidden="true" data-icon="max"></span>
                  </a>
                </li><?}?>
                 <?if($settings["TELEGRAM"]["VALUE"]){?><li class="contacts-social__item">
                  <a class="contacts-social__link" href="<?=$settings["TELEGRAM"]["VALUE"];?>" target="_blank" rel="noopener">
                    <span
                      class="ui-icon ui-icon_small contacts-social__icon"
                      aria-hidden="true"
                      data-icon="telegram"
                    ></span>
                  </a>
				 </li><?}?>
              </ul>
            </div>
          </li>
		<?if(!empty($settingsPage["YUR"]["VALUE"])){?>
          <li class="contacts-card contacts-card--legal">
            <span class="ui-icon ui-icon_small contacts__icon" aria-hidden="true" data-icon="info"></span>
            <div class="contacts-card__body">
              <span class="contacts-card__label">Юридическая информация:</span>
              <ul class="contacts-card__list contacts-card__list--legal">
				<?foreach($settingsPage["YUR"]["VALUE"] as $vl){?>
					<li><?=$vl;?></li>
				<?}?>
              </ul>
            </div>
          </li>
		<?}?>
        </ul>
      </section>

<?if(!empty($settingsPage["TIME"]["~VALUE"])){?><section class="contacts-map page-section container" aria-labelledby="contacts-map-title">
        <figure class="contacts-map__figure">
          <div class="contacts-map__canvas">
            <?=$settingsPage["MAP"]["~VALUE"];?>
          </div>
        </figure>
      </section><?}?>
