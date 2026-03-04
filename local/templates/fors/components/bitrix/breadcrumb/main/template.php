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


$titleToLastIndex = [];
foreach ($arResult as $idx => $item) {
    $titleRaw = trim((string)($item['TITLE'] ?? ''));
    $titleNorm = html_entity_decode($titleRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $titleNorm = preg_replace('/\s+/u', ' ', $titleNorm);
    $titleNorm = preg_replace('/[^\p{L}\p{N}]+/u', '', $titleNorm);
    $titleNorm = mb_strtolower(trim((string)$titleNorm));
    if ($titleNorm !== '') {
        $titleToLastIndex[$titleNorm] = $idx;
    }
}

$items = [];
$prevKey = null;
$prevLinkRaw = null;
foreach ($arResult as $idx => $item) {
    $titleRaw = trim((string)($item['TITLE'] ?? ''));
    $linkRaw = trim((string)($item['LINK'] ?? ''));
    $titleNorm = html_entity_decode($titleRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $titleNorm = preg_replace('/\s+/u', ' ', $titleNorm);
    $titleNorm = preg_replace('/[^\p{L}\p{N}]+/u', '', $titleNorm);
    $titleNorm = mb_strtolower(trim((string)$titleNorm));

    if ($titleNorm !== '' && isset($titleToLastIndex[$titleNorm]) && $titleToLastIndex[$titleNorm] !== $idx) {
        continue;
    }

    // Hide redundant "Новость/Новости" node when it repeats the previous link.
    if (
        $prevLinkRaw !== null
        && $linkRaw !== ''
        && $linkRaw === $prevLinkRaw
        && in_array($titleNorm, ['новость', 'новости'], true)
    ) {
        continue;
    }

    $dedupeKey = mb_strtolower($titleRaw . '|' . $linkRaw);
    if ($dedupeKey === $prevKey) {
        continue;
    }
    $prevKey = $dedupeKey;
    $items[] = [
        'TITLE' => $titleRaw,
        'LINK' => $linkRaw,
    ];
    $prevLinkRaw = $linkRaw;
}

$itemSize = count($items);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($items[$index]['TITLE']);
	if($items[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
	    $strReturn .= '<li class="breadcrumbs__item"><a  class="breadcrumbs__link"  href="' . $items[$index]['LINK'] . '" title="' . htmlspecialchars($title) . '">';
	    $strReturn .= $title;
	    $strReturn .= '</a><span class="breadcrumbs__separator" aria-hidden="true"></span></li>';
		}else{
			 $strReturn .= '<li class="breadcrumbs__item">' . $title . '</li>';
		}
    if (
	        !empty($items[$index]['LINK'])
	        && $index != $itemSize - 1
    ) {
        $strReturn .= $arrow;
    }
}
$strReturn .= '</ol>';
$strReturn .= '</nav>';

return $strReturn;
