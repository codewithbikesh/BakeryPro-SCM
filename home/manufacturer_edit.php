<?php
error_reporting(0);
include'../libraries/sidebar.php';

if (($_SESSION['TYPE']=='2') OR ($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){ ?>

  <script type="text/javascript">
      //then it will be redirected
      window.location = "index.php";
  </script>

<?php }      

$id = (isset($_GET['id']) ? $_GET['id'] : null);
$DATA_BANK = $SCA->SCA_DATA('MANUFACTURER_EDIT', $id);
foreach ($DATA_BANK AS $ROW_DETAIL){

      		$idd= $ROW_DETAIL['ID'];
      		$firstname= $ROW_DETAIL['F_NAME'];
      		$lastname=$ROW_DETAIL['L_NAME'];
      		$username=$ROW_DETAIL['USERNAME'];
      		$email=$ROW_DETAIL['EMAIL'];
      		$phonenumber=$ROW_DETAIL['PHONE_NUMBER'];
      		$createddate=$ROW_DETAIL['CREATED_DATE'];

        }
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="manufacturer.php">Manage Manufacturer</a>
</li>
<li class="breadcrumb-item active">Update Manufacturer</li>
</ol>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Manufacturer Account</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="manufacturer.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
      

            <form role="form" method="post" action="manufacturer_edit_post.php">
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
                 Username:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
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
                 Contact #:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder="Contact #" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
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