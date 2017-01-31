<?php 
if(isset($_REQUEST['write']) && $_REQUEST['write']==1){
	$data = $_REQUEST['base64data'];

	// Start :: Create Lable image
	$var =time();
	    // Start :: Create Lable image
	$labelPath = '/media/catalog/product/productbuildernew/label_img.png';
	$labelname = getcwd().$labelPath;


	$flabel = fopen($labelname, 'w') or die("can't open file");
	$labelimage = explode('base64,',$data); 
	fwrite($flabel, base64_decode($labelimage[1]));
	fclose($flabel);

	//chmod($labelname, 777 );
	echo $labelname; exit;
}
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="http://192.168.5.129/vaktrommet_dev/js/html5/canvg/canvg-latest.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/bootstrap-responsive.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/font-awesome.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/font-awesome-ie7.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/font-awesome/css/font-awesome.css" media="all" />
<link rel="stylesheet" type="text/css" href="http://192.168.5.129/vaktrommet_dev/skin/frontend/magma/default/css/font-awesome/css/font-awesome.min.css" media="all" /> -->

    <a id='imgId'>Save</a>

<div id="svgDiv" style=" "><svg width="851" height="355" xmlns="http://www.w3.org/2000/svg"><g><title></title><text class="titleClass" xml:space="preserve" text-anchor="middle" font-family="Arial" font-size="66.644578313253" id="svg_1" y="260.4921620805369" x="425.5" stroke-width="0" stroke="#000000" fill="#000000">Your Title</text><text class="textClass" xml:space="preserve" text-anchor="middle" font-family="Arial" font-size="164.04819277108433" id="svg_2" y="177.5" x="425.5" stroke-width="0" stroke="#000000" fill="#000000">Your Text</text></g></svg>
</div>

<image src="image" class="image"  style="display: none; "/>
<style type="text/css">
	/*.FAImage:before{ content: "\uf182"; }*/
</style>
<canvas style="display: none; width: 851px; height: 355px;" id="customizationLabelCan" ></canvas>
<canvas style="display: none;width: 1051px; height: 555px;" id="highresolutioncanvas" width="1051" height="555"></canvas>

<script type="text/javascript">
	
	var label_svg = $('#svgDiv').html();

	var customizationLabelCan = document.getElementById('customizationLabelCan');

	canvg(customizationLabelCan, label_svg, {renderCallback: addingBleedArea});



	function addingBleedArea(){
		//console.log('customizationLabelCan2: '+customizationLabelCan);
		mylabel = document.getElementById('highresolutioncanvas');

		mylabel.width 	= '1051';
		mylabel.height = '555';

		labelcontext = mylabel.getContext('2d');
		labelcontext.globalCompositeOperation = "source-over";
		labelcontext.fillStyle = '#FFC0CB'; // set canvas background color

		labelcontext.fillRect (0,0,1051,555);  // now fill the canvas
		labelcontext.drawImage(customizationLabelCan,100,100,851,355);
		var test = mylabel.toDataURL("image/png");

		//console.log(test);
		//var image = $('.image').attr('src',test.replace(/^data:image\/(png|jpg);base64,/, ""));
		 //image.src= test.replace(/^data:image\/(png|jpg);base64,/, "");
		//console.log(v);
		//$('.image').attr('src',test);

		 var a = document.getElementById('imgId');
    a.download = "export_" + Date.now() + ".png";
    a.href=test; 

	}

$('.generateimage').click(function(){
	var data;
	$.ajax({ 
    type: "POST", 
    url: 'testsvg.php?write=1',
    data: {
        base64data :$('.image').attr('src')
    }
});
});

		


</script>

