<?php

// Layouts do not include the Bitrix prolog, so redirects must run before HTML.
if (PHP_SAPI === 'cli' || !in_array($_SERVER['REQUEST_METHOD'] ?? '', ['GET', 'HEAD'], true)) {
    return;
}

$layoutRedirects = [
    '/verstka/index.php' => '/',
    '/verstka/about.php' => '/about/',
    '/verstka/articles.php' => '/articles/',
    '/verstka/articles_element.php' => '/articles/',
    '/verstka/autodrome.php' => '/autodrom/',
    '/verstka/cars.php' => '/cars/',
    '/verstka/category.php' => '/category/',
    '/verstka/contacts.php' => '/contacts/',
    '/verstka/discount.php' => '/news/',
    '/verstka/discount_element.php' => '/news/',
    '/verstka/driving.php' => '/driving/',
    '/verstka/exams.php' => '/exams/',
    '/verstka/extreme.php' => '/extremal/',
    '/verstka/faq.php' => '/faq/',
    '/verstka/fast_courses.php' => '/accelerated/',
    '/verstka/gallery.php' => '/gallery/',
    '/verstka/gifts.php' => '/gifts/',
    '/verstka/info.php' => '/info/',
    '/verstka/instructors.php' => '/instructors/',
    '/verstka/instructors_element.php' => '/instructors/',
    '/verstka/license.php' => '/poluchenie-voditelskikh-prav/',
    '/verstka/news.php' => '/news/',
    '/verstka/news_element.php' => '/news/',
    '/verstka/online.php' => '/online-traning/',
    '/verstka/payment.php' => '/payment/',
    '/verstka/policy.php' => '/policy/',
    '/verstka/price.php' => '/price/',
    '/verstka/reviews.php' => '/reviews/',
    '/verstka/schedule.php' => '/calendar/',
    '/verstka/search.php' => '/search/',
    '/verstka/skills.php' => '/restoring-skills/',
    '/verstka/specsignal.php' => '/special-signals/',
    '/verstka/video.php' => '/reviews/',
    '/verstka/' => '/',
    '/verstka' => '/',
];
$layoutPath = (string)parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
if (!isset($layoutRedirects[$layoutPath])) {
    return;
}
$layoutTarget = $layoutRedirects[$layoutPath];
$layoutQuery = (string)($_SERVER['QUERY_STRING'] ?? '');
if ($layoutQuery !== '') {
    $layoutTarget .= '?' . $layoutQuery;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
LocalRedirect($layoutTarget, true, '301 Moved Permanently');
