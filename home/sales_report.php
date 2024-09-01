<?php
error_reporting(0);
include'../libraries/sidebar.php';

if ($_SESSION['TYPE']=='3') { ?>
  <script type="text/javascript">
    //then it will be redirected
    window.location = "index.php";
  </script>

<?php 
}

$TODAY_DATE = date('Y-m-d');

$FROM_DATE = (isset($_POST['from_date']) ? $_POST['from_date'] : null);
$TO_DATE = (isset($_POST['to_date']) ? $_POST['to_date'] : null);

?>

<style>

.quantity {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
}

</style>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Sales Report</li>
</ol>


            <div class="card shadow mb-4">
            <div class="card-header py-3">
			<form action="sales_report.php" method="POST">
			<div class="form-group row"><div class="col-xs-2"><h4 class="m-2 font-weight-bold text-primary">Sales Report</h4></div>&nbsp;<div class="col-xs-3"><input class="form-control" type="date" name="from_date" value="<?php echo $FROM_DATE; ?>" /></div>&nbsp; <div class="col-xs-4"><input class="form-control" type="date" name="to_date" value="<?php echo $TO_DATE; ?>" /></div>&nbsp;&nbsp;<div class="col-xs-5"><input type="submit" class="btn btn-primary" value="Filter" /></div>&nbsp;&nbsp;<div class="col-xs-12"><button id="export-btn" class="btn btn-success">Export To Excel</button></div></div>
			</form>
            </div>

            <div class="card-body">
              <div class="table-responsive">
		<form action="" method="POST" class="form">
		<table class="table table-bordered" width="100%" cellspacing="0" id="myTable">
            <thead>

			<tr>
				<th> S.N. </th>
				<th> Invoice ID </th>
				<th> Retailer Name </th>
				<th> Items Count </th>
				<th> Invoice Date </th>
				<th> Total Amount (Rs) </th>
			</tr>

            </thead>
			<tbody>
<?php
$i = 0;
if (($FROM_DATE > 0) && ($TO_DATE > 0)) {
	$DATA_BANK = $SCA->SCA_DATA('SALES_REPORT', $FROM_DATE, $TO_DATE);
} else {
	$DATA_BANK = $SCA->SCA_DATA('SALES_REPORT_TODAY', $TODAY_DATE);
}
foreach ($DATA_BANK AS $ROW_DETAIL){
	$i = $i + 1;
		$RETAILER_ID = $ROW_DETAIL['RETAILER_ID'];
		$RETAILER_FNAME = $SCA -> RETURN_FIELD('users','F_NAME','ID',$RETAILER_ID);
		$RETAILER_LNAME = $SCA -> RETURN_FIELD('users','L_NAME','ID',$RETAILER_ID);

		$INVOICE_ID = $ROW_DETAIL['INVOICE_ID'];
		$ITEMS_COUNT = $SCA->SCA_INFO('ITEMS_COUNT', $INVOICE_ID);

		$TOTAL_AMOUNT = $ROW_DETAIL['TOTAL_AMOUNT'];
		$DISCOUNT = $ROW_DETAIL['DISCOUNT'];

		$AREA_ID = $SCA -> RETURN_FIELD('users','AREA_ID','ID',$RETAILER_ID);
		$SHIPPING_COST = $SCA -> RETURN_FIELD('area','SHIPPING_CHARGE','ID',$AREA_ID);

		$FINAL_AMOUNT = ((($TOTAL_AMOUNT - $DISCOUNT) * 13/100) + ($TOTAL_AMOUNT - $DISCOUNT) + $SHIPPING_COST);
?> 
			<tr>
				<td><?php echo $i; ?></td>
				<td><a href="invoice_details.php?invoice_id=<?php echo $ROW_DETAIL['INVOICE_ID']; ?>" ><?php echo "#" . $ROW_DETAIL['INVOICE_ID']; ?></a></td>
				<td><?php echo $RETAILER_FNAME . " " . $RETAILER_LNAME; ?></td>
				<td><?php echo $ITEMS_COUNT; ?></td>
				<td><?php echo $ROW_DETAIL['CREATED_DATE']; ?></td>
				<td><?php echo $FINAL_AMOUNT; ?></td>
			</tr>

			<?php } ?>


			<tr style="height:40px;vertical-align:bottom;">
				<td colspan="5" style="text-align:right;"><b> Total Sale Amount: </b></td>
				<td><b>Rs <span id="sum"></span></b></td>
			</tr>

			</tbody>

		</table>
		<script>
		var sum = 0;
		$('.table td:nth-child(6)').each(function() {
    	sum += parseFloat($(this).text());
		});
		$('#sum').text(sum);
		</script>

		</form>
		</div>
		</div>
		</div>


<?php
include'../libraries/footer.php';
?>
<script>
  // Reference the button and table
  var btn = document.getElementById("export-btn");
  var table = document.getElementById("myTable");

  // Add a click event listener to the button
  btn.addEventListener("click", function() {
    // Create a new workbook
    var wb = XLSX.utils.table_to_book(table);

    // Get binary string as output
    var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

    // Generate a download link
    function s2ab(s) {
      var buf = new ArrayBuffer(s.length);
      var view = new Uint8Array(buf);
      for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
      return buf;
    }

    var link = document.createElement("a");
    link.href = window.URL.createObjectURL(new Blob([s2ab(wbout)], { type: "application/octet-stream" }));
    link.download = "SalesReport.xlsx";
    link.click();
  });
</script>
