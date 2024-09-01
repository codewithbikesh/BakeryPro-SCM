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
			$email = (isset($_POST['email']) ? $_POST['email'] : null);
			$gender = (isset($_POST['GENDER_CODE']) ? $_POST['GENDER_CODE'] : null);
			$phonenumber = (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);
			$address = (isset($_POST['address']) ? $_POST['address'] : null);
		
	 		$UPDATE = 'UPDATE users set F_NAME="'.$firstname.'", L_NAME="'.$lastname.'", EMAIL="'.$email.'", GENDER_ID="'.$gender.'", ADDRESS ="'.$address.'", PHONE_NUMBER ="'.$phonenumber.'" WHERE
					   ID ="'.$id.'"';
			$RESULT = $SCA->SCA_EXECUTE($UPDATE);	

			if ($RESULT=='1'){
				$_SESSION['success'] = 'Distributor Updated Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "distributor.php";
            </script>
            
<?php
			}
			else{
				$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "distributor.php";
            </script>
            
<?php
			}
	}						
?>



