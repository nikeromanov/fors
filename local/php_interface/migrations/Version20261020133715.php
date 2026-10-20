<?php

namespace Sprint\Migration;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20261020133715 extends Version
{
    protected $author = 'admin';
    protected $description = 'Загрузить PDF-документы образовательной организации из папки Форсаж для сайта';
    protected $moduleVersion = '5.6.4';

    private const ASSETS = __DIR__ . '/assets/education-documents/';

    public function up()
    {
        $iblockId = $this->getIblockId();
        $documents = $this->readDocuments();
        $sections = $this->getSections($iblockId);

        // Проверяем все исходники и существующие записи до первой записи в БД.
        foreach ($documents as $document) {
            $path = self::ASSETS . $document['file'];
            if (!is_file($path)
                || filesize($path) !== $document['size']
                || hash_file('sha256', $path) !== $document['sha256']
            ) {
                throw new MigrationException('Не найден или поврежден PDF: ' . $document['source']);
            }
            if ($document['section'] !== 'programs' && !isset($sections[$document['section']])) {
                throw new MigrationException('Не найден раздел: ' . $document['section']);
            }
            $existing = $this->getElement($iblockId, $document['xml_id']);
            if ($existing) {
                $this->verifyAttachment($existing, $document);
            }
        }
        if (!isset($sections['education'])) {
            throw new MigrationException('Не найден родительский раздел Образование');
        }
        if (isset($sections['programs'])) {
            $programs = $sections['programs'];
            if ($programs['XML_ID'] !== 'fors.education.documents.programs'
                || (int)$programs['IBLOCK_SECTION_ID'] !== (int)$sections['education']['ID']
            ) {
                throw new MigrationException('Код programs занят другим разделом');
            }
        } else {
            $sectionId = $this->getHelperManager()->Iblock()->addSection($iblockId, [
                'NAME' => 'Программы',
                'CODE' => 'programs',
                'XML_ID' => 'fors.education.documents.programs',
                'IBLOCK_SECTION_ID' => (int)$sections['education']['ID'],
                'ACTIVE' => 'Y',
                'SORT' => 300,
            ]);
            $sections['programs'] = ['ID' => $sectionId];
        }

        $created = 0;
        $reused = 0;
        foreach ($documents as $document) {
            $existing = $this->getElement($iblockId, $document['xml_id']);
            if ($existing) {
                // Повторный up не загружает файл заново и сохраняет правки редактора.
                if ($existing['ACTIVE'] !== 'Y') {
                    $this->setActivity((int)$existing['ID'], 'Y');
                }
                $reused++;
                continue;
            }
            $file = \CFile::MakeFileArray(self::ASSETS . $document['file']);
            if (!$file) {
                throw new MigrationException('Не удалось прочитать PDF: ' . $document['source']);
            }
            $file['name'] = $document['original_name'];
            $file['type'] = 'application/pdf';
            $file['MODULE_ID'] = 'iblock';
            $sectionId = (int)$sections[$document['section']]['ID'];
            $element = new \CIBlockElement();
            $id = $element->Add([
                'IBLOCK_ID' => $iblockId,
                'IBLOCK_SECTION_ID' => $sectionId,
                'IBLOCK_SECTION' => [$sectionId],
                'XML_ID' => $document['xml_id'],
                'CODE' => 'edu-' . substr($document['xml_id'], -24),
                'NAME' => $document['name'],
                'SORT' => $document['sort'],
                'ACTIVE' => 'Y',
                'PROPERTY_VALUES' => ['PDF_FILE' => ['n0' => ['VALUE' => $file]]],
            ], false, false);
            if (!$id) {
                throw new MigrationException($document['source'] . ': ' . $element->LAST_ERROR);
            }
            $this->verifyAttachment($this->getElement($iblockId, $document['xml_id']), $document);
            $created++;
        }

        \CIBlock::clearIblockTagCache($iblockId);
        $this->outSuccess('Документов создано: ' . $created . ', уже загружено: ' . $reused);
    }

