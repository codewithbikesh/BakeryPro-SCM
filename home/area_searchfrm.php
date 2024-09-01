<?php
error_reporting(0);
include'../libraries/sidebar.php';
?>
<?php 
                   
if (($_SESSION['TYPE']=='2') OR ($_GET['id']==0) OR ($_SESSION['TYPE']=='3')){ ?>

                <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                </script>
<?php   }
                        
$id = $_GET['id'];  

$DATA_BANK = $SCA->SCA_DATA('AREA_SEARCHFRM', $id);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $areacode= $ROW_DETAIL['AREA_CODE'];
      $areaname= $ROW_DETAIL['AREA_NAME'];
      $shipping_charge= $ROW_DETAIL['SHIPPING_CHARGE'];
      $createddate= $ROW_DETAIL['CREATED_DATE'];
      $createdby= $ROW_DETAIL['CREATED_BY'];
    
  }

  $DATA_BANK = $SCA->SCA_DATA('AREA_CREATOR', $createdby);
  foreach ($DATA_BANK AS $ROW_CREATOR){

				$creatorfirstname = $ROW_CREATOR['F_NAME'];
				$creatorlastname = $ROW_CREATOR['L_NAME'];
				$creatordesignation = $ROW_CREATOR['TYPE'];
			
    }
?>
            
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="area.php">Manage Area</a>
</li>
<li class="breadcrumb-item active">Area Details</li>
</ol>

            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Area Detail</h4>
            </div>
            <a href="area.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Area Name<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $areaname; ?> <br>
                        </h5>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Area Code<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $areacode; ?> <br>
                        </h5>
                      </div>
                      
                    </div>
                    
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Shipping Charge<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $shipping_charge; ?> <br>
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
                          : <?php echo $createddate; ?> <br>
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
                          : <?php echo $creatorfirstname . "&nbsp;" . $creatorlastname; ?> <br>
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
                          : <?php echo $creatordesignation; ?> <br>
                        </h5>
                      </div>
                      
                    </div>

            </div>
          </div>

<?php
include'../libraries/footer.php';
?>