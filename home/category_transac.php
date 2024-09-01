<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_POST['categoryname']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		  <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
          </script> 

<?php } if ($_POST['categoryname']!='NULL') {

	$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
	$created_date = $date->format('Y-m-d H:i A');

	$categoryname = (isset($_POST['categoryname']) ? $_POST['categoryname'] : null);
	$categorydescription = (isset($_POST['categorydescription']) ? $_POST['categorydescription'] : null);
	$createdby = (isset($_POST['user']) ? $_POST['user'] : null);

	if ($categoryname!='NULL') {

              $INSERT = "INSERT INTO category (CATEGORY_NAME, CATEGORY_DESCRIPTION, CREATED_DATE, CREATED_BY)
                        VALUES ('{$categoryname}','{$categorydescription}','{$created_date}','{$createdby}')";
	      $RESULT = $SCA->SCA_EXECUTE($INSERT);	

	      if($RESULT=='1'){
	      		$_SESSION['success'] = 'Category Added Successfully !';
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
}

?>