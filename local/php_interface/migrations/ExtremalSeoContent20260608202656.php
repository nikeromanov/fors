<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class ExtremalSeoContent20260608202656 extends Version
{
    protected $author = "admin";

    protected $description = "Update extremal page SEO content";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updatePage($this->getNewText());
    }

    public function down()
    {
        $this->updatePage($this->getOldText());
    }

    private function updatePage(string $detailText): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $element = new \CIBlockElement();
        if (!$element->Update($this->getElementId(), [
            'DETAIL_TEXT_TYPE' => 'html',
            'DETAIL_TEXT' => $detailText,
        ])) {
            throw new MigrationException($element->LAST_ERROR);
        }

        $this->outSuccess('Контент страницы "Курс экстремального вождения" обновлен');
    }

    private function getNewText(): string
    {
        return <<<'HTML'
<section aria-labelledby="driving-intro-title" class="driving-section">
	<h2 class="u-visually-hidden" id="driving-intro-title">Введение</h2>
	<p class="driving-content__text">Автошкола «Форсаж» предлагает пройти курсы экстремального вождения в Воронеже по выгодной цене. Это позволит вам чувствовать себя более уверенными за рулем, быть готовыми к различным экстренным случаям на дороге.</p>
</section>

<section aria-labelledby="extreme-features-title" class="driving-section">
	<h2 id="extreme-features-title">Особенности</h2>
	<p class="driving-content__intro-text">Стандартное обучение управлению автомобилем дает базовые навыки и знания, которые необходимы для езды в безаварийном режиме в нормальной дорожной обстановке. Однако при движении могут возникать разные опасные ситуации, от которых, к сожалению, никто не застрахован. К ним следует быть готовыми. Надо уметь вовремя сориентироваться, выполнить правильные действия, которые позволят уйти от опасности.</p>
	<p class="driving-content__text">Конечно, этому можно научиться и самостоятельно, но нужно будет проехать десятки тысяч километров. Мы же предлагаем водителям получить опыт и навыки быстрее под чутким контролем инструкторов нашей автошколы.</p>
	<p class="driving-content__text">Они искусственным образом создадут экстремальные ситуации, которые достаточно часто происходят в реальной жизни, и покажут, как из них выходить. Вы можете обучаться только на своей машине. Этот вариант предпочтительнее, так как каждое транспортное средство ведет себя по-разному, а вам нужно почувствовать именно собственный автомобиль.</p>
</section>

<section aria-labelledby="extreme-useful-title" class="driving-section">
	<h3 id="extreme-useful-title">Чему научитесь на курсах экстрим-вождения в нашей школе</h3>
	<p class="driving-content__text">После обучения, которое проводится преимущественно в зимнее время, вы сможете:</p>
	<ul class="driving-content__list">
		<li class="driving-content__list-item">спокойно двигаться по мокрой или обледенелой дороге;</li>
		<li class="driving-content__list-item">соблюдать безопасную дистанцию;</li>
		<li class="driving-content__list-item">выбирать подходящий для времени года скоростной режим, не подвергая себя и окружающих опасности;</li>
		<li class="driving-content__list-item">оперативно реагировать на текущую дорожную обстановку;</li>
		<li class="driving-content__list-item">следить за сцеплением с трассой, сразу же определять занос и возвращаться в стабильное состояние;</li>
		<li class="driving-content__list-item">подбирать правильную технику поворотов и торможения на заледенелых магистралях;</li>
		<li class="driving-content__list-item">беспроблемно проходить неровности на пути;</li>
		<li class="driving-content__list-item">чувствовать себя значительно увереннее за рулем, что снизит риск ДТП.</li>
	</ul>
	<p class="driving-content__text">Кроме того, во время обучения вы испытаете острые ощущения. Таким образом, приобретете не только навыки, но и сможете получить яркие впечатления.</p>
</section>

<section aria-labelledby="extreme-price-title" class="driving-section">
	<h2 id="extreme-price-title">Расценки</h2>
	<p class="driving-content__text">Мы предлагаем курсантам честные цены. Нет скрытых платежей и комиссий. После подписания договора ничего не придется оплачивать дополнительно. Наши расценки:</p>
	<ul class="driving-content__list">
		<li class="driving-content__list-item">Персональный часовой урок экстремального вождения по привлекательной стоимости в 2 тысячи рублей – автоинструктор школы находится в машине с обучающимся на курсе.</li>
		<li class="driving-content__list-item">Комплексная программа по контраварийной подготовке – 8 тыс. руб. Будет изучение теории в учебном классе и 2 дня индивидуальной практики на автодроме с инструктором по 2 часа.</li>
		<li class="driving-content__list-item">Одно занятие на своем ТС – 2000 руб. за 1 ч.</li>
	</ul>
</section>

<section aria-labelledby="extreme-why-title" class="driving-section">
	<h2 id="extreme-why-title">Почему стоит записаться в нашу автошколу</h2>
	<p class="driving-content__text">Мы имеем следующие преимущества:</p>
	<ul class="driving-content__list">
		<li class="driving-content__list-item">Существуем более 20 лет – компания основана в 2003 г. Обучили около 70 000 водителей. У нас учатся поколениями: родители, которые пользовались услугами, приводят потом своих детей. Это говорит о высоком качестве занятий, надежности и добропорядочности.</li>
		<li class="driving-content__list-item">Предлагаем адекватную стоимость услуг. Мы стараемся держать ее на конкурентоспособном уровне. Сделать расценки еще более выгодными возможно при помощи налогового вычета. Предоставим для него все необходимые документы.</li>
		<li class="driving-content__list-item">У нас работают лучшие инструкторы с многолетним опытом преподавания.</li>
	</ul>
	<p class="driving-content__text">Чтобы по разумным ценам пройти в Воронеже курс контраварийного вождения автомобиля в нашей школе и чувствовать себя уверенно даже при экстремальных условиях на дороге, заполните форму обратной связи на сайте: менеджер свяжется с вами в течение рабочего дня и подробнее расскажет о стоимости обучения антиаварийному управлению.</p>
</section>
HTML;
    }

    private function getOldText(): string
    {
        return <<<'HTML'
<section aria-labelledby="driving-intro-title driving-section">
            <h2 class="u-visually-hidden" id="driving-intro-title">Введение</h2>
            <p class="driving-content__text">
              Автошкола «Форсаж» предлагает пройти курсы экстремального вождения в&nbsp;Воронеже по&nbsp;выгодной цене.
              Это&nbsp;позволит вам&nbsp;чувствовать себя более уверенными за&nbsp;рулём, быть готовыми к&nbsp;различным экстренным случаям
              на&nbsp;дороге.
            </p>
          </section>

          <section aria-labelledby="extreme-features-title">
            <h2 id="extreme-features-title">Особенности</h2>
            <p class="driving-content__intro-text">
              Стандартное обучение управлению автомобилем даёт базовые навыки и&nbsp;знания, которые необходимы для&nbsp;езды
              в&nbsp;безаварийном режиме в&nbsp;нормальной дорожной обстановке. Однако придвижении могут возникать разные опасные
              ситуации, от&nbsp;которых, к&nbsp;сожалению, никто не&nbsp;застрахован. К&nbsp;ним&nbsp;следует быть готовыми. Надо&nbsp;уметь вовремя
              сориентироваться, выполнитьправильные действия, которые позволят уйти от&nbsp;опасности.
            </p>
            <p class="driving-content__text">
              Конечно, этому можно научиться и&nbsp;самостоятельно, но&nbsp;нужно будет проехать десятки тысяч километров.
              Мы&nbsp;же&nbsp;предлагаем водителям получить опыт и&nbsp;навыки быстрее под&nbsp;чутким контролем инструкторов нашей
              автошколы.
            </p>
            <p class="driving-content__text">
              Они&nbsp;искусственным образом создадут экстремальные ситуации, которые достаточно часто происходят в&nbsp;реальной
              жизни, и&nbsp;покажут, как&nbsp;из&nbsp;них выходить. Вы&nbsp;можете обучаться только на&nbsp;своей машине. Этот&nbsp;вариант
              предпочтительнее, так&nbsp;как&nbsp;каждое транспортное средство ведёт себя по‑разному, а&nbsp;вам&nbsp;нужно почувствовать
              именно собственный автомобиль.
            </p>
          </section>

          <section aria-labelledby="extreme-useful-title driving-section">
            <h2 id="extreme-useful-title">Чему научитесь на курсах экстрим-вождения в нашей школе</h2>
            <p class="driving-content__text">
              После обучения, которое проводится преимущественно в зимнее время, вы сможете:
            </p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">спокойно двигаться по мокрой или обледенелой дороге;</li>
              <li class="driving-content__list-item">соблюдать безопасную дистанцию;</li>
              <li class="driving-content__list-item">
                выбирать подходящий для времени года скоростной режим, не подвергая себя и окружающих опасности;
              </li>
              <li class="driving-content__list-item">оперативно реагировать на текущую дорожную обстановку;</li>
              <li class="driving-content__list-item">
                следить за сцеплением с трассой, сразу же определять занос и возвращаться в стабильное состояние;
              </li>
              <li class="driving-content__list-item">
                подбирать правильную технику поворотов и торможения на заледенелых магистралях;
              </li>
              <li class="driving-content__list-item">беспроблемно проходить неровности на пути;</li>
              <li class="driving-content__list-item">
                чувствовать себя значительно увереннее за рулем, что снизит риск ДТП.
              </li>
            </ul>
            <p class="driving-content__text">
              Кроме того, во время обучения вы испытаете острые ощущения. Таким образом, приобретете не только навыки,
              но и сможете получить яркие впечатления.
            </p>
          </section>

          <section aria-labelledby="extreme-price-title driving-section">
            <h2 id="extreme-price-title">Расценки</h2>

            <p class="driving-content__text">
              Мы предлагаем курсантам честные цены. Нет скрытых платежей и комиссий. После подписания договора ничего не
              придется оплачивать дополнительно. Наши расценки:
            </p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
                Персональный часовой урок экстремального вождения по привлекательной стоимости в 2 тысячи рублей &ndash; автоинструктор школы находится в машине с обучающимся на курсе.
              </li>
              <li class="driving-content__list-item">
                Комплексная программа по контраварийной подготовке &ndash; 8 тыс. руб. Будет изучение теории в учебном классе и 2 дня индивидуальной практики на автодроме с инструктором по 2 часа.
              </li>
              <li class="driving-content__list-item">
                Одно занятие на своем ТС &ndash; 2000 руб. за 1 ч.
              </li>
            </ul>
          </section>

          <section aria-labelledby="extreme-why-title driving-section">
            <h2 id="extreme-why-title">Почему стоит записаться в&nbsp;нашу автошколу</h2>
            <p>Мы имеем следующие преимущества:</p>
            <ul class="driving-content__list">
              <li class="driving-content__list-item">
             Существуем более 20 лет &ndash; компания основана в 2003 г. Обучили около 70 000 водителей. У нас учатся поколениями: родители, которые пользовались услугами, приводят потом своих детей. Это говорит о высоком качестве занятий, надежности и добропорядочности.
              </li>
              <li class="driving-content__list-item">
                Предлагаем адекватные расценки. Мы&nbsp;стараемся держать их&nbsp;на&nbsp;конкурентоспособном уровне. Сделать стоимость
                ещё&nbsp;более выгодной возможно при&nbsp;помощи налогового вычета.Предоставим для&nbsp;него все&nbsp;необходимые документы.
              </li>
              <li class="driving-content__list-item">
                У нас работают лучшие инструкторы с многолетним опытом преподавания.
              </li>
            </ul>
            <p class="driving-content__text">
              Чтобы по разумным ценам пройти в Воронеже курс контраварийного вождения автомобиля в нашей школе и чувствовать себя уверенно даже при экстремальных условиях на дороге, заполните форму обратной связи на сайте: менеджер свяжется с вами в течение рабочего дня и подробнее расскажет про стоимость обучения антиаварийному управлению.
            </p>
          </section>
HTML;
    }

    private function getElementId(): int
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => 29,
            'ACTIVE' => 'Y',
        ], false, ['nTopCount' => 1], ['ID'])->Fetch();

        if (empty($element['ID'])) {
            throw new MigrationException('Элемент настроек страницы extremal не найден');
        }

        return (int)$element['ID'];
    }
}
