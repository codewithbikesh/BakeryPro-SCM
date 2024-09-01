<?php
error_reporting(0);
include 'class/connection.php';

$AUTH= $_GET['auth'];
if(strlen($AUTH)==0) {
    $o= (isset($_POST['o']) ? $_POST['o'] : null);
}

if($AUTH=='invalid') {
  $o= (isset($_GET['o']) ? $_GET['o'] : null);
  }

    if(strlen($o)==0) { header('location:index.php'); }
    $email= (isset($_POST['email']) ? $_POST['email'] : null);

		$requireErr = $matchErr ="";
		if($_SERVER['REQUEST_METHOD'] == "POST") {
					if(!empty($_POST['txtNewPassword']) && !empty($_POST['txtConfirmPassword'])){
						$newPassword = sha1($_POST['txtNewPassword']);
						$confirmPassword = sha1($_POST['txtConfirmPassword']);
						if(strcmp($newPassword,$confirmPassword) == 0) {
							$query_UpdatePassword = "UPDATE users SET PASSWORD='$confirmPassword' WHERE EMAIL='$email'";
							if(mysqli_query($db,$query_UpdatePassword)) {
                echo "<script> alert(\"Password Updated Successfully\"); </script>";
		            header("Refresh:0; url=index.php");
							}
							else {
                echo "<script> alert(\"* Updating Password Failed\"); </script>";
							}
						}
						else {
              echo "<script> alert(\"* New Password and Confirm Password do not match\"); </script>";
						}
					}
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

    <center>
		<div class="card shadow mb-4 col-xs-12 col-md-5 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Change Password</h4>
            </div>


		<form action="" method="POST" class="form">
            <div class="card-body">

                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="newPassword">New Password</label>
                      </div>

                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="txtNewPassword" onkeyup="passcheck();" placeholder="New Password"  required />
                      </div>
			            </div>

                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <label for="confirmPassword">Confirm Password</label>
                      </div>

                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirmPassword" name="txtConfirmPassword" onkeyup="passcheck();" placeholder="Confirm Password" required /><span class="error_message"><?php echo $matchErr; ?></span>
                      </div>
			            </div>
        <h5 id="passcheck"></h5>
              <hr>
			<input type="submit" value="Change Password" class="btn btn-primary bg-gradient-primary" /><span class="error_message"> <?php echo $requireErr; ?>
  		              <input type="hidden" name="o" value="change.password">
  		              <input type="hidden" name="email" value="<?php print "$email"; ?>">
		
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
