<?php

namespace Sprint\Migration;

use Bitrix\Iblock\InheritedProperty\SectionTemplates;
use Bitrix\Iblock\InheritedProperty\SectionValues;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260813124715 extends Version
{
    protected $author = "admin";

    protected $description = "Категория D: SEO-текст и мета-теги (задача 600296)";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateSection(
            'возраст — не менее 21 года;',
            'возраст – не менее 21 года;',
            $this->getNewMetaTags()
        );
    }

    public function down()
    {
        $this->updateSection(
            'возраст – не менее 21 года;',
            'возраст — не менее 21 года;',
            $this->getOldMetaTags()
        );
    }

    private function updateSection(string $search, string $replacement, array $metaTags): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $sectionId = $this->getSectionId();
        $sectionData = \CIBlockSection::GetList(
            [],
            ['ID' => $sectionId, 'IBLOCK_ID' => $this->getIblockId()],
            false,
            ['ID', 'UF_TEXT']
        )->Fetch();
        $text = (string)($sectionData['UF_TEXT'] ?? '');

        if (substr_count($text, $search) !== 1) {
            throw new MigrationException('Не найден единственный ожидаемый фрагмент текста категории D');
        }

        $updatedText = str_replace($search, $replacement, $text, $replaceCount);
        if ($replaceCount !== 1) {
            throw new MigrationException('Не удалось обновить текст категории D');
        }

        $section = new \CIBlockSection();
        if (!$section->Update($sectionId, ['UF_TEXT' => $updatedText])) {
            throw new MigrationException($section->LAST_ERROR);
        }

        $templates = new SectionTemplates($this->getIblockId(), $sectionId);
        $templates->set($metaTags);

        $values = new SectionValues($this->getIblockId(), $sectionId);
        $values->clearValues();

        \CIBlock::clearIblockTagCache($this->getIblockId());
        $this->outSuccess('Текст и мета-теги категории D обновлены');
    }

    private function getNewMetaTags(): array
    {
        return [
            'SECTION_META_TITLE' => 'Обучение на права категории Д в Воронеже по выгодной стоимости: сдать экзамены и открыть водительское удостоверение D для автобуса по оптимальной цене - отучитесь на курсах для водителей и получите ВУ в автошколе «Форсаж»',
            'SECTION_META_DESCRIPTION' => 'Сдайте на права категории Д в Воронеже - пройдите обучение для водителей по разумной стоимости: получение ВУ для вождения автобуса - откройте водительское удостоверение D по привлекательной цене на курсах в автошколе «Форсаж».',
        ];
    }

    private function getOldMetaTags(): array
    {
        return [
            'SECTION_META_TITLE' => 'Обучение на права категории Д в Воронеже по отличной стоимости: сдать экзамены и открыть водительское удостоверение D для автобуса по доступной цене - отучитесь на курсах для водителей и получите ВУ в автошколе «Форсаж»',
            'SECTION_META_DESCRIPTION' => 'Сдайте на права категории Д в Воронеже - пройдите обучение для водителей по выгодной стоимости: получение ВУ для вождения автобуса - откройте водительское удостоверение D по оптимальной цене на курсах в автошколе «Форсаж».',
        ];
    }

    private function getSectionId(): int
    {
        $section = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            '=CODE' => 'kategoriya-d-d1',
        ], false, ['ID'])->Fetch();

        if (empty($section['ID'])) {
            throw new MigrationException('Раздел kategoriya-d-d1 не найден');
        }

        return (int)$section['ID'];
    }

    private function getIblockId(): int
    {
        return 5;
    }
}
