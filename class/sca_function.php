<?php

	include_once 'sca_connect.php';

	class sca_function extends sca_connect
	{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function SCA_EXECUTE($query)
	{
		$rs = $this->db->query($query);
		if ($rs == false) {
			echo 'Duplicate or Invalid Record. Try Again.';
			return false;
		} else {
			return true;
		}
	}

	public function SCA_INFO($QID, $P1=NULL, $P2=NULL, $P3=NULL, $P4=NULL, $P5=NULL)
	{
		if ($QID=='MANUFACTURER_COUNT') 	{ $QRY = "SELECT count(*) as RET FROM users WHERE TYPE_ID='$P1'"; }
		if ($QID=='RETAILER_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM users WHERE TYPE_ID='$P1'"; }
		if ($QID=='AREA_COUNT') 			{ $QRY = "SELECT count(*) as RET FROM area"; }
		if ($QID=='DISTRIBUTOR_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM users WHERE TYPE_ID='$P1'"; }
		if ($QID=='UNIT_COUNT') 			{ $QRY = "SELECT count(*) as RET FROM unit"; }
		if ($QID=='PRODUCT_COUNT') 			{ $QRY = "SELECT count(*) as RET FROM product"; }
		if ($QID=='CATEGORY_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM category"; }
		
		if ($QID=='MY_ORDER_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM orders WHERE RETAILER_ID='$P1' AND STATUS=0"; }
		if ($QID=='MY_INVOICE_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM invoices WHERE RETAILER_ID='$P1' AND PAYMENT_STATUS=0"; }

		if ($QID=='ORDER_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM orders WHERE STATUS=0"; }
		if ($QID=='INVOICE_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM invoices WHERE PAYMENT_STATUS=0"; }

		if ($QID=='AUTO_INCREMENT') 		{ $QRY = "SELECT MAX(INVOICE_ID) AS RET FROM $P1"; }

		if ($QID=='ITEMS_COUNT') 		{ $QRY = "SELECT count(*) as RET FROM invoice_items WHERE INVOICE_ID='$P1'"; }

		$rs = $this->db->query($QRY);

		while ($row = $rs->fetch_assoc()) {
			$RET = $row['RET'];
		}
	
	if (strlen($RET)==0) { $RET = 0;}
	return $RET;

	}

	
	public function SCA_DATA($QID, $P1=NULL, $P2=NULL, $P3=NULL, $P4=NULL, $P5=NULL)
	{

		if ($QID=='PROFILE_DATA') 			{ $QRY = "SELECT u.ID, u.F_NAME, u.L_NAME, u.GENDER_ID, u.USERNAME, u.PASSWORD, u.EMAIL, u.PHONE_NUMBER, u.IMAGE_PATH, u.CREATED_DATE, u.TYPE_ID, u.STREET_ADDRESS, u.COUNTRY_ID, u.STATE, u.POSTCODE, u.COMPANY_NAME, u.VAT_NUMBER, t.TYPE, u.TSV FROM users u join type t on u.TYPE_ID = t.TYPE_ID WHERE ID ='$P1'"; }
		if ($QID=='PROFILE_PHOTO') 			{ $QRY = "SELECT * FROM users WHERE ID ='$P1'"; }

		if ($QID=='RECENT_PRODUCTS_LIST') 	{ $QRY = "SELECT PRODUCT_NAME, PRODUCT_ID FROM product order by PRODUCT_ID DESC LIMIT 10"; }
		if ($QID=='RECENT_ORDERS_LIST') 	{ $QRY = "SELECT u.F_NAME, u.L_NAME, o.ORDER_ID, o.STATUS FROM orders o, users u WHERE o.RETAILER_ID=u.ID AND o.STATUS=0 order by o.CREATED_DATE DESC LIMIT 10"; }
		if ($QID=='PRODUCTS_FOR_ORDER') 	{ $QRY = "SELECT p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_CODE, p.PRICE, p.ON_STOCK, c.CATEGORY_NAME, u.UNIT_ID, u.UNIT_NAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID join unit u on p.UNIT_ID=u.UNIT_ID WHERE p.CATEGORY_ID='$P1' AND p.ON_STOCK>0 GROUP BY PRODUCT_ID"; }

		if ($QID=='AREA_LIST') 				{ $QRY = "SELECT ID, AREA_CODE, AREA_NAME, SHIPPING_CHARGE FROM area GROUP BY AREA_CODE"; }
		if ($QID=='AREA_EDIT') 				{ $QRY = "SELECT * FROM area WHERE ID ='$P1'"; }
		if ($QID=='AREA_SEARCHFRM') 		{ $QRY = "SELECT * FROM area WHERE ID ='$P1'"; }
		if ($QID=='AREA_CREATOR') 			{ $QRY = "SELECT a.F_NAME, a.L_NAME, a.TYPE_ID, t.TYPE FROM users a join type t on a.TYPE_ID=t.TYPE_ID WHERE a.ID='$P1'"; }

		if ($QID=='CATEGORY_LIST') 			{ $QRY = "SELECT CATEGORY_ID, CATEGORY_NAME, CATEGORY_DESCRIPTION FROM category GROUP BY CATEGORY_ID"; }
		if ($QID=='CATEGORY_EDIT') 			{ $QRY = "SELECT * FROM category WHERE CATEGORY_ID ='$P1'"; }
		if ($QID=='CATEGORY_SEARCHFRM') 	{ $QRY = "SELECT * FROM category WHERE CATEGORY_ID ='$P1'"; }
		if ($QID=='CATEGORY_CREATOR') 		{ $QRY = "SELECT a.F_NAME, a.L_NAME, a.TYPE_ID, t.TYPE FROM users a join type t on a.TYPE_ID=t.TYPE_ID WHERE a.ID='$P1'"; }

		if ($QID=='UNIT_LIST') 				{ $QRY = "SELECT UNIT_ID, UNIT_NAME, UNIT_DESCRIPTION FROM unit GROUP BY UNIT_ID"; }
		if ($QID=='UNIT_EDIT') 				{ $QRY = "SELECT * FROM unit WHERE UNIT_ID ='$P1'"; }
		if ($QID=='UNIT_SEARCHFRM') 		{ $QRY = "SELECT * FROM unit WHERE UNIT_ID ='$P1'"; }
		if ($QID=='UNIT_CREATOR') 			{ $QRY = "SELECT a.F_NAME, a.L_NAME, a.TYPE_ID, t.TYPE FROM users a join type t on a.TYPE_ID=t.TYPE_ID WHERE a.ID='$P1'"; }

		if ($QID=='DISTRIBUTOR_LIST') 		{ $QRY = "SELECT ID, F_NAME, L_NAME, EMAIL, PHONE_NUMBER, STREET_ADDRESS FROM users WHERE TYPE_ID=4 order by ID"; }
		if ($QID=='DISTRIBUTOR_EDIT') 		{ $QRY = "SELECT ID, F_NAME, L_NAME, GENDER_ID, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, CREATED_DATE, STREET_ADDRESS FROM users WHERE ID ='$P1'"; }
		if ($QID=='DISTRIBUTOR_SEARCHFRM') 	{ $QRY = "SELECT u.ID, u.F_NAME, u.L_NAME, u.USERNAME, u.EMAIL, u.GENDER_ID, u.PHONE_NUMBER, u.CREATED_DATE, u.STREET_ADDRESS, g.GENDER_NAME FROM users u join gender_code g on u.GENDER_ID=g.GENDER_ID WHERE u.ID ='$P1'"; }

		if ($QID=='MANUFACTURER_LIST') 		{ $QRY = "SELECT ID, F_NAME, L_NAME, EMAIL, PHONE_NUMBER, USERNAME FROM users WHERE TYPE_ID=2 order by ID"; }
		if ($QID=='MANUFACTURER_EDIT') 		{ $QRY = "SELECT ID, F_NAME, L_NAME, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, CREATED_DATE FROM users WHERE ID ='$P1'"; }
		if ($QID=='MANUFACTURER_SEARCHFRM') { $QRY = "SELECT ID, F_NAME, L_NAME, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, CREATED_DATE FROM users WHERE ID ='$P1'"; }

		if ($QID=='PRODUCT_LIST') 			{ $QRY = "SELECT p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_CODE, p.MFD_DATE, p.EXP_DATE, p.PRICE, p.ON_STOCK, c.CATEGORY_NAME, u.UNIT_ID, u.UNIT_NAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID join unit u on p.UNIT_ID=u.UNIT_ID GROUP BY PRODUCT_ID"; }
		if ($QID=='PRODUCT_EDIT') 			{ $QRY = "SELECT p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_CODE, p.MFD_DATE, p.EXP_DATE, p.PRICE, p.ON_STOCK, p.MANAGE_STOCK, p.DESCRIPTION, c.CATEGORY_ID, u.UNIT_ID, u.UNIT_NAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID join unit u on p.UNIT_ID=u.UNIT_ID WHERE p.PRODUCT_ID='$P1' GROUP BY PRODUCT_ID"; }
		if ($QID=='PRODUCT_SEARCHFRM') 		{ $QRY = "SELECT p.PRODUCT_ID, p.PRODUCT_NAME, p.PRODUCT_CODE, p.MFD_DATE, p.EXP_DATE, p.DESCRIPTION, p.CREATED_DATE, p.ON_STOCK, p.MANAGE_STOCK, p.CREATED_BY, p.PRICE, c.CATEGORY_NAME, u.UNIT_ID, u.UNIT_NAME, t.TYPE, z.F_NAME, z.L_NAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID join unit u on p.UNIT_ID=u.UNIT_ID join users z on p.CREATED_BY=z.ID join type t on z.TYPE_ID=t.TYPE_ID WHERE p.PRODUCT_ID='$P1' GROUP BY p.PRODUCT_ID"; }
		
		if ($QID=='ORDER_LIST') 			{ $QRY = "SELECT o.ORDER_ID, o.CREATED_DATE, o.APPROVED, o.STATUS, u.F_NAME, u.L_NAME FROM orders o, users u WHERE o.RETAILER_ID=u.ID AND (o.STATUS = 0 OR o.STATUS = 2) order by o.ORDER_ID DESC"; }
		if ($QID=='ORDER_ITEMS_DETAILS') 	{ $QRY = "SELECT RETAILER_ID,APPROVED,CREATED_DATE,STATUS,TOTAL_AMOUNT FROM orders WHERE ORDER_ID='$P1'"; }
		if ($QID=='PRODUCT_ORDER_DETAILS') 	{ $QRY = "SELECT *,order_items.quantity AS quantity FROM orders,order_items,product,unit WHERE product.UNIT_ID=unit.UNIT_ID AND order_items.ORDER_ID='$P1' AND order_items.PRODUCT_ID=product.PRODUCT_ID AND order_items.ORDER_ID=orders.ORDER_ID"; }

		if ($QID=='RETAILER_LIST') 			{ $QRY = "SELECT u.ID, u.F_NAME, u.L_NAME, u.VERIFIED, u.USERNAME, u.EMAIL, u.PHONE_NUMBER, u.STREET_ADDRESS, u.AREA_ID, a.AREA_CODE FROM users u join area a on u.AREA_ID=a.ID WHERE u.TYPE_ID=3 order by u.ID"; }
		if ($QID=='RETAILER_EDIT') 			{ $QRY = "SELECT ID, F_NAME, L_NAME, USERNAME, PASSWORD, EMAIL, AREA_ID, PHONE_NUMBER, CREATED_DATE, STREET_ADDRESS, STATE, POSTCODE, COUNTRY_ID, COMPANY_NAME, VAT_NUMBER FROM users WHERE ID ='$P1'"; }
		if ($QID=='RETAILER_SEARCHFRM') 	{ $QRY = "SELECT u.ID, u.F_NAME, u.L_NAME, u.USERNAME, u.PASSWORD, u.EMAIL, u.PHONE_NUMBER, u.CREATED_DATE, u.STREET_ADDRESS, u.STATE, u.POSTCODE, u.COUNTRY_ID, u.COMPANY_NAME, u.VAT_NUMBER, u.TERMS, a.AREA_CODE, a.AREA_NAME FROM users u join area a on u.AREA_ID=a.ID WHERE u.ID ='$P1'"; }

		if ($QID=='RETAILER_INVOICES') 		{ $QRY = "SELECT *, invoices.CREATED_DATE FROM invoices,users,area WHERE invoices.RETAILER_ID=users.ID AND users.AREA_ID=area.ID AND users.ID='$P1' ORDER BY invoices.INVOICE_ID DESC"; }
		if ($QID=='RETAILER_VIEW_ORDERS') 	{ $QRY = "SELECT * FROM orders WHERE RETAILER_ID ='$P1' AND (STATUS = 0 OR STATUS = 2)"; }

		if ($QID=='SELECT_INVOICE') 		{ $QRY = "SELECT *, invoices.CREATED_DATE, invoices.DISCOUNT, invoices.SHIPPING_COST FROM invoices,users,area WHERE invoices.INVOICE_ID='$P1' AND invoices.RETAILER_ID=users.ID AND users.AREA_ID=area.ID"; }
		if ($QID=='SELECT_DISTRIBUTOR') 	{ $QRY = "SELECT users.F_NAME, users.L_NAME FROM users WHERE ID ='$P1'"; }
		if ($QID=='SELECT_INVOICE_ITEMS') 	{ $QRY = "SELECT *,invoice_items.QUANTITY as QUANTITY FROM invoices,invoice_items,product WHERE invoices.INVOICE_ID='$P1' AND invoice_items.PRODUCT_ID=product.PRODUCT_ID AND invoice_items.INVOICE_ID=invoices.INVOICE_ID"; }

		if ($QID=='VIEW_INVOICE_DATA') 		{ $QRY = "SELECT *, invoices.CREATED_DATE, invoices.SHIPPING_COST FROM invoices,users,area WHERE invoices.RETAILER_ID=users.ID AND users.AREA_ID=area.ID ORDER BY invoices.CREATED_DATE"; }

		if ($QID=='GENERATE_INVOICE_SELECT_ORDER') 		{ $QRY = "SELECT CREATED_DATE,STATUS FROM orders WHERE ORDER_ID ='$P1'"; }
		if ($QID=='GENERATE_INVOICE_SELECT_INVOICEID') 		{ $QRY = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='erp3' AND TABLE_NAME='invoices'"; }
		if ($QID=='GENERATE_INVOICE_SELECT_ORDER_ITEMS') 		{ $QRY = "SELECT *,order_items.QUANTITY AS q FROM orders,order_items,product WHERE order_items.ORDER_ID='$P1' AND order_items.PRODUCT_ID=product.PRODUCT_ID AND order_items.ORDER_ID=orders.ORDER_ID"; }
	
		if ($QID=='INSERT_INVOICE_SELECT_ORDER') 	{ $QRY = "SELECT * FROM orders WHERE ORDER_ID='$P1'"; }
		if ($QID=='INSERT_INVOICE_SELECT_ORDER_ITEMS') 	{ $QRY = "SELECT * FROM order_items WHERE ORDER_ID='$P1'"; }

		if ($QID=='PROFILE_UPDATE_EMAIL_CHECK') 	{ $QRY = "SELECT EMAIL FROM users WHERE EMAIL='$P1' AND EMAIL!='$P2'"; }
		if ($QID=='PROFILE_UPDATE_USERNAME_CHECK') 	{ $QRY = "SELECT USERNAME FROM users WHERE USERNAME='$P1' AND USERNAME!='$P2'"; }

		if ($QID=='RETAILER_DETAIL') 			{ $QRY = "SELECT * FROM users WHERE TYPE_ID ='3' AND EMAIL = '$P1'"; }
		
		if ($QID=='SALES_REPORT') 			{ $QRY = "SELECT DATE_FORMAT(CREATED_DATE, '%Y-%m-%d') AS CREATED_DATE, RETAILER_ID, INVOICE_ID, TOTAL_AMOUNT, DISCOUNT, SHIPPING_COST FROM invoices WHERE CREATED_DATE >= '$P1' AND CREATED_DATE <= '$P2'"; }
		if ($QID=='SALES_REPORT_TODAY') 			{ $QRY = "SELECT DATE_FORMAT(CREATED_DATE, '%Y-%m-%d') AS CREATED_DATE, RETAILER_ID, INVOICE_ID, TOTAL_AMOUNT, DISCOUNT, SHIPPING_COST FROM invoices WHERE CREATED_DATE >= '$P1'"; }

		$rs = $this->db->query($QRY);
		if ($rs == false){
			return false;
		}

		$rows = array();

		while ($row = $rs->fetch_assoc()) {
			$rows[] = $row;
		}
	
		return $rows;

	}

	
    public function RETURN_FIELD($TAB, $DESC, $FIELD, $VAL) {

        $RET = NULL;  
        $qry = "SELECT " . $DESC . " AS RET FROM " . $TAB . " WHERE " . $FIELD . "='" . $VAL . "'";

        $rs = $this->db->query($qry);
        while ($row = $rs->fetch_assoc()) {
            $RET = $row['RET'];
        }
        if (strlen($RET)==0) { $RET = Null; } 
        return $RET;
    } 

	}
	
?>