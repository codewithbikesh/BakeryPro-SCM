<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php

if (($_POST['id']==0) OR ($_SESSION['TYPE']=='3')) { ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['id']>0) {

		$id = (isset($_POST['id']) ? $_POST['id'] : null);
		$firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
		$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : null);
		$areaid = (isset($_POST['AREA']) ? $_POST['AREA'] : null);
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
		$email = (isset($_POST['email']) ? $_POST['email'] : null);
		$phonenumber = (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);
		$street_address = (isset($_POST['street_address']) ? $_POST['street_address'] : null);
		$country_id = (isset($_POST['TBL_COUNTRIES']) ? $_POST['TBL_COUNTRIES'] : null);
		$state = (isset($_POST['state']) ? $_POST['state'] : null);
		$postcode = (isset($_POST['postcode']) ? $_POST['postcode'] : null);
		$company_name = (isset($_POST['company_name']) ? $_POST['company_name'] : null);
		$vat_number = (isset($_POST['vat_number']) ? $_POST['vat_number'] : null);
		
	 	$UPDATE = 'UPDATE users set F_NAME="'.$firstname.'", L_NAME="'.$lastname.'", AREA_ID="'.$areaid.'", USERNAME="'.$username.'", EMAIL="'.$email.'", STREET_ADDRESS ="'.$street_address.'", COUNTRY_ID ="'.$country_id.'", STATE ="'.$state.'", POSTCODE ="'.$postcode.'", COMPANY_NAME ="'.$company_name.'", VAT_NUMBER ="'.$vat_number.'", PHONE_NUMBER ="'.$phonenumber.'" WHERE
				   ID ="'.$id.'"';
		$RESULT = $SCA->SCA_EXECUTE($UPDATE);

		if ($RESULT=='1'){
				$_SESSION['success'] = 'Retailer Updated Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "retailer.php";
            </script>
            
<?php
		}
		else{
				$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "retailer.php";
            </script>
            
<?php
		}
	}							
?>


