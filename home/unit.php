<?php

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
<li class="breadcrumb-item active">Manage Unit</li>
</ol>


            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Unit&nbsp;<a  href="#" data-toggle="modal" data-target="#unitModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Unit Name</th>
                     <th>Unit Description</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  

$DATA_BANK = $SCA->SCA_DATA('UNIT_LIST');
foreach ($DATA_BANK AS $ROW_DETAIL){
                                 
                echo '<tr>';
                echo '<td>'. $ROW_DETAIL['UNIT_NAME'].'</td>';
                echo '<td>'. $ROW_DETAIL['UNIT_DESCRIPTION'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="unit_searchfrm.php?action=view & id='.$ROW_DETAIL['UNIT_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="unit_edit.php?action=edit & id='.$ROW_DETAIL['UNIT_ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                  <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" data-toggle="modal" data-target="#unit'.$ROW_DETAIL['UNIT_ID'].'" href="">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
                echo '</tr> ';

              
//Unit Delete Modal    
  echo '<div id="unit'.$ROW_DETAIL['UNIT_ID'].'" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>

  <div class="modal-body">
    <form role="form" method="post" action="unit_delete.php?action=delete & id='.$ROW_DETAIL['UNIT_ID'].'">
      <div class="modal-body">
        <b>Are you sure you want to Delete Unit: '.$ROW_DETAIL['UNIT_NAME'].' - '.$ROW_DETAIL['UNIT_DESCRIPTION'].' ?</b>
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

  <!-- Product Modal-->
  <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form role="form" method="post" action="unit_transac.php?action=add">
              <input type="hidden" name="user" value="<?php echo $_SESSION['MEMBER_ID']; ?>" />
           <div class="form-group">
             <input class="form-control" placeholder="Unit Name" name="unitname" required>
           </div>
 
           <div class="form-group">
             <input class="form-control" placeholder="Unit Description" name="unitdescription">
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