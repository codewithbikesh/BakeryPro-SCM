<?php
error_reporting(0);
include'../libraries/sidebar.php';
                   
if (($_SESSION['TYPE']=='2') OR ($_SESSION['TYPE']=='3') OR ($_GET['id']==0)){ ?>
 
  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php }      

$areaid = (isset($_GET['id']) ? $_GET['id'] : null);
$DATA_BANK = $SCA->SCA_DATA('AREA_EDIT', $areaid);
foreach ($DATA_BANK AS $ROW_DETAIL){

      $areacode= $ROW_DETAIL['AREA_CODE'];
      $areaname= $ROW_DETAIL['AREA_NAME'];
      $shipping_charge= $ROW_DETAIL['SHIPPING_CHARGE'];

  }
?>
           
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>&nbsp; / &nbsp;
<a href="area.php">Manage Area</a>
</li>
<li class="breadcrumb-item active">Update Area</li>
</ol>

          <center>
          <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Area</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="area.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="area_edit_post.php">
              <input type="hidden" name="id" value="<?php echo $areaid; ?>" />
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Area Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Area Name" name="areaname" value="<?php echo $areaname; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Area Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Area Code" name="areacode" value="<?php echo $areacode; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Shipping Charge:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Shipping Charge" name="shipping_charge" value="<?php echo $shipping_charge; ?>">
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