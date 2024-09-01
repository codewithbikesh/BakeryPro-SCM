<?php
error_reporting(0);
include'../libraries/sidebar.php';

if ($_SESSION['TYPE']=='3'){
?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php } ?>
       
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
     
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Manage Retailer</li>
</ol>

        <!-- ADMIN TABLE -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Retailer(s)&nbsp;<a  href="#" data-toggle="modal" data-target="#retailerModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
            <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Name</th>
                       <th>Username</th>
                       <th>Area Code</th>
                       <th>Email</th>
                       <th>Phone</th>
                       <th>Street Address</th>
                       <th>Verification</th>
                       <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                 

$DATA_BANK = $SCA->SCA_DATA('RETAILER_LIST');
foreach ($DATA_BANK AS $ROW_DETAIL){
                                 
                echo '<tr>';
                echo '<td>'. $ROW_DETAIL['F_NAME'].' '. $ROW_DETAIL['L_NAME'].'</td>';
                echo '<td>'. $ROW_DETAIL['USERNAME'].'</td>';
                echo '<td>'. $ROW_DETAIL['AREA_CODE'].'</td>';
                echo '<td>'. $ROW_DETAIL['EMAIL'].'</td>';
                echo '<td>'. $ROW_DETAIL['PHONE_NUMBER'].'</td>';
                echo '<td>'. $ROW_DETAIL['STREET_ADDRESS'].'</td>';
                if ($ROW_DETAIL['VERIFIED'] == 1) { echo '<td>'. Verified .'</td>'; } else { echo '<td>'. Unverified. ' <br><a href="verify_retailer.php?id='.$ROW_DETAIL['ID'] . ' & email='.$ROW_DETAIL['EMAIL'] . '"> Verify Now </a></td>'; }
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="retailer_searchfrm.php?action=view & id='.$ROW_DETAIL['ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="retailer_edit.php?action=edit & id='.$ROW_DETAIL['ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                  <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" data-toggle="modal" data-target="#retailer'.$ROW_DETAIL['ID'].'" href="">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                                
                                </li>
                            </ul>
                            </div>
                          </div></td>';
                echo '</tr> ';

//Retailer Delete Modal    
echo '<div id="retailer'.$ROW_DETAIL['ID'].'" class="modal fade" role="dialog">
<div class="modal-dialog">

<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Delete Retailer</h5>
  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>

<div class="modal-body">
  <form role="form" method="post" action="retailer_delete.php?action=delete & id='.$ROW_DETAIL['ID']. '">
    <div class="modal-body">
      <b>Are you sure you want to Delete Retailer: '.$ROW_DETAIL['F_NAME'].' '.$ROW_DETAIL['L_NAME'].' ?</b>
    </div>
    <hr>
    <button type="submit" class="btn btn-danger"><i class="fa fa-check fa-fw"></i>Delete</button>
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
  </form>  
</div>
</div>

</div>
</div>';

      }

?>         
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>



<?php
include'../libraries/footer.php';
?>

  <!-- User Account Modal-->
  <div class="modal fade" id="retailerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Retailer Account</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="retailer_transac.php?action=add">
              
                            <div class="form-group">
                              <span>First Name: </span>
                              <input class="form-control" placeholder="First Name" name="firstname" required>
                            </div>

                            <div class="form-group">
                              <span>Last Name: </span>
                              <input class="form-control" placeholder="Last Name" name="lastname" required>
                            </div>

                	          <div class="form-group">
                              <span>Select Area: </span>
                              <?php $TBID = "area"; include("../class/area_selection_box.php"); ?>
                	          </div>

                            <div class="form-group">
                              <span>Username: </span>
                              <input class="form-control" placeholder="User Name" name="username" required>
                            </div>

                            <div class="form-group">
                              <span>Password: </span>
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>

                            <div class="form-group">
                              <span>Email: </span>
                              <input class="form-control" placeholder="Email" name="email" required>
                            </div>

                            <div class="form-group">
                              <span>Phone Number: </span>
                              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
                            </div>

                	          <div class="form-group">
                              <span>Select Country: </span>
                              <?php $TBID = "tbl_countries"; include("../class/country_selection_box.php"); ?>
                	          </div>

                            <div class="form-group">
                              <span>Street Address: </span>
			                        <input id="street_address" name="street_address" placeholder="Street Address" class="form-control" required/>
                            </div>

                            <div class="form-group">
                              <span>State: </span>
			                        <input id="state" name="state" placeholder="State" class="form-control" required/>
                            </div>
                            
                            <div class="form-group">
                              <span>Post Code: </span>
			                        <input id="postcode" name="postcode" placeholder="Postcode" class="form-control" required/>
                            </div>
                            
                            <div class="form-group">
                              <span>Company Name: </span>
			                        <input id="company_name" name="company_name" placeholder="Company Name" class="form-control" required/>
                            </div>
                            
                            <div class="form-group">
                              <span>VAT Number: </span>
			                        <input id="vat_number" name="vat_number" placeholder="VAT Number" class="form-control" required/>
                            </div>

            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>