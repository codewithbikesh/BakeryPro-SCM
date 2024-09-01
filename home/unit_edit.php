<?php

include'../libraries/sidebar.php';

if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){
?>

  <script type="text/javascript">
      //then it will be redirected
      window.location = "index.php";
  </script>

<?php }     

  $id = $_GET['id'];

  $DATA_BANK = $SCA->SCA_DATA('UNIT_EDIT', $id);
  foreach ($DATA_BANK AS $ROW_DETAIL){

      $unitdescription= $ROW_DETAIL['UNIT_DESCRIPTION'];
      $unitname= $ROW_DETAIL['UNIT_NAME'];

  }
?>
            
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="unit.php">Manage Unit</a>
</li>
<li class="breadcrumb-item active">Update Unit</li>
</ol>


            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Unit</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="unit.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="unit_edit_post.php">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Unit Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Unit Name" name="unitname" value="<?php echo $unitname; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Unit Description:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Unit Description" name="unitdescription" value="<?php echo $unitdescription; ?>" >
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../libraries/footer.php';
?>