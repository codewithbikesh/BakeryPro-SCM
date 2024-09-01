<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>
          
<?php if (($_POST['productname']=='NULL') OR ($_SESSION['TYPE']=='3')){ ?>

		<script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
        </script>

<?php } if ($_POST['productname']!='NULL') {

              $date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
              $created_date = $date->format('Y-m-d H:i A');

              $productname = (isset($_POST['productname']) ? $_POST['productname'] : null);
              $productcode = (isset($_POST['productcode']) ? $_POST['productcode'] : null);
              $manufactureddate = (isset($_POST['manufactureddate']) ? $_POST['manufactureddate'] : null);
              $expirydate = (isset($_POST['expirydate']) ? $_POST['expirydate'] : null);
              $productdescription = (isset($_POST['productdescription']) ? $_POST['productdescription'] : null);
              $productprice = (isset($_POST['price']) ? $_POST['price'] : null);
              $category = (isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : null);
              $stockmanagement = (isset($_POST['stockmanagement']) ? $_POST['stockmanagement'] : null);

	            if ($stockmanagement=='Y') { $stock='0'; } else { $stock='N/A'; }
              $unit = (isset($_POST['UNIT']) ? $_POST['UNIT'] : null);
              $createdby = (isset($_POST['user']) ? $_POST['user'] : null);
        
              switch($_GET['action']){
                case 'add':  

              $INSERT = "INSERT INTO product (PRODUCT_NAME, PRODUCT_CODE, MFD_DATE, EXP_DATE, DESCRIPTION, PRICE, ON_STOCK, MANAGE_STOCK, CATEGORY_ID, UNIT_ID, CREATED_DATE, CREATED_BY)
                         VALUES ('{$productname}','{$productcode}','{$manufactureddate}','{$expirydate}','{$productdescription}','{$productprice}','{$stock}','{$stockmanagement}','{$category}','{$unit}','{$created_date}','{$createdby}')";
	            $RESULT = $SCA->SCA_EXECUTE($INSERT);
                    
			        if ($RESULT=='1'){
				            $_SESSION['success'] = 'Product Added Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "product.php";
            </script>
            
<?php
			        }
			        else{
				            $_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "product.php";
            </script>
            
<?php
			        }
                    
                break;
              }
}

?>