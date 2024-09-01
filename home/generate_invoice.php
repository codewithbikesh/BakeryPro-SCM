<?php
	ob_start();
	error_reporting(0);
	include'../libraries/sidebar.php';

	if (($_SESSION['TYPE']=='2') && ($_GET['id']>0)) {

		$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
		$currentDate = $date->format('Y-m-d H:i A');

			$order_id = (isset($_GET['id']) ? $_GET['id'] : null);

			$DATA_BANK_ORDER_ITEMS = $SCA->SCA_DATA('GENERATE_INVOICE_SELECT_ORDER_ITEMS', $order_id);
			foreach ($DATA_BANK_ORDER_ITEMS AS $ROW_DETAIL){
				
                $total_amount=$ROW_DETAIL['TOTAL_AMOUNT'];
			}

			$DATA_BANK = $SCA->SCA_DATA('GENERATE_INVOICE_SELECT_ORDER', $order_id);
			foreach ($DATA_BANK AS $ROW_DETAIL){
				
                $created_date=$ROW_DETAIL['CREATED_DATE'];
			}
			
			$TAB = 'invoices';
			$invoice_no = $SCA->SCA_INFO('AUTO_INCREMENT', $TAB);
			
		} else {
			header("Refresh:0; url=index.php");
		}
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="order.php">Manage Orders</a>
</li>
<li class="breadcrumb-item active">Generate Invoice</li>
</ol>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Invoice Summary&nbsp;</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">


		<table class="table_infoFormat">
		<tr>
			<td> Invoice No: </td>
			<td> <?php echo $invoice_no; ?> </td>
		</tr>
		<tr>
			<td> Invoice Date: </td>
			<td> <?php echo $currentDate; ?> </td>
		</tr>
		<tr>
			<td> Order No: </td>
			<td> <?php echo $order_id; ?> </td>
		</tr>
		<tr>
			<td> Order Date: </td>
			<td> <?php echo $created_date; ?> </td>
		</tr>
		</table>
<br>

		<form action="insert_invoice.php" method="POST" class="form">
		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />

		<table class="table">
               <thead>
			<tr>
				<th> S.N. </th>
				<th> Products </th>
				<th> Unit Price </th>
				<th> Quantity </th>
				<th> Amount </th>
			</tr>
               </thead>
          <tbody>

			<?php 
			$i = 0;
			$DATA_BANK = $SCA->SCA_DATA('GENERATE_INVOICE_SELECT_ORDER_ITEMS', $order_id);
			foreach ($DATA_BANK AS $ROW_DETAILS) { 
				$i = $i + 1;
			
					echo '<tr>';
					echo '<td>'. $i.'</td>';
					echo '<td>'. $ROW_DETAILS['PRODUCT_NAME'].'</td>';
					echo '<td>Rs '. $ROW_DETAILS['PRICE'].'</td>';
					echo '<td>'. $ROW_DETAILS['q'].'</td>';
					echo '<td>Rs '. $ROW_DETAILS['q']*$ROW_DETAILS['PRICE'].'</td>';
					echo '</tr>';
			} ?>

			<tr style="height:40px;vertical-align:bottom;">
				<td colspan="4" style="text-align:right;"> Grand Total: </td>
				<td>Rs 
				<?php echo $total_amount; ?>
				</td>
			</tr>
		</table>

			<br/>
			Discount: &nbsp;&nbsp;&nbsp;&nbsp;
			<input class="form-control" placeholder="Discount Amount" name="discount">
			<br/>
			Ship via: &nbsp;&nbsp;&nbsp;&nbsp;
			<?php $TBID = "users"; include("../class/users_selection_box.php"); ?>
			
			<br/>
			<input type="checkbox" name="shipping_charge" style="height:20px;width:30px;">&nbsp;
			Apply Shipping Charge?
			<br>
			<br/>
			Comments: <textarea class="form-control" maxlength="400" name="txtComment" rows="5" cols=""></textarea>
			<br/>
			<input type="submit" class="btn btn-primary bg-gradient-primary" style="float:right;" value="Generate Invoice" class="submit_button" />
		</form>

                        </div>
                    </div>
                  </div>

<?php
include'../libraries/footer.php';
ob_end_flush();
?>
