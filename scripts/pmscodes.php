<?php
	

	require 'app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');

	$read= Mage::getSingleton('core/resource')->getConnection('core_read'); //Only for reading the data from the database tables
	$write = Mage::getSingleton('core/resource')->getConnection('core_write'); // Only for writing the data into the database tables

	$query = 'SELECT * FROM pms';

	$results = $read->fetchAll($query);
	$file = fopen("pms_codes.csv","w");
	fputcsv($file,array('PMS Code','Hexcode'));
	foreach ($results as $key) {
		unset($key['id']);
		fputcsv($file,$key);
	}
	
	fclose($file); 
	echo 'File created successfully.';
	exit;
