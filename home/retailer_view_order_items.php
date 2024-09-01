<?php

include'../libraries/sidebar.php';
                   
$retailer_id = $_SESSION['MEMBER_ID'];

if (($_SESSION['TYPE']=='2') OR ($_GET['id']==0) OR ($_SESSION['TYPE']=='1')){ ?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php }        

$order_id = (isset($_GET['id']) ? $_GET['id'] : null);		
$DATA_BANK = $SCA->SCA_DATA('ORDER_ITEMS_DETAILS', $order_id);
foreach ($DATA_BANK AS $ROW_DETAILS){

	$status=$ROW_DETAILS['STATUS'];
	$total_amount=$ROW_DETAILS['TOTAL_AMOUNT'];
	$created_date=$ROW_DETAILS['CREATED_DATE'];
	$approved=$ROW_DETAILS['APPROVED'];

}

?>
            
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="retailer_view_orders.php">My Orders</a>
</li>
<li class="breadcrumb-item active">Order Details</li>
</ol>


            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Order Details&nbsp;</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">

		<table class="table_infoFormat">
		<tr>
			<td> Order No </td>
			<td width="10%"> : </td>
			<td> <?php echo $order_id; ?> </td>
		</tr>
		<tr>
			<td> Order Status </td>
			<td> : </td>
			<td>
			<?php
				if($status == 0) {
					echo "Pending";
				}
				else if($status == 1) {
					echo "Completed";
				} 
				else if($status == 2){
					echo "Cancelled";
				}
			?>
			</td>
		</tr>
		<tr>
			<td> Order Date </td>
			<td> : </td>
			<td> <?php echo $created_date; ?> </td>
		</tr>
		</table>

<br>

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
$DATA_BANK = $SCA->SCA_DATA('PRODUCT_ORDER_DETAILS', $order_id);
foreach ($DATA_BANK AS $ROW_DETAIL){
$i = $i + 1;

		echo '<tr>';
		echo '<td>'. $i .'</td>';
		echo '<td>'. $ROW_DETAIL['PRODUCT_NAME'].'</td>';
		echo '<td> Rs '. $ROW_DETAIL['PRICE'].'</td>';
		echo '<td>'. $ROW_DETAIL['QUANTITY']. " " . $ROW_DETAIL['UNIT_NAME'].'</td>';
		echo '<td> Rs '. $ROW_DETAIL['QUANTITY']*$ROW_DETAIL['PRICE'].'</td>';
		echo '</tr> ';

}
?>


			<tr style="height:40px;vertical-align:bottom;">
				<td colspan="4" style="text-align:right;"> Sub Total: </td>
				<td>Rs <?php echo $total_amount; ?></td>
			</tr>

                            </table>
                        </div>
                    </div>
                  </div>

<?php
include'../libraries/footer.php';
?>

