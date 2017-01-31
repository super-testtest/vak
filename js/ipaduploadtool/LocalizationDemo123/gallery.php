<?php 
  //This variable specifies relative path to the folder, where the gallery with uploaded files is located.
  //Do not forget about the slash in the end of the folder name.
  $galleryPath = '../UploadedFiles/';
  
  $thumbnailsPath = $galleryPath . 'Thumbnails/';
  
  $absGalleryPath = realpath($galleryPath) . DIRECTORY_SEPARATOR;
  
  $descriptions = new DOMDocument('1.0');
  $descriptions->load($absGalleryPath . 'files.xml');
?>
<?php
  // Buffer output
  ob_start();
?>
<link href="../Libraries/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<script src="../Libraries/fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
<script type="text/javascript">

  $(function() { $('a.fancybox').fancybox(); });
  
</script>

  


<script type="text/javascript">  
	function replacehtmldata(htmldata)
	{	htmldata =  '<li class="imgloader"><a href="javascript:void(0);" onclick="javascript:loadImageONCanvas(this)" class ="imageclass" rel="http://192.168.5.10/html5productbuilder/ipaduploadtool/UploadedFiles/geek.jpg" ><img class ="lazy" data="http://192.168.5.10/html5productbuilder/ipaduploadtool/UploadedFiles/geek.jpg" src="http://192.168.5.10/html5productbuilder/ipaduploadtool/Libraries/fancybox/loading.gif" onload="lazyLoaderImg(this)" /></a></li>';	
		//$('#flickerresult', window.parent.document).append(htmldata);		
		$(htmldata).appendTo($('#flickerresult', window.parent.document));
		$('#svg_image_upload', window.parent.document).hide();	
	}
	
</script>
<style>
#go_back {
  margin: 0 2px;
  padding: 4px 46px; cursor:pointer;
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  cursor: default;
  outline: none;
  font-family: Arial, sans-serif;
  color: #000;
  border: 1px solid #bbb;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  /* TODO(eae): Change this to -webkit-linear-gradient once
                https://bugs.webkit.org/show_bug.cgi?id=28152 is resolved. */
  background: -webkit-gradient(linear, 0% 40%, 0% 70%, from(#f9f9f9), to(#e3e3e3));
  background: -moz-linear-gradient(top, #f9f9f9, #e3e3e3);
  font-size:12px; text-decoration:none; width:140px; margin-left:80px;
}
</style>
<?php
  // Get head content
  $page_head = ob_get_clean();

  // Buffer output
  ob_start(); 
?>
<div class="gallery">
<script type="text/javascript">replacehtmldata('');</script>

	<a id="go_back" href="http://192.168.5.10/html5productbuilder/ipaduploadtool/LocalizationDemo/index.php?uniqueid=d8fd93f76a0f3bb689684ab91d7cdfca26970633523573458" >+ Upload Images</a>
<!-- Edited  <ul class="gallery-link-list">
    <?php for ($i = 0; $i < $descriptions->documentElement->childNodes->length; $i++) :
            $xmlFile = $descriptions->documentElement->childNodes->item($i); ?>
    <li><a target="_blank" href="<?php echo $galleryPath . rawurlencode($xmlFile->getAttribute('source')); ?>">
    <?php echo htmlentities($xmlFile->getAttribute('name'), ENT_COMPAT, 'UTF-8'); ?></a></li>
    <?php endfor; ?>
  </ul> -->
</div>
<?php
  // Get body content
  $page_body = ob_get_clean();
  
  // render page
  include '../Includes/master.php';
?>
