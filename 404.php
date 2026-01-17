<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);
global $additionalClass;
$additionalClass = "page-404";
$APPLICATION->AddHeadString('<style>body.page-404 .primary-nav__link{color:var(--color-text);}</style>');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("К сожалению, такой страницы 
не существует");?>
<section class="page-section error-hero" aria-labelledby="error-title">
        <figure class="error-hero__icon" aria-hidden="true">
          <img src="<?=SITE_TEMPLATE_PATH;?>/assets/icons/block.svg" alt="" width="315" height="316" loading="eager" decoding="async" />
        </figure>
        <div class="error-hero__content">
          <h1 class="error-hero__title" id="error-title">Урок 404:</h1>
          <p class="error-hero__subtitle">Даже опытные водители иногда теряются.</p>
          <p class="error-hero__text">
            Но мы знаем, как найти дорогу обратно —
            <a class="error-hero__link" href="/">
              нажмите сюда
              <svg
                class="error-hero__link-icon"
                aria-hidden="true"
                width="22"
                height="12"
                viewBox="0 0 22 12"
                focusable="false"
              >
                <path
                  d="M1 6h18M14 1l6 5-6 5"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
          </p>
        </div>
      </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
