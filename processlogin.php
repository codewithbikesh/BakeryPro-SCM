<?php
error_reporting(0);
include('class/connection.php');
require('home/session.php');

if (isset($_POST['btnlogin'])) {

  $users = (isset($_POST['user']) ? $_POST['user'] : null);
  $upass = (isset($_POST['password']) ? $_POST['password'] : null);

  $h_upass = sha1($upass);

    if(!empty($_POST["remembercredentials"])) {
	    setcookie ("username",$_POST["user"],time()+ 3000000000);
	    setcookie ("password",$_POST["password"],time()+ 3000000000);
    } else {
	    setcookie("username","");
	    setcookie("password","");
    }

  //create some sql statement             
        $qry = "SELECT TSV,ID,F_NAME,L_NAME,GENDER_ID,EMAIL,USERNAME,PHONE_NUMBER,STREET_ADDRESS,IMAGE_PATH,TYPE_ID,VERIFIED
        FROM  `users`
        WHERE  `USERNAME` ='" . $users . "' OR `EMAIL` ='" . $users . "' AND  `PASSWORD` =  '" . $h_upass . "'";
        $rs = mysqli_query($db, $qry);
        
        if ($rs){
        $count = mysqli_num_rows($rs);
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $count > 0) {
              while ($found_user = mysqli_fetch_assoc($rs)) {
                //store the result to a array and passed to variable found_user
                $verified = $found_user['VERIFIED'];
                if ($verified == '1') {

                $_SESSION['TSV']  = $found_user['TSV']; 

                if ($_SESSION['TSV'] == 'Y') { ?>
                  
		        <script type="text/javascript">
                      //then it will be redirected
                      window.location = "tsv.php?email=<?php echo $found_user['EMAIL']; ?>&auth_p=<?php echo $upass; ?>&auth_u=<?php echo $users; ?>";
            </script>

            <?php
                } else {

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

                } else {
                echo "<script> alert(\"Account is not verified yet. Contact to your Administrator.\"); </script>";
				        header('Refresh:0; url=index.php'); 
              }
            }
            
            } else {

              echo "<script> alert(\"Account Not Found on this details.\"); </script>";
              header('Refresh:0; url=index.php'); 

            }

        } 
      
}       
?>