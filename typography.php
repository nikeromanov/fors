<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тестовая страница типографики заголовков");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
$APPLICATION->SetTitle("Типографика заголовков");

$headingLevels = [
    [
        "tag" => "h1",
        "label" => "H1",
        "text" => "Заголовок первого уровня",
        "size" => "clamp(2rem, 1.55rem + 1.9vw, 3.25rem)",
    ],
    [
        "tag" => "h2",
        "label" => "H2",
        "text" => "Заголовок второго уровня",
        "size" => "clamp(1.75rem, 1.4rem + 1.4vw, 2.5rem)",
    ],
    [
        "tag" => "h3",
        "label" => "H3",
        "text" => "Заголовок третьего уровня",
        "size" => "clamp(2.25rem, 1.875rem + 1.35vw, 3rem)",
    ],
    [
        "tag" => "h4",
        "label" => "H4",
        "text" => "Заголовок четвертого уровня",
        "size" => "clamp(1.875rem, 1.65rem + 0.9vw, 2.4375rem)",
    ],
    [
        "tag" => "h5",
        "label" => "H5",
        "text" => "Заголовок пятого уровня",
        "size" => "clamp(1.6875rem, 1.575rem + 0.525vw, 2.0625rem)",
    ],
    [
        "tag" => "h6",
        "label" => "H6",
        "text" => "Заголовок шестого уровня",
        "size" => "clamp(1.5rem, 1.425rem + 0.3vw, 1.6875rem)",
    ],
];
?>

<div class="typography-demo">
    <p class="typography-demo__lead">
        Ниже показана единая шкала размеров заголовков. Чем выше уровень заголовка, тем крупнее шрифт.
    </p>

    <div class="typography-demo__grid">
        <?php foreach ($headingLevels as $headingLevel): ?>
            <?php $tag = $headingLevel["tag"]; ?>
            <section class="typography-demo__item" aria-label="<?=htmlspecialcharsbx($headingLevel["label"]);?>">
                <p class="typography-demo__label"><?=htmlspecialcharsbx($headingLevel["label"]);?></p>
                <<?=$tag?> class="typography-demo__sample heading-level heading-level--<?=htmlspecialcharsbx($headingLevel["tag"]);?>">
                    <?=htmlspecialcharsbx($headingLevel["text"]);?>
                </<?=$tag?>>
                <p class="typography-demo__meta">
                    <code><?=htmlspecialcharsbx($headingLevel["size"]);?></code>
                </p>
            </section>
        <?php endforeach; ?>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
