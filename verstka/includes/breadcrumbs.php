<?php
// Хлебные крошки, подготовлены под подключение компонентов Битрикс

$breadcrumbItems = $breadcrumbItems ?? [["title" => "Главная", "url" => "/"], ["title" => "Страница"]];

$lastIndex = count($breadcrumbItems) - 1;
?>
<nav class="breadcrumbs" aria-label="Хлебные крошки">
    <!-- bx:breadcrumb-path -->
    <ol class="breadcrumbs__list">
      <?php foreach ($breadcrumbItems as $index => $item): ?>
        <?php
        $title = htmlspecialchars($item["title"] ?? "", ENT_QUOTES, "UTF-8");
        $url = $item["url"] ?? null;
        $isLast = $index === $lastIndex;
        ?>
        <li class="breadcrumbs__item"<?php if ($isLast) {
          echo ' aria-current="page"';
        } ?>>
          <?php if (!$isLast && $url): ?>
            <a class="breadcrumbs__link" href="<?php echo htmlspecialchars($url, ENT_QUOTES, "UTF-8"); ?>">
              <?php echo $title; ?>
            </a>
            <span class="breadcrumbs__separator" aria-hidden="true"></span>
          <?php elseif (!$isLast): ?>
            <span class="breadcrumbs__link"><?php echo $title; ?></span>
            <span class="breadcrumbs__separator" aria-hidden="true"></span>
          <?php else: ?>
            <span class="breadcrumbs__current"><?php echo $title; ?></span>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ol>
</nav>
<?php unset($breadcrumbItems); ?>
