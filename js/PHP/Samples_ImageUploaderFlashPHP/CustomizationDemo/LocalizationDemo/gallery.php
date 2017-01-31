<?php include('../../../../../app/Mage.php');
  //This variable specifies relative path to the folder, where the gallery with uploaded files is located.
  //Do not forget about the slash in the end of the folder name.
  $galleryPath = '../../UploadedFiles/';
  
  $thumbnailsPath = $galleryPath . 'Thumbnails/';
  
  $absGalleryPath = realpath($galleryPath) . DIRECTORY_SEPARATOR;
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

  //$(function() { $('a.fancybox').fancybox(); });
  
</script>
<script type="text/javascript">  
	function replacehtmldata(htmldata)
	{
    //alert('test',window.parent.document);	
    $(htmldata).appendTo($('#flickerresult', window.parent.document));
    $('#flickerresult', window.parent.document).html(htmldata);
      //console.log($( "#flickerresult li.imgloader" ).find( "img" ),window.parent.document);
    $("#flickerresult li.imgloader a",window.parent.document).trigger({
    type:"click",
    });
    //$(htmldata).appendTo($('#myimage', window.parent.document));
    $('#svg_image_upload', window.parent.document).hide();  
	}
	
</script>
<?php
  // Get head content
  $page_head = ob_get_clean();
  ?>
  <?php 
  // Buffer output
  ob_start(); 
?>
<div class="gallery">
<?php $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB); ?>
  <!--<ul class="gallery-link-list">
  <?php $htmldata = "";?>
    <?php for ($i = 0; $i < $descriptions->documentElement->childNodes->length; $i++) :
            $xmlFile = $descriptions->documentElement->childNodes->item($i); ?>
    <?php $htmldata .= '<li class="imgloader"><a href="javascript:void(0);" onclick="javascript:loadImageONCanvas(this)" class ="imageclass" rel="'.$baseUrl.'js/PHP/Samples_ImageUploaderFlashPHP/UploadedFiles/' . rawurlencode($xmlFile->getAttribute('source')).'" ><img class ="lazy" data="'.$baseUrl.'js/PHP/Samples_ImageUploaderFlashPHP/UploadedFiles/'. rawurlencode($xmlFile->getAttribute('source')).'" src="'.$baseUrl.'js/ipaduploadtool/Libraries/fancybox/loading.gif" onload="lazyLoaderImg(this)" /></a></li>'; ?>    <?php endfor; ?>
  </ul>
-->

<script type="text/javascript">replacehtmldata('<?php echo $htmldata;?>');</script>

</div>
<?php
  // Get body content
  $page_body = ob_get_clean();
  
  // render page
  include '../../Includes/master.php';
?>
<?php include('index.php'); ?>
