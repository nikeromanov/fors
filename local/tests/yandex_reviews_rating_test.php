<?php
// Standalone contract tests: php local/tests/yandex_reviews_rating_test.php
namespace {
    if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
}
namespace Bitrix\Main\Localization {
    class Loc {
        public static function loadMessages($file): void { global $MESS; include dirname($file).'/lang/ru/'.basename($file); }
        public static function getMessage($key, $values = []): string { global $MESS; return strtr($MESS[$key], $values); }
    }
}
namespace Bitrix\Main\Page {
    class Asset {
        public static function getInstance(): self { return new self; }
        public function addCss($path): void {}
        public function addJs($path): void {}
    }
}
namespace Bitrix\Main\Data {
    class Cache
    {
        public static array $entries = [];
        private string $key;
        public static function createInstance(): self { return new self; }
        public function initCache($ttl, $key, $dir): bool { $this->key = $key; return isset(self::$entries[$key]); }
        public function getVars(): array { return self::$entries[$this->key]; }
        public function clean($key, $dir): void { unset(self::$entries[$key]); }
        public function startDataCache($ttl, $key, $dir): bool { $this->key = $key; return true; }
        public function endDataCache($value): void { self::$entries[$this->key] = $value; }
    }
}
namespace Bitrix\Main\Web {
    class HttpClient
    {
        public static int $requests = 0;
        public static array $responses = [];
        private int $status = 0;
        public function __construct(array $options) {}
        public function setHeader($name, $value): void {}
        public function get($url) {
            self::$requests++;
            $response = array_shift(self::$responses);
            if ($response === null) throw new \RuntimeException('Timeout');
            [$this->status, $body] = $response;
            return $body;
        }
        public function getStatus(): int { return $this->status; }
    }
}
namespace {
    use Bitrix\Main\Data\Cache;
    use Bitrix\Main\Web\HttpClient;
    use Fors\YandexReviewsRating;

    require dirname(__DIR__).'/php_interface/lib/YandexReviewsRating.php';
    $_SERVER['DOCUMENT_ROOT'] = '/tmp/fors-rating-tests-'.getmypid();
    $logs = [];
    function AddMessage2Log($message, $module): void { $GLOBALS['logs'][] = [$message, $module]; }
    function check(bool $condition, string $message): void {
        if (!$condition) throw new RuntimeException($message);
        echo "PASS: $message\n";
    }
    function page($rating = 4.900000095, $count = 517, $id = '70026884601'): string {
        $state = ['stack' => [['response' => ['items' => [[
            'id' => $id, 'ratingData' => ['ratingValue' => $rating, 'reviewCount' => $count, 'ratingCount' => 812],
        ]]]]]];
        return '<html><script class="other state-view extra" type="application/json">'.json_encode($state).'</script></html>';
    }
    function expire(): void { foreach (Cache::$entries as &$entry) $entry['next_check_at'] = 0; }

    check(YandexReviewsRating::parse(page()) === ['rating' => 4.9, 'review_count' => 517], 'correct organization, one decimal and review count rather than rating count');
    check(YandexReviewsRating::parse(page(5, 1, 'other')) === null, 'ignore another organization');
    foreach ([page(0), page(6), page(4.9, -1), page(4.9, '517'), '<html>CAPTCHA</html>', '<script type="application/json" class="state-view">{broken</script>'] as $invalid) {
        check(YandexReviewsRating::parse($invalid) === null, 'reject invalid or unavailable source');
    }
    HttpClient::$responses[] = [200, page(4.8, 521)];
    $value = YandexReviewsRating::get();
    check($value['rating'] === 4.8 && $value['review_count'] === 521, 'refresh with new source values');
    check($value['next_check_at'] - $value['checked_at'] === 21600, 'successful refresh lasts six hours');
    YandexReviewsRating::get();
    check(HttpClient::$requests === 1, 'fresh cache makes no HTTP request');

    expire();
    $value = YandexReviewsRating::get();
    check($value['rating'] === 4.8 && $value['review_count'] === 521, 'timeout preserves last successful values');
    check($value['next_check_at'] > time() && $value['next_check_at'] <= time() + 900, 'failed refresh is retried after fifteen minutes');
    YandexReviewsRating::get();
    check(HttpClient::$requests === 2 && count($logs) === 1, 'retry throttle prevents repeated requests and log spam');

    expire();
    HttpClient::$responses[] = [200, '<html>CAPTCHA</html>'];
    check(YandexReviewsRating::get()['review_count'] === 521, 'CAPTCHA preserves the previous count');
    expire();
    HttpClient::$responses[] = [503, 'Unavailable'];
    check(YandexReviewsRating::get()['review_count'] === 521, 'HTTP failure preserves the previous count');
    Cache::$entries = [];
    check(YandexReviewsRating::get()['review_count'] === 517, 'cold-cache failure uses the verified snapshot');

    // Another visitor refreshing the source must not block this request.
    expire();
    $lockPath = sys_get_temp_dir().'/fors_yandex_'.sha1($_SERVER['DOCUMENT_ROOT'].YandexReviewsRating::ORGANIZATION_ID).'.lock';
    $lock = fopen($lockPath, 'c');
    flock($lock, LOCK_EX);
    $requests = HttpClient::$requests;
    YandexReviewsRating::get();
    check(HttpClient::$requests === $requests, 'parallel refresh returns cached values without another HTTP request');
    flock($lock, LOCK_UN);
    fclose($lock);
    unlink($lockPath);
    define('B_PROLOG_INCLUDED', true);
    define('SITE_TEMPLATE_PATH', '/local/templates/fors');
    function htmlspecialcharsbx($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
    $APPLICATION = new class { public function IncludeComponent(...$params): void {} };
    $_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__, 2);
    $key = array_key_first(Cache::$entries);
    foreach ([0 => 'отзывов', 1 => 'отзыв', 2 => 'отзыва', 5 => 'отзывов', 11 => 'отзывов', 21 => 'отзыв', 22 => 'отзыва', 111 => 'отзывов'] as $count => $word) {
        Cache::$entries[$key] = ['rating' => 4.9, 'review_count' => $count, 'checked_at' => time(), 'next_check_at' => time() + 21600];
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/local/templates/fors/includes/reviews-media.php';
        $html = ob_get_clean();
        check(str_contains($html, $count.' '.$word.' на Яндексе') && str_contains($html, '4,9'), 'render dynamic count and correct Russian plural: '.$count);
    }

}
