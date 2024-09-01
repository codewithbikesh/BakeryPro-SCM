<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_POST['unitname']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['unitname']!='NULL') {

    $date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
    $created_date = $date->format('Y-m-d H:i A');

    $unitname = (isset($_POST['unitname']) ? $_POST['unitname'] : null);
    $unitdescription = (isset($_POST['unitdescription']) ? $_POST['unitdescription'] : null);
    $createdby = (isset($_POST['user']) ? $_POST['user'] : null);

    if ($unitname!='NULL') {

        $INSERT = "INSERT INTO unit (UNIT_NAME, UNIT_DESCRIPTION, CREATED_DATE, CREATED_BY)
                  VALUES ('{$unitname}','{$unitdescription}','{$created_date}','{$createdby}')";
	    $RESULT = $SCA->SCA_EXECUTE($INSERT);

		if ($RESULT=='1'){
				$_SESSION['success'] = 'Unit Added Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "unit.php";
            </script>
            
<?php
		}
		else{
				$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "unit.php";
            </script>
            
<?php
		}	
    }
}

?>