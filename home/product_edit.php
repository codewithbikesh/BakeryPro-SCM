<?php
error_reporting(0);
include'../libraries/sidebar.php';

$pid = (isset($_GET['id']) ? $_GET['id'] : null);

if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){
?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php }     

$DATA_BANK = $SCA->SCA_DATA('PRODUCT_EDIT', $pid);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $productid = $ROW_DETAIL['PRODUCT_ID'];
      $productname = $ROW_DETAIL['PRODUCT_NAME'];
      $productcode = $ROW_DETAIL['PRODUCT_CODE'];
      $mfd_date = $ROW_DETAIL['MFD_DATE'];
      $exp_date = $ROW_DETAIL['EXP_DATE'];
      $description = $ROW_DETAIL['DESCRIPTION'];
      $price = $ROW_DETAIL['PRICE'];
      $stockmanagement = $ROW_DETAIL['MANAGE_STOCK'];
      $categoryid = $ROW_DETAIL['CATEGORY_ID'];
      $unitid = $ROW_DETAIL['UNIT_ID'];

  }

?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="product.php">Manage Products</a>
</li>
<li class="breadcrumb-item active">Update Product</li>
</ol>


  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Product</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">

            <form role="form" method="post" action="product_edit_post.php">
              <input type="hidden" name="id" value="<?php echo $productid; ?>" />

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Name" name="productname" value="<?php echo $productname; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Code" name="productcode" value="<?php echo $productcode; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Manufactured Date:
                </div>
                <div class="col-sm-9">
                  <input type="date" class="form-control" placeholder="Manufactured Date" name="manufactureddate" value="<?php echo $mfd_date; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Expiry Date:
                </div>
                <div class="col-sm-9">
                  <input type="date" class="form-control" placeholder="Expiry Date" name="expirydate" value="<?php echo $exp_date; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Price:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Price" name="price" value="<?php echo $price; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Stock Management:
                </div>
                <div class="col-sm-9">
			<select class='form-control' name='stockmanagement' required>
        		<option disabled selected hidden>Select Stock Management</option>
        		<option value="Y" <?php if ($stockmanagement=='Y') { echo "selected"; } ?>>Enabled</option>
        		<option value="N" <?php if ($stockmanagement=='N') { echo "selected"; } ?>>Disabled</option>
			</select>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category:
                </div>
                <div class="col-sm-9">
                    <?php $TBID = "category"; include("../class/category_selection_box.php"); ?>
                </div>
              </div>
              
              <script>
	                document.getElementById('CATEGORY').value='<?php print $categoryid; ?>';
              </script>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Unit:
                </div>
                <div class="col-sm-9">
                    <?php $TBID = "unit"; include("../class/unit_selection_box.php"); ?>
                </div>
              </div>
              
              <script>
	                document.getElementById('UNIT').value='<?php print $unitid; ?>';
              </script>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Description:
                </div>
                <div class="col-sm-9">
                   <textarea class="form-control" rows="5" cols="50" placeholder="Description" name="description"><?php echo $description; ?></textarea>
                </div>
              </div>

              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../libraries/footer.php';
?>