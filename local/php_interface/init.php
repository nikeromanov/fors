<?php
define("SETTINGS_IBLOCK_ID","1");
define("CATALOG_IBLOCK_ID","2");

include_once __DIR__ . '/vendor/autoload.php';

AddEventHandler('main', 'OnPageStart', 'forsHandleInvalidUrl');
function forsHandleInvalidUrl()
{
    if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
        return;
    }

    if (php_sapi_name() === 'cli') {
        return;
    }

    if (!class_exists('\Bitrix\Main\Context')) {
        return;
    }

    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    if (!$request) {
        return;
    }

    $path = (string)$request->getRequestedPage();
    if ($path === '') {
        return;
    }

    if (preg_match('#//+#', $path)) {
        if (!defined('ERROR_404')) {
            define('ERROR_404', 'Y');
        }
        if (class_exists('CHTTP')) {
            CHTTP::SetStatus('404 Not Found');
        } elseif (function_exists('http_response_code')) {
            http_response_code(404);
        }
        $page404 = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/404.php';
        if (is_file($page404)) {
            require $page404;
        }
        if (class_exists('\Bitrix\Main\Application')) {
            \Bitrix\Main\Application::getInstance()->end();
        }
        exit;
    }
}


if (!function_exists('CurrencyFormat')) {

    function CurrencyFormat($sum, $currency = 'RUB', $useTemplate = true): string
    {
       
        if (is_string($sum)) {
            $sum = str_replace(["\xC2\xA0", ' '], '', $sum); // nbsp + пробел
            $sum = str_replace(',', '.', $sum);
        }
        $num = (float)$sum;

       
        $isInt = abs($num - round($num)) < 0.0000001;
        $decimals = $isInt ? 0 : 2;

        return number_format($num, $decimals, '.', ' ') . ' ₽';
    }
}

function getSettings($iblockId = 0,$id = 0){
	CModule::IncludeModule("iblock");
	if($iblockId==0){
		$iblockId=SETTINGS_IBLOCK_ID;
	}
	$arSelect = Array("ID", "IBLOCK_ID","PROPERTY_*","NAME","PREVIEW_TEXT","DETAIL_TEXT","DETAIL_PICTURE","PREVIEW_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>$iblockId,  "ACTIVE"=>"Y");
	if($id>0){
		$arFilter["ID"] = $id;
	}
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields();  
	
		$arProps = $ob->GetProperties();
		$arFields["PROPERTIES"]=$arProps;
	}
	return $arFields;
}
function num_word_standart($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}
function splitByParentheses(string $s): array
{
    $s = trim($s);

    if (preg_match('/^(.*?)(?:\s*\((.*?)\)\s*)$/u', $s, $m)) {
        return [
            'text'   => trim($m[1]),                
            'inside' => trim($m[2]) !== '' ? trim($m[2]) : '', 
        ];
    }

    return ['text' => $s, 'inside' => null];
}

AddEventHandler('main', 'OnEpilog', 'forsSendLastModifiedHeader');
AddEventHandler('main', 'OnEndBufferContent', 'forsApplyAltFromCsv');

function forsSendLastModifiedHeader()
{
    global $APPLICATION;

    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
        return;
    }

    if (!class_exists('CHTTP') || !is_object($APPLICATION) || !method_exists($APPLICATION, 'GetPageProperty')) {
        return;
    }

    if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
        return;
    }

    $request = \Bitrix\Main\Context::getCurrent()->getRequest();

    if (!$request || !in_array($request->getRequestMethod(), ['GET', 'HEAD'], true)) {
        return;
    }

    $lastModified = 0;
    $pageProperty = trim((string)$APPLICATION->GetPageProperty('last_modified'));

    if ($pageProperty !== '') {
        $timestamp = MakeTimeStamp($pageProperty);

        if ($timestamp) {
            $lastModified = $timestamp;
        }
    }

    $documentRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
    $paths = [];

    $curPage = $APPLICATION->GetCurPage(true);

    if ($curPage) {
        $paths[] = $documentRoot . $curPage;
    }

    if (defined('SITE_TEMPLATE_PATH')) {
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/header.php';
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/footer.php';
    }

    if (defined('TEMPLATE_PAGE') && TEMPLATE_PAGE != '') {
        $paths[] = $documentRoot . SITE_TEMPLATE_PATH . '/template_blocks/' . TEMPLATE_PAGE . '.php';
    }

    foreach ($paths as $path) {
        if (is_file($path)) {
            $mtime = filemtime($path);

            if ($mtime && $mtime > $lastModified) {
                $lastModified = $mtime;
            }
        }
    }

    if ($lastModified <= 0 || headers_sent()) {
        return;
    }

    $headerValue = gmdate('D, d M Y H:i:s', $lastModified) . ' GMT';
    $ifModifiedSinceHeader = trim((string)$request->getHeader('If-Modified-Since'));
    $ifModifiedSince = $ifModifiedSinceHeader !== '' ? strtotime($ifModifiedSinceHeader) : false;

    if ($ifModifiedSince !== false && $ifModifiedSince >= $lastModified) {
        if (is_callable(['CHTTP', 'SetStatus'])) {
            CHTTP::SetStatus('304 Not Modified');
        } elseif (function_exists('http_response_code')) {
            http_response_code(304);
        } elseif (isset($_SERVER['SERVER_PROTOCOL'])) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
        }

        header('Last-Modified: ' . $headerValue);

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        \Bitrix\Main\Application::getInstance()->end();
    }

    if (is_callable(['CHTTP', 'SetLastModified'])) {
        CHTTP::SetLastModified($lastModified);
    } else {
        header('Last-Modified: ' . $headerValue);
    }
}

