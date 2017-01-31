<?php
 
include_once('../../app/Mage.php');

$website_root =  Mage::getBaseUrl();
$clipArtFolder = $website_root.'media/faicons/';
$clipArtFolder =  str_replace("getrelatedFA.php/", "", $clipArtFolder);
$fld = getcwd().'/../../media/faicons/';

$cnt = 1;
if ($dh = opendir($fld)) {
    while (($file = readdir($dh)) !== false) {
    	if($file != '.' && $file != '..')
    	{
    		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
    		$iconTitle = substr($withoutExt, 0, -5);
    		$iconCode = "\u".substr($withoutExt,(strlen($withoutExt)-4));
	    	$imageFileName = $clipArtFolder.$file;
	        if (!is_dir($clipArtFolder.$file)) {
	        	echo '<li><a href="javascript:void(0);" onClick="loadFA(this,\'' . $iconCode .'\',\'' . $iconTitle .'\');setFAPath(\'' . $imageFileName .'\');" rel="' . $imageFileName . '"><img data="' . $imageFileName . '" src="' . $imageFileName . '" title="'.$iconTitle.'"></a></li>';
	        	$cnt++;
	        }
    	}
    }
}