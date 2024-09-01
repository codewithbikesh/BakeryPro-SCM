<?php
error_reporting(0);
include'../libraries/sidebar.php';

$MANUFACTURER_COUNT = $SCA->SCA_INFO('MANUFACTURER_COUNT', 2);
$RETAILER_COUNT = $SCA->SCA_INFO('RETAILER_COUNT', 3);
$AREA_COUNT = $SCA->SCA_INFO('AREA_COUNT');
$DISTRIBUTOR_COUNT = $SCA->SCA_INFO('DISTRIBUTOR_COUNT', 4);
$UNIT_COUNT = $SCA->SCA_INFO('UNIT_COUNT');
$PRODUCT_COUNT = $SCA->SCA_INFO('PRODUCT_COUNT');
$CATEGORY_COUNT = $SCA->SCA_INFO('CATEGORY_COUNT');

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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Move', 'Percentage'],
          ["King's pawn (e4)", 44],
          ["Queen's pawn (d4)", 31],
          ["Knight to King 3 (Nf3)", 12],
          ["Queen's bishop pawn (c4)", 10],
          ['Other', 3]
        ]);

        var options = {
          width: 400,
          legend: { position: 'none' },
          chart: {
            title: 'Chess opening moves',
            subtitle: 'popularity by percentage' },
          axes: {
            x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>





<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">My Dashboard</li>
</ol>

          <div class="row show-grid">
            
            <!-- Manufacturer ROW -->
            <div class="col-md-3">
<?php if ($_SESSION['TYPE']!="2") { ?>
            <!-- Manufacturer record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Manufacturer</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php print $MANUFACTURER_COUNT; ?> Record(s)
                      </div>
                    </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>
<?php } ?>

<?php if ($_SESSION['TYPE']!="3") { ?>
            <!-- Retailer record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Retailer</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php print $RETAILER_COUNT; ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php } ?>

<?php if ($_SESSION['TYPE']!="3") { ?>
            <!-- Area record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Area</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php print $AREA_COUNT; ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php } ?>


          </div>
          

            <!-- Distributor ROW -->
          <div class="col-md-3">
            <!-- Distributor record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Distributor</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php print $DISTRIBUTOR_COUNT; ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php if ($_SESSION['TYPE']!="3") { ?>
            <!-- Unit record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Unit</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800">
                        <?php print $UNIT_COUNT; ?> Record(s)
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-coins fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<?php } ?>

          </div>
          <!-- PRODUCTS ROW -->
          <div class="col-md-3">
            <!-- Product record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Product</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php print $PRODUCT_COUNT; ?> Record(s)
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>

                  </div>
                </div>
              </div>
            </div>

<?php if ($_SESSION['TYPE']!="3") { ?>
            <!-- Category record -->
            <div class="col-md-12 mb-3">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col mr-0">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Category</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php print $CATEGORY_COUNT; ?> Record(s)
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                    </div>

                  </div>
                </div>
              </div>
            </div>
<?php } ?>


            </div>


<?php if ($_SESSION['TYPE']!="2") { ?>
          <!-- RECENT PRODUCTS -->
                <div class="col-lg-3">
                    <div class="card shadow h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Recent Products
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="list-group">
                              <?php 

                                $DATA_BANK = $SCA->SCA_DATA('RECENT_PRODUCTS_LIST');
                                foreach ($DATA_BANK AS $ROW_DETAIL){

                                    echo "<a href='product_searchfrm.php?action=edit & id=".$ROW_DETAIL['PRODUCT_ID']."' class='list-group-item text-gray-800'>
                                          <i class='fa fa-tasks fa-fw'></i> ".$ROW_DETAIL['PRODUCT_NAME']."
                                          </a>";
                                  }
                              ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="product.php" class="btn btn-default btn-block">View All Products</a>
                        </div>
                        <!-- /.panel-body -->
                    </div></div></div></div></div></div>
		</div>
          </div>
<?php } ?>

<?php if ($_SESSION['TYPE']=="2") { ?>
          <!-- RECENT PRODUCTS -->
                <div class="col-lg-3">
                    <div class="card shadow h-100">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">

                          <div class="col-auto">
                            <i class="fa fa-th-list fa-fw"></i> 
                          </div>

                        <div class="panel-heading"> Recent Orders
                        </div>
                        <div class="row no-gutters align-items-center mt-1">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-0 text-gray-800">
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="list-group">

                              <?php 
                              
                              $DATA_BANK = $SCA->SCA_DATA('RECENT_ORDERS_LIST');
                              foreach ($DATA_BANK AS $ROW_DETAIL){
                                
						                        if ($ROW_DETAIL['STATUS']==0) { $status = "<div style='color:red;'>Pending</div>"; } else { $status = "<div style='color:green;'>Completed</div>"; } 
                                    echo "<a href='order_items.php?action=view & id=".$ROW_DETAIL['ORDER_ID']."' class='list-group-item text-gray-800'>
                                          <i class='fa fa-cart-arrow-down'></i>&nbsp; $ROW_DETAIL[F_NAME] $ROW_DETAIL[L_NAME] - $status
                                          </a>";
                                  
                                }
                              ?>


                            </div>
                            <!-- /.list-group -->
                            <a href="order.php" class="btn btn-default btn-block">View All Orders</a>
                        </div>
                        <!-- /.panel-body -->
                    </div></div></div></div></div></div>
                    
		</div>
          </div>
<?php } ?>

<?php
include'../libraries/footer.php';
?>