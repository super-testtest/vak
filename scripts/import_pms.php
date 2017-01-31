<?php 
	
	require '../app/Mage.php';
	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore('en');
	error_reporting(E_ALL);
	set_time_limit(0);
	ini_set('memory_limit','1024M');

	$read= Mage::getSingleton('core/resource')->getConnection('core_read'); 
	$write = Mage::getSingleton('core/resource')->getConnection('core_write'); 
		

	$file = fopen("pms_vaktrommet.csv","r");

	while(! feof($file)){
		$data = fgetcsv($file);
		$array = explode(';', $data['0']);

		if(isset($array['0']) && isset($array['1']) && $array['0'] != '' && $array['1'] != ''){
			$pms_code = 'PMS ' . $array['0'];
			$hex_code = $array['1'];

			$sql = "INSERT INTO pms (pms,hex) VALUES ('".$pms_code."','".$hex_code."')"; 
				
			$write->query($sql); 	
		}
		
	}
	
	echo 'PMS codes inserted successfully';
	
?>