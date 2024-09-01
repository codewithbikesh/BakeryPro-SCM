<?php
	error_reporting(0);
	require("../class/connection.php");
	include'session.php';

		if (($_SESSION['TYPE']=='2') && ($_GET['id']!=0)) {
			$id = $_GET['id'];

			$PRODUCT_ID = $orderQuantity = $availQuantity = [];
			$queryAvailQuantity = "SELECT product.PRODUCT_ID AS PRODUCT_ID,product.ON_STOCK AS STOCK FROM order_items,product WHERE product.PRODUCT_ID=order_items.PRODUCT_ID AND order_items.ORDER_ID='$id' AND product.ON_STOCK IS NOT NULL";
			$resultAvailQuantity = mysqli_query($db,$queryAvailQuantity);
			$queryOrderQuantity = "SELECT QUANTITY AS q,PRODUCT_ID AS p FROM order_items WHERE ORDER_ID='$id'";
			$resultOrderQuantity = mysqli_query($db,$queryOrderQuantity);

			while($rowAvailQuantity = mysqli_fetch_array($resultAvailQuantity)){
				$availProId[] = $rowAvailQuantity['PRODUCT_ID'];
				$availQuantity[] = $rowAvailQuantity['STOCK'];
			}
			while($rowOrderQuantity = mysqli_fetch_array($resultOrderQuantity)){
				$orderProId[] = $rowOrderQuantity['p'];
				$orderQuantity[] = $rowOrderQuantity['q'];
			}

			foreach(array_combine($orderProId, $orderQuantity) as $p => $q) {
				foreach(array_combine($availProId,$availQuantity) as $proId => $STOCK) {

					if($p == $proId) {
						$total = $STOCK-$q;
						if($total >= 0 ) {
							$queryUpdateQuantity = "UPDATE product SET ON_STOCK='$total' WHERE PRODUCT_ID='$proId'";
							$result = mysqli_query($db,$queryUpdateQuantity);
						}
					}
				}
			}

			if(!isset($result) || !$result){
				$_SESSION['error']="You don't have enough stock to approve this order.";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "order.php";
            </script>
            
<?php
			}
			else {

				$queryConfirm = "UPDATE orders SET APPROVED=1 WHERE ORDER_ID='$id'";
				if(mysqli_query($db,$queryConfirm)) {
				$_SESSION['success']="This Order has been Approved.";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "order.php";
            </script>
            
<?php
				}
				else {
				$_SESSION['error']="There was some issue in approving order.";
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "order.php";
            </script>
            
<?php
				}

			}
		} else {
		header('Location:index.php');
	}
?>