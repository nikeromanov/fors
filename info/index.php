<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/education-info.css");
$APPLICATION->AddViewContent("additionalclasses", "education-info-page");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
$APPLICATION->SetTitle(\Bitrix\Main\Localization\Loc::getMessage("FORS_EDUCATION_PAGE_TITLE"));
$APPLICATION->IncludeComponent(
    "iswin:education.documents",
    "",
    [
        "IBLOCK_TYPE" => "content",
        "IBLOCK_CODE" => "education_documents",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 3600,
    ],
    false
);
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>