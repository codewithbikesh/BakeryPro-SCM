<?php
include'../libraries/sidebar.php';
?>

<?php 

if (($_SESSION['TYPE']=='3') || ($_GET['id']==0)){ ?>

                <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
                </script>

<?php }                         

$retailerid = (isset($_GET['id']) ? $_GET['id'] : null);
$DATA_BANK = $SCA->SCA_DATA('RETAILER_SEARCHFRM', $retailerid);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $idd= $ROW_DETAIL['ID'];
      $firstname= $ROW_DETAIL['F_NAME'];
      $lastname=$ROW_DETAIL['L_NAME'];
      $areacode=$ROW_DETAIL['AREA_CODE'];
      $areaname=$ROW_DETAIL['AREA_NAME'];
      $username=$ROW_DETAIL['USERNAME'];
      $password=$ROW_DETAIL['PASSWORD'];
      $email=$ROW_DETAIL['EMAIL'];
      $phonenumber=$ROW_DETAIL['PHONE_NUMBER'];
      $createddate=$ROW_DETAIL['CREATED_DATE'];
      $street_address=$ROW_DETAIL['STREET_ADDRESS'];
      $state=$ROW_DETAIL['STATE'];
      $postcode=$ROW_DETAIL['POSTCODE'];
      $countryid=$ROW_DETAIL['COUNTRY_ID'];
      $country_name = $SCA->RETURN_FIELD('tbl_countries', 'COUNTRY_NAME', 'ID', $countryid);
      $company_name=$ROW_DETAIL['COMPANY_NAME'];
      $vat_number=$ROW_DETAIL['VAT_NUMBER'];
      $terms=$ROW_DETAIL['TERMS'];
      if ($terms == 'Y') {
        $terms = 'Yes';
      } else {
        $terms = 'No';
      }
    
  }
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="retailer.php">Manage Retailer</a>
</li>
<li class="breadcrumb-item active">Retailer Details</li>
</ol>

          <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"><?php echo $firstname; ?>'s Detail</h4>
            </div>
            <a href="retailer.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
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
                          Username<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $username; ?> <br>
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
                          Country<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $country_name; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Street Address<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $street_address; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          State<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $state; ?> <br>
                        </h5>
                      </div>
                    </div>
                    
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Postcode<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $postcode; ?> <br>
                        </h5>
                      </div>
                    </div>

          <?php if (strlen($company_name)>0) { ?>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Company Name<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $company_name; ?> <br>
                        </h5>
                      </div>
                    </div>
          <?php } ?>
          <?php if (strlen($vat_number)>0) { ?>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          VAT Number<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $vat_number; ?> <br>
                        </h5>
                      </div>
                    </div>
          <?php } ?>
                    <div class="form-group row text-left">
                      <div class="col-sm-3 text-primary">
                        <h5>
                          Terms Accepted<br>
                        </h5>
                      </div>
                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $terms; ?> <br>
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
          </div>
          </div>

<?php
include'../libraries/footer.php';
?>