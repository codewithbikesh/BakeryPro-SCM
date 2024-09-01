<?php
//error_reporting(0);
$SUBMIT_OTP = (isset($_POST['btnotp']) ? $_POST['btnotp'] : null); 
$SYSTEM_OTP = (isset($_POST['system_otp']) ? $_POST['system_otp'] : null); 
$USER_OTP = (isset($_POST['user_otp']) ? $_POST['user_otp'] : null); 

if ($SUBMIT_OTP=="SUBMIT_OTP") {
	if ($SYSTEM_OTP==$USER_OTP) {
		echo "<script>alert('OTP Verification Successful.');</script>";
		header('Refresh:0; url=change_password.php');
	} else {
		echo "<script>alert('Invalid OTP');</script>";
		header("Refresh:0; url=otp.php?system_otp=$SYSTEM_OTP&submitsystemotp=submitotp");
	}
}
?>










