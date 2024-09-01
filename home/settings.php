<?php
error_reporting(0);
include'../libraries/sidebar.php';
?>

<?php

$MEMBER_ID = $_SESSION['MEMBER_ID'];
$DATA_BANK = $SCA->SCA_DATA('PROFILE_DATA', $MEMBER_ID);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $idd= $ROW_DETAIL['ID'];
      $firstname= $ROW_DETAIL['F_NAME'];
      $lastname=$ROW_DETAIL['L_NAME'];
      $gender=$ROW_DETAIL['GENDER_ID'];
      $username=$ROW_DETAIL['USERNAME'];
      $password=$ROW_DETAIL['PASSWORD'];
      $email=$ROW_DETAIL['EMAIL'];
      $phonenumber=$ROW_DETAIL['PHONE_NUMBER'];
      $createddate=$ROW_DETAIL['CREATED_DATE'];
      $address=$ROW_DETAIL['STREET_ADDRESS'];
      $typeid=$ROW_DETAIL['TYPE_ID'];
      $type=$ROW_DETAIL['TYPE'];
      $photo=$ROW_DETAIL['IMAGE_PATH'];
      $countryid=$ROW_DETAIL['COUNTRY_ID'];
      $state=$ROW_DETAIL['STATE'];
      $postcode=$ROW_DETAIL['POSTCODE'];
      $company_name=$ROW_DETAIL['COMPANY_NAME'];
      $vat_number=$ROW_DETAIL['VAT_NUMBER'];
      $tsv= $ROW_DETAIL['TSV'];

		  if (strlen($photo)==0) { 
			$my_photo_path = "../images/default.png";
		  } else { 
			$my_photo_path = "../images/" . $type . "/" . $photo;
		  }	

}

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

<style>
label{
  display: inline-block;
  background-color: indigo;
  color: white;
  padding: 0.5rem;
  font-family: sans-serif;
  border-radius: 0.3rem;
  cursor: pointer;
  margin-top: 0rem;
}
</style>


<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">My Account</li>
</ol>

	<center>
        <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Account Info</h4>
            </div>
      

            <form role="form" method="post" action="settings_edit.php" enctype="multipart/form-data">
            <div class="card-body">
              <input type="hidden" name="id" value="<?php echo $idd; ?>" />
              <input type="hidden" name="type" value="<?php echo $type; ?>" />

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

<?php if ($_SESSION['TYPE']!='2') { ?>
<?php if ($_SESSION['TYPE']!='3') { ?>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Gender:
                </div>
                <div class="col-sm-9"><?php $TBID = "gender_code"; include("../class/gender_selection_box.php"); ?>
                </div>
              </div>

              <script>
	                document.getElementById('GENDER_CODE').value='<?php print $gender; ?>';
              </script>
<?php } ?>
<?php } ?>

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
                  <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Contact #:
                </div>
                <div class="col-sm-9">
                   <input type="tel" class="form-control" placeholder="Contact #" name="phone" value="<?php echo $phonenumber; ?>" required>
                </div>
              </div>


<?php if ($_SESSION['TYPE']=='1') { ?>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Address:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Address" name="street_address" value="<?php echo $address; ?>" required>
                </div>
              </div>
<?php } ?>

<?php if ($_SESSION['TYPE']=='3') { ?>
  
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Country:
                </div>
                <div class="col-sm-9">
                            <?php $TBID = "tbl_countries"; include("../class/country_selection_box.php"); ?>
                </div>
              </div>
              <script>
	                document.getElementById('TBL_COUNTRIES').value='<?php print $countryid; ?>';
              </script>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Street Address:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Street Address" name="street_address" value="<?php echo $address; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 State:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="State" name="state" value="<?php echo $state; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Postcode:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Postcode" name="postcode" value="<?php echo $postcode; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Company Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Company Name" name="company_name" value="<?php echo $company_name; ?>">
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 VAT Number:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="VAT Number" name="vat_number" value="<?php echo $vat_number; ?>">
                </div>
              </div>

<?php } ?>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Created Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Created Date" name="createddate" value="<?php echo $createddate; ?>" required readonly>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Account Type:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Account Type" name="type" value="<?php echo $type; ?>" readonly>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Two Step Verification:
                </div>
                <div class="col-sm-9">
                    <select name="tsv" class="form-control" required>
                    <option VALUE="Y" <?php if($tsv == 'Y') {echo "selected";} ?>>ON</option>
                    <option VALUE="N" <?php if($tsv == 'N') {echo "selected";} ?>>OFF</option>
                    <select>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Upload Photo:
                </div>
                <div class="col-sm-9">
			<input type="file" id="upload" name="photo" accept="image/png, image/gif, image/jpeg" onChange="img_pathUrl(this);" hidden/>
			<label for="upload">Upload Photo</label>
<?php if (strlen($my_photo_path)>0) { ?>
        		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myprofile" style="color:blue"><img src="<?php print $my_photo_path.'?rand='.rand(1,2000); ?>" id="profilephoto" width="100px" style="border:solid 3px #143049;border-radius:5px;"></button>
<?php } else { ?>
        		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myprofile" style="color:blue"><img src="<?php print $my_photo_path; ?>" id="profilephoto" width="100px"></button>
<?php } ?>
  			<script>
				function img_pathUrl(input){
	   			var OBJ = '#profilephoto';	
	   			$(OBJ)[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
				}
			</script>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-primary bg-gradient-primary"><i class="fa fa-edit fa-fw"></i>Update Info</button> 

            </div>   
              </form>  
          </div> 
       


<?php
include'../libraries/footer.php';
?>


			<div class="modal fade" id="myprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">

					<table width="100%">
					<tr>
					<td><h5 class="modal-title" id="exampleModalLongTitle"><b>Profile Picture </b></h5></td>
					<td><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>
					</tr>
					</table>

			      </div>
			      <div class="modal-body">
			      <img src="<?php print $my_photo_path.'?rand='.rand(1,2000); ?>" width="100%">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>