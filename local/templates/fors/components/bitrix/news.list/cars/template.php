<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?if(!empty($arResult["ITEMS"])){?>
<section class="cars-gallery" aria-labelledby="cars-gallery-title">
<h2 class="page-section__title cars-gallery__title" id="cars-gallery-title">
  Выбери машину на которой хочешь практиковать
</h2>
<span class="ui-icon cars-gallery__icon" aria-hidden="true" data-icon="down-arrow"></span>

<ul class="cars-gallery__list">
<?foreach($arResult["ITEMS"] as $item){?>
  <li class="cars-gallery__item">
	<div class="cars-gallery__card">
	  <figure class="cars-gallery__image-wrapper">
		<?if($item["PREVIEW_PICTURE"]["SRC"]){?>
		<img
		  class="cars-gallery__image"
		  src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
		  alt="VOLKSWAGEN POLO"
		  loading="lazy"
		  decoding="async"
		  width="650"
		  height="400"
		/><?}?>
	  </figure>
	  <div class="cars-gallery__form" data-car-form>
		<button class="cars-gallery__form-toggle" data-car-toggle aria-expanded="false" type="button">
		  <h3 class="cars-gallery__car-name"><?=$item["NAME"];?></h3>
		  <span class="ui-icon cars-gallery__toggle-icon" data-icon="up-arrow" aria-hidden="true"></span>
		</button>
		<div class="cars-gallery__form-content">
		  <dl class="cars-gallery__specs">
			<?if($item["PROPERTIES"]["OBJEM"]["VALUE"]){?><div class="cars-gallery__spec-item">
			  <dt>Объем двигателя:</dt>
			  <dd><?=$item["PROPERTIES"]["OBJEM"]["VALUE"];?></dd>
			</div><?}?>
			<?if($item["PROPERTIES"]["KOROBKA"]["VALUE"]){?><div class="cars-gallery__spec-item">
			  <dt>Коробка передач:</dt>
			  <dd><?=$item["PROPERTIES"]["KOROBKA"]["VALUE"];?></dd>
			</div><?}?>
			<?if($item["PROPERTIES"]["YEAR"]["VALUE"]){?><div class="cars-gallery__spec-item">
			  <dt>Год выпуска:</dt>
			  <dd><?=$item["PROPERTIES"]["YEAR"]["VALUE"];?></dd>
			</div><?}?>
		  </dl>
		  <div class="cars-gallery__divider"></div>
		  <form class="cars-gallery__contact-form standart_form" action="/submit" method="post">
			<input type="hidden" name="action" value="add_form">
			<input type="hidden" name="service" value="Практиковать на <?=$item["NAME"];?>"><div class="answer_form"></div>
			<label class="cars-gallery__form-label" for="car-phone-<?=$item["ID"];?>">
			  Оставьте свой номер телефона
			  <br />
			  и мы скоро вам перезвоним!
			</label>
			<input
			  class="cars-gallery__input"
			  type="tel"
			  id="car-phone-<?=$item["ID"];?>"
			  name="phone"
			  placeholder="Ваш номер телефона"
			  inputmode="tel"
			  autocomplete="tel"
			  required
			/>
			<span class="cars-gallery__privacy">
			  Отправляя заявку вы соглашаетесь на обработку персональных данных
			</span>
			<button class="btn btn--primary btn--large" type="submit">Практиковать на <?=$item["NAME"];?></button>
		  </form>
		</div>
	  </div>
	</div>
  </li>
<?}?>
  
</ul>
</section>
<?}?>