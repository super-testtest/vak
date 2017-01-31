<?php

class Edipost_Integration_Block_Adminhtml_Sales_Order_View extends Mage_Adminhtml_Block_Sales_Order_View {
	public function  __construct() {
		parent::__construct();

		$addressUrl     = Mage::getModel('adminhtml/url')->getUrl('adminhtml/edipost/address');
		$consignmentUrl = Mage::getModel('adminhtml/url')->getUrl('adminhtml/edipost/consignment');
		$zipcodeUrl     = Mage::getModel('adminhtml/url')->getUrl('adminhtml/edipost/zipcode');

		$username = Mage::getStoreConfig('carriers/edipost/username');
    $password = Mage::getStoreConfig('carriers/edipost/password');

		$orderId = $this->getOrder()['increment_id'];

		$address = $this->getOrder()->getShippingAddress();

		$firstname = $address['firstname'];
		$lastname  = $address['lastname'];
		$street    = $address['street'];
		$zipcode   = $address['postcode'];
		$city      = $address['city'];
		$country   = $address['country_id'];
		$email     = $address['email'];
		$phone     = $address['phone'];


		?>

		<style>
			.edipost-invalid {
				background-color: pink;
			}

			.edipost-popup-hidden {
				visibility: hidden;
				display: none;
			}

			.edipost-popup-container {
				width: 100%;
		    height: 100%;
		    top: 0;
		    position: absolute;
		    background-color: rgba(22,22,22,0.5);
			}

			.edipost-popup {
				background:#e1e1e1;
				margin: 0 auto;
				width:480px;
				position:relative;
				z-index:41;
				top: 25%;
				-webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
				-moz-box-shadow:0 0 10px rgba(0,0,0,0.4);
				box-shadow:0 0 10px rgba(0,0,0,0.4);
			}

			.edipost-popup-header {
				background: #6F8992 none repeat scroll 0% 0%;
				padding: 2px 10px 2px 10px;
				color: #ffffff;
				font-size: 1em;
				line-height: 18px;
				font-weight: bold;
			}

			.edipost-popup-body {
				border: 1px solid #D6D6D6;
				background: #FAFAFA none repeat scroll 0% 0%;
				padding: 10px 15px 30px 15px;
			}

			.edipost-popup-body input {
				width: 450px;
			}

			.edipost-popup-body select {
				width: 200px;
			}

			#zipcode {
				width: 100px;
			}

