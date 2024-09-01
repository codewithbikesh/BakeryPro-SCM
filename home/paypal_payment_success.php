<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php if (($_SESSION['TYPE']=='2') OR ($_SESSION['TYPE']=='1')){ ?>

		<script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
        </script>

<?php } else {

	$invoice_id = (isset($_REQUEST['invoice_id']) ? $_REQUEST['invoice_id'] : null);
	$status = (isset($_REQUEST['status']) ? $_REQUEST['status'] : null);
	if ($status == "success") {
            $UPDATE = "UPDATE invoices SET PAYMENT_STATUS = 1, PAYMENT_METHOD='Paypal' WHERE INVOICE_ID = $invoice_id";
	      	$RESULT = $SCA->SCA_EXECUTE($UPDATE);

	      if($RESULT=='1'){
			$_SESSION['success'] = 'Payment Successful through Paypal for Invoice: '.$invoice_id.'';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "invoice_details.php?invoice_id=<?php echo $invoice_id; ?>";
            </script>
            
<?php
	      
		} else{
			$_SESSION['error'] = 'Payment Failed!';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "invoice_details.php?invoice_id=<?php echo $invoice_id; ?>";
            </script>
            
<?php
	      }
	} else if ($status == "failed") {
		$_SESSION['error'] = 'Payment Failed!';
		?>

			<script type="text/javascript">
                      //then it will be redirected
                      window.location = "invoice_details.php?invoice_id=<?php echo $invoice_id; ?>";
            </script>

		<?php
	}
}

?>