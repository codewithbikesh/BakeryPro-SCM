<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_SESSION['TYPE']=='2') OR ($_POST['areacode']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		<script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                </script>

<?php } if (!isset($_GET['do']) || $_GET['do'] != 1) {

	$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
	$created_date = $date->format('Y-m-d H:i A');

	$areaname = (isset($_POST['areaname']) ? $_POST['areaname'] : null);
	$areacode = (isset($_POST['areacode']) ? $_POST['areacode'] : null);
	$createdby = (isset($_POST['user']) ? $_POST['user'] : null);
	$shipping_charge = (isset($_POST['shipping_charge']) ? $_POST['shipping_charge'] : null);

	if ($areacode!='NULL') {

            $INSERT = "INSERT INTO area (AREA_NAME, AREA_CODE, SHIPPING_CHARGE, CREATED_DATE, CREATED_BY)
                        VALUES ('{$areaname}','{$areacode}','{$shipping_charge}','{$created_date}','{$createdby}')";
	      	$RESULT = $SCA->SCA_EXECUTE($INSERT);

	      if($RESULT=='1'){
			$_SESSION['success'] = 'Area Added Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>
            
<?php
	      }
	      else{
			$_SESSION['error'] = 'Error occured. Please try again.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>
            
<?php
	      }
	}
}

?>