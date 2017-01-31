<?php
include_once '../app/Mage.php';
Mage::app();
global $myDeviceId, $myDeviceId1;
//if(isset($_POST['qty']) && !empty($_POST['qty'])){
 //print_r($_POST);
// set data
if($_GET['value'] == "icon")
{
if($_GET['set'] == "true")
{
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));

$session->setData("device_id", 20);
 
$myDeviceId = $session->getData("device_id");
  
$product_id = $_POST['product'];
$cursym = $_POST['cursym'];
$pprice = $_POST['price'];

$my_qty = $_POST['qty'];
//$_product = Mage::getModel('catalog/product')->load($product_id);
$calculated_price = $pprice +  $myDeviceId + $myDeviceId1;
echo $cursym.' '.number_format($calculated_price,2,',',','); 
}
if($_GET['set'] == "false")
{
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));

$session->setData("device_id", 0);
 
$myDeviceId = $session->getData("device_id");
   
$product_id = $_POST['product'];
$cursym = $_POST['cursym'];
$pprice = $_POST['price'];

$my_qty = $_POST['qty'];
//$_product = Mage::getModel('catalog/product')->load($product_id);
$calculated_price = $pprice +  $myDeviceId;
echo $cursym.' '.number_format($calculated_price,2,',',','); 

echo $myDeviceId;
 echo $myDeviceId1;
 
}
}


if($_GET['value'] == "image")
{
if($_GET['set'] == "true")
{
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));

$session->setData("device_id1", 20);
$myDeviceId =  $session->getData("device_id");
$myDeviceId1 = $session->getData("device_id1");
  
$product_id = $_POST['product'];
$cursym = $_POST['cursym'];
$pprice = $_POST['price'];

$my_qty = $_POST['qty'];
global $myDeviceId, $myDeviceId1;
//$_product = Mage::getModel('catalog/product')->load($product_id);
$calculated_price = $pprice + $myDeviceId + $myDeviceId1;
//$calculated_price = $pprice +  $myDeviceId1;
//echo "f".$session->getData("device_id");
//echo "cf".$myDeviceId1;
echo $cursym.' '.number_format($calculated_price,2,',',','); 
}

if($_GET['set'] == "false")
{
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));

$session->setData("device_id1", 0);
 
$myDeviceId1 = $session->getData("device_id1");
   
$product_id = $_POST['product'];
$cursym = $_POST['cursym'];
$pprice = $_POST['price'];

$my_qty = $_POST['qty'];
//$_product = Mage::getModel('catalog/product')->load($product_id);
$calculated_price = $pprice + $myDeviceId + $myDeviceId1;
echo $cursym.' '.number_format($calculated_price,2,',',',');
echo $myDeviceId;
 echo $myDeviceId1;
}
}
?>