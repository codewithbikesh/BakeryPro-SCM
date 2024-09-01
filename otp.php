<?php
error_reporting(0);

$o= (isset($_POST['o']) ? $_POST['o'] : null);
if(strlen($o)==0) { header('location:index.php'); }

$SUBMIT = (isset($_POST['submit']) ? $_POST['submit'] : null);
$EMAIL = (isset($_POST['email']) ? $_POST['email'] : null); 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'assets/vendor/autoload.php';
    include 'class/connection.php';

if ($SUBMIT=="NEW_OTP") {

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
                        $mail->Subject = 'Password Recovery';
                        $mail->Body    = 'Dear ' . $name . ',' . "<br><br>" . 'Please use this OTP: ' . "<b>" . $SYSTEM_OTP . "</b>&nbsp;" . ' to recover your password.' . "<br><br>" . 'Thanks and Regards,' . "<br>" . 'SCM Team';

                        $mail->send();

                        echo "<script> alert(\"OTP has been sent to $EMAIL Successfully !\"); </script>";

                    } catch (Exception $e) {

                        echo "<script> alert(\"Message could not be sent. Mailer Error!\"); </script>";

                    }

                    echo "</div>";
	} else {
		echo "<script>alert('This Email Doesnt exist in the system. Please enter correct email.');</script>";
		header("Refresh:0; url=index.php?o=forgot.password&auth=invalid");
	}

}

?>


<center>
<div class="card shadow mb-4 col-xs-12 col-md-4 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Verify OTP</h4>
            </div>
&nbsp;
                <form class="user" role="form" action="index.php" method="post">
                    <div class="form-group">
                        Email: <?php print $EMAIL; ?>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-user" placeholder="OTP" name="otpvalue" type="text" autofocus required>
                    </div>&nbsp;
                    <button class="btn btn-primary btn-user btn-block">Verify OTP</button>
  		              <input type="hidden" name="submit" value="SUBMIT_OTP_VERIFY">
  		              <input type="hidden" name="o" value="otp.verify">
  		              <input type="hidden" name="otp" value="<?php print "$SYSTEM_OTP"; ?>">
  		              <input type="hidden" name="email" value="<?php print "$EMAIL"; ?>">
                </form>
    &nbsp;</br>
                <form class="user" role="form" action="index.php" method="post">
                    <button class="btn btn-primary btn-user btn-block">Resend OTP</button>
  		              <input type="hidden" name="submit" value="NEW_OTP">
  		              <input type="hidden" name="o" value="otp">
  		              <input type="hidden" name="otp" value="<?php print "$SYSTEM_OTP"; ?>">
  		              <input type="hidden" name="email" value="<?php print "$EMAIL"; ?>">
                    <hr>
                </form>

  </div>
    </center>










