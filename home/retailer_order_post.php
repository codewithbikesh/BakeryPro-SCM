<?php

	require("../class/connection.php");
	require'session.php';

	$date = new DateTime("now", new DateTimeZone('Asia/Kathmandu') );
	$created_date = $date->format('Y-m-d H:i A');

	$retailer_id = $_SESSION['MEMBER_ID'];
	$sql = "SELECT PRODUCT_ID FROM product ORDER BY PRODUCT_ID DESC LIMIT 1";
	$result = mysqli_query($db,$sql);
	$row=mysqli_fetch_array($result);
	$total_products = $row[0];
	
	$quantityArray = array();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!empty($_POST['total_price'])){
			$total_price = $_POST['total_price'];
			for($i=1;$i<=$total_products;$i++){
				$quantityArray[$i] = $_POST['txtQuantity'.$i];
			}
		}
		else{
			echo "Total price not recieved.";
		}
	}

	$query_insertOrder = "INSERT INTO orders(RETAILER_ID,TOTAL_AMOUNT,CREATED_DATE) VALUES('$retailer_id','$total_price','$created_date')";
	if($db->query($query_insertOrder) === true){
		$sql_getOrderId = "SELECT ORDER_ID FROM orders ORDER BY ORDER_ID DESC LIMIT 1";
		$result_getOrderId = mysqli_query($db,$sql_getOrderId);
		$row_getOrderId =mysqli_fetch_array($result_getOrderId);
		$order_id = $row_getOrderId[0];
		foreach($quantityArray as $key_productId => $value_quantity){
			if($value_quantity != NULL){
				$query_insertOrderItems = "INSERT INTO order_items(ORDER_ID,PRODUCT_ID,QUANTITY) VALUES('$order_id','$key_productId','$value_quantity')";
				if($db->query($query_insertOrderItems) === true){
					$_SESSION['success'] = "Your order is registered successfully !";
				}
				else {
					$_SESSION['error'] = "There was some error.";
				}
			}
		}
	}
	else{
		$_SESSION['error'] = "There was some error posting your order.";
	}
	header('Location:retailer_view_orders.php?status=redirect');
?>