<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class CategoryBRemoveOldImages20260608194355 extends Version
{
    protected $author = "admin";

    protected $description = "Remove category B old transmission images";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->updateSection([
            'UF_IMAGES' => [],
        ]);
    }

    public function down()
    {
        $this->updateSection([
            'UF_IMAGES' => [64, 65],
        ]);
    }

    private function updateSection(array $fields): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }

        $section = new \CIBlockSection();
        if (!$section->Update($this->getSectionId(), $fields)) {
            throw new MigrationException($section->LAST_ERROR);
        }

        $this->outSuccess('Старые изображения категории B обновлены');
    }

    private function getSectionId(): int
    {
        $section = \CIBlockSection::GetList([], [
            'IBLOCK_ID' => $this->getIblockId(),
            '=CODE' => 'kategoriya-v-v1',
        ], false, ['ID'])->Fetch();

        if (empty($section['ID'])) {
            throw new MigrationException('Раздел kategoriya-v-v1 не найден');
        }

        return (int)$section['ID'];
    }

    private function getIblockId(): int
    {
        return 5;
    }
}
