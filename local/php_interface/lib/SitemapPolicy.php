<?php

namespace Fors;

use Bitrix\Main\Config\Option;

/**
 * CSiteMap reads the search index. Keep exclusions at its source so that
 * regeneration from the admin UI or an existing cron uses the same policy.
 */
final class SitemapPolicy
{
    public const OPTION = 'fors_sitemap_policy_enabled';

    public const EXCLUDED_DIRECTORIES = [
        '/verstka/', '/test/', '/stats/', '/search/', '/info/', '/content/',
        '/output/', '/error/', '/text-page/', '/online-traning-main/',
        '/shares/', '/branches/', '/concurses/', '/ofisy-i-klassy/',
        '/calendar_old/',
    ];

    public const EXCLUDED_FILES = ['/readme.html', '/typography.php'];

    public static function isExcluded(string $url): bool
    {
        $url = str_replace(['#SITE_DIR#', '#LANG#', '#SERVER_NAME#'], ['/', '/', 'fors36.ru'], $url);
        $path = (string)parse_url($url, PHP_URL_PATH);
        $path = preg_replace('#/+#', '/', $path);
        $path = preg_replace('#/index\.(?:php|html?)$#i', '/', $path);

        foreach (self::EXCLUDED_DIRECTORIES as $directory) {
            if ($path === rtrim($directory, '/') || strpos($path, $directory) === 0) {
                return true;
            }
        }

        return in_array($path, self::EXCLUDED_FILES, true);
    }

    public static function beforeIndex(array $fields): array
    {
        if (Option::get('main', self::OPTION, 'N') !== 'Y') {
            return $fields;
        }

        $sites = $fields['SITE_ID'] ?? $fields['LID'] ?? [];
        if (!is_array($sites)) {
            $sites = [$sites];
        }
        if (!in_array('s1', $sites, true) && !array_key_exists('s1', $sites)) {
            return $fields;
        }

        $url = isset($sites['s1']) && $sites['s1'] !== '' ? $sites['s1'] : ($fields['URL'] ?? '');
        if (self::isExcluded((string)$url)) {
            // The native Index API removes entries with empty TITLE and BODY.
            $fields['TITLE'] = '';
            $fields['BODY'] = '';
        }

        return $fields;
    }
}
