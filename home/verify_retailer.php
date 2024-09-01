<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';

	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../assets/vendor/autoload.php';

?>

<?php

if (($_GET['id']==0) OR ($_SESSION['TYPE']=='3')) { ?>

		  <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
          </script>

<?php } else {
 	if ($_GET['id']>0) {

	 $retailerid = (isset($_GET['id']) ? $_GET['id'] : null);
	 $retaileremail = (isset($_GET['email']) ? $_GET['email'] : null);
		
$DATA_BANK = $SCA->SCA_DATA('RETAILER_DETAIL', $retaileremail);
foreach ($DATA_BANK AS $ROW_DETAIL){
	$firstname = $ROW_DETAIL['F_NAME'];
	$lastname = $ROW_DETAIL['L_NAME'];
}

	 $UPDATE = 'UPDATE users SET VERIFIED =1 WHERE ID ="'.$retailerid.'"';
	 $RESULT = $SCA->SCA_EXECUTE($UPDATE);

	 if($RESULT=='1'){
		
		echo "<div style='display: none;'>";
		$mail = new PHPMailer(true);
	
		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'jananpandey1995@gmail.com';                     //SMTP username
			$mail->Password   = 'uowqndmbthkfdppx';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
			//Recipients
			$mail->setFrom('jananpandey1995@gmail.com');
			$mail->addAddress($retaileremail);
	
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Account Activation';
			$mail->Body    = 'Dear ' . $firstname . ' ' . $lastname . ',' . "<br><br>" . 'Your account is now active. You can login now.' . "<br><br>" . 'Best Regards,' . "<br>" . 'SCM Team';
	
			$mail->send();
	
	
		} catch (Exception $e) {
	
	
		}

		$_SESSION['success'] = 'Retailer Verified Successfully !';
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
}
?>	