			#city {
				width: 200px;
			}
		</style>

		<div class="edipost-popup-container edipost-popup-hidden">
			<div class="edipost-popup">

				<!-- Header -->
				<div class="edipost-popup-header">
					Send pakke
				</div>

				<!-- Body -->
				<div class="edipost-popup-body">

					<span class="field-row">
						<label for="product">Sendingsm&aring;te</label><br>
						<select id="product">
							<option value="8">Kliman&oslash;ytral Servicepakke</option>
							<option value="457">Bedriftspakke</option>
							<option value="15">Returservice Bedriftspakke</option>
							<option value="16">Bedriftspakke Ekspress over natt</option>
							<option value="20">Returservice Bedriftspakke Ekspress</option>
							<option value="18">Minipakken</option>
						</select>
					</span>

					<span class="field-row">
						<label for="company">Mottaker</label><br>
						<input type="text" id="company" value="<?php echo $firstname . ' ' . $lastname; ?>">
					</span>

					<span class="field-row">
						<label for="street">Adresse</label><br>
						<input type="text" id="street" value="<?php echo $street; ?>">
					</span>

					<span class="field-row">
						<label for="zipcode">Postnummer / Sted</label><br>
						<input type="text" id="zipcode" value="<?php echo $zipcode; ?>">
						<input type="text" id="city" value="<?php echo $city; ?>" readonly>
					</span>

					<span class="field-row">
						<label for="contact">Kontaktperson</label><br>
						<input type="text" id="contact">
					</span>

					<span class="field-row">
						<label for="email">E-postadresse</label><br>
						<input type="text" id="email" value="<?php echo $email; ?>">
					</span>

					<span class="field-row">
						<label for="phone">Mobilnummer</label><br>
						<input type="text" id="phone" value="<?php echo $phone; ?>">
					</span>

					<span class="field-row">
						<label for="reference">Referanse / sendingsinstruksjoner</label><br>
						<input type="text" id="reference" value="Ordre nr <?php echo $orderId; ?>">
					</span>

					<br><br>

					<span class="f-right">
						<button type="button" class="scalable save" id="openEdipostBtn">&Aring;pne i Edipost</button>
						<button type="button" class="scalable save" id="createShipmentBtn">Lag pakke</button>
						<button type="button" class="scalable save" id="closeEdipostBtn">Lukk</button>
					</span>
				</div>

			</div>
		</div>

		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script>

			var $j = jQuery.noConflict();


			function openEdipostPopup() {
				$j('.edipost-popup-container').removeClass('edipost-popup-hidden');
			}


			function closeEdipostPopup() {
				$j('.edipost-popup-container').addClass('edipost-popup-hidden');
			}


			function openEdipost() {
				if( validateForm() ) {
					var username = '<?php echo $username; ?>';
					var password = '<?php echo $password; ?>';
					var addressUrl = '<?php echo $addressUrl; ?>';

					var addressData = {
						company: $j('#company').val(),
						street:  $j('#street').val(),
						zipcode: $j('#zipcode').val(),
						city:    $j('#city').val(),
						country: "NO",
						contact: $j('#contact').val(),
						email:   $j('#email').val(),
						phone:   $j('#phone').val()
					};

					$j.get( addressUrl, addressData, function(data) {
						var url = 'https://no.pbshipment.com/login?Username=' + username + '&Password=' + password + '#id=' + data;

						try {
							window.open(url);

						} catch(e) {
							alert('Klarte ikke å åpne Edipost. Vennligst prøv igjen senere.');
						}

					})
					.fail(function() {
						alert('Klarte ikke å åpne Edipost. Vennligst prøv igjen senere.');
					});
				}
			}


			function createShipment() {
				if( validateForm() ) {
					var consignmentUrl = '<?php echo $consignmentUrl; ?>';

					var addressData = {
						company:   $j('#company').val(),
						street:    $j('#street').val(),
						zipcode:   $j('#zipcode').val(),
						city:      $j('#city').val(),
						country:   "NO",
						contact:   $j('#contact').val(),
						email:     $j('#email').val(),
						phone:     $j('#phone').val(),
						product:   $j('#product').val(),
						reference: $j('#reference').val()
					};

					var url = consignmentUrl + '?' + $j.param(addressData);
					location = url;
				}
			}


			function validateForm() {
				var valid = true;

				// Check that company is non-empty
				if( $j('#company').val().length <= 0 ) {
					$j('#company').addClass('edipost-invalid');
					valid = false;
				} else {
					$j('#company').removeClass('edipost-invalid');
				}

				// Check that street address is non-empty
				if( $j('#street').val().length <= 0 ) {
					$j('#street').addClass('edipost-invalid');
					valid = false;
				} else {
					$j('#street').removeClass('edipost-invalid');
				}

				// Check that zip code is non-empty
				if( $j('#zipcode').val().length <= 0 ) {
					$j('#zipcode').addClass('edipost-invalid');
					valid = false;
				} else {
					$j('#zipcode').removeClass('edipost-invalid');
				}

				// Check that city is non-empty and valid
				if( $j('#city').val().length <= 0 || $j('#city').val() == 'Ugyldig postnummer' ) {
					$j('#zipcode').addClass('edipost-invalid');
					valid = false;
				} else {
					$j('#zipcode').removeClass('edipost-invalid');
				}

				return valid;
			}


			function findCityByZipcode() {
				var url = '<?php echo $zipcodeUrl ?>';
				var data = { zipcode: $j('#zipcode').val() };

				$j.get( url, data, function(data) {
					$j('#city').val( data );
				});
			}


			$j( document ).ready(function() {

				// Close Edipost popup
				$j('#closeEdipostBtn').click(function() {
				  closeEdipostPopup();
				});

				// Open Edipost page
				$j('#openEdipostBtn').click(function() {
				  openEdipost();
				});

				// Create shipment
				$j('#createShipmentBtn').click(function() {
				  createShipment();
				});

				$j('#zipcode').change(function() {
					findCityByZipcode();
				});

				findCityByZipcode();

			});


		</script>


		<?php

		$this->_addButton( 'button_id', array(
			'label' => Mage::helper( 'Sales' )->__( 'Pakkelapp' ),
			'onclick' => "openEdipostPopup()",
			'class' => 'go'
		), 0, 100, 'header', 'header' );

	}
}

?>
