<?php
    error_reporting(1);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php

if (($_SESSION['TYPE']=='2') OR ($_POST['id']==0) OR ($_SESSION['TYPE']=='3')) { ?>

		  <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                  </script>

         <?php } if ($_POST['id']>0) {

	 $areaid = (isset($_POST['id']) ? $_POST['id'] : null);
	 $areaname = (isset($_POST['areaname']) ? $_POST['areaname'] : null);
	 $areacode = (isset($_POST['areacode']) ? $_POST['areacode'] : null);
	 $shipping_charge = (isset($_POST['shipping_charge']) ? $_POST['shipping_charge'] : null);
		
	 $UPDATE = 'UPDATE area SET AREA_NAME ="'.$areaname.'", AREA_CODE ="'.$areacode.'", SHIPPING_CHARGE ="'.$shipping_charge.'" WHERE ID ="'.$areaid.'"';
	 $RESULT = $SCA->SCA_EXECUTE($UPDATE);

	 if($RESULT=='1'){
		$_SESSION['success'] = 'Area Updated Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>

<?php
	 }
	 else{
		$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>
            
<?php
	}
}
 ?>	


