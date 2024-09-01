<?php 
error_reporting(0);
include'../libraries/sidebar.php';
$type_id = $_SESSION['TYPE'];

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
<li class="breadcrumb-item active"><?php if ($type_id == '3') { echo 'Products'; } else { echo 'Manage Products'; } ?></li>
</ol>
  
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Product(s)&nbsp;<?php if ($_SESSION['TYPE']!='3') { ?><a  href="#" data-toggle="modal" data-target="#productModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a><?php } ?></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Product Name</th>
                     <th>Price</th>
                     <th>Category</th>
                     <th>Mfd Date</th>
                     <th>Exp Date</th>
                     <th>Unit</th>
<?php if ($_SESSION['TYPE']!='3') { ?>
                     <th>Available Quantity</th>
                     <th>Action</th>
<?php } ?>
                   </tr>
               </thead>
          <tbody>

<?php                

$DATA_BANK = $SCA->SCA_DATA('PRODUCT_LIST');
foreach ($DATA_BANK AS $ROW_DETAIL){
                                 
                echo '<tr>';
                echo '<td><b>'. $ROW_DETAIL['PRODUCT_NAME'] . '</b><br>Code: ' . $ROW_DETAIL['PRODUCT_CODE'] . '</td>';
                echo '<td> Rs '. $ROW_DETAIL['PRICE'].'</td>';
                echo '<td>'. $ROW_DETAIL['CATEGORY_NAME'].'</td>';
                echo '<td>'. $ROW_DETAIL['MFD_DATE'].'</td>';
                echo '<td>'. $ROW_DETAIL['EXP_DATE'].'</td>';
                echo '<td>'. $ROW_DETAIL['UNIT_NAME'].'</td>';
if ($_SESSION['TYPE']!='3') {
                echo '<td>'. $ROW_DETAIL['ON_STOCK'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="product_searchfrm.php?action=edit & id='.$ROW_DETAIL['PRODUCT_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="product_edit.php?action=edit & id='.$ROW_DETAIL['PRODUCT_ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                  <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" data-toggle="modal" data-target="#product'.$ROW_DETAIL['PRODUCT_ID'].'" href="">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
}
                echo '</tr> ';


//Product Delete Modal    
echo '<div id="product'.$ROW_DETAIL['PRODUCT_ID'].'" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>

<div class="modal-body">
  <form role="form" method="post" action="product_delete.php?action=delete & id='.$ROW_DETAIL['PRODUCT_ID'].'">
    <div class="modal-body">
      <b>Are you sure you want to Delete Product: '.$ROW_DETAIL['PRODUCT_NAME'].' ?</b>
    </div>
    <hr>
    <button type="submit" class="btn btn-danger"><i class="fa fa-check fa-fw"></i>Delete</button>
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
  </form>  
</div>
</div>

</div>
</div>';


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

  <!-- Product Modal-->
  <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="product_transac.php?action=add">
              <input type="hidden" name="user" value="<?php echo $_SESSION['MEMBER_ID']; ?>" />
           <div class="form-group">
            <span>Product Name: </span>
             <input class="form-control" placeholder="Product Name" name="productname" required>
           </div>

           <div class="form-group">
            <span>Product Code: </span>
             <input class="form-control" placeholder="Product Code" name="productcode" required>
           </div>
           
           <div class="form-group">
            <span>Manufactured Date: </span>
             <input type="date" class="form-control" placeholder="Manufactured Date" name="manufactureddate" required>
           </div>
           
           <div class="form-group">
            <span>Expiry Date: </span>
             <input type="date" class="form-control" placeholder="Expiry Date" name="expirydate" required>
           </div>

           <div class="form-group">
            <span>Price: </span>
             <input type="number" min="1" max="9999999999" class="form-control" placeholder="Price" name="price" required>
           </div>

           <div class="form-group">
            <span>Stock Management: </span>
		<select class='form-control' name='stockmanagement' required>
        	<option disabled selected hidden>Stock Management</option>
        	<option value="Y">Enabled</option>
        	<option value="N">Disabled</option>
		</select>
           </div>

           <div class="form-group">
            <span>Select Category: </span>
                  <?php $TBID = "category"; include("../class/category_selection_box.php"); ?>
           </div>
           <div class="form-group">
            <span>Select Unit: </span>
                  <?php $TBID = "unit"; include("../class/unit_selection_box.php"); ?>
           </div>

           <div class="form-group">
            <span>Description: </span>
             <textarea rows="5" cols="50" texarea" class="form-control" placeholder="Description" name="description"></textarea>
           </div>

            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>