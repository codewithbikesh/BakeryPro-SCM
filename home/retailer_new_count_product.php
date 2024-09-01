<?php
	require("../class/connection.php");
	$sql = "SELECT PRODUCT_ID FROM product ORDER BY PRODUCT_ID DESC LIMIT 1";
	$result = mysqli_query($db,$sql);
	$row=mysqli_fetch_array($result);
	echo $row[0];
?>