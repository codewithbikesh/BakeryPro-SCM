<?php
	error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';

if ($_POST['id']==0) { ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['id']>0) {

		$idd = (isset($_POST['id']) ? $_POST['id'] : null);
		$firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
		$lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : null);
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
		$email = (isset($_POST['email']) ? $_POST['email'] : null);
		$phonenumber = (isset($_POST['phone']) ? $_POST['phone'] : null);
		$createddate = (isset($_POST['createddate']) ? $_POST['createddate'] : null);
		$type = (isset($_POST['type']) ? $_POST['type'] : null);
		$session_email = $_SESSION['EMAIL'];
		$session_username = $_SESSION['USERNAME'];
		$tsv = (isset($_POST['tsv']) ? $_POST['tsv'] : null);
		
		$DATA_BANK_EMAIL_CHECK = $SCA->SCA_DATA('PROFILE_UPDATE_EMAIL_CHECK', $email, $session_email);
		foreach ($DATA_BANK_EMAIL_CHECK AS $ROW_DETAIL){
			$exist_email=$ROW_DETAIL['EMAIL'];
		}
		
		$DATA_BANK_USERNAME_CHECK = $SCA->SCA_DATA('PROFILE_UPDATE_USERNAME_CHECK', $username, $session_username);
		foreach ($DATA_BANK_USERNAME_CHECK AS $ROW_DETAIL){
			$exist_username=$ROW_DETAIL['USERNAME'];
		}

		if ($exist_username == $username) {
			$_SESSION['error'] = 'This Username already exists!';
			//echo "<script> alert(\"This Username already exists!\"); </script>";
			header("Refresh:0; url=settings.php");
		} else {

		if ($exist_email == $email) {
			$_SESSION['error'] = 'This Email address already exists!';
			//echo "<script> alert(\"This Email address already exists!\"); </script>";
			header("Refresh:0; url=settings.php");
		} else {
			
		$folder_id = "../images/" . $type . "/";

        if (!file_exists($folder_id)) {
	    if (!mkdir($folder_id, 0777, true)) { die('Failed to create folders...'); }
        }


		$photo_id = "photo"; 
		$photo = $_FILES[$photo_id]['name'];

		if (strlen($photo)>0) { 
			$new_photo_id = $firstname . $idd . ".jpg";

	                if (move_uploaded_file($_FILES[$photo_id]["tmp_name"], $folder_id . $new_photo_id)) {
        	           //echo "The file ". basename( $_FILES[$PHOTO_ID]["name"]). " has been uploaded.";  
                	} else {

	                }
		} else {
			
			$DATA_BANK = $SCA->SCA_DATA('PROFILE_PHOTO', $idd);
			foreach ($DATA_BANK AS $ROW_DETAIL){
				$image_path=$ROW_DETAIL['IMAGE_PATH'];
			}

			$new_photo_id = $image_path;
		}


		if (($_SESSION['TYPE']=='1') OR ($_SESSION['TYPE']=='3')) {
			$street_address = (isset($_POST['street_address']) ? $_POST['street_address'] : null);
		}
		
		if ($_SESSION['TYPE']=='3') {
			$countryid = (isset($_POST['TBL_COUNTRIES']) ? $_POST['TBL_COUNTRIES'] : null);
			$state = (isset($_POST['state']) ? $_POST['state'] : null);
			$postcode = (isset($_POST['postcode']) ? $_POST['postcode'] : null);
			$company_name = (isset($_POST['company_name']) ? $_POST['company_name'] : null);
			$vat_number = (isset($_POST['vat_number']) ? $_POST['vat_number'] : null);
		}

		if ($_SESSION['TYPE']=='1') {
				if(isset($_POST['GENDER_CODE'])) {
					$gender = (isset($_POST['GENDER_CODE']) ? $_POST['GENDER_CODE'] : null);
				}
		}

		if ($_SESSION['TYPE']=='1') {

	 			$UPDATE = 'UPDATE users set F_NAME="'.$firstname.'", L_NAME="'.$lastname.'", GENDER_ID="'.$gender.'", USERNAME="'.$username.'", EMAIL="'.$email.'", STREET_ADDRESS ="'.$street_address.'", PHONE_NUMBER ="'.$phonenumber.'", IMAGE_PATH="'.$new_photo_id.'", TSV="'.$tsv.'" WHERE
					ID ="'.$idd.'"';
		} else if ($_SESSION['TYPE']=='2') {
	 			$UPDATE = 'UPDATE users set F_NAME="'.$firstname.'", L_NAME="'.$lastname.'", USERNAME="'.$username.'", EMAIL="'.$email.'", PHONE_NUMBER ="'.$phonenumber.'", IMAGE_PATH="'.$new_photo_id.'", TSV="'.$tsv.'" WHERE
					ID ="'.$idd.'"';
		} else if ($_SESSION['TYPE']=='3') {
	 			$UPDATE = 'UPDATE users set F_NAME="'.$firstname.'", L_NAME="'.$lastname.'", USERNAME="'.$username.'", EMAIL="'.$email.'", STREET_ADDRESS ="'.$street_address.'", COUNTRY_ID ="'.$countryid.'", STATE ="'.$state.'", POSTCODE ="'.$postcode.'", COMPANY_NAME ="'.$company_name.'", VAT_NUMBER ="'.$vat_number.'", PHONE_NUMBER ="'.$phonenumber.'", IMAGE_PATH="'.$new_photo_id.'", TSV="'.$tsv.'" WHERE
					ID ="'.$idd.'"';
		}

		$RESULT = $SCA->SCA_EXECUTE($UPDATE);

?>	

		    <script type="text/javascript">
                      //then it will be redirected
					alert("You've Updated Your Profile Successfully. You will be redirected to login page for security purpose.");
                    window.location = "logout.php";
            </script>

<?php 
}
}
}
 ?>