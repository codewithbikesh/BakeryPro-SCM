<?php

include'../libraries/sidebar.php';

?>

<?php 

if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){ ?>

                <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                </script>
<?php   }                         

$id = $_GET['id'];

$DATA_BANK = $SCA->SCA_DATA('UNIT_SEARCHFRM', $id);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $unitcode= $ROW_DETAIL['UNIT_ID'];
      $unitname= $ROW_DETAIL['UNIT_NAME'];
      $unitdescription= $ROW_DETAIL['UNIT_DESCRIPTION'];
      $createddate= $ROW_DETAIL['CREATED_DATE'];
      $createdby= $ROW_DETAIL['CREATED_BY'];

  }

  $DATA_BANK = $SCA->SCA_DATA('UNIT_CREATOR', $createdby);
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
<a href="unit.php">Manage Unit</a>
</li>
<li class="breadcrumb-item active">Unit Details</li>
</ol>


            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Unit Detail</h4>
            </div>
            <a href="unit.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Unit Name<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $unitname; ?> <br>
                        </h5>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Unit Description<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $unitdescription; ?> <br>
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