<?php 
  //This variable specifies relative path to the folder, where the gallery with uploaded files is located.
  //Do not forget about the slash in the end of the folder name.
  $galleryPath = '../../UploadedFiles/';
  
  $thumbnailsPath = $galleryPath . 'Thumbnails/';
  
  $absGalleryPath = realpath($galleryPath) . DIRECTORY_SEPARATOR;
  //exit;
  $descriptions = new DOMDocument('1.0');
  
  $descriptions->load($absGalleryPath . 'files.xml');
?>
<?php
  // Buffer output
  ob_start();
?>
<link href="../../Libraries/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<script src="../../Libraries/fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
<script type="text/javascript">

  $(function() { $('a.fancybox').fancybox(); });
  
</script>
<?php
  // Get head content
  $page_head = ob_get_clean();

  // Buffer output
  ob_start(); 
?>
<div class="gallery">
  <ul class="gallery-link-list">
    <?php for ($i = 0; $i < $descriptions->documentElement->childNodes->length; $i++) :
            $xmlFile = $descriptions->documentElement->childNodes->item($i); ?>
    <li><a target="_blank" href="<?php echo $galleryPath . rawurlencode($xmlFile->getAttribute('source')); ?>">
    <?php echo htmlentities($xmlFile->getAttribute('name'), ENT_COMPAT, 'UTF-8'); ?></a></li>
    <?php endfor; ?>
  </ul>
</div>
<?php
  // Get body content
  $page_body = ob_get_clean();
  
  // render page
  include '../Includes/master.php';
?>
