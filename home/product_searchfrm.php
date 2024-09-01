<?php
error_reporting(0);
include'../libraries/sidebar.php';

?>

<?php

$pid = (isset($_GET['id']) ? $_GET['id'] : null);
if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){ ?>

            <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } ?>                        

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="product.php">Manage Products</a>
</li>
<li class="breadcrumb-item active">Product Details</li>
</ol>


          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Product's Detail</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
            <div class="card-body">

          <?php 
          
$DATA_BANK = $SCA->SCA_DATA('PRODUCT_SEARCHFRM', $pid);
foreach ($DATA_BANK AS $ROW_DETAIL){

                $productid= $ROW_DETAIL['PRODUCT_ID'];
                $productname= $ROW_DETAIL['PRODUCT_NAME'];
                $productcode= $ROW_DETAIL['PRODUCT_CODE'];
                $mfd_date= $ROW_DETAIL['MFD_DATE'];
                $exp_date= $ROW_DETAIL['EXP_DATE'];
                $description=$ROW_DETAIL['DESCRIPTION'];
                $productprice=$ROW_DETAIL['PRICE'];
                $category=$ROW_DETAIL['CATEGORY_NAME'];
                $unit=$ROW_DETAIL['UNIT_NAME'];
                $stockmanagement=$ROW_DETAIL['MANAGE_STOCK'];
                if ($stockmanagement=='Y') { $stockmanagement="Enabled"; } else if ($stockmanagement=='N') { $stockmanagement="Disabled"; }
                $on_stock=$ROW_DETAIL['ON_STOCK'];
                $designation=$ROW_DETAIL['TYPE'];
                $created_date=$ROW_DETAIL['CREATED_DATE'];
                $createdby=$ROW_DETAIL['F_NAME'] . "&nbsp;" . $ROW_DETAIL['L_NAME'];
              
            }
?>


                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Product Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $productname; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Product Code<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $productcode; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Manufactured Date<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $mfd_date; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Expiry Date<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $exp_date; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Product Price<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $productprice; ?> <br>
                        </h5>
                      </div>
                    </div>


                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Stock Management<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $stockmanagement; ?> <br>
                        </h5>
                      </div>
                    </div>

                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Description<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $description; ?><br>
                        </h5>
                      </div>
                    </div>


                  <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Category<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $category; ?><br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Unit<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $unit; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Quantity<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $on_stock; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Created Date<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $created_date; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Created By<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $createdby; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Creator's Designation<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $designation; ?> <br>
                        </h5>
                      </div>
                    </div>

          </div></center>

<?php
include'../libraries/footer.php';
?>