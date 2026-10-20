<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Text\HtmlFilter;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
Loc::loadMessages(__FILE__);
$this->setFrameMode(true);
$escape = static fn($value): string => HtmlFilter::encode((string)$value);
if (empty($arResult['SECTIONS'])) {
    ?><p class="education-documents__empty"><?= $escape(Loc::getMessage('FORS_EDUCATION_EMPTY')) ?></p><?php
    return;
}

$renderSection = static function (array $section, int $level, ?int $number = null) use (&$renderSection, $escape): void {
    $heading = 'h' . min(6, $level);
    $anchor = $escape($section['ANCHOR']);
    ?>
    <section class="education-documents__section<?= $level > 2 ? ' education-documents__section--nested' : '' ?>"
             id="<?= $anchor ?>" aria-labelledby="<?= $anchor ?>-title" data-education-section="<?= $escape($section['CODE']) ?>">
        <div class="education-documents__section-header">
            <?php if ($number !== null): ?>
                <span class="education-documents__number" aria-hidden="true"><?= sprintf('%02d', $number) ?></span>
            <?php endif; ?>
            <<?= $heading ?> class="education-documents__section-title" id="<?= $anchor ?>-title"><?= $escape($section['NAME']) ?></<?= $heading ?>>
            <span class="education-documents__count" aria-label="<?= $escape(Loc::getMessage('FORS_EDUCATION_COUNT', ['#COUNT#' => $section['COUNT']])) ?>"><?= (int)$section['COUNT'] ?></span>
        </div>
        <?php if ($section['DOCUMENTS']): ?>
            <ul class="education-documents__list">
                <?php foreach ($section['DOCUMENTS'] as $document): ?>
                    <li class="education-documents__item">
                        <a class="education-documents__link" href="<?= $escape($document['URL']) ?>" target="_blank" rel="noopener"
                           aria-label="<?= $escape(Loc::getMessage('FORS_EDUCATION_OPEN', ['#NAME#' => $document['NAME'], '#SIZE#' => $document['SIZE']])) ?>"
                           data-document-id="<?= (int)$document['ID'] ?>">
                            <span class="education-documents__format" aria-hidden="true">PDF</span>
                            <span class="education-documents__name"><?= $escape($document['NAME']) ?></span>
                            <span class="education-documents__size" aria-hidden="true"><?= $escape($document['SIZE']) ?></span>
                            <svg class="education-documents__arrow" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" focusable="false"><path d="M5 15 15 5M5 5h10v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php foreach ($section['CHILDREN'] as $child): ?>
            <?php $renderSection($child, $level + 1); ?>
        <?php endforeach; ?>
    </section>
    <?php
};
?>
<div class="education-documents">
    <aside class="education-documents__sidebar">
        <nav class="education-documents__contents" aria-label="<?= $escape(Loc::getMessage('FORS_EDUCATION_CONTENTS')) ?>">
            <details class="education-documents__navigation" open>
                <summary class="education-documents__contents-title"><?= $escape(Loc::getMessage('FORS_EDUCATION_CONTENTS')) ?><span aria-hidden="true">+</span></summary>
                <ol class="education-documents__contents-list">
                    <?php foreach ($arResult['SECTIONS'] as $index => $section): ?>
                        <li><a class="education-documents__contents-link" href="#<?= $escape($section['ANCHOR']) ?>"><span aria-hidden="true"><?= sprintf('%02d', $index + 1) ?></span><?= $escape($section['NAME']) ?></a></li>
                    <?php endforeach; ?>
                </ol>
            </details>
        </nav>
    </aside>
    <div class="education-documents__body">
        <p class="education-documents__hint"><?= $escape(Loc::getMessage('FORS_EDUCATION_HINT')) ?></p>
        <?php foreach ($arResult['SECTIONS'] as $index => $section): ?>
            <?php $renderSection($section, 2, $index + 1); ?>
        <?php endforeach; ?>
    </div>
</div>
