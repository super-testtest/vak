<?php
	
	
	
	echo '<br>before magento:';
echo date('Y-m-d h:i:s a');
	require 'app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore('en');
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');
	echo '<br>after magento:';
echo date('Y-m-d h:i:sa');
	
?>