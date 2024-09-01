<?php
error_reporting(0);
include'../class/connection.php';
include'../libraries/sidebar.php';

		$requireErr = $oldPasswordErr = $matchErr ="";
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if(!empty($_POST['txtOldPassword'])){
				$password = sha1($_POST['txtOldPassword']);
				$query_oldPassword = "SELECT PASSWORD FROM users WHERE PASSWORD='$password'";
				$result_oldPassword = mysqli_query($db,$query_oldPassword);
				$row_oldPassword = mysqli_fetch_array($result_oldPassword);
				if($row_oldPassword) {
					if(!empty($_POST['txtNewPassword']) && !empty($_POST['txtConfirmPassword'])){
						$newPassword = sha1($_POST['txtNewPassword']);
						$confirmPassword = sha1($_POST['txtConfirmPassword']);
						if(strcmp($newPassword,$confirmPassword) == 0) {
							$query_UpdatePassword = "UPDATE users SET PASSWORD='$confirmPassword' WHERE ID=".$_SESSION['MEMBER_ID']."";
							if(mysqli_query($db,$query_UpdatePassword)) {
								$_SESSION['success']="Password Changed Successfully";
								//header("Refresh:0");
							}
							else {
								$requireErr = "* Changing Password Failed";
								$_SESSION['error'] = $requireErr;
							}
						}
						else {
							$matchErr = "* New Password and Confirm Password do not match";
							$_SESSION['error'] = $matchErr;
						}
					}
					else {
						$requireErr = "* All Fields are required";
						$_SESSION['error'] = $requireErr;
					}
				}
				else {
					$oldPasswordErr = "* Old Password do not match";
					$_SESSION['error'] = $oldPasswordErr;
				}
			}
	}

?>

<?php

  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='alert alert-success alert-dismissible fade show' role='alert' ID='alert'>
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
  				<div class='alert alert-danger alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['error']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>

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



<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Change Password</li>
</ol>

            <center>
		<div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Change Password</h4>
            </div>


		<form action="" method="POST" class="form">
            <div class="card-body">
                <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="oldPassword">Old Password</label>
                      </div>

                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="oldPassword" name="txtOldPassword" placeholder="Old Password" required /><span class="error_message"><?php echo $oldPasswordErr; ?></span>
                      </div>
				</div>

                <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="newPassword">New Password</label>
                      </div>

                      <div class="col-sm-9">
                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onkeyup="passcheck();" id="newPassword" name="txtNewPassword" placeholder="New Password"  required />
                      </div>
				</div>

                <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="confirmPassword">Confirm Password</label>
                      </div>

                      <div class="col-sm-9">
                        <input type="password" class="form-control" onkeyup="passcheck();" id="confirmPassword" name="txtConfirmPassword" placeholder="Confirm Password"  required /><span class="error_message"><?php echo $matchErr; ?></span>
                      </div>
				</div>
        <h5 id="passcheck"></h5>
              <hr>
			<input type="submit" value="Change Password" class="btn btn-primary bg-gradient-primary" /> <span class="error_message"> <?php echo $requireErr; ?>
		
		</div>
		</form>
		
<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

		</div>


<?php
include'../libraries/footer.php';
?>

<script type="text/javascript">

function passcheck(){
  
  if (($('#newPassword').val()!='')&&($('#confirmPassword').val()!=='')) {

    if( $('#newPassword').val()  == $('#confirmPassword').val() ){
      $('#passcheck').html("Password Matched.");
    }else{
      $('#passcheck').html("Password didn't matched!!!");
    }
  }
}

</script>


<script>
var myInput = document.getElementById("newPassword");
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