    public function down()
    {
        $iblockId = $this->getIblockId();
        $count = 0;
        foreach ($this->readDocuments() as $document) {
            $element = $this->getElement($iblockId, $document['xml_id']);
            if ($element) {
                $this->setActivity((int)$element['ID'], 'N');
                $count++;
            }
        }
        \CIBlock::clearIblockTagCache($iblockId);
        $this->outSuccess('Отключено документов: ' . $count . '. Элементы, PDF-файлы и разделы сохранены');
    }

    private function readDocuments(): array
    {
        $json = file_get_contents(self::ASSETS . 'documents.json');
        if ($json === false) {
            throw new MigrationException('Не найден манифест документов');
        }
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $documents = $data['documents'] ?? [];
        if (count($documents) !== 45) {
            throw new MigrationException('В манифесте ожидается 45 документов');
        }
        $seen = [];
        foreach ($documents as $document) {
            if (!preg_match('/^[a-f0-9]{64}\.pdf$/D', $document['file'])
                || !preg_match('/^fors\.education\.document\.[a-f0-9]{24}$/D', $document['xml_id'])
                || isset($seen[$document['xml_id']])
                || trim($document['name']) === ''
            ) {
                throw new MigrationException('Некорректная запись в манифесте');
            }
            $seen[$document['xml_id']] = true;
        }
        return $documents;
    }

    private function getIblockId(): int
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }
        $rows = IblockTable::getList([
            'select' => ['ID', 'XML_ID', 'ACTIVE'],
            'filter' => ['=IBLOCK_TYPE_ID' => 'content', '=CODE' => 'education_documents'],
            'limit' => 2,
        ])->fetchAll();
        if (count($rows) !== 1 || $rows[0]['XML_ID'] !== 'fors.education.documents'
            || $rows[0]['ACTIVE'] !== 'Y'
        ) {
            throw new MigrationException('Сначала примените миграцию Version20261020111458');
        }
        $id = (int)$rows[0]['ID'];
        $property = \CIBlockProperty::GetList([], ['IBLOCK_ID' => $id, 'CODE' => 'PDF_FILE'])->Fetch();
        if (!$property || $property['PROPERTY_TYPE'] !== 'F' || $property['MULTIPLE'] !== 'N'
            || $property['FILE_TYPE'] !== 'pdf' || $property['IS_REQUIRED'] !== 'Y'
        ) {
            throw new MigrationException('Не найдено ожидаемое свойство PDF_FILE');
        }
        return $id;
    }

    private function getSections(int $iblockId): array
    {
        $sections = [];
        $result = \CIBlockSection::GetList([], ['IBLOCK_ID' => $iblockId], false,
            ['ID', 'CODE', 'XML_ID', 'IBLOCK_SECTION_ID']);
        while ($section = $result->Fetch()) {
            if (isset($sections[$section['CODE']])) {
                throw new MigrationException('Найден повторяющийся код раздела: ' . $section['CODE']);
            }
            $sections[$section['CODE']] = $section;
        }
        return $sections;
    }

    private function getElement(int $iblockId, string $xmlId): ?array
    {
        $result = \CIBlockElement::GetList([], ['IBLOCK_ID' => $iblockId, '=XML_ID' => $xmlId],
            false, ['nTopCount' => 2], ['ID', 'ACTIVE', 'PROPERTY_PDF_FILE']);
        $element = $result->Fetch();
        if ($result->Fetch()) {
            throw new MigrationException('Найден повторяющийся XML_ID документа: ' . $xmlId);
        }
        return $element ?: null;
    }

    private function verifyAttachment(?array $element, array $document): void
    {
        $file = $element ? \CFile::GetFileArray((int)$element['PROPERTY_PDF_FILE_VALUE']) : false;
        $path = $file ? $_SERVER['DOCUMENT_ROOT'] . $file['SRC'] : '';
        if (!$file || !is_file($path) || hash_file('sha256', $path) !== $document['sha256']) {
            throw new MigrationException('Прикрепленный PDF отличается от исходника: ' . $document['source']);
        }
    }

    private function setActivity(int $id, string $active): void
    {
        $element = new \CIBlockElement();
        if (!$element->Update($id, ['ACTIVE' => $active], false, false)) {
            throw new MigrationException($element->LAST_ERROR);
        }
    }
}
