<?php

include'../libraries/sidebar.php';
                   
$retailer_id = $_SESSION['MEMBER_ID'];

if (($_SESSION['TYPE']=='2') OR ($_SESSION['TYPE']=='1')){ ?>

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
<li class="breadcrumb-item active">My Orders</li>
</ol>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">My Orders&nbsp;</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
			<tr>
				<th> Order ID </th>
				<th> Order Date </th>
				<th> Approved Status </th>
				<th> Order Status </th>
				<th> Details </th>
			</tr>
               </thead>
          <tbody>

<?php                

$DATA_BANK = $SCA->SCA_DATA('RETAILER_VIEW_ORDERS', $retailer_id);
foreach ($DATA_BANK AS $ROW_DETAIL){

                if ($ROW_DETAIL['APPROVED']=='0') { $approved = 'Not Approved'; } else { $approved = 'Approved'; }
                if ($ROW_DETAIL['STATUS']=='0') { $status = '<div style="color:red;">Pending</div>'; } else if (($ROW_DETAIL['STATUS']=='1')) { $status = '<div style="color:green;">Completed</div>'; } else { $status = '<div style="color:red;">Cancelled</div>'; }
                echo '<tr>';
                echo '<td>'. $ROW_DETAIL['ORDER_ID'].'</td>';
                echo '<td>'. $ROW_DETAIL['CREATED_DATE'].'</td>';
                echo '<td>'. $approved.'</td>';
                if (($ROW_DETAIL['APPROVED']==0) AND ($ROW_DETAIL['STATUS'] != 2)) {
                echo '<td>'. $status.'<a type="button" href="cancel_order.php?action=view & id='.$ROW_DETAIL['ORDER_ID'] . '"> Cancel Order</a></td>';
                } else {
                  echo '<td>'. $status.'</td>';
                }
                      echo '<td align="center"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="retailer_view_order_items.php?action=view & id='.$ROW_DETAIL['ORDER_ID'] . '"> View Items</a>
                          </div> </td>';
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

