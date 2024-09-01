<?php
error_reporting(0);
include'../libraries/sidebar.php';
                   
$retailer_id = $_SESSION['MEMBER_ID'];

if ($_SESSION['TYPE']=='3'){
?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php } ?>
        

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
<li class="breadcrumb-item active">Manage Orders</li>
</ol>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Orders&nbsp;</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
			<tr>
				<th> Order ID </th>
				<th> Retailer </th>
				<th> Order Date </th>
				<th> Approved Status </th>
				<th> Order Status </th>
				<th> Details </th>
<?php if ($_SESSION['TYPE']=='2') { ?>
				<th> Confirm </th>
				<th> Generate Invoice </th>
<?php } ?>
			</tr>
               </thead>
          <tbody>

<?php              

$DATA_BANK = $SCA->SCA_DATA('ORDER_LIST');
foreach ($DATA_BANK AS $ROW_DETAIL){

                if ($ROW_DETAIL['APPROVED']=='0') { $approved = 'Not Approved'; } else { $approved = 'Approved'; }
                if ($ROW_DETAIL['STATUS']=='0') { $status = '<div style="color:red;">Pending</div>'; } else if ($ROW_DETAIL['STATUS']=='1') { $status = '<div style="color:green;">Completed</div>'; } else { $status = '<div style="color:red;">Cancelled</div>';}
                echo '<tr>';
                echo '<td>'. $ROW_DETAIL['ORDER_ID'].'</td>';
                echo '<td>'. $ROW_DETAIL['F_NAME'] . " " . $ROW_DETAIL['L_NAME'].'</td>';
                echo '<td>'. $ROW_DETAIL['CREATED_DATE'].'</td>';
                echo '<td>'. $approved.'</td>';
                echo '<td>'. $status.'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="order_items.php?action=view & id='.$ROW_DETAIL['ORDER_ID'] . '"> View Items</a>
                          </div> </td>';
if ($_SESSION['TYPE']=='2') {
if (($ROW_DETAIL['APPROVED']==0) && ($ROW_DETAIL['STATUS']!='2')) { 
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="confirm_order.php?action=confirm & id='.$ROW_DETAIL['ORDER_ID'] . '"> Confirm</a>
                          </div> </td>';
} else {
echo '<td align="right"></td>';
}
 
if (($ROW_DETAIL['STATUS']==0) && ($ROW_DETAIL['APPROVED']>0)) {
                      echo '<td align="center"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="generate_invoice.php?action=invoice & id='.$ROW_DETAIL['ORDER_ID'] . '"> + Invoice</a>
                          </div> </td>';
} else {
                      echo '<td align="center"></td>';
}

}
                echo '</tr> ';

}

?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

<?php
include'../libraries/footer.php';
?>

