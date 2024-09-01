<?php
    error_reporting(1);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php

if (($_SESSION['TYPE']=='2') OR ($_GET['id']==0) OR ($_SESSION['TYPE']=='1')) { ?>

		  <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                  </script>

         <?php } if ($_GET['id']>0) {

	 $invoiceid = (isset($_GET['id']) ? $_GET['id'] : null);
		
	 $UPDATE = 'UPDATE invoices SET PAYMENT_METHOD="Cash On Delivery" WHERE INVOICE_ID ="'.$invoiceid.'"';
	 $RESULT = $SCA->SCA_EXECUTE($UPDATE);

	 if($RESULT=='1'){
		$_SESSION['success'] = 'Payment Method set Successfully for Invoice: '.$invoiceid.'';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "retailer_invoices.php";
            </script>

<?php
	 }
	 else{
		$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "retailer_invoices.php";
            </script>
            
<?php
	}
}
 ?>	


