<?php

ob_start();
error_reporting(0);
require("../libraries/sidebar.php");
$type_id = $_SESSION['TYPE'];

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='jananpandey1995@gmail.com'; // Business email ID

if ($_POST['invoice_id']) {

	$invoice_id = (isset($_POST['invoice_id']) ? $_POST['invoice_id'] : null);
} else if ($_GET['invoice_id']){
  
	$invoice_id = (isset($_REQUEST['invoice_id']) ? $_REQUEST['invoice_id'] : null);
}

	$DATA_BANK_INVOICE_ITEMS = $SCA->SCA_DATA('SELECT_INVOICE_ITEMS', $invoice_id);
	foreach ($DATA_BANK_INVOICE_ITEMS AS $ROW_INVOICE_ITEMS){
	
	}
			
$DATA_BANK = $SCA->SCA_DATA('SELECT_INVOICE', $invoice_id);
foreach ($DATA_BANK AS $ROW_DETAIL){

	$retailer_id = $ROW_DETAIL['RETAILER_ID'];
	$distributor_id = $ROW_DETAIL['DISTRIBUTOR_ID'];
	$discount = $ROW_DETAIL['DISCOUNT'];
	$shipping_charge = $ROW_DETAIL['SHIPPING_COST'];
	$payment_status = $ROW_DETAIL['PAYMENT_STATUS'];
	$country_id = $ROW_DETAIL['COUNTRY_ID'];
	$country = $SCA->RETURN_FIELD('tbl_countries','COUNTRY_NAME','ID',$country_id);
	$area_id = $SCA->RETURN_FIELD('users','AREA_ID','ID',$retailer_id);
	if ($shipping_charge == 'Y'){
		$shipping_charge = $SCA->RETURN_FIELD('area','SHIPPING_CHARGE','ID',$area_id);
	} else {
		$shipping_charge = 0.00;
	}
	
	$payment_method = $ROW_DETAIL['PAYMENT_METHOD'];

}


$DATA_BANK = $SCA->SCA_DATA('SELECT_DISTRIBUTOR', $distributor_id);
foreach ($DATA_BANK AS $ROW_DISTRIBUTOR){

}

$from_curr = 'NPR';
$to_curr = 'USD';
$amount = ((($ROW_INVOICE_ITEMS['TOTAL_AMOUNT'] - $discount) * 13/100) + ($ROW_INVOICE_ITEMS['TOTAL_AMOUNT'] - $discount) + $shipping_charge);

function convertCurrency($from_currency,$to_currency,$amount){

    $req_url = 'https://api.exchangerate.host/latest?base='.$from_currency.'&amount='.$amount.'&symbols='.$to_currency;

    $response_json = file_get_contents($req_url);

    $hasConversion = false;
    $converted_amount = 0;
    if(false !== $response_json) {
        try {
            $response = json_decode($response_json);

            if($response->success === true) {

                 // Read conversion rate
                 $converted_amount = round($response->rates->$to_currency,2);

                 $hasConversion = true;
            }

        } catch(Exception $e) {
            // Handle JSON parse error...

        }
    }

    $return_arr = array(
        "success" => $hasConversion,
        "amount" => $amount,
        "converted_amount" => $converted_amount
    );

    return $return_arr;
}


$from_currency = $from_curr;
$to_currency = $to_curr;
$amount = $amount;

$response = convertCurrency($from_currency,$to_currency,$amount);

//echo "<pre>";
// /print_r($response);
//echo "</pre>";

extract($response);
$usd_amount = $converted_amount;
//print $usd_amount;
//echo "\$a = $hasConversion; \$b = $amount; \$usd_amount = $converted_amount";
?>

<?php

  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='alert alert-success alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['success']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['success']);
  		}

  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='alert alert-danger alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['error']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>



<!DOCTYPE html>
<html>
<head>
	<title> View Invoice Details </title>

</head>
<body>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<?php if ($type_id == '3') { ?><a href="retailer_invoices.php"><?php } else { ?><a href="view_invoice.php"><?php } ?><?php if ($type_id == '3') { echo 'My Invoices'; } else { echo 'Manage Invoices'; } ?></a>
</li>
<li class="breadcrumb-item active">Invoice Details</li>
</ol>

<div id="printableArea">

<div class="container-fluid">
<div id="ui-view" data-select2-id="ui-view">
<div>
<div class="card">
<div class="card-header">Invoice
<strong>#<?php echo $ROW_DETAIL['INVOICE_ID']; ?></strong>
&nbsp;&nbsp;
<span class="me-1 fw-bold">Status:</span><?php if ($payment_status==0) { ?><span class="badge bg-danger text-white fw-bold">Unpaid</span><?php } else if ($payment_status==1) { ?><span class="badge bg-success text-white fw-bold">Paid</span> <?php } ?>
<button class="btn btn-sm btn-secondary float-right d-print-none" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-4">
<h6 class="mb-3">From:</h6>
<div>
<strong>BakeryPro SCM</strong>
</div>
<div>Bagmati, 44600</div>
<div>Maitidevi, Kathmandu, Nepal</div>
 <div>Email: info@bakerypro.com</div>
