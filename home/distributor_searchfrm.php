<?php
error_reporting(0);
include'../libraries/sidebar.php';

?>

<?php
if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){ ?>

                <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                </script>
<?php }                         

$id = (isset($_GET['id']) ? $_GET['id'] : null);
$DATA_BANK = $SCA->SCA_DATA('DISTRIBUTOR_SEARCHFRM', $id);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $idd= $ROW_DETAIL['ID'];
      $firstname= $ROW_DETAIL['F_NAME'];
      $lastname=$ROW_DETAIL['L_NAME'];
      $gendercode=$ROW_DETAIL['GENDER_ID'];
      $gender=$ROW_DETAIL['GENDER_NAME'];
      $email=$ROW_DETAIL['EMAIL'];
      $phonenumber=$ROW_DETAIL['PHONE_NUMBER'];
      $createddate=$ROW_DETAIL['CREATED_DATE'];
      $address=$ROW_DETAIL['STREET_ADDRESS'];
    
  }
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="distributor.php">Manage Distributor</a>
</li>
<li class="breadcrumb-item active">Distributor Details</li>
</ol>

          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"><?php echo $firstname; ?>'s Detail</h4>
            </div>
            <a href="distributor.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Full Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $firstname; ?> <?php echo $lastname; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Email<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $email; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Gender<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $gender; ?> <br>
                        </h5>
                      </div>
                    </div>

                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Contact #<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $phonenumber; ?> <br>
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
                          Address<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $address; ?> <br>
                        </h5>
                      </div>
                    </div>
          </div>
          </div>

<?php
include'../libraries/footer.php';
?>