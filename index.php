<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BakeryPro SCM</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor_bootstrap/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body>
<br><br>
<?php 

    error_reporting(0);

    $AUTH= (isset($_GET['auth']) ? $_GET['auth'] : null);

    if(strlen($AUTH)==0) {
    $o= (isset($_POST['o']) ? $_POST['o'] : null);
    }

    if($AUTH=='invalid') {
      $o= (isset($_GET['o']) ? $_GET['o'] : null);
    }

    $INPUT_OTP = (isset($_POST['otpvalue']) ? $_POST['otpvalue'] : null);
    $SYSTEM_OTP = (isset($_POST['otp']) ? $_POST['otp'] : null);
    $EMAIL = (isset($_POST['email']) ? $_POST['email'] : null); 

    if($o=="otp.verify"){
        if ($INPUT_OTP==$SYSTEM_OTP){
        $o="change.password";
    } else {
        $o="otp";
        echo "<script> alert(\"You have entered Invalid OTP. Please check your email.\"); </script>";
    }
    }

   if(strlen($o)==0) { include("login.php"); } 
   if(strlen($o)>0) {
   if($o=='forgot.password') { include("forgot_password.php"); }
   if($o=='otp') { include("otp.php"); }
   if($o=='change.password') { include("change_password.php"); }
   if($o=='signup') { include("signup.php"); }
   
   }
   
?>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor_bootstrap/jquery/jquery.min.js"></script>
  <script src="assets/vendor_bootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor_bootstrap/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>