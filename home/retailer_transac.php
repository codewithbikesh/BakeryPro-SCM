<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_POST['username']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['username']!='NULL') {

		$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
		$created_date = $date->format('Y-m-d H:i A');

		$firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
		$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : null);
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
		$password = (isset($_POST['password']) ? $_POST['password'] : null);
		$email = (isset($_POST['email']) ? $_POST['email'] : null);
		$phonenumber = (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);
		$street_address = (isset($_POST['street_address']) ? $_POST['street_address'] : null);
		$areaid = (isset($_POST['AREA']) ? $_POST['AREA'] : null);
		$country_id = (isset($_POST['TBL_COUNTRIES']) ? $_POST['TBL_COUNTRIES'] : null);
		$state = (isset($_POST['state']) ? $_POST['state'] : null);
		$postcode = (isset($_POST['postcode']) ? $_POST['postcode'] : null);
		$company_name = (isset($_POST['company_name']) ? $_POST['company_name'] : null);
		$vat_number = (isset($_POST['vat_number']) ? $_POST['vat_number'] : null);
		
		include_once('../class/connection.php');
		$check_email = " SELECT * FROM users WHERE EMAIL = '$email'";
		$check = mysqli_query($db, $check_email);
		$num = mysqli_num_rows($check);
	  
		$check_username = " SELECT * FROM users WHERE USERNAME = '$username'";
		$check_username = mysqli_query($db, $check_username);
		$username_check = mysqli_num_rows($check_username);

		if($username_check == 1) {
			$_SESSION['error'] = 'User with same username already exists.';
			header('Location: retailer.php');
		  } else {
		
		  if($num == 1){
			$_SESSION['error'] = 'User with same email already exists.';
			header('Location: retailer.php');
		  } else {
		
        switch($_GET['action']){
            case 'add':    
                $INSERT = "INSERT INTO users (F_NAME, L_NAME, AREA_ID, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, TYPE_ID, STREET_ADDRESS, COUNTRY_ID, STATE, POSTCODE, COMPANY_NAME, VAT_NUMBER, TSV, TERMS, VERIFIED, CREATED_DATE)
                        VALUES ('{$firstname}','{$lastname}','{$areaid}','{$username}',sha1('{$password}'),'{$email}','{$phonenumber}','3','{$street_address}','{$country_id}','{$state}','{$postcode}','{$company_name}','{$vat_number}','N','Y','1','{$created_date}')";
				$RESULT = $SCA->SCA_EXECUTE($INSERT);

		if ($RESULT=='1'){
				$_SESSION['success'] = 'Retailer Added Successfully !';
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
        break;
        }
	}
}
}

?> 
