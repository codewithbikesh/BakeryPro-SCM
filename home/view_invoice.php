<?php

	ob_start();
	error_reporting(0);
	include("../libraries/sidebar.php");

		if ($_SESSION['TYPE']=='3') {
?>
		    
		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>
<?php
		}
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

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Manage Invoices</li>
</ol>


        <!-- INVOICE TABLE -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Invoice(s)&nbsp;<a href="sales_report.php" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-file-invoice"></i> Sales Report</a></h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
			<tr>
				<th> Invoice ID </th>
				<th> Retailer Name </th>
				<th> Area </th>
				<th> Invoice Date </th>
				<th> Total Amount (With VAT) </th>
				<th> Payment Status </th>
				<th> Payment Method </th>
				<th> Details </th>
			</tr>

               </thead>
          <tbody>
<?php 

$DATA_BANK = $SCA->SCA_DATA('VIEW_INVOICE_DATA');
foreach ($DATA_BANK AS $ROW_DETAIL){ 
  
	$retailer_id = $ROW_DETAIL['RETAILER_ID'];
	$area_id = $SCA->RETURN_FIELD('users','AREA_ID','ID',$retailer_id);
	$shipping_charge = $ROW_DETAIL['SHIPPING_COST'];
	if ($shipping_charge == 'Y'){
		$shipping_charge = $SCA->RETURN_FIELD('area','SHIPPING_CHARGE','ID',$area_id);
	} else {
		$shipping_charge = 0.00;
	}
  ?>

			<tr>
			
				<td> <?php echo $ROW_DETAIL['INVOICE_ID']; ?> </td>
				<td> <?php echo $ROW_DETAIL['F_NAME']. " " . $ROW_DETAIL['L_NAME']; ?> </td>
				<td> <?php echo $ROW_DETAIL['AREA_NAME']; ?> </td>
				<td> <?php echo $ROW_DETAIL['CREATED_DATE']; ?> </td>
				<td>Rs <?php echo ((($ROW_DETAIL['TOTAL_AMOUNT'] - $ROW_DETAIL['DISCOUNT']) * 13/100) + ($ROW_DETAIL['TOTAL_AMOUNT'] - $ROW_DETAIL['DISCOUNT']) + $shipping_charge); ?> </td>
				<td> <?php if ($ROW_DETAIL['PAYMENT_STATUS']==0) { ?> <a href="#" data-toggle="modal" data-target="#clearpayment<?php echo $ROW_DETAIL['INVOICE_ID']; ?>" data-abc="true">Clear Payment</a> <br><?php } ?><?php if ($ROW_DETAIL['PAYMENT_STATUS']==1) { ; ?><span class="badge bg-success text-white fw-bold">Paid</span><?php } else if ($ROW_DETAIL['PAYMENT_STATUS']==0) { ?><span class="badge bg-danger text-white fw-bold">Unpaid</span><?php } ?> </td>
				<td> <?php echo $ROW_DETAIL['PAYMENT_METHOD']; ?> </td>
				<td>
				     <form action="invoice_details.php" method="POST" class="form">
				     <input type="submit" class="btn btn-primary bg-gradient-primary" value="View Invoice" class="submit_button" />
				     <input type="hidden" name="invoice_id" value="<?php echo $ROW_DETAIL['INVOICE_ID']; ?>"/>
				     </form>
				</td>
			</tr>

			
<!--Clear Payment Modal-->
  <div id="clearpayment<?php echo $ROW_DETAIL['INVOICE_ID']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Clear Payment</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>

  <div class="modal-body">
    <form role="form" method="post" action="clear_payment.php?id=<?php echo $ROW_DETAIL['INVOICE_ID']; ?>">
      <div class="modal-body">
		Are you sure you want to clear payment for Invoice: <b>#<?php echo $ROW_DETAIL['INVOICE_ID']; ?> ?</b>
      </div>    
      <hr>
      <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Clear</button>
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>  
    </form>  
  </div>
</div>

  </div>
</div>
<?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>


<?php
		include("../libraries/footer.php");
		ob_end_flush();
?>