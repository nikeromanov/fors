<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
global $additionalClass;
Loc::loadMessages(__FILE__);
global $settings;
global $settingsAll;
$settingsAll = getSettings();
$settings = $settingsAll['PROPERTIES'];
global $APPLICATION;
$dir = $APPLICATION->GetCurDir();
$curPage = $APPLICATION->GetCurPage(false);
$is404 = defined("ERROR_404") || $curPage === "/404.php";
$isHome = ($dir == "/" && !$is404);
global $USER;
global $hideH;
global $notstandart;
CJSCore::Init(array('ajax'));
$breadcrumbIblockMap = [
	'/category/' => 5,
	'/articles/' => 14,
	'/shares/' => 24,
	'/reviews/' => 9,
	'/test/' => 40,
	'/instructors/' => 35,
	'/faq/' => 30,
	'/calendar/' => 23,
];
$addBreadcrumbChain = function () use ($dir, $breadcrumbIblockMap, $APPLICATION) {
	if (!Loader::includeModule('iblock')) {
		return;
	}
	foreach ($breadcrumbIblockMap as $baseDir => $iblockId) {
		if ($dir === $baseDir || strpos($dir, $baseDir) !== 0) {
			continue;
		}
		$relativePath = trim(substr($dir, strlen($baseDir)), '/');
		if ($relativePath === '') {
			break;
		}
		$relativeParts = explode('/', $relativePath);
		$lastSegment = end($relativeParts);
		$section = CIBlockSection::GetList(
			[],
			[
				'IBLOCK_ID' => $iblockId,
				'=CODE' => $lastSegment,
				'ACTIVE' => 'Y',
			],
			false,
			['ID', 'NAME', 'SECTION_PAGE_URL']
		)->Fetch();
		if ($section) {
			$navChain = CIBlockSection::GetNavChain($iblockId, $section['ID'], ['ID', 'NAME', 'SECTION_PAGE_URL']);
			while ($navItem = $navChain->GetNext()) {
				$APPLICATION->AddChainItem($navItem['NAME'], $navItem['SECTION_PAGE_URL']);
			}
			break;
		}
		$element = CIBlockElement::GetList(
			[],
			[
				'IBLOCK_ID' => $iblockId,
				'=CODE' => $lastSegment,
				'ACTIVE' => 'Y',
			],
			false,
			false,
			['ID', 'NAME', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL']
		)->GetNext();
		if ($element) {
			if (!empty($element['IBLOCK_SECTION_ID'])) {
				$navChain = CIBlockSection::GetNavChain($iblockId, $element['IBLOCK_SECTION_ID'], ['ID', 'NAME', 'SECTION_PAGE_URL']);
				while ($navItem = $navChain->GetNext()) {
					$APPLICATION->AddChainItem($navItem['NAME'], $navItem['SECTION_PAGE_URL']);
				}
			}
			$APPLICATION->AddChainItem($element['NAME'], $element['DETAIL_PAGE_URL']);
		}
		break;
	}
};
?><!DOCTYPE html>
    <html lang="ru">
    <head>
        <? $APPLICATION->ShowHead();
        ?>
        <title><? $APPLICATION->ShowTitle(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="/favicon.svg" type="image/svg+xml" sizes="any" />
		<link rel="alternate icon" href="/favicon.ico" type="image/x-icon" />
		
		
		<link rel="preload" as="style" href="<?= SITE_TEMPLATE_PATH; ?>/assets/css/styles.css" />
		<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH; ?>/assets/css/styles.css" />
		<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH; ?>/assets/css/media.css" />
        <?
        $objAsset = Asset::getInstance();
        $objAsset->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        // styles
        $objAsset->addCss(SITE_TEMPLATE_PATH . '/assets/js/fancybox/fancyboxudm.css');
        $objAsset->addCss(SITE_TEMPLATE_PATH . '/assets/js/owl/owl.carousel.min.css');
        $objAsset->addCss(SITE_TEMPLATE_PATH . '/assets/js/owl/owl.theme.default.min.css');


        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/jquery-3.4.1.min.js');
        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/owl/owl.carousel.min.js');
        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/jquery.validate.min.js');
        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/inputmask/min/jquery.inputmask.bundle.min.js');
		$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/fancybox/fancyboxumd.js');
		$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/swiper-bundle.min.js');
		$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/privacy-consent.js');
		$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/app.js');
		
        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/script.js');
		if($dir == "/" && !empty($settings["AKC_DATE"]["VALUE"]) && strtotime($settings["AKC_DATE"]["VALUE"]) > time()){
			$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/home-hero-timer.js');
		}
        $APPLICATION->ShowViewContent('ogtitle');
        $APPLICATION->ShowViewContent('ogdescription');
        $APPLICATION->ShowViewContent('ogimage');

		if ($isHome) {
			$organizationDescription = trim((string)$APPLICATION->GetPageProperty("description"));
			if ($organizationDescription === "") {
				$organizationDescription = trim((string)$APPLICATION->GetProperty("description"));
			}
			if ($organizationDescription === "" && defined("HOME_META_DESCRIPTION")) {
				$organizationDescription = HOME_META_DESCRIPTION;
			}
			$organizationSameAs = array_values(array_filter([
				$settings["VK"]["VALUE"] ?? "",
				$settings["TELEGRAM"]["VALUE"] ?? "",
				$settings["TIKTOK"]["VALUE"] ?? "",
				$settings["MAX"]["VALUE"] ?? "",
				$settings["WHATSAPP"]["VALUE"] ?? "",
			], static function ($url) {
				return is_string($url) && preg_match('/^https?:\/\//', $url);
			}));
			$organizationSchema = [
				"@context" => "http://schema.org",
				"@type" => "Organization",
				"@id" => "https://fors36.ru/#organization",
				"name" => "Автошкола «Форсаж»",
				"alternateName" => "Форсаж",
				"description" => $organizationDescription,
				"url" => "https://fors36.ru/",
				"logo" => "https://fors36.ru" . SITE_TEMPLATE_PATH . "/assets/icons/logo-forsazh.svg",
				"image" => "https://fors36.ru" . SITE_TEMPLATE_PATH . "/assets/icons/logo-forsazh.svg",
				"telephone" => $settings["PHONE"]["VALUE"] ?? "+7 (473) 269-00-00",
				"email" => $settings["EMAIL"]["VALUE"] ?? "fors36@mail.ru",
				"address" => [
					"@type" => "PostalAddress",
					"addressLocality" => "Воронеж",
					"streetAddress" => $settings["ADDRESS"]["VALUE"] ?? "ул. Плехановская, 35, 2 этаж",
					"addressCountry" => "RU",
				],
				"contactPoint" => [
					"@type" => "ContactPoint",
					"telephone" => $settings["PHONE"]["VALUE"] ?? "+7 (473) 269-00-00",
					"contactType" => "customer service",
					"areaServed" => "RU",
					"availableLanguage" => "Russian",
				],
			];
			if (!empty($organizationSameAs)) {
				$organizationSchema["sameAs"] = $organizationSameAs;
			}
			if ($organizationDescription === "") {
				unset($organizationSchema["description"]);
			}
			?>
			<script type="application/ld+json"><?=json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);?></script>
			<?
		}

        ?>

    </head>
<body style="<?$APPLICATION->ShowViewContent('additionalstyles');?>" class="<?$APPLICATION->ShowViewContent('additionalclasses');?> <? if ($isHome) { ?>home_page<? } else { ?>not_home<? } ?> <? if ($is404) { ?>page-404<? } ?> <?=$additionalClass;?> <?if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {?>page_<?=TEMPLATE_PAGE;?> <?}?> <?if($notstandart){?>notstandart<?}?>">
<? $APPLICATION->ShowPanel(); ?>
<? if ($isHome) { ?>
 <?php include __DIR__ . "/includes/header-index.php"; ?>
<?}else{?>
	<?php include __DIR__ . "/includes/header-inner.php"; ?>
<?}?>
<?

if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {
    ?><? if ($dir != "/") { ?>
		<?
		$addBreadcrumbChain();
		?><? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false); ?><?}?>
    <?
    include_once "template_blocks/" . TEMPLATE_PAGE . ".php";
    ?>
<? }else{ ?>
<main class="main">
<? $addBreadcrumbChain(); ?>
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false); ?>
<? if (!CSite::InDir('/shares/')&&!($dir != "/articles/"&&CSite::InDir('/articles/'))&&!CSite::InDir('/category/')&&!($dir != "/instructors/"&&CSite::InDir('/instructors/'))&&!($dir != "/news/"&&CSite::InDir('/news/'))) { ?><section class="page-section page-section__flex container">
	<h1 class="page-section__title"><? $APPLICATION->ShowTitle(false); ?></h1>
	<div class="content_block ">
<?}?>
<?}?>
