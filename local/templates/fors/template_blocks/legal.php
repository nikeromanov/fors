<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;
global $legalDocumentFile;

$legalDocumentPath = __DIR__ . '/../includes/legal/' . basename((string)$legalDocumentFile);
?>
<section class="page-section page-section__flex policy container" aria-labelledby="legal-document-title">
  <h1 class="policy__title page-section__title" id="legal-document-title"><?$APPLICATION->ShowTitle(false)?></h1>
  <div class="policy__document detail_content content_block">
    <?if (is_file($legalDocumentPath)) {
      include $legalDocumentPath;
    }?>
  </div>
  <?include __DIR__ . '/../includes/legal/related-links.php';?>
</section>