function forsLoadAltMapFromCsv(): array
{
    static $cache = null;

    if ($cache !== null) {
        return $cache;
    }

    $cache = [];
    $filePath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/alt_texts.csv';

    if (!is_file($filePath) || !is_readable($filePath)) {
        return $cache;
    }

    if (($handle = fopen($filePath, 'r')) === false) {
        return $cache;
    }

    $header = fgetcsv($handle);

    if (!is_array($header)) {
        fclose($handle);
        return $cache;
    }

    $headerMap = [];
    foreach ($header as $index => $name) {
        $name = mb_strtolower(trim((string)$name));
        if ($name !== '') {
            $headerMap[$name] = $index;
        }
    }

    $fromIndex = $headerMap['from'] ?? null;
    $toIndex = $headerMap['to'] ?? null;
    $altIndex = $headerMap['alt'] ?? null;

    if ($fromIndex === null || $toIndex === null || $altIndex === null) {
        fclose($handle);
        return $cache;
    }

    while (($row = fgetcsv($handle)) !== false) {
        $from = trim((string)($row[$fromIndex] ?? ''));
        $to = trim((string)($row[$toIndex] ?? ''));
        $alt = trim((string)($row[$altIndex] ?? ''));

        if ($to === '' || $alt === '') {
            continue;
        }

        if ($from === '') {
            $from = '*';
        }

        $cache[$from][$to] = $alt;
    }

    fclose($handle);

    return $cache;
}

function forsApplyAltFromCsv(&$content): void
{
    if (!is_string($content) || $content === '' || stripos($content, '<img') === false) {
        return;
    }

    if (defined('ADMIN_SECTION') && ADMIN_SECTION === true) {
        return;
    }

    $request = \Bitrix\Main\Context::getCurrent()->getRequest();
    if (!$request || !in_array($request->getRequestMethod(), ['GET', 'HEAD'], true)) {
        return;
    }

    $altMap = forsLoadAltMapFromCsv();
    if (!$altMap) {
        return;
    }

    global $APPLICATION;

    if (!is_object($APPLICATION) || !method_exists($APPLICATION, 'GetCurPage')) {
        return;
    }

    $scheme = $request->isHttps() ? 'https' : 'http';
    $host = $request->getHttpHost();
    $path = $APPLICATION->GetCurPage(false);
    $currentUrl = $scheme . '://' . $host . $path;

    $pageTargets = $altMap[$currentUrl] ?? $altMap[$path] ?? $altMap['*'] ?? [];

    if (!$pageTargets) {
        return;
    }

    $content = preg_replace_callback('/<img\b[^>]*>/i', function ($matches) use ($pageTargets, $scheme, $host) {
        $tag = $matches[0];

        if (!preg_match('/\bsrc\s*=\s*(["\'])(.*?)\1/i', $tag, $srcMatch)) {
            return $tag;
        }

        $src = trim($srcMatch[2]);
        if ($src === '') {
            return $tag;
        }

        $candidates = [$src];
        if (strpos($src, '//') === 0) {
            $candidates[] = $scheme . ':' . $src;
        } elseif (strpos($src, '/') === 0) {
            $candidates[] = $scheme . '://' . $host . $src;
        }

        $altText = null;
        foreach ($candidates as $candidate) {
            if (isset($pageTargets[$candidate])) {
                $altText = $pageTargets[$candidate];
                break;
            }
        }

        if ($altText === null) {
            return $tag;
        }

        $charset = defined('SITE_CHARSET') ? SITE_CHARSET : 'UTF-8';
        $escapedAlt = htmlspecialchars($altText, ENT_QUOTES | ENT_SUBSTITUTE, $charset);

        if (preg_match('/\balt\s*=\s*(["\'])(.*?)\1/i', $tag)) {
            return preg_replace('/\balt\s*=\s*(["\'])(.*?)\1/i', 'alt="' . $escapedAlt . '"', $tag, 1);
        }

        if (substr($tag, -2) === '/>') {
            return substr($tag, 0, -2) . ' alt="' . $escapedAlt . '" />';
        }

        return substr($tag, 0, -1) . ' alt="' . $escapedAlt . '">';
    }, $content);
}
