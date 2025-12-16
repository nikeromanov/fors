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
global $USER;
global $hideH;
global $notstandart;
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
        $APPLICATION->ShowViewContent('ogtitle');
        $APPLICATION->ShowViewContent('ogdescription');
        $APPLICATION->ShowViewContent('ogimage');

        ?>


    </head>
<body style="<?$APPLICATION->ShowViewContent('additionalstyles');?>" class="<?$APPLICATION->ShowViewContent('additionalclasses');?> <? if ($dir == "/") { ?>home_page<? } else { ?>not_home<? } ?> <?=$additionalClass;?> <?if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {?>page_<?=TEMPLATE_PAGE;?> <?}?> <?if($notstandart){?>notstandart<?}?>">
<? $APPLICATION->ShowPanel(); ?>
<? if ($dir == "/") { ?>
 <?php include __DIR__ . "/includes/header-index.php"; ?>
<?}else{?>
	<?php include __DIR__ . "/includes/header-inner.php"; ?>
<?}?>
<?

if (defined("TEMPLATE_PAGE") && TEMPLATE_PAGE != "") {
    ?><? if ($dir != "/") { ?><? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false); ?><?}?>
    <?
    include_once "template_blocks/" . TEMPLATE_PAGE . ".php";
    ?>
<? }else{ ?>
<main class="main">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(), false); ?>
<? if (!CSite::InDir('/shares/')&&!($dir != "/articles/"&&CSite::InDir('/articles/'))&&!CSite::InDir('/category/')) { ?><section class="page-section page-section__flex container">
	<h1 class="page-section__title"><? $APPLICATION->ShowTitle(false); ?></h1>
	<div class="content_block ">
<?}?>
<?}?>