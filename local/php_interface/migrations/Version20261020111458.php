<?php

namespace Sprint\Migration;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20261020111458 extends Version
{
    protected $author = 'admin';
    protected $description = 'Создать инфоблок сведений об образовательной организации с разделами и PDF';
    protected $moduleVersion = '5.6.4';

    private const IBLOCK_TYPE = 'content';
    private const IBLOCK_CODE = 'education_documents';
    private const XML_ID = 'fors.education.documents';

    // Порядок основных разделов из документа «Структура».
    private const SECTIONS = [
        'basic-information' => 'Основные сведения',
        'management-structure' => 'Структура и органы управления образовательной организацией',
        'documents' => 'Документы',
        'education' => 'Образование',
        'management' => 'Руководство',
        'teaching-staff' => 'Педагогический состав',
        'facilities' => 'Материально-техническое обеспечение и оснащенность образовательного процесса',
        'paid-services' => 'Платные образовательные услуги',
        'financial-activity' => 'Финансово-хозяйственная деятельность',
        'vacancies' => 'Вакантные места для приема (перевода) обучающихся',
        'student-support' => 'Стипендии и меры поддержки обучающихся',
        'international-cooperation' => 'Международное сотрудничество',
        'catering' => 'Организация питания в образовательной организации',
    ];

    public function up()
    {
        $this->checkEnvironment();
        $this->getOwnIblock();
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->saveIblock([
            'IBLOCK_TYPE_ID' => self::IBLOCK_TYPE,
            'CODE' => self::IBLOCK_CODE,
            'XML_ID' => self::XML_ID,
            'API_CODE' => 'educationdocuments',
            'NAME' => 'Сведения об образовательной организации',
            'LID' => ['s1'],
            'ACTIVE' => 'Y',
            'SORT' => 600,
            'VERSION' => 2,
            'LIST_MODE' => 'S',
            'SECTION_CHOOSER' => 'L',
            'SECTION_PROPERTY' => 'Y',
            'LIST_PAGE_URL' => '#SITE_DIR#info/',
            'SECTION_PAGE_URL' => '#SITE_DIR#info/',
            'DETAIL_PAGE_URL' => '#SITE_DIR#info/',
            'GROUP_ID' => ['1' => 'X', '2' => 'R'],
            'INDEX_ELEMENT' => 'N',
            'INDEX_SECTION' => 'N',
            'BIZPROC' => 'N',
            'WORKFLOW' => 'N',
        ]);

        $helper->Iblock()->saveIblockFields($iblockId, [
            'NAME' => ['IS_REQUIRED' => 'Y'],
            'IBLOCK_SECTION' => ['IS_REQUIRED' => 'Y'],
            'CODE' => ['IS_REQUIRED' => 'N'],
            'XML_ID' => ['IS_REQUIRED' => 'N'],
            'PREVIEW_TEXT' => ['IS_REQUIRED' => 'N'],
            'DETAIL_TEXT' => ['IS_REQUIRED' => 'N'],
            'PREVIEW_PICTURE' => ['IS_REQUIRED' => 'N'],
            'DETAIL_PICTURE' => ['IS_REQUIRED' => 'N'],
        ]);

        $helper->Iblock()->saveProperty($iblockId, [
            'NAME' => 'PDF-файл',
            'CODE' => 'PDF_FILE',
            'XML_ID' => 'fors.education.pdf',
            'ACTIVE' => 'Y',
            'SORT' => 100,
            'PROPERTY_TYPE' => 'F',
            'FILE_TYPE' => 'pdf',
            'MULTIPLE' => 'N',
            'IS_REQUIRED' => 'Y',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
        ]);

        $sort = 100;
        foreach (self::SECTIONS as $code => $name) {
            $helper->Iblock()->saveSectionByCode($iblockId, [
                'CODE' => $code,
                'XML_ID' => self::XML_ID . '.' . $code,
                'NAME' => $name,
                'IBLOCK_SECTION_ID' => false,
                'ACTIVE' => 'Y',
                'SORT' => $sort,
            ]);
            $sort += 100;
        }

        $helper->UserOptions()->saveElementForm($iblockId, [
            'Документ|edit1' => [
                'NAME' => 'Название',
                'PROPERTY_PDF_FILE' => 'PDF-файл',
                'SECTIONS' => 'Раздел',
            ],
            'Настройки|edit2' => [
                'ACTIVE' => 'Активность',
                'SORT' => 'Сортировка',
            ],
        ]);
        $helper->UserOptions()->saveSectionForm($iblockId, [
            'Раздел|edit1' => [
                'NAME' => 'Название',
                'CODE' => 'Символьный код',
                'IBLOCK_SECTION_ID' => 'Родительский раздел',
                'ACTIVE' => 'Активность',
                'SORT' => 'Сортировка',
            ],
        ]);
        $helper->UserOptions()->saveElementList($iblockId, [
            'order' => 'asc',
            'by' => 'sort',
            'page_size' => 20,
            'columns' => ['NAME', 'PROPERTY_PDF_FILE', 'SORT', 'ACTIVE', 'ID'],
        ]);

        \CIBlock::clearIblockTagCache($iblockId);
        $this->outSuccess('Создан инфоблок #' . $iblockId . ': 13 разделов, название и обязательный PDF-файл');
    }

    public function down()
    {
        $this->checkEnvironment();
        $iblock = $this->getOwnIblock();
        if (!$iblock) {
            $this->outInfo('Инфоблок не найден');
            return;
        }

        // Сохраняем разделы, документы и прикрепленные файлы при откате.
        $entity = new \CIBlock();
        if (!$entity->Update((int)$iblock['ID'], ['ACTIVE' => 'N'])) {
            throw new MigrationException($entity->LAST_ERROR);
        }
        \CIBlock::clearIblockTagCache((int)$iblock['ID']);
        $this->outSuccess('Инфоблок отключен. Разделы, документы и PDF-файлы сохранены');
    }

    private function getOwnIblock(): ?array
    {
        $rows = IblockTable::getList([
            'select' => ['ID', 'XML_ID'],
            'filter' => ['=IBLOCK_TYPE_ID' => self::IBLOCK_TYPE, '=CODE' => self::IBLOCK_CODE],
            'limit' => 2,
        ])->fetchAll();
        if (count($rows) > 1 || ($rows && $rows[0]['XML_ID'] !== self::XML_ID)) {
            throw new MigrationException('Код education_documents занят другим инфоблоком');
        }
        return $rows[0] ?? null;
    }

    private function checkEnvironment(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }
        $type = \CIBlockType::GetByID(self::IBLOCK_TYPE)->Fetch();
        if (!$type || $type['SECTIONS'] !== 'Y') {
            throw new MigrationException('Не найден тип content с поддержкой разделов');
        }
        $site = \CSite::GetByID('s1')->Fetch();
        if (!$site || $site['DIR'] !== '/' || $site['SERVER_NAME'] !== 'fors36.ru') {
            throw new MigrationException('Не найден ожидаемый сайт fors36.ru в корне s1');
        }
    }
}
