<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php

if (($_POST['id']==0) OR ($_SESSION['TYPE']=='3')) { ?>

		  <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
          </script>

<?php } if ($_POST['id']>0) {

	 	$categoryid = (isset($_POST['id']) ? $_POST['id'] : null);
	 	$categoryname = (isset($_POST['categoryname']) ? $_POST['categoryname'] : null);
	 	$categorydescription = (isset($_POST['categorydescription']) ? $_POST['categorydescription'] : null);
	   	
	 	$UPDATE = 'UPDATE category set CATEGORY_NAME ="'.$categoryname.'",
			  CATEGORY_DESCRIPTION ="'.$categorydescription.'" WHERE
			  CATEGORY_ID ="'.$categoryid.'"';
	 	$RESULT = $SCA->SCA_EXECUTE($UPDATE);	

		if ($RESULT=='1'){
			$_SESSION['success'] = 'Category Updated Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "category.php";
            </script>
            
<?php
		}
		else{
			$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "category.php";
            </script>
            
<?php
		}
	}

?>	


