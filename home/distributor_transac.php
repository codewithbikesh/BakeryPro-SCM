<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_POST['email']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['email']!='NULL') {

        $date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
        $created_date = $date->format('Y-m-d H:i A');
        
        $firstname= (isset($_POST['firstname']) ? $_POST['firstname'] : null);
        $lastname= (isset($_POST['lastname']) ? $_POST['lastname'] : null);
        $email= (isset($_POST['email']) ? $_POST['email'] : null);
        $phonenumber= (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);
        $address= (isset($_POST['address']) ? $_POST['address'] : null);
        $createdby= (isset($_POST['user']) ? $_POST['user'] : null);
        
				if(isset($_POST['GENDER_CODE'])) {
          $gender= (isset($_POST['GENDER_CODE']) ? $_POST['GENDER_CODE'] : null);
				}

        switch($_GET['action']){
          case 'add':    
            $INSERT = "INSERT INTO users (F_NAME, L_NAME, GENDER_ID, EMAIL, PHONE_NUMBER, TYPE_ID, VERIFIED, STREET_ADDRESS, CREATED_DATE, CREATED_BY)
                      VALUES ('{$firstname}','{$lastname}','{$gender}','{$email}','{$phonenumber}','4','1','{$address}','{$created_date}','{$createdby}')";
	          $RESULT = $SCA->SCA_EXECUTE($INSERT);
            
			  if ($RESULT=='1'){
				    $_SESSION['success'] = 'Distributor Added Successfully !';
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

        break;
        }
}

?> 
