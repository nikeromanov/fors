<?php

namespace Sprint\Migration;

use Bitrix\Iblock\InheritedProperty\SectionTemplates;
use Bitrix\Iblock\InheritedProperty\SectionValues;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260824201237 extends Version
{
    protected $author = "admin";

    protected $description = "Категория E: текст и мета-теги (задача 600295)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateSection(
            'Бренд fors36.ru существует более 20 лет – наши эксперты сумели обучить порядка 70 000 выпускников, от теперь уже профессиональных водителей до тех, кто стремился просто восстановить навыки.',
            'Наш бренд существует более 20 лет – эксперты сумели обучить порядка 70 000 выпускников, от теперь уже профессиональных водителей до тех, кто стремился просто восстановить навыки.',
            'Почему сдать на права категории Е нужно именно у нас',
            'Почему сдать на права категории Е лучше именно в нашей школе',
            $this->getNewMetaTags()
        );
    }

    public function down()
    {
        $this->updateSection(
            'Наш бренд существует более 20 лет – эксперты сумели обучить порядка 70 000 выпускников, от теперь уже профессиональных водителей до тех, кто стремился просто восстановить навыки.',
            'Бренд fors36.ru существует более 20 лет – наши эксперты сумели обучить порядка 70 000 выпускников, от теперь уже профессиональных водителей до тех, кто стремился просто восстановить навыки.',
            'Почему сдать на права категории Е лучше именно в нашей школе',
            'Почему сдать на права категории Е нужно именно у нас',
            $this->getOldMetaTags()
        );
    }

    private function updateSection(
        string $descriptionSearch,
        string $descriptionReplacement,
        string $textSearch,
        string $textReplacement,
        array $metaTags
    ): void {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $sectionId = $this->getSectionId();
        $sectionData = \CIBlockSection::GetList(
            [],
            ['ID' => $sectionId, 'IBLOCK_ID' => $this->getIblockId()],
            false,
            ['ID', 'DESCRIPTION', 'UF_TEXT']
        )->Fetch();
        $description = (string)($sectionData['DESCRIPTION'] ?? '');
        $text = (string)($sectionData['UF_TEXT'] ?? '');

        if (substr_count($description, $descriptionSearch) !== 1) {
            throw new MigrationException('Не найден единственный ожидаемый фрагмент описания категории E');
        }

        if (substr_count($text, $textSearch) !== 1) {
            throw new MigrationException('Не найден единственный ожидаемый заголовок категории E');
        }

        $updatedDescription = str_replace(
            $descriptionSearch,
            $descriptionReplacement,
            $description,
            $descriptionReplaceCount
        );
        $updatedText = str_replace($textSearch, $textReplacement, $text, $textReplaceCount);

        if ($descriptionReplaceCount !== 1 || $textReplaceCount !== 1) {
            throw new MigrationException('Не удалось обновить текст категории E');
        }

        $section = new \CIBlockSection();
        if (!$section->Update($sectionId, [
            'DESCRIPTION' => $updatedDescription,
            'DESCRIPTION_TYPE' => 'html',
            'UF_TEXT' => $updatedText,
        ])) {
            throw new MigrationException($section->LAST_ERROR);
        }

        $templates = new SectionTemplates($this->getIblockId(), $sectionId);
        $templates->set($metaTags);

        $values = new SectionValues($this->getIblockId(), $sectionId);
        $values->clearValues();

        \CIBlock::clearIblockTagCache($this->getIblockId());
        $this->outSuccess('Текст и мета-теги категории E обновлены');
    }

    private function getNewMetaTags(): array
    {
        return [
            'SECTION_META_TITLE' => 'Обучение категории Е в Воронеже по отличной стоимости: сдать экзамен и получить водительские права направления E по доступной цене с автошколой "Форсаж"',
            'SECTION_META_DESCRIPTION' => 'Запишитесь на обучение категории Е в Воронеже по выгодной стоимости: сдайте экзамен и получите водительские права класса E для вождения транспортного средства с прицепом по привлекательной цене в автошколе "Форсаж".',
        ];
    }

    private function getOldMetaTags(): array
    {
        return [
            'SECTION_META_TITLE' => 'Обучение категории Е в Воронеже по оптимальной стоимости: сдать экзамен и получить водительские права направления E по выгодной цене с автошколой "Форсаж"',
            'SECTION_META_DESCRIPTION' => 'Запишитесь на обучение категории Е в Воронеже по отличной стоимости: сдайте экзамен и получите водительские права класса E по доступной цене для вождения транспортного средства с прицепом в автошколе "Форсаж".',
        ];
    }

    private function getSectionId(): int
    {
        $section = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            '=CODE' => 'kategoriya-e',
        ], false, ['ID'])->Fetch();

        if (empty($section['ID'])) {
            throw new MigrationException('Раздел kategoriya-e не найден');
        }

        return (int)$section['ID'];
    }

    private function getIblockId(): int
    {
        return 5;
    }
}
