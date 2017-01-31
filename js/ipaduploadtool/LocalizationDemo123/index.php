<?php
  require_once '../ImageUploaderFlashPHP/ImageUploaderFlash.class.php';
  
  // Buffer output
  ob_start();
  
  // Render uploader css
  ImageUploaderFlash::renderCssRules();
?>
<link href="localization.css" rel="stylesheet" type="text/css" />
<?php
  // Get head content
  $page_head = ob_get_clean();

  // Buffer output
  ob_start(); 
?>
<fieldset class="content-block">
  <legend>Languages</legend>
  <ul class="languages">
    <li><a href="?lang=cs" class="lang" id="lang_cs">Czech</a></li>
    <li><a href="?lang=nl" class="lang" id="lang_nl">Dutch</a></li>
    <li><a href="?lang=en" class="lang" id="lang_en">English</a></li>
    <li><a href="?lang=fr" class="lang" id="lang_fr">French</a></li>
    <li><a href="?lang=de" class="lang" id="lang_de">German</a></li>
    <li><a href="?lang=he" class="lang" id="lang_he">Hebrew</a></li>
    <li><a href="?lang=it" class="lang" id="lang_it">Italian</a></li>
    <li><a href="?lang=ja" class="lang" id="lang_ja">Japanese</a></li>
    <li><a href="?lang=ko" class="lang" id="lang_ko">Korean</a></li>
    <li><a href="?lang=no" class="lang" id="lang_no">Norwegian</a></li>
    <li><a href="?lang=ru" class="lang" id="lang_ru">Russian</a></li>
    <li><a href="?lang=zh_cn" class="lang" id="lang_zh_cn">Simplified Chinese</a></li>
    <li><a href="?lang=es" class="lang" id="lang_es">Spanish</a></li>
    <li><a href="?lang=sv" class="lang" id="lang_sv">Swedish</a></li>
    <li><a href="?lang=zh_tw" class="lang" id="lang_zh_tw">Traditional Chinese</a></li>
    <li><a href="?lang=tr" class="lang" id="lang_tr">Turkish</a></li>
  </ul>
</fieldset>
<div class="code">
<?php
  // create uploader object
  $uploader = new ImageUploaderFlash('Uploader1');

  //set uploader size
  $uploader->setWidth("100%");
  $uploader->setHeight("500px");
    
  // set background, showing while loading control
  $uploader->getFlashControl()->setBgColor('#f5f5f5');

  // set license key
  $uploader->setLicenseKey('77FF4-004CF-DC7DA-910A9-10760-7454A5');

  // configure upload settings
  $uploader->getUploadSettings()->setActionUrl("upload.php");
  $uploader->getUploadSettings()->setRedirectUrl("gallery.php");


  // configure converters

  $converter1 = new Converter();
  $converter1->setMode("*.*=SourceFile");

  $uploader->setConverters(array($converter1));
    
  // configure file filter for open file dialog
  $uploader->getRestrictions()->setFileMask("[['Images (*.jpg;*.jpeg;*.png;*.gif;*.bmp)', '*.jpg;*.jpeg;*.png;*.gif;*.bmp']]");

  // Set language
  if (!empty($_GET['lang'])) {
    $uploader->setLanguage($_GET['lang']);
  }
  
  // render uploader markup
  $uploader->render();                  
?>
</div>
<?php
  // Get body content
  $page_body = ob_get_clean();
  
  // render page
  include '../Includes/master.php';
?>