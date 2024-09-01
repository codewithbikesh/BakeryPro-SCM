<?php
error_reporting(0);
include'../libraries/sidebar.php';

if (($_SESSION['TYPE']=='1') || ($_SESSION['TYPE']=='2')) { ?>
  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php } ?>

<style>

.quantity {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
}

</style>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">New Order</li>
</ol>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Order Items</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
		<form action="retailer_order_post.php" method="POST" class="form">
		<table class="table table-bordered" width="100%" cellspacing="0">
               <thead>

			<tr>
				<th> Product Name </th>
				<th> Price </th>
				<th> Available </th>
				<th> Quantity </th>
				<th> Price </th>
			</tr>
               </thead>

			   <?php 
						$DATA_BANK = $SCA->SCA_DATA('CATEGORY_LIST');
						foreach ($DATA_BANK AS $ROW_DETAIL){
							$CATEGORY_ID 	= $ROW_DETAIL['CATEGORY_ID'];
						  	$CATEGORY_NAME	= $ROW_DETAIL['CATEGORY_NAME']; 
				?>
						
					<tr>
						<td>
					<span style="color:black; text-decoration:none"><b><?php print $CATEGORY_NAME; ?></b></span>

<?php
$DATA_BANK = $SCA->SCA_DATA('PRODUCTS_FOR_ORDER', $CATEGORY_ID);
foreach ($DATA_BANK AS $ROW_DETAIL){
       $i=1;
	   ?>
			<tr>
				<td><?php echo $ROW_DETAIL['PRODUCT_NAME']; ?><br><span style="font-size:12px;">Code: <?php echo $ROW_DETAIL['PRODUCT_CODE']; ?></span></td>
				<td>Rs <?php echo $ROW_DETAIL['PRICE']; ?></td>
				<td><?php echo $ROW_DETAIL['ON_STOCK']; ?><input type="hidden" id="onstock" value="<?php echo $ROW_DETAIL['ON_STOCK']; ?>" name="<?php echo $ROW_DETAIL['ON_STOCK']; ?>" size="10" /></td>
				<td><input type="number" class="quantity" id="<?php echo $ROW_DETAIL['PRODUCT_ID']; ?>" name="<?php echo "txtQuantity".$ROW_DETAIL['PRODUCT_ID']; ?>" min="0" max="<?php echo $ROW_DETAIL['ON_STOCK']; ?>" /></td>
				<td> <div id="<?php echo "totalPrice".$ROW_DETAIL['PRODUCT_ID']; ?>"></div> </td>
			</tr>


			<script>
        $(function() {
            $("input[name='<?php echo "txtQuantity".$ROW_DETAIL['PRODUCT_ID']; ?>']").on('input', function(e) {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    </script>


<script type="text/javascript">
    $(function () {
        $("#<?php echo $ROW_DETAIL['PRODUCT_ID']; ?>").keyup(function () {
            //Reference the Button.
            var btnSubmit = $("#btnSubmit");

            //Verify the TextBox value.
            if ($(this).val().trim() != "") {
                //Enable the TextBox when TextBox has value.
                btnSubmit.removeAttr("disabled");
            } else {
                //Disable the TextBox when TextBox is empty.
                btnSubmit.attr("disabled", "disabled");
            }
        });
    });
</script>

			<?php $i++; } ?>

</td>
</tr>
<?php } ?>
			<tr>
				<td colspan="4" style="text-align:right;"> Total Price: </td>
				<td> <input type="text" class="form-control" size="10" id="txtFinalAmount" name="total_price" readonly="readonly" value="" />&nbsp;<span style="color:red;">13% VAT will be<br> added in Invoice.</span> </td>
			</tr>

</table>

			<input id="btnSubmit" type="submit" value="Post Order" class="btn btn-primary bg-gradient-primary" style="float:right;" disabled="disabled" />

		</form>
		</div>
		</div>
		</div>


	<script type="text/javascript" src="../libraries/jquery.js"> </script>
	<script type="text/javascript" src="retailer_new_order.js"> </script>

<?php
include'../libraries/footer.php';
?>
