<?php
error_reporting(0);
include'../libraries/sidebar.php';

if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){

?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php }      
   
$id = $_GET['id'];
$DATA_BANK = $SCA->SCA_DATA('DISTRIBUTOR_EDIT', $id);
foreach ($DATA_BANK AS $ROW_DETAIL){

      		$idd= $ROW_DETAIL['ID'];
      		$firstname= $ROW_DETAIL['F_NAME'];
      		$lastname=$ROW_DETAIL['L_NAME'];
      		$gender=$ROW_DETAIL['GENDER_ID'];
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
<li class="breadcrumb-item active">Update Distributor</li>
</ol>


  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Distributor Account</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="distributor.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
      

            <form role="form" method="post" action="distributor_edit_post.php">
              <input type="hidden" name="id" value="<?php echo $idd; ?>" />

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 First Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="First Name" name="firstname" value="<?php echo $firstname; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Last Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Email:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Gender:
                </div>
                <div class="col-sm-9">
                  <?php $TBID = "gender_code"; include("../class/gender_selection_box.php"); ?>
                </div>
              </div>
              
              <script>
	                document.getElementById('GENDER_CODE').value='<?php print $gender; ?>';
              </script>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Contact #:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Contact #" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Address:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
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