<div>Phone: +977 1234567890</div>
</div>
<div class="col-sm-4">
<h6 class="mb-3">To:</h6>
<div>
<strong><?php echo $ROW_DETAIL['F_NAME']. " " . $ROW_DETAIL['L_NAME']; ?></strong>
</div>
<div><?php echo $ROW_DETAIL['STATE']; ?>, <?php echo $ROW_DETAIL['POSTCODE']; ?></div>
<div><?php echo $ROW_DETAIL['STREET_ADDRESS']; ?>, <?php echo $country; ?></div>
<div>Email: <?php echo $ROW_DETAIL['EMAIL']; ?></div>
<div>Phone: <?php echo $ROW_DETAIL['PHONE_NUMBER']; ?></div>
</div>
<div class="col-sm-4">
<h6 class="mb-3">Details:</h6>
<div>Invoice
<strong>#<?php echo $ROW_DETAIL['INVOICE_ID']; ?></strong>
</div>
<div>Invoice Date: <?php echo $ROW_DETAIL['CREATED_DATE']; ?></div>
</div>
</div>
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Products</th>
<th class="right">Unit Price</th>
<th class="center">Quantity</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
	
<?php $i=1; foreach ($DATA_BANK_INVOICE_ITEMS AS $ROW_INVOICE_ITEMS) { ?>

<tr>
<td class="center"><?php echo $i; ?></td>
<td class="left"><?php echo $ROW_INVOICE_ITEMS['PRODUCT_NAME']; ?>
                 <br> Mfd: <?php echo $ROW_INVOICE_ITEMS['MFD_DATE']; ?><br>
                 Exp: <?php echo $ROW_INVOICE_ITEMS['EXP_DATE']; ?>
</td>
<td class="right">Rs <?php echo $ROW_INVOICE_ITEMS['PRICE']; ?></td>
<td class="center"><?php echo $ROW_INVOICE_ITEMS['QUANTITY']; ?></td>
<td class="right">Rs <?php echo $ROW_INVOICE_ITEMS['QUANTITY']*$ROW_INVOICE_ITEMS['PRICE']; ?></td>
</tr>

<?php $i++; } ?>

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5"><?php if (strlen($ROW_DETAIL['COMMENTS'])>0) { ?>Comments: <?php } ?><?php echo $ROW_DETAIL['COMMENTS']; ?>
<br><br><?php if(strlen($ROW_DETAIL['PAYMENT_METHOD'])>0) { ?>
Payment Method : <?php } ?><?php print $ROW_DETAIL['PAYMENT_METHOD']; ?>
</div>

<div class="col-lg-5 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right"><?php	echo "Rs " . $ROW_INVOICE_ITEMS['TOTAL_AMOUNT']; ?></td>
</tr>
<tr>
<td class="left">
<strong>Discount</strong>
</td>
<td class="right">Rs <?php echo $discount; ?></td>
</tr>
<tr>
<td class="left">
<strong>13.00% VAT</strong>
</td>
<td class="right">Rs <?php echo (($ROW_INVOICE_ITEMS['TOTAL_AMOUNT'] - $discount) * 13/100); ?></td>
</tr>

<tr>
<td class="left">
<strong>Shipping Charge</strong>
</td>
<td class="right">Rs <?php echo $shipping_charge; ?></td>
</tr>

 <tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong><?php echo "Rs " . ((($ROW_INVOICE_ITEMS['TOTAL_AMOUNT'] - $discount) * 13/100) + ($ROW_INVOICE_ITEMS['TOTAL_AMOUNT'] - $discount) + $shipping_charge); ?></strong>
</td>
</tr>
</tbody>
</table>


<?php if (($payment_status==0) && ($type_id == '3')) { ?>
<?php if ($payment_method != "Cash On Delivery") { ?>

<a class="btn btn-success d-print-none" href="cash_payment.php?id=<?php echo $invoice_id; ?>">
<i class="fa fa-usd"></i> Cash on Delivery</a>
&nbsp;<span class="d-print-none">OR</span>

<?php } ?>
<?php if (($payment_status==0) && ($payment_method == "Cash On Delivery")) { ?>
	<br>
	<span class="d-print-none">Pay With</span>
<?php } ?>

<form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1" target="_blank">
<br>
    <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="BakeryPro Payment">
    <input type="hidden" name="item_number" value="<?php print count($DATA_BANK_INVOICE_ITEMS); ?>">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="amount" value="<?php echo $usd_amount; ?>">
    <input type="hidden" name="cpp_header_image" value="https://phplift.net/wp-content/uploads/2017/01/logo.png">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="http://localhost/fyp/home/paypal_payment_success.php?invoice_id=<?php echo $invoice_id; ?>&status=failed">
    <input type="hidden" name="return" value="http://localhost/fyp/home/paypal_payment_success.php?invoice_id=<?php echo $invoice_id; ?>&status=success">

	<input type="image" class="d-print-none" src="../images/paypal.png" border="0" width="150" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>

    <?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div> 

</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


<?php
		include("../libraries/footer.php");
		ob_end_flush();
?>

</body>
</html>