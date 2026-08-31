<?php

namespace Sprint\Migration;

use Bitrix\Main\Loader;
use Sprint\Migration\Exceptions\MigrationException;

class Version20260831134418 extends Version
{
    protected $author = "admin";

    protected $description = "Обновление политики конфиденциальности 2026-08-26";

    protected $moduleVersion = "5.6.4";

    public function up()
    {
        $this->ensureIblockModule();
        $this->updatePolicy(true);
    }

    public function down()
    {
        $this->ensureIblockModule();
        $this->updatePolicy(false);
    }

    private function ensureIblockModule(): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new MigrationException('Модуль iblock не подключен');
        }
    }

    private function updatePolicy(bool $useNewPolicy): void
    {
        $result = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['IBLOCK_ID' => 21, 'ACTIVE' => 'Y'],
            false,
            ['nTopCount' => 2],
            ['ID', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE']
        );
        $policy = $result->Fetch();
        if (!$policy || $result->Fetch()) {
            throw new MigrationException('Не найден единственный активный элемент политики конфиденциальности');
        }

        $projectRoot = dirname(__DIR__, 3);
        $oldPolicyPath = __DIR__ . '/assets/privacy-policy-before-2026-08-26.html.base64';
        $newPolicyPath = $projectRoot . '/local/templates/fors/includes/legal/privacy-policy-2026-08-26.html';
        $oldPolicy = $this->readBase64File($oldPolicyPath);
        $newPolicy = $this->readFile($newPolicyPath);
        $source = $useNewPolicy ? $oldPolicy : $newPolicy;
        $target = $useNewPolicy ? $newPolicy : $oldPolicy;
        $current = (string)$policy['DETAIL_TEXT'];

        if ($current === $target) {
            $this->outInfo('Политика уже находится в требуемой редакции');
            return;
        }
        if ($current !== $source) {
            throw new MigrationException('Текущий текст политики отличается от ожидаемой редакции; автоматическая замена остановлена');
        }

        $element = new \CIBlockElement();
        if (!$element->Update((int)$policy['ID'], [
            'DETAIL_TEXT' => $target,
            'DETAIL_TEXT_TYPE' => 'html',
        ])) {
            throw new MigrationException($element->LAST_ERROR ?: 'Не удалось обновить политику конфиденциальности');
        }

        \CIBlock::clearIblockTagCache(21);
        $this->outSuccess($useNewPolicy ? 'Политика обновлена до редакции от 26 августа 2026 года' : 'Предыдущая редакция политики восстановлена');
    }

    private function readFile(string $path): string
    {
        if (!is_file($path)) {
            throw new MigrationException('Не найден файл миграции: ' . $path);
        }
        $content = file_get_contents($path);
        if ($content === false || $content === '') {
            throw new MigrationException('Не удалось прочитать файл миграции: ' . $path);
        }
        return $content;
    }

    private function readBase64File(string $path): string
    {
        $encoded = $this->readFile($path);
        $content = base64_decode($encoded, true);
        if ($content === false || $content === '') {
            throw new MigrationException('Не удалось распаковать файл миграции: ' . $path);
        }
        return $content;
    }
}
