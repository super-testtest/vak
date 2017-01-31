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