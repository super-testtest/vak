<?php

require_once( Mage::getBaseDir( 'lib' ) . '/php-rest-client/EdipostService.php' );

use EdipostService\Client\Address;
use EdipostService\Client\Builder\ConsigneeBuilder;
use EdipostService\Client\Builder\ConsignmentBuilder;
use EdipostService\Client\Consignee;
use EdipostService\Client\Consignment;
use EdipostService\Client\Consignor;
use EdipostService\Client\Contact;
use EdipostService\Client\Item;
use EdipostService\Client\Items;
use EdipostService\Client\Product;
use EdipostService\EdipostService;


class Edipost_Integration_EdipostController extends Mage_Adminhtml_Controller_Action {

  /**
   * Create consignment
   */
  public function consignmentAction() {
    $key = Mage::getStoreConfig('carriers/edipost/shipping_key');

    $api = new EdipostService( $key );


    // Get default consignor
    $consignor = $api->getDefaultConsignor();


    // Create new consingee
    $builder = new ConsigneeBuilder();

    $consignee = $builder
      ->setCompanyName( $_GET['company'] )
      ->setCustomerNumber( '0' )
      ->setPostAddress( $_GET['street'] )
      ->setPostZip( $_GET['zipcode'] )
      ->setPostCity( $_GET['city'] )
      ->setStreetAddress( $_GET['street'] )
      ->setStreetZip( $_GET['zipcode'] )
      ->setStreetCity( $_GET['city'] )
      ->setContactName( $_GET['contact'] )
      ->setContactEmail( $_GET['email'] )
      ->setContactPhone( $_GET['phone'] )
      ->setContactCellPhone( $_GET['phone'] )
      ->setContactTelefax( '' )
      ->setCountry( $_GET['country'] )
      ->build();

    $newConsignee = $api->createConsignee( $consignee );


    // Create new consignment
    $builder = new ConsignmentBuilder();

		$consignment = $builder
			->setConsignorID( $consignor->ID )
			->setConsigneeID( $newConsignee->ID )
			->setProductID( $_GET['product'] )
			->setTransportInstructions( '' )
			->setContentReference( $_GET['reference'] )
			->setInternalReference( '' );

		$consignment->addItem( new Item( 1, 0, 0, 0 ) );

		$newConsignment = $api->createConsignment( $consignment->build() );


    // Print consignment
		$pdf = $api->printConsignment( $newConsignment->id );

    header("Content-type: application/pdf");
    header("Content-Disposition: attachment;filename='etikett.pdf'");
    echo $pdf;
  }


  /**
   * Create consignee
   */
  public function addressAction() {
    $key = Mage::getStoreConfig('carriers/edipost/shipping_key');

		$api = new EdipostService( $key );


    // Create consignee
		$builder = new ConsigneeBuilder();

		$consignee = $builder
			->setCompanyName( $_GET['company'] )
			->setCustomerNumber( '0' )
			->setPostAddress( $_GET['street'] )
			->setPostZip( $_GET['zipcode'] )
			->setPostCity( $_GET['city'] )
			->setStreetAddress( $_GET['street'] )
			->setStreetZip( $_GET['zipcode'] )
			->setStreetCity( $_GET['city'] )
			->setContactName( $_GET['contact'] )
			->setContactEmail( $_GET['email'] )
			->setContactPhone( $_GET['phone'] )
			->setContactCellPhone( $_GET['phone'] )
			->setContactTelefax( '' )
			->setCountry( $_GET['country'] )
			->build();

		$newConsignee = $api->createConsignee( $consignee );

		echo $newConsignee->ID;
  }



  /**
   * Lookup city from zipcode
   */
  public function zipcodeAction() {
    $url = 'https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=edipost&country=no&pnr=' . $_GET['zipcode'];
    $data = file_get_contents( $url );
    $json = json_decode( $data );

    echo $json->result;
  }
}

?>
