<?php
	if(preg_match("/^[0-9.]*$/",$_POST['quantity'])){
		$quantity = $_POST['quantity'];
		$current_id = $_POST['current_id'];
		require'../../class/connection.php';
		$sql = "SELECT PRICE FROM product WHERE PRODUCT_ID=$current_id";
		$result = mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result);
		$total_price=$row["PRICE"]*$quantity;
	//	$net_price = array();
	//	$net_price[$current_id]=$total_price;
	//	$final_amount = $final_amount + $net_price[$current_id];
		echo (float)$total_price;
	//	echo $total_price."[BRK]".$quantity;
	}
	else {
		echo "Invalid Quantity.";
	}
?>