<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';

	if (($_SESSION['TYPE']=='2') && ($_POST['order_id']>0)) {

	$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
	$created_date = $date->format('Y-m-d H:i A');

	$order_id = (isset($_POST['order_id']) ? $_POST['order_id'] : null);
	$comment = (isset($_POST['txtComment']) ? $_POST['txtComment'] : null);
	$distributor_id = (isset($_POST['USERS']) ? $_POST['USERS'] : null);

	$shipping_charge = (isset($_POST['shipping_charge']) ? $_POST['shipping_charge'] : null);
	if ($shipping_charge == "on") {
		$shipping_charge = 'Y';
	} else {
		$shipping_charge = 'N';
	}

	$discount = (isset($_POST['discount']) ? $_POST['discount'] : null);
	if (strlen($discount)>0) {
		$discount = $discount;
	} else {
		$discount = 0;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$DATA_BANK = $SCA->SCA_DATA('INSERT_INVOICE_SELECT_ORDER', $order_id);
		foreach ($DATA_BANK AS $ROW_DETAIL){

			$retailer_id = $ROW_DETAIL['RETAILER_ID'];
			$total_amount = $ROW_DETAIL['TOTAL_AMOUNT'];
		}
		

			$INSERT_INVOICE = "INSERT INTO invoices(ORDER_ID,RETAILER_ID,DISTRIBUTOR_ID,CREATED_DATE,TOTAL_AMOUNT,DISCOUNT,COMMENTS,SHIPPING_COST) VALUES('$order_id','$retailer_id','$distributor_id','$created_date','$total_amount','$discount','$comment','$shipping_charge')";
			$SCA->SCA_EXECUTE($INSERT_INVOICE);	
				
			$TAB = 'invoices';
			$invoice_id = $SCA->SCA_INFO('AUTO_INCREMENT', $TAB);

			$DATA_BANK = $SCA->SCA_DATA('INSERT_INVOICE_SELECT_ORDER_ITEMS', $order_id);
			foreach ($DATA_BANK AS $ROW_DETAIL){

					$product_id = $ROW_DETAIL['PRODUCT_ID'];
					$quantity = $ROW_DETAIL['QUANTITY'];

					$INSERT_INVOICE_ITEMS = "INSERT INTO invoice_items(INVOICE_ID,PRODUCT_ID,QUANTITY) VALUES('$invoice_id','$product_id','$quantity')";
					$SCA->SCA_EXECUTE($INSERT_INVOICE_ITEMS);
				}
				
					$UPDATE_STATUS = "UPDATE orders SET STATUS=1 WHERE ORDER_ID='$order_id'";
					$RESULT = $SCA->SCA_EXECUTE($UPDATE_STATUS);	

					$_SESSION['success'] = "Invoice Generated Successfully";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "view_invoice.php";
            </script>
            
<?php
					}
					else {
						$_SESSION['error'] = "Can not generate invoice.";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "view_invoice.php";
            </script>
            
<?php
					}
				}
?>
