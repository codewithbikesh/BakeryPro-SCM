<?php

  error_reporting(0);

  require('session.php');
  confirm_logged_in();

  include("../class/sca_connect.php");
  include("../class/sca_function.php");
  $SCA = new sca_function();
  
$MEMBER_ID = $_SESSION['MEMBER_ID'];
$MY_ORDER_COUNT = $SCA->SCA_INFO('MY_ORDER_COUNT', $MEMBER_ID);
$MY_INVOICE_COUNT = $SCA->SCA_INFO('MY_INVOICE_COUNT', $MEMBER_ID);

$ORDER_COUNT = $SCA->SCA_INFO('ORDER_COUNT');
$INVOICE_COUNT = $SCA->SCA_INFO('INVOICE_COUNT');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}

</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BakeryPro SCM</title>
  <link rel="icon" href="https://www.freeiconspng.com/uploads/sales-icon-7.png">

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor_bootstrap/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../assets/vendor_bootstrap/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Including jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  
    <!-- Including Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        setTimeout(function () {
  
            // Closing the alert
            $('#alert').alert('close');
        }, 5000);
    </script>
    

</head>

<style>
.nav-item.active{
	background-color:green;
	transition: 0.8s;
}
</style>


<body id="page-top">


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-janam sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
<!--        <div class="sidebar-brand-icon rotate-n-15">-->
<!--          <i class="fas fa-laugh-wink"></i>-->
        <div>
		<img src="../images/supplychain.png" width="50"/>
        </div>
        <div class="sidebar-brand-text mx-4">BakeryPro SCM</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-fw fa-home"></i><span>Home</span></a></li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Tables
      </div>

<?php if ($_SESSION['TYPE']!="3") { ?>
      <li class="nav-item"><a class="nav-link" href="order.php"><i class="fas fa-cart-arrow-down"></i><span>Orders</span>&nbsp;<span class="badge badge-info right"><?php print $ORDER_COUNT; ?></span></a></li>
      <li class="nav-item"><a class="nav-link" href="view_invoice.php"><i class="fas fa-file-invoice"></i><span>Invoices</span>&nbsp;<span class="badge badge-info right"><?php print $INVOICE_COUNT; ?></span></a></li>
<?php } ?>
      <li class="nav-item"><a class="nav-link" href="product.php"><i class="fas fa-fw fa-table"></i><span>Products</span></a></li>
<?php if ($_SESSION['TYPE']=="3") { ?>
      <li class="nav-item"><a class="nav-link" href="retailer_new_order.php"><i class="fas fa-cart-arrow-down"></i><span>New Order</span></a></li>
      <li class="nav-item"><a class="nav-link" href="retailer_view_orders.php"><i class="fas fa-cart-arrow-down"></i><span>My Orders</span>&nbsp;<span class="badge badge-info right"><?php print $MY_ORDER_COUNT; ?></span></a></li>
      <li class="nav-item"><a class="nav-link" href="retailer_invoices.php"><i class="fas fa-file-invoice"></i><span>My Invoices</span>&nbsp;<span class="badge badge-info right"><?php print $MY_INVOICE_COUNT; ?></span></a></li>
<?php } ?>
<?php if ($_SESSION['TYPE']!="3") { ?>
<?php if ($_SESSION['TYPE']!="1") { ?>
      <li class="nav-item"><a class="nav-link" href="stock.php"><i class="fas fa-fw fa-table"></i><span>Manage Stock</span></a></li>
<?php } ?>
      <li class="nav-item"><a class="nav-link" href="retailer.php"><i class="fas fa-fw fa-users"></i><span>Retailers</span></a></li>
<?php if ($_SESSION['TYPE']!="2") { ?>
      <li class="nav-item"><a class="nav-link" href="manufacturer.php"><i class="fas fa-fw fa-users"></i><span>Manufacturers</span></a></li>
<?php } ?>
      <li class="nav-item"><a class="nav-link" href="distributor.php"><i class="fas fa-fw fa-users"></i><span>Distributors</span></a></li>
      <li class="nav-item"><a class="nav-link" href="unit.php"><i class="fas fa-fw fa-coins"></i><span>Manage Unit</span></a></li>
      <li class="nav-item"><a class="nav-link" href="category.php"><i class="fas fa-fw fa-layer-group"></i><span>Manage Category</span></a></li>
<?php if ($_SESSION['TYPE']!="2") { ?>
      <li class="nav-item"><a class="nav-link" href="area.php"><i class="fas fa-map-pin"></i><span>Manage Area</span></a></li>
<?php } ?>
<?php } ?>

<script>
$(document).ready(function() {
    $.each($('#accordionSidebar').find('li'), function() {
        $(this).toggleClass('active', 
            window.location.pathname.indexOf($(this).find('a').attr('href')) > -1);
    }); 
});
</script>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



    </ul>
    

    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>

