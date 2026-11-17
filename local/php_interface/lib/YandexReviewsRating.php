<?php

namespace Fors;

use Bitrix\Main\Data\Cache;
use Bitrix\Main\Web\HttpClient;

final class YandexReviewsRating
{
    public const ORGANIZATION_ID = '70026884601';
    public const URL = 'https://yandex.ru/maps/org/forsazh/'.self::ORGANIZATION_ID.'/reviews/';
    private const CACHE_KEY = 'yandex_reviews_'.self::ORGANIZATION_ID.'_v1';
    private const CACHE_DIR = '/fors/yandex_reviews';
    private const STORAGE_TTL = 31536000;
    private const REFRESH_INTERVAL = 21600;
    private const RETRY_INTERVAL = 900;

    public static function get(): array
    {
        $state = self::readState();
        if ($state['next_check_at'] > time()) return $state;

        // Do not let concurrent visitors trigger parallel requests to Yandex.
        $lockPath = sys_get_temp_dir().'/fors_yandex_'.sha1($_SERVER['DOCUMENT_ROOT'].self::ORGANIZATION_ID).'.lock';
        $lock = @fopen($lockPath, 'c');
        if (!$lock) return $state;
        if (!flock($lock, LOCK_EX | LOCK_NB)) {
            fclose($lock);
            return $state;
        }

        try {
            $state = self::readState();
            if ($state['next_check_at'] > time()) return $state;
            try {
                $client = new HttpClient([
                    'socketTimeout' => 2, 'streamTimeout' => 3,
                    'redirect' => false, 'bodyLengthMax' => 4194304,
                ]);
                $client->setHeader('Accept-Language', 'ru-RU,ru;q=0.9');
                $body = $client->get(self::URL.'?lang=ru_RU');
                if ($client->getStatus() !== 200 || !is_string($body)) {
                    throw new \RuntimeException('Unexpected HTTP response: '.$client->getStatus());
                }
                $values = self::parse($body);
                if ($values === null) throw new \RuntimeException('Organization rating not found or invalid');
                $state = $values + ['checked_at' => time(), 'next_check_at' => time() + self::REFRESH_INTERVAL];
            } catch (\Throwable $exception) {
                // Preserve the last verified figures on network errors, CAPTCHA or format changes.
                $state['next_check_at'] = time() + self::RETRY_INTERVAL;
                AddMessage2Log($exception->getMessage(), 'fors.yandex_reviews');
            }
            $cache = Cache::createInstance();
            $cache->clean(self::CACHE_KEY, self::CACHE_DIR);
            if ($cache->startDataCache(self::STORAGE_TTL, self::CACHE_KEY, self::CACHE_DIR)) {
                $cache->endDataCache($state);
            }
            return $state;
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    private static function readState(): array
    {
        $cache = Cache::createInstance();
        if ($cache->initCache(self::STORAGE_TTL, self::CACHE_KEY, self::CACHE_DIR)) {
            $state = $cache->getVars();
            if (is_array($state) && self::validValues($state)
                && isset($state['checked_at'], $state['next_check_at'])
                && is_int($state['checked_at']) && is_int($state['next_check_at'])
            ) return $state;
        }
        // Verified snapshot for cold-cache failures; never replace it with zeroes.
        return ['rating' => 4.9, 'review_count' => 517, 'checked_at' => 1794916800, 'next_check_at' => 0];
    }

    public static function parse(string $html): ?array
    {
        if ($html === '' || strlen($html) > 4194304) return null;
        $document = new \DOMDocument();
        if (!$document->loadHTML($html, LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING)) return null;
        $xpath = new \DOMXPath($document);
        $scripts = $xpath->query('//script[@type="application/json" and contains(concat(" ", normalize-space(@class), " "), " state-view ")]');
        foreach ($scripts as $script) {
            try {
                $state = json_decode($script->textContent, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $exception) {
                continue;
            }
            if (!is_array($state)) continue;
            $values = self::findOrganization($state);
            if ($values !== null) return $values;
        }
        return null;
    }

    private static function findOrganization(array $node): ?array
    {
        $id = $node['id'] ?? null;
        if ((is_string($id) || is_int($id)) && (string)$id === self::ORGANIZATION_ID && isset($node['ratingData'])) {
            $data = $node['ratingData'];
            if (!is_array($data)) return null;
            $values = ['rating' => $data['ratingValue'] ?? null, 'review_count' => $data['reviewCount'] ?? null];
            if (!self::validValues($values)) return null;
            $values['rating'] = round((float)$values['rating'], 1);
            return $values;
        }
        foreach ($node as $value) {
            if (is_array($value)) {
                $found = self::findOrganization($value);
                if ($found !== null) return $found;
            }
        }
        return null;
    }

    private static function validValues(array $values): bool
    {
        return isset($values['rating'], $values['review_count'])
            && (is_int($values['rating']) || is_float($values['rating']))
            && is_finite((float)$values['rating']) && $values['rating'] >= 1 && $values['rating'] <= 5
            && is_int($values['review_count']) && $values['review_count'] >= 0;
    }
}
