<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тестовая страница типографики заголовков");
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
        "size" => "clamp(3rem, 2.5rem + 1.8vw, 4rem)",
    ],
    [
        "tag" => "h4",
        "label" => "H4",
        "text" => "Заголовок четвертого уровня",
        "size" => "clamp(2.5rem, 2.2rem + 1.2vw, 3.25rem)",
    ],
    [
        "tag" => "h5",
        "label" => "H5",
        "text" => "Заголовок пятого уровня",
        "size" => "clamp(2.25rem, 2.1rem + 0.7vw, 2.75rem)",
    ],
    [
        "tag" => "h6",
        "label" => "H6",
        "text" => "Заголовок шестого уровня",
        "size" => "clamp(2rem, 1.9rem + 0.4vw, 2.25rem)",
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
