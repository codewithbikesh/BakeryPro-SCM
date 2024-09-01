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

		$productid = (isset($_POST['id']) ? $_POST['id'] : null);
		$productname = (isset($_POST['productname']) ? $_POST['productname'] : null);
		$productcode = (isset($_POST['productcode']) ? $_POST['productcode'] : null);
		$manufactureddate = (isset($_POST['manufactureddate']) ? $_POST['manufactureddate'] : null);
		$expirydate = (isset($_POST['expirydate']) ? $_POST['expirydate'] : null);
		$description = (isset($_POST['description']) ? $_POST['description'] : null);
		$price = (isset($_POST['price']) ? $_POST['price'] : null);
		$stockmanagement = (isset($_POST['stockmanagement']) ? $_POST['stockmanagement'] : null);
		$category = (isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : null);
		$unit = (isset($_POST['UNIT']) ? $_POST['UNIT'] : null);
		
	 	$UPDATE = 'UPDATE product set PRODUCT_NAME="'.$productname.'", PRODUCT_CODE="'.$productcode.'", MFD_DATE="'.$manufactureddate.'", EXP_DATE="'.$expirydate.'",
				  DESCRIPTION="'.$description.'", PRICE="'.$price.'", MANAGE_STOCK="'.$stockmanagement.'", CATEGORY_ID ="'.$category.'", UNIT_ID ="'.$unit.'" WHERE
				  PRODUCT_ID ="'.$productid.'"';
		$RESULT = $SCA->SCA_EXECUTE($UPDATE);
						
		if ($RESULT=='1'){
				$_SESSION['success'] = 'Product Updated Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "product.php";
            </script>
            
<?php
		}
		else{
				$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "product.php";
            </script>
<?php
		}	
	}
?>	