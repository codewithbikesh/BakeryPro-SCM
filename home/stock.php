<?php
error_reporting(0);
include'../class/connection.php';
include'../libraries/sidebar.php';

if (($_SESSION['TYPE']=='1') || ($_SESSION['TYPE']=='3')) { ?>

  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php }

			if($_SERVER['REQUEST_METHOD'] == "POST") {
				if(isset($_POST['txtQuantity'])){
					$arrayQuantity = $_POST['txtQuantity'];

					foreach($arrayQuantity as $key => $value) {
						$queryUpdateStock = "UPDATE product SET ON_STOCK='$value' WHERE PRODUCT_ID='$key'";
						$result = mysqli_query($db,$queryUpdateStock);
					}
					if (!$result) {
						$_SESSION['error'] = 'Updating Product Failed.';
					}
					else {
						$_SESSION['success'] = 'Stock Updated Successfully.';
					}

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
	
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Manage Stock</li>
</ol>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Manage Stock</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
		<form action="" method="POST" class="form">
		<table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
			<tr>
				<th> Product ID </th>
				<th> Product Name </th>
				<th> Unit </th>
				<th> Quantity </th>
			</tr>
               </thead>

<?php
	$query = 'SELECT p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_CODE, p.PRICE, p.ON_STOCK, c.CATEGORY_NAME, u.UNIT_ID, u.UNIT_NAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID join unit u on p.UNIT_ID=u.UNIT_ID WHERE MANAGE_STOCK="Y" GROUP BY PRODUCT_ID';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) { ?>
			<tr>
				<td><?php echo $row['PRODUCT_ID']; ?></td>
				<td><?php echo $row['PRODUCT_NAME']; ?><br><span style="font-size:12px;">Code: <?php echo $row['PRODUCT_CODE']; ?></span></td>
				<td><?php echo $row['UNIT_NAME']; ?></td>
				<td><input type="text" class="form-control" name="txtQuantity[<?php echo $row['PRODUCT_ID']; ?>]" value="<?php echo $row['ON_STOCK']; ?>" size="10"/></td>
			</tr>
			<?php } ?>
		</table>
			<input id="btnSubmit" type="submit" value="Update Stock" class="btn btn-primary bg-gradient-primary" style="float:right;" />

		</form>
		</div>
		</div>
		</div>



<?php
include'../libraries/footer.php';
?>
