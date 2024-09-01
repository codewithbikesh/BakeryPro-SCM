<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_SESSION['TYPE']=='2') OR ($_POST['username']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		      <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
          </script>

<?php } if (!isset($_GET['do']) || $_GET['do'] != 1) {

      $date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
      $created_date = $date->format('Y-m-d H:i A');

      $firstname = (isset($_POST['firstname']) ? $_POST['firstname'] : null);
      $lastname = (isset($_POST['lastname']) ? $_POST['lastname'] : null);
      $username = (isset($_POST['username']) ? $_POST['username'] : null);
      $password = (isset($_POST['password']) ? $_POST['password'] : null);
      $email = (isset($_POST['email']) ? $_POST['email'] : null);
      $phonenumber = (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);

      include_once('../class/connection.php');
      $check_email = " SELECT * FROM users WHERE EMAIL = '$email'";
      $check = mysqli_query($db, $check_email);
      $num = mysqli_num_rows($check);
      
      $check_username = " SELECT * FROM users WHERE USERNAME = '$username'";
      $check_username = mysqli_query($db, $check_username);
      $username_check = mysqli_num_rows($check_username);

      if($username_check == 1) {
        $_SESSION['error'] = 'User with same username already exists.';
        header('Location: manufacturer.php');
        } else {
      
        if($num == 1){
        $_SESSION['error'] = 'User with same email already exists.';
        header('Location: manufacturer.php');
        } else {

      if ($username!='NULL') {
              switch($_GET['action']){
                case 'add':    
                    $INSERT = "INSERT INTO users (F_NAME, L_NAME, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, TYPE_ID, TSV, VERIFIED, CREATED_DATE)
                               VALUES ('{$firstname}','{$lastname}','{$username}',sha1('{$password}'),'{$email}','{$phonenumber}','2','N','1','{$created_date}')";
	                  $RESULT = $SCA->SCA_EXECUTE($INSERT);

			        if ($RESULT=='1'){
				            $_SESSION['success'] = 'Manufacturer Added Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "manufacturer.php";
            </script>
<?php
			        }
			        else{
				            $_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "manufacturer.php";
            </script>
            
<?php
			        }

                break;
              }
      }
    }
  }
}

?> 