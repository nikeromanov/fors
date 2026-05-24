<?php

namespace Sprint\Migration;

use Bitrix\Iblock\InheritedProperty\ElementTemplates;
use Bitrix\Iblock\InheritedProperty\ElementValues;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class NewsMetaTags2026052420260524161954 extends Version
{
    protected $author = "admin";

    protected $description = "SEO мета-теги новостей";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->setMetaTags($this->getMetaTags());
    }

    public function down()
    {
        $emptyMetaTags = [];

        foreach (array_keys($this->getMetaTags()) as $elementCode) {
            $emptyMetaTags[$elementCode] = [
                'ELEMENT_META_TITLE' => '',
                'ELEMENT_META_DESCRIPTION' => '',
            ];
        }

        $this->setMetaTags($emptyMetaTags);
    }

    private function getMetaTags(): array
    {
        return [
            'skidka-uchastnikam-svo-i-chlenam-ikh-semey' => [
                'ELEMENT_META_TITLE' => 'Скидка участникам СВО и их семьям в автошколе «Форсаж» в Воронеже: условия и преимущества обучения',
                'ELEMENT_META_DESCRIPTION' => 'Узнайте о специальной акции для участников СВО и членов их семей в автошколе «Форсаж» в Воронеже: порядок получения скидки и условия обучения на категории.',
            ],
            'skidka-1000-rub' => [
                'ELEMENT_META_TITLE' => 'Скидка 1000 рублей на курсы в автошколе «Форсаж»: условия акции и запись на обучение в Воронеже',
                'ELEMENT_META_DESCRIPTION' => 'Узнайте о предложении автошколы «Форсаж» в Воронеже: как оформить скидку 1000 рублей и начать обучение на выбранную категорию.',
            ],
            'skidka-na-vtoruyu-kategoriyu-50-acz' => [
                'ELEMENT_META_TITLE' => 'Обучение на две категории со скидкой 50% в автошколе «Форсаж»: условия акции и запись на курсы в Воронеже',
                'ELEMENT_META_DESCRIPTION' => 'Узнайте, как пройти обучение сразу на две категории в автошколе «Форсаж» в Воронеже со скидкой 50%: доступные направления подготовки и условия участия в акции.',
            ],
        ];
    }

    private function setMetaTags(array $metaTagsByCode): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $newsIblockId = $this->getNewsIblockId();
        if ($newsIblockId <= 0) {
            throw new MigrationException('Инфоблок "Новости" не найден');
        }

        $elementsByCode = [];
        foreach ($metaTagsByCode as $elementCode => $metaTags) {
            $element = $this->findNewsElement($newsIblockId, $elementCode);

            if (empty($element)) {
                throw new MigrationException(sprintf('Новость с кодом "%s" не найдена', $elementCode));
            }

            $elementsByCode[$elementCode] = $element;
        }

        foreach ($metaTagsByCode as $elementCode => $metaTags) {
            $element = $elementsByCode[$elementCode];
            $templates = new ElementTemplates((int)$element['IBLOCK_ID'], (int)$element['ID']);
            $templates->set($metaTags);

            $values = new ElementValues((int)$element['IBLOCK_ID'], (int)$element['ID']);
            $values->clearValues();

            $this->outSuccess(sprintf('SEO обновлено для новости "%s"', $elementCode));
        }
    }

    private function getNewsIblockId(): int
    {
        $iblock = \CIBlock::GetList([], [
            'TYPE' => 'content',
            'NAME' => 'Новости',
        ])->Fetch();

        return $iblock ? (int)$iblock['ID'] : 0;
    }

    private function findNewsElement(int $iblockId, string $elementCode): ?array
    {
        $element = \CIBlockElement::GetList([], [
            'IBLOCK_ID' => $iblockId,
            '=CODE' => $elementCode,
        ], false, false, [
            'ID',
            'IBLOCK_ID',
            'CODE',
        ])->Fetch();

        return $element ?: null;
    }
}
