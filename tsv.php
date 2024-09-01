<?php
error_reporting(0);
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'assets/vendor/autoload.php';
include 'class/connection.php';

$SUBMIT = (isset($_POST['submit']) ? $_POST['submit'] : null);

if ($SUBMIT == "SUBMIT_OTP_VERIFY") {
    
  $USER_OTP = (isset($_POST['otpvalue']) ? $_POST['otpvalue'] : null);
  $SYSTEM_OTP = (isset($_POST['otp']) ? $_POST['otp'] : null);
  $EMAIL = (isset($_POST['email']) ? $_POST['email'] : null);
  $users = (isset($_POST['user']) ? $_POST['user'] : null);
  $upass = (isset($_POST['password']) ? $_POST['password'] : null);

  $h_upass = sha1($upass);

  if($USER_OTP == $SYSTEM_OTP) {

  //create some sql statement             
        $qry = "SELECT TSV,ID,F_NAME,L_NAME,GENDER_ID,EMAIL,USERNAME,PHONE_NUMBER,STREET_ADDRESS,IMAGE_PATH,TYPE_ID,VERIFIED
        FROM  `users`
        WHERE  `USERNAME` ='" . $users . "' OR `EMAIL` ='" . $users . "' AND  `PASSWORD` =  '" . $h_upass . "'";
        $rs = mysqli_query($db, $qry);
        
        if ($rs){
            while ($found_user = mysqli_fetch_assoc($rs)) {
                
                $_SESSION['TSV']  = $found_user['TSV']; 
                $_SESSION['MEMBER_ID']  = $found_user['ID']; 
                $_SESSION['FIRST_NAME'] = $found_user['F_NAME']; 
                $_SESSION['LAST_NAME']  =  $found_user['L_NAME'];  
                $_SESSION['GENDER_ID']  =  $found_user['GENDER_ID'];
                $_SESSION['EMAIL']  =  $found_user['EMAIL'];
                $_SESSION['USERNAME']  =  $found_user['USERNAME'];
                $_SESSION['PHONE_NUMBER']  =  $found_user['PHONE_NUMBER'];
                $_SESSION['ADDRESS']  =  $found_user['STREET_ADDRESS']; 
                $_SESSION['TYPE']  =  $found_user['TYPE_ID']; 
                $_SESSION['IMAGE_PATH']  =  $found_user['IMAGE_PATH']; 
                $AAA = $_SESSION['MEMBER_ID'];
		        $member = $_SESSION['MEMBER_ID'];

		        $type = "SELECT t.TYPE FROM type t, users u WHERE t.TYPE_ID=u.TYPE_ID AND u.ID=$AAA";

                $result = mysqli_query($db, $type) or die(mysqli_error($db));
                while($row = mysqli_fetch_array($result))
                {  
                    $type=$row['TYPE'];
		        }

		            if (strlen($_SESSION['IMAGE_PATH'])==0) { 
			            $_SESSION['my_photo_path'] = "images/default.png";
		            } else { 
			            $_SESSION['my_photo_path'] = "images/" . $type . "/" . $_SESSION['IMAGE_PATH'];
		            }	
                    
                //this part is the verification if admin or user 
                if (($_SESSION['TYPE']=='1') OR ($_SESSION['TYPE']=='2') OR ($_SESSION['TYPE']=='3')){
                    $_SESSION['success'] = "Welcome" . " " . $_SESSION['FIRST_NAME'] . " " . $_SESSION['LAST_NAME'] . " " . "!";
                    header('Refresh:0; url=home/index.php'); 
                }
            }
        }

    
  } else {
    $_SESSION['error'] = 'Invalid OTP!';
    $SYSTEM_OTP = $SYSTEM_OTP;
    $EMAIL = $EMAIL;
    $username = $users;
    $password = $upass;
    //$password = $upass;
  }

} else {

    $EMAIL = (isset($_GET['email']) ? $_GET['email'] : null);
    $username = (isset($_GET['auth_u']) ? $_GET['auth_u'] : null);
    $password = (isset($_GET['auth_p']) ? $_GET['auth_p'] : null);

	$SYSTEM_OTP=rand(100000, 999999);//OTP generate
    	$query = "SELECT * FROM users WHERE email='$EMAIL'";
        $result = mysqli_query($db, $query) or die (mysqli_error($db));

            while ($row = mysqli_fetch_assoc($result)) {
                    $email=$row['EMAIL'];
                    $name=$row['F_NAME'] . "&nbsp;" . $row['L_NAME'];
	    }

        if ($email==$EMAIL) {

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
                        $mail->addAddress($EMAIL);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Two Step Verification Alert!';
                        $mail->Body    = 'Dear ' . $name . ',' . "<br><br>" . 'Your Two Step Verification OTP to login is : ' . "<b>" . $SYSTEM_OTP . "</b>&nbsp;<br>" . ' Did you just try to logged in to BakeryPro SCM? If not then do not Share this to anyone. ' . "<br><br>" . 'Thanks and Regards,' . "<br>" . 'SCM Team';

                        $mail->send();

                        $_SESSION['success'] = 'OTP for Two Step Verification is successfully sent to '.$EMAIL.'';
                    } catch (Exception $e) {

                        echo "<script> alert(\"Message could not be sent. Mailer Error!\"); </script>";

                    }

                    echo "</div>";
	}

}
?>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor_bootstrap/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  
    <!-- Including jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  
    <!-- Including Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<br><br><br>
<center>
<?php

  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='alert alert-success alert-dismissible fade show' style='width:50%;' role='alert' ID='alert'>
			  	<p>".$_SESSION['success']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['success']);
  		}

  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='alert alert-danger alert-dismissible fade show' style='width:50%;' role='alert' ID='alert'>
			  	<p>".$_SESSION['error']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>

<div class="card shadow mb-4 col-xs-12 col-md-4 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Two Step Verification</h4>
            </div>
&nbsp;
                <form class="user" role="form" action="tsv.php" method="post">
                    <div class="form-group">
                        Email: <?php print $EMAIL; ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-user" placeholder="OTP" name="otpvalue" type="text" autofocus required>
                    </div>&nbsp;
                    <button class="btn btn-primary btn-user btn-block">Verify OTP for Login</button>
  		              <input type="hidden" name="submit" value="SUBMIT_OTP_VERIFY">
  		              <input type="hidden" name="otp" value="<?php print "$SYSTEM_OTP"; ?>">
  		              <input type="hidden" name="email" value="<?php print "$EMAIL"; ?>">
  		              <input type="hidden" name="user" value="<?php print "$username"; ?>">
  		              <input type="hidden" name="password" value="<?php print "$password"; ?>">
                </form>

  </div>
    </center>










