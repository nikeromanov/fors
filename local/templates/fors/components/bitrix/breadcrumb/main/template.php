<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult)) {
    return '';
}

$strReturn = '';
$strReturn .= '<nav class="breadcrumbs container" aria-label="Хлебные крошки">';
$strReturn .= ' <ol class="breadcrumbs__list">';

$arrow = '';


$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]['TITLE']);
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
    $strReturn .= '<li class="breadcrumbs__item"><a  class="breadcrumbs__link"  href="' . $arResult[$index]['LINK'] . '" title="' . htmlspecialchars($title) . '">';
    $strReturn .= $title;
    $strReturn .= '</a><span class="breadcrumbs__separator" aria-hidden="true"></span></li>';
	}else{
		 $strReturn .= $title;
	}
    if (
        !empty($arResult[$index]['LINK'])
        && $index != $itemSize - 1
    ) {
        $strReturn .= $arrow;
    }
}
$strReturn .= '</ol>';
$strReturn .= '</nav>';

return $strReturn;
