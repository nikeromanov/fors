<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (empty($arResult)) return; ?>

<?php foreach ($arResult as $section){ ?>
	  <nav class="site-menu__nav" aria-label="Быстрые ссылки">
		<ul class="site-menu__list" role="list">
		  <li class="site-menu__item">
			<a class="site-menu__link site-menu__title" href="<?=$section['LINK'];?>"><?=$section['NAME'];?></a>
		  </li>
		  <?php if (!empty($section['CHILDS'])){ ?>
			<?php foreach ($section['CHILDS'] as $item){ ?>
			  <li class="site-menu__item">
				<a class="site-menu__link" href="<?=$item['LINK'];?>"><?=$item['NAME'];?></a>
			  </li>
			<?}?>
		  <?}?>
		</ul>
	  </nav>
<?}?>
 