<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
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
?><!DOCTYPE html>
    <html lang="">
    <head>
        <? $APPLICATION->ShowHead();
        ?>
        <title><? $APPLICATION->ShowTitle(); ?></title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		
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
		$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/app.js');
		
        $objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/script.js');
		if($dir == "/" && !empty($settings["AKC_DATE"]["VALUE"]) && strtotime($settings["AKC_DATE"]["VALUE"]) > time()){
			$objAsset->addJs(SITE_TEMPLATE_PATH . '/assets/js/home-hero-timer.js');
		}
        $APPLICATION->ShowViewContent('ogtitle');
        $APPLICATION->ShowViewContent('ogdescription');
        $APPLICATION->ShowViewContent('ogimage');

        ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" data-skip-moving="true">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js', 'ym');

    ym(11787892, 'init', {webvisor:true, clickmap:true, accurateTrackBounce:true, trackLinks:true});
</script>



    </head>
<body style="<?$APPLICATION->ShowViewContent('additionalstyles');?>" class="<?$APPLICATION->ShowViewContent('additionalclasses');?> <? if ($isHome) { ?>home_page<? } else { ?>not_home<? } ?> <? if ($is404) { ?>page-404<? } ?> <?=$additionalClass;?> <?if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {?>page_<?=TEMPLATE_PAGE;?> <?}?> <?if($notstandart){?>notstandart<?}?>">
<noscript><div><img src="https://mc.yandex.ru/watch/11787892" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<? $APPLICATION->ShowPanel(); ?>
<? if ($isHome) { ?>
 <?php include __DIR__ . "/includes/header-index.php"; ?>
<?}else{?>
	<?php include __DIR__ . "/includes/header-inner.php"; ?>
<?}?>
<?

if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {
    ?><? if ($dir != "/") { ?><? $APPLICATION->AddBufferContent(function () use ($APPLICATION) {
        ob_start();
        $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false);
        return ob_get_clean();
    }); ?><?}?>
    <?
    include_once "template_blocks/" . TEMPLATE_PAGE . ".php";
    ?>
<? }else{ ?>
<main class="main">
<? $APPLICATION->AddBufferContent(function () use ($APPLICATION) {
    ob_start();
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false);
    return ob_get_clean();
}); ?>
<? if (!CSite::InDir('/shares/')&&!($dir != "/articles/"&&CSite::InDir('/articles/'))&&!CSite::InDir('/category/')&&!($dir != "/instructors/"&&CSite::InDir('/instructors/'))&&!($dir != "/news/"&&CSite::InDir('/news/'))) { ?><section class="page-section page-section__flex container">
	<h1 class="page-section__title"><? $APPLICATION->ShowTitle(false); ?></h1>
	<div class="content_block ">
<?}?>
<?}?>
