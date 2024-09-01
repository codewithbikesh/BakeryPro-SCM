<?php
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'assets/vendor/autoload.php';
include 'class/connection.php';

$AUTH= $_GET['auth'];
$countryid = 149;
if(strlen($AUTH)==0) {
    $o= (isset($_POST['o']) ? $_POST['o'] : null);
}

if($AUTH=='invalid') {
  $o= (isset($_GET['o']) ? $_GET['o'] : null);
  }

if(strlen($o)==0) { header('location:index.php'); }

if($_SERVER['REQUEST_METHOD'] == "POST") {

  $date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
  $created_date = $date->format('Y-m-d H:i A');

  $firstname= (isset($_POST['firstname']) ? $_POST['firstname'] : null);
  $lastname= (isset($_POST['lastname']) ? $_POST['lastname'] : null);
  $area= (isset($_POST['AREA']) ? $_POST['AREA'] : null);
  $username= (isset($_POST['username']) ? $_POST['username'] : null);
  $password = sha1((isset($_POST['password']) ? $_POST['password'] : null));
  $email= (isset($_POST['email']) ? $_POST['email'] : null);
  $number= (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);
  $street_address= (isset($_POST['street_address']) ? $_POST['street_address'] : null);
  $company_name= (isset($_POST['company_name']) ? $_POST['company_name'] : null);
  $state= (isset($_POST['state']) ? $_POST['state'] : null);
  $postcode= (isset($_POST['postcode']) ? $_POST['postcode'] : null);
  $countryid= (isset($_POST['TBL_COUNTRIES']) ? $_POST['TBL_COUNTRIES'] : null);
  $vat_number= (isset($_POST['vat_number']) ? $_POST['vat_number'] : null);
  $accept_terms= (isset($_POST['accept_terms']) ? $_POST['accept_terms'] : null);
  if ($accept_terms = 'on') {
    $terms = 'Y';
  } else {
    $terms = 'N';
  }

  include_once('class/connection.php');
  
  $check_email = " SELECT * FROM users WHERE EMAIL = '$email'";
  $check = mysqli_query($db, $check_email);
  $num = mysqli_num_rows($check);

  $check_username = " SELECT * FROM users WHERE USERNAME = '$username'";
  $check_username = mysqli_query($db, $check_username);
  $username_check = mysqli_num_rows($check_username);

  if($username_check == 1) {
    echo "<script> alert(\"User with same username already exists.\"); </script>";
  } else {

  if($num == 1){
    echo "<script> alert(\"User with same email already exists.\"); </script>";
  } else {
    $INSERT= "INSERT INTO users(`F_NAME`, `L_NAME`, `EMAIL`, `PHONE_NUMBER`, `STREET_ADDRESS`, `COMPANY_NAME`, `STATE`, `POSTCODE`, `COUNTRY_ID`, `VAT_NUMBER`, `TERMS`, `USERNAME`, `PASSWORD`, `AREA_ID`, `TYPE_ID`, `TSV`, `VERIFIED`, `CREATED_DATE`) 
    VALUES ('$firstname', '$lastname', '$email', '$number', '$street_address','$company_name','$state','$postcode','$countryid','$vat_number','$terms','$username','$password','$area','3','N','0','$created_date') ";
    mysqli_query($db, $INSERT);
    
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
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Account Registration';
    $mail->Body    = 'Dear ' . $firstname . ' ' . $lastname . ',' . "<br><br>" . 'Thank you for your registration as a Retailer account. Your account will be active soon.' . "<br><br>" . 'Best Regards,' . "<br>" . 'SCM Team';

    $mail->send();

} catch (Exception $e) {


}
    echo "<script> alert(\"Account successfully created.\"); </script>";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>
            
<?php
  }
  mysqli_close($db);
}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    
      <title>Signup</title>
      <link href="https://fonts.googleapis.com/css?family=Aleo&display=swap" rel="stylesheet">
      <style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
</head>

<body>

<form role="form" action="index.php" method="post">
<center>
		<div class="card shadow mb-4 col-xs-12 col-md-6 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Personal Information</h4>
            </div>

            <div class="card-body">

              <div class="row g-3">

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="firstname" class="col-form-label">First Name : </label>
                    </div>
                        <input class="form-control" placeholder="First Name" name="firstname" type="text" autofocus required>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="lastname" class="col-form-label">Last Name : </label>
                    </div>
                        <input class="form-control" placeholder="Last Name" name="lastname" type="text" autofocus required>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="email" class="col-form-label">Email : </label>
                    </div>
                        <input class="form-control" placeholder="Email" name="email" type="email" autofocus required>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="phonenumber" class="col-form-label">Phone Number : </label>
                    </div>
                        <input class="form-control" placeholder="Phone Number" name="phonenumber" type="text" autofocus required>
                    </div>

              </div>
            </div>
      </div>
</center>

<center>
<div class="card shadow mb-4 col-xs-12 col-md-6 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Billing Address</h4>
            </div>

            <div class="card-body">

              <div class="row g-3">

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="area" class="col-form-label">Company Name : </label>
                    </div>
                        <input class="form-control" placeholder="Company Name (Optional)" name="company_name" type="text" autofocus>
                    </div>

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="area" class="col-form-label">Area : </label>
                    </div>
                        <?php $TBID = "area"; include("class/area_selection_box.php"); ?>
                    </div>
                    
                    
                    <div class="col-md-12">
                    <div class="text-left">
                        <label for="address" class="col-form-label">Street Address : </label>
                    </div>
                        <input class="form-control" placeholder="Street Address" name="street_address" type="text" autofocus required>
                    </div>

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="state" class="col-form-label">State : </label>
                    </div>
                        <input class="form-control" placeholder="State" name="state" type="text" autofocus required>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="postcode" class="col-form-label">Postcode : </label>
                    </div>
                        <input class="form-control" placeholder="Postcode" name="postcode" type="text" autofocus required>
                    </div>

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="address" class="col-form-label">Country : </label>
                    </div>
                        <?php $TBID = "tbl_countries"; include("class/country_selection_box.php"); ?>
                    </div>

                <script>
	                document.getElementById('TBL_COUNTRIES').value='<?php print $countryid; ?>';
                </script>

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="vat number" class="col-form-label">VAT Number : </label>
                    </div>
                        <input class="form-control" placeholder="VAT Number (Optional)" name="vat_number" type="text" autofocus>
                    </div>

              </div>
            </div>
</div>
</center>

<center>
		<div class="card shadow mb-4 col-xs-12 col-md-6 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Account Security</h4>
            </div>

            <div class="card-body">

              <div class="row g-3">

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="username" class="col-form-label">Username : </label>
                    </div>
                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                    </div>

                    <div class="col-md-6">
                    <div class="text-left">
                        <label for="password" class="col-form-label">Password : </label>
                    </div>
                        <input class="form-control" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" name="password" type="password" required>
                    </div>

              </div>
            </div>
            
<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
      </div>
      
				
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</center>

<center>

<label class="form-check">
        <input type="checkbox" name="accept_terms" class="form-check-input accepttos" required>
                        I accept that all the data are accurate.
</label>

<button class="btn btn-primary btn-user btn-block" style="width:30%;">Proceed to Sign Up</button>
<input type="hidden" name="o" value="signup">
<hr>
            <a href="index.php">Back to Login</a>
</center>

</form>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright © Janam Pandey 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

         
</body>

</html>