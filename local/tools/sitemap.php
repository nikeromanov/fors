<?php

// Use the same native generator as /bitrix/admin/search_sitemap.php.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__, 2);
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Fors\SitemapPolicy;

Loc::loadMessages(__FILE__);

$lock = fopen(sys_get_temp_dir() . '/fors-sitemap-' . md5($_SERVER['DOCUMENT_ROOT']) . '.lock', 'c');
if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
    fwrite(STDERR, Loc::getMessage('FORS_SITEMAP_LOCK') . PHP_EOL);
    exit(1);
}

try {
    if (!Loader::includeModule('search') || Option::get('main', SitemapPolicy::OPTION, 'N') !== 'Y') {
        throw new RuntimeException(Loc::getMessage('FORS_SITEMAP_POLICY_REQUIRED'));
    }
    $site = \CSite::GetByID('s1')->Fetch();
    if (!$site || $site['DIR'] !== '/' || $site['SERVER_NAME'] !== 'fors36.ru') {
        throw new RuntimeException(Loc::getMessage('FORS_SITEMAP_SITE_REQUIRED'));
    }

    $map = new \CSiteMap();
    $state = ['ID' => 0, 'CNT' => 0, 'FILE_SIZE' => 0, 'FILE_ID' => 0,
        'FILE_URL_CNT' => 0, 'ERROR_CNT' => 0, 'PARAM2' => 0];
    do {
        $state = $map->Create('s1', [10, 5000], $state, ['USE_HTTPS' => 'Y']);
        if ($state === false) {
            throw new RuntimeException(strip_tags($map->m_error));
        }
    } while (is_array($state));

    echo Loc::getMessage('FORS_SITEMAP_COMPLETE') . PHP_EOL;
} catch (Throwable $error) {
    fwrite(STDERR, $error->getMessage() . PHP_EOL);
    exit(1);
} finally {
    flock($lock, LOCK_UN);
    fclose($lock);
}
