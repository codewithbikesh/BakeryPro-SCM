<?php
error_reporting(0);
    $o= (isset($_POST['o']) ? $_POST['o'] : null);
if(strlen($o)==0) { header('location:index.php'); }
?>

<center>
		<div class="card shadow mb-4 col-xs-12 col-md-4 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Forgot Password?</h4>
            </div>

            <form class="user" role="form" action="index.php" method="post">
            <div class="card-body">
                    <div class="form-group">
                        <input class="form-control form-control-user" placeholder="Email" name="email" type="email" autofocus required>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">Send OTP</button>
  		              <input type="hidden" name="submit" value="NEW_OTP">
  		              <input type="hidden" name="o" value="otp">
                    <hr>
            <a href="index.php">Back to Login</a>
            </div>
            </form>
</center>

</div>