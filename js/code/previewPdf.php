<?php
$post_data = $_POST;

//$file_path = 'http://192.168.5.106/joomla-anisha/html5productbuilder/designed_products/';
$file_name = '../../media/catalog/product/productbuilder/product_img_'.time().'.png';
/*header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$file_name);
header("Content-Type: image/png'");
*/$fh = fopen($file_name, 'w') or die("can't open file");
$image = explode('base64,',$post_data['png_data1']); 
fwrite($fh, base64_decode($image[1]));
fclose($fh);
?>
<script type="text/javascript">
	this.window.close();
</script>
<?php
//readfile($file_name);
/*
$i = 1;
foreach ($post_data as $img){
	if($img != 'undefined'){
	$image = explode('base64,',$img); 
	file_put_contents("product_img$i.png", base64_decode($image[1]));
	 $i++;
	}
}*/