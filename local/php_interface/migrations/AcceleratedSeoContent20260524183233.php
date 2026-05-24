<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class AcceleratedSeoContent20260524183233 extends Version
{
    protected $author = "admin";

    protected $description = "Update accelerated page SEO content";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->ensureProperties();
        $this->updatePage($this->getNewFields(), $this->getNewProperties());
    }

    public function down()
    {
        $this->updatePage($this->getOldFields(), $this->getOldProperties());
    }

    private function ensureProperties(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        foreach ($this->getAdditionalProperties() as $property) {
            $exists = \CIBlockProperty::GetList([], [
                'IBLOCK_ID' => $this->getIblockId(),
                'CODE' => $property['CODE'],
            ])->Fetch();

            if ($exists) {
                continue;
            }

            $propertyObject = new \CIBlockProperty();
            $propertyId = $propertyObject->Add($property);

            if (!$propertyId) {
                throw new MigrationException($propertyObject->LAST_ERROR);
            }
        }
    }

    private function updatePage(array $fields, array $properties): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $elementId = $this->getElementId();
        $elementObject = new \CIBlockElement();

        if (!$elementObject->Update($elementId, $fields)) {
            throw new MigrationException($elementObject->LAST_ERROR);
        }

        \CIBlockElement::SetPropertyValuesEx($elementId, $this->getIblockId(), $properties);
        $this->outSuccess('Контент страницы "Ускоренные курсы вождения" обновлён');
    }

    private function getAdditionalProperties(): array
    {
        return [
            [
                'IBLOCK_ID' => $this->getIblockId(),
                'NAME' => 'Текст после преимуществ',
                'CODE' => 'AFTER_BENEFITS_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'MULTIPLE' => 'N',
                'SORT' => 500,
            ],
            [
                'IBLOCK_ID' => $this->getIblockId(),
                'NAME' => 'Финальный текст',
                'CODE' => 'FINAL_TEXT',
                'PROPERTY_TYPE' => 'S',
                'USER_TYPE' => 'HTML',
                'MULTIPLE' => 'N',
                'SORT' => 510,
            ],
        ];
    }

    private function getNewFields(): array
    {
        return [
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => '<p>Обучение на ускоренных курсах вождения в автошколе «Форсаж» – отличный выбор для тех, кто ценит свое свободное время и хочет быстро сдать теорию и практику для получения водительских прав. У нас работают лучшие инструкторы города Воронежа, готовые оперативно научить студентов всем тонкостям управления автотранспортом. Несмотря на то что программа проходит в кратчайшие сроки, умения ученика будут на самом высоком уровне.</p>',
            'DETAIL_TEXT_TYPE' => 'html',
            'DETAIL_TEXT' => '<p>График подбирается в индивидуальном порядке, под удобные клиенту дни. Будущего водителя ждут как теоретические, так и практические занятия на современных и хорошо обслуживаемых транспортных средствах.</p>',
        ];
    }

    private function getOldFields(): array
    {
        return [
            'PREVIEW_TEXT_TYPE' => 'html',
            'PREVIEW_TEXT' => '<p>
	 Ускоренные курсы вождения&nbsp;— отличный выбор для&nbsp;тех, кто&nbsp;ценит своё свободное время. В&nbsp;автошколе «Форсаж» работают лучшие инструкторы Воронежа, готовые научить студентов всем тонкостям управления транспортом в&nbsp;кратчайшие сроки. Несмотря на&nbsp;то&nbsp;что&nbsp;прохождение программы идёт быстрее, умения ученика будут на&nbsp;высоком уровне.
</p>
<p>
	 Самый важный нюанс заключается в&nbsp;том, что&nbsp;количество практических часов не&nbsp;уменьшается, а&nbsp;проработка материала остаётся качественной.
</p>',
            'DETAIL_TEXT_TYPE' => 'html',
            'DETAIL_TEXT' => 'График подбирается в&nbsp;индивидуальном порядке, под&nbsp;удобные клиенту&nbsp;дни. Будущего водителя ждут как&nbsp;теоретические, так&nbsp;и&nbsp;практические занятия на&nbsp;современных и&nbsp;хорошо обслуживаемых транспортных средствах. Экспресс-обучение не&nbsp;привязано к&nbsp;конкретной категории. Пройти его&nbsp;могут как&nbsp;будущие мотоциклисты, так&nbsp;и&nbsp;те, кто&nbsp;открывает группу «Е» для&nbsp;управления транспортными средствами с&nbsp;прицепами и&nbsp;полуприцепами.',
        ];
    }

    private function getNewProperties(): array
    {
        return [
            'TITLE' => 'Преимущества экспресс-курса обучения вождению в нашей автошколе',
            'SUBTITLE' => 'Уроки в ускоренном режиме подойдут всем – как новичкам без водительских прав, так и людям, желающим восстановить навыки или открыть категорию. В числе ключевых особенностей занятий:',
            'ETAP_TITLE' => 'Этапы получения водительского удостоверения',
            'ETAP_SUBTITLE' => 'Процесс состоит из следующих шагов:',
            'ETAPS' => [
                'Подбор оптимального курса и заключение договора.',
                'Прохождение медицинского обследования по установленному регламенту.',
                'Сбор необходимой документации по заранее предоставленному списку.',
                'Усвоение теории на локальных или дистанционных занятиях.',
                'Завершение практики сначала на автодроме, а затем и в городе.',
                'Сдача экзаменов – внутреннего и в отделении ГИБДД.',
            ],
            'DOCS_TITLE' => 'Какие документы нужны',
            'TITLE_US' => 'Почему выбирают нас',
            'SUBTITLE_US' => 'Наша школа – одна из старейших в Воронеже. Ученики «Форсажа» получают множество преимуществ:',
            'AFTER_BENEFITS_TEXT' => [
                'VALUE' => [
                    'TYPE' => 'HTML',
                    'TEXT' => '<p>Самый важный нюанс заключается в том, что количество практических часов не уменьшается, а проработка материала остается качественной.</p><p>Экспресс-обучение не привязано к конкретной категории. Пройти его могут как будущие мотоциклисты, так и те, кто открывает группу «Е» для управления транспортными средствами с прицепами и полуприцепами.</p>',
                ],
            ],
            'FINAL_TEXT' => [
                'VALUE' => [
                    'TYPE' => 'HTML',
                    'TEXT' => '<p>Ускоренная программа обучения в автошколе «Форсаж» – идеальный способ получить водительские права в Воронеже быстро и в комфортных для вас условиях. Работаем более 20 лет, у нас занимаются поколениями: ученики довольны качеством приобретенных знаний и затем приводят на учебу своих детей.</p><p>Чтобы оставить заявку на занятия, воспользуйтесь формой обратной связи или свяжитесь с нашими менеджерами по телефону +7 (473) 269-00-00. Кроме того, можно обратиться за личной консультацией в офис по адресу: ул. Плехановская, д. 35, 2 этаж.</p>',
                ],
            ],
        ];
    }

    private function getOldProperties(): array
    {
        return [
            'TITLE' => 'Преимущества экспресс-курса обучения вождению',
            'SUBTITLE' => 'Уроки в ускоренном режиме подойдут всем — как новичкам без водительских прав, так и людям, желающим восстановить навыки или открыть категорию. В числе ключевых особенностей занятий:',
            'ETAP_TITLE' => 'Этапы получения водительского удостоверения',
            'ETAP_SUBTITLE' => 'Подготовили ускоренный маршрут — от первого звонка до экзаменов в ГИБДД.',
            'ETAPS' => [
                'Подбор оптимального курса и заключение договора.',
                'Прохождение медицинского обследования по установленному регламенту',
                'Сбор необходимой документации по заранее предоставленному списку.',
                'Усвоение теории на локальных',
                'Завершение практики сначала на автодроме, а затем и в городе',
                'Сдача экзаменов — внутреннего',
            ],
            'DOCS_TITLE' => 'Какие документы нужны',
            'TITLE_US' => 'Почему выбирают нас',
            'SUBTITLE_US' => 'Наша автошкола — одна из старейших в Воронеже. Ученики «Форсажа» получают множество преимуществ:',
            'AFTER_BENEFITS_TEXT' => false,
            'FINAL_TEXT' => false,
        ];
    }

    private function getElementId(): int
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            'ACTIVE' => 'Y',
        ], false, ['nTopCount' => 1], ['ID'])->Fetch();

        if (empty($element['ID'])) {
            throw new MigrationException('Элемент настроек страницы не найден');
        }

        return (int)$element['ID'];
    }

    private function getIblockId(): int
    {
        return 31;
    }
}
