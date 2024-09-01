DROP TABLE area;

CREATE TABLE `area` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `AREA_CODE` varchar(10) COLLATE utf8_bin NOT NULL,
  `AREA_NAME` varchar(255) COLLATE utf8_bin NOT NULL,
  `SHIPPING_CHARGE` float(12,2) NOT NULL DEFAULT 0.00,
  `CREATED_BY` varchar(20) COLLATE utf8_bin NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO area VALUES("10","PKR","Pokhara","0.00","10","2023-01-11 11:40 PM");
INSERT INTO area VALUES("11","KTM","Kathmandu","250.00","1","2023-01-11 11:38 PM");
INSERT INTO area VALUES("32","MKL","Malekhu","200.00","1","2023-01-11 11:35 PM");
INSERT INTO area VALUES("52","NPL","Nepalgunj","0.00","1","2023-01-11 11:32 PM");
INSERT INTO area VALUES("56","OKL","Okhaldhunga","0.00","1","2023-01-12 00:01 AM");



DROP TABLE category;

CREATE TABLE `category` (
  `CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` varchar(50) DEFAULT NULL,
  `CATEGORY_DESCRIPTION` varchar(255) NOT NULL,
  `CREATED_DATE` varchar(255) DEFAULT NULL,
  `CREATED_BY` varchar(55) NOT NULL,
  PRIMARY KEY (`CATEGORY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("1","Bread","A staple food prepared from a dough of flour and water, usually by baking.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("2","Cakes","A type of (usually) sweet dessert which is baked.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("3","Bun","A type of bread roll, typically filled with savory fillings","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("4","Pastries","baked products made from ingredients such as flour, sugar, milk, butter, shortening, baking powder, and eggs.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("5","Biscuits","A flour-based baked and shaped food product.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("6","Cookies","A baked or cooked snack or dessert that is typically small, flat and sweet.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("7","Doughnuts","A type of food made from leavened fried dough.","2023-01-12 21:23 PM","1");
INSERT INTO category VALUES("8","Crackers","A flat, dry baked biscuit typically made with flour.","2023-01-12 21:24 PM","1");



DROP TABLE gender_code;

CREATE TABLE `gender_code` (
  `GENDER_ID` int(4) NOT NULL AUTO_INCREMENT,
  `GENDER_NAME` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`GENDER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO gender_code VALUES("1","Male");
INSERT INTO gender_code VALUES("2","Female");
INSERT INTO gender_code VALUES("3","Other");



DROP TABLE invoice_items;

CREATE TABLE `invoice_items` (
  `INVOICE_ITEMS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `INVOICE_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(6) NOT NULL,
  PRIMARY KEY (`INVOICE_ITEMS_ID`),
  KEY `invoice_items_ibfk_1` (`INVOICE_ID`),
  KEY `invoice_items_ibfk_2` (`PRODUCT_ID`),
  CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`INVOICE_ID`) REFERENCES `invoices` (`INVOICE_ID`) ON UPDATE CASCADE,
  CONSTRAINT `invoice_items_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO invoice_items VALUES("8","2","1","2");
INSERT INTO invoice_items VALUES("9","2","2","2");
INSERT INTO invoice_items VALUES("10","2","3","2");
INSERT INTO invoice_items VALUES("11","2","14","2");
INSERT INTO invoice_items VALUES("12","2","21","2");
INSERT INTO invoice_items VALUES("13","2","22","2");
INSERT INTO invoice_items VALUES("14","2","25","3");
INSERT INTO invoice_items VALUES("15","3","3","20");
INSERT INTO invoice_items VALUES("22","6","2","10");
INSERT INTO invoice_items VALUES("23","6","10","10");
INSERT INTO invoice_items VALUES("24","7","25","10");
INSERT INTO invoice_items VALUES("25","8","4","20");
INSERT INTO invoice_items VALUES("26","8","8","15");
INSERT INTO invoice_items VALUES("27","8","11","25");
INSERT INTO invoice_items VALUES("28","9","1","10");
INSERT INTO invoice_items VALUES("29","9","2","10");
INSERT INTO invoice_items VALUES("30","9","3","10");
INSERT INTO invoice_items VALUES("31","9","4","10");
INSERT INTO invoice_items VALUES("32","9","10","10");
INSERT INTO invoice_items VALUES("33","10","7","20");
INSERT INTO invoice_items VALUES("80","34","2","5");
INSERT INTO invoice_items VALUES("81","34","3","6");
INSERT INTO invoice_items VALUES("82","34","7","10");



DROP TABLE invoices;

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDER_ID` int(11) NOT NULL,
  `RETAILER_ID` int(11) NOT NULL,
  `DISTRIBUTOR_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` float(12,2) NOT NULL,
  `DISCOUNT` float(12,2) DEFAULT NULL,
  `COMMENTS` text COLLATE utf8_bin DEFAULT NULL,
  `PAYMENT_STATUS` int(11) NOT NULL,
  `PAYMENT_METHOD` varchar(55) COLLATE utf8_bin DEFAULT NULL,
  `SHIPPING_COST` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`INVOICE_ID`),
  KEY `invoice_ibfk_1` (`ORDER_ID`),
  KEY `invoice_ibfk_2` (`RETAILER_ID`),
  KEY `invoice_ibfk_3` (`DISTRIBUTOR_ID`),
  CONSTRAINT `distributor_ibfk` FOREIGN KEY (`DISTRIBUTOR_ID`) REFERENCES `users` (`ID`),
  CONSTRAINT `order_ibfk` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`),
  CONSTRAINT `retailer_ibfk` FOREIGN KEY (`RETAILER_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO invoices VALUES("2","1","37","34","2440.00","40.00","hello","1","Paypal","N","2023-01-13 21:56 PM");
INSERT INTO invoices VALUES("3","2","37","34","3000.00","0.00","Test Data","1","Paypal","N","2023-01-14 01:46 AM");
INSERT INTO invoices VALUES("6","8","37","40","2800.00","0.00","test","1","Paypal","Y","2023-01-20 12:01 PM");
INSERT INTO invoices VALUES("7","7","37","38","4000.00","0.00","hello hello","1","Cash On Delivery","N","2023-01-21 02:05 AM");
INSERT INTO invoices VALUES("8","9","41","40","24500.00","50.00","Thank you!!!","0","Cash On Delivery","Y","2023-01-23 23:30 PM");
INSERT INTO invoices VALUES("9","10","37","38","10300.00","300.00","Thank you","1","Cash On Delivery","Y","2023-01-24 21:38 PM");
INSERT INTO invoices VALUES("10","13","37","38","4000.00","0.00","Thank You!","0","","Y","2023-01-29 19:09 PM");
INSERT INTO invoices VALUES("34","35","52","38","3900.00","0.00","Thank you for your order!","1","Paypal","N","2023-01-31 13:49 PM");



DROP TABLE order_items;

CREATE TABLE `order_items` (
  `ORDER_ITEMS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(6) NOT NULL,
  PRIMARY KEY (`ORDER_ITEMS_ID`),
  KEY `orders_items_ibfk_1` (`ORDER_ID`),
  KEY `orders_items_ibfk_2` (`PRODUCT_ID`),
  CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`),
  CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO order_items VALUES("1","1","1","2");
INSERT INTO order_items VALUES("2","1","2","2");
INSERT INTO order_items VALUES("3","1","3","2");
INSERT INTO order_items VALUES("4","1","14","2");
INSERT INTO order_items VALUES("5","1","21","2");
INSERT INTO order_items VALUES("6","1","22","2");
INSERT INTO order_items VALUES("7","1","25","3");
INSERT INTO order_items VALUES("8","2","3","20");
INSERT INTO order_items VALUES("14","7","25","10");
INSERT INTO order_items VALUES("15","8","2","10");
INSERT INTO order_items VALUES("16","8","10","10");
INSERT INTO order_items VALUES("17","9","4","20");
INSERT INTO order_items VALUES("18","9","8","15");
INSERT INTO order_items VALUES("19","9","11","25");
INSERT INTO order_items VALUES("20","10","1","10");
INSERT INTO order_items VALUES("21","10","2","10");
INSERT INTO order_items VALUES("22","10","3","10");
INSERT INTO order_items VALUES("23","10","4","10");
INSERT INTO order_items VALUES("24","10","10","10");
INSERT INTO order_items VALUES("26","12","24","25");
INSERT INTO order_items VALUES("27","13","7","20");
INSERT INTO order_items VALUES("30","16","24","6");
INSERT INTO order_items VALUES("32","18","1","22");
INSERT INTO order_items VALUES("33","19","1","12");
INSERT INTO order_items VALUES("35","19","20","20");
INSERT INTO order_items VALUES("36","19","23","22");
INSERT INTO order_items VALUES("37","19","25","15");
INSERT INTO order_items VALUES("38","20","5","30");
INSERT INTO order_items VALUES("72","35","2","5");
INSERT INTO order_items VALUES("73","35","3","6");
INSERT INTO order_items VALUES("74","35","7","10");



DROP TABLE orders;

CREATE TABLE `orders` (
  `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RETAILER_ID` int(11) NOT NULL,
  `APPROVED` tinyint(1) NOT NULL DEFAULT 0,
  `STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `TOTAL_AMOUNT` float(12,2) NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ORDER_ID`),
  KEY `orders_ibfk_1` (`RETAILER_ID`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`RETAILER_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO orders VALUES("1","37","1","1","2440.00","2023-01-12 23:48 AM");
INSERT INTO orders VALUES("2","37","1","1","3000.00","2023-01-14 01:45 PM");
INSERT INTO orders VALUES("7","37","1","1","4000.00","2023-01-18 23:09 AM");
INSERT INTO orders VALUES("8","37","1","1","2800.00","2023-01-20 11:59 AM");
INSERT INTO orders VALUES("9","41","1","1","24500.00","2023-01-22 22:26 PM");
INSERT INTO orders VALUES("10","37","1","1","10300.00","2023-01-22 22:26 AM");
INSERT INTO orders VALUES("12","37","0","2","7500.00","2023-01-26 22:14 AM");
INSERT INTO orders VALUES("13","37","1","1","4000.00","2023-01-26 22:16 AM");
INSERT INTO orders VALUES("16","37","1","1","1800.00","2023-01-26 22:38 AM");
INSERT INTO orders VALUES("18","37","1","1","2200.00","2023-01-26 22:50 AM");
INSERT INTO orders VALUES("19","41","0","2","17300.00","2023-01-30 22:56 AM");
INSERT INTO orders VALUES("20","41","1","1","18000.00","2023-01-26 23:34 AM");
INSERT INTO orders VALUES("35","52","1","1","3900.00","2023-01-31 13:47 PM");



DROP TABLE product;

CREATE TABLE `product` (
  `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(50) DEFAULT NULL,
  `PRODUCT_CODE` varchar(55) NOT NULL,
  `MFD_DATE` date DEFAULT NULL,
  `EXP_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(250) NOT NULL,
  `MANAGE_STOCK` varchar(4) NOT NULL,
  `ON_STOCK` varchar(50) NOT NULL DEFAULT 'NA',
  `PRICE` float(12,2) DEFAULT NULL,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `UNIT_ID` int(11) DEFAULT NULL,
  `CREATED_DATE` varchar(255) NOT NULL,
  `CREATED_BY` int(12) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`),
  KEY `CATEGORY_ID` (`CATEGORY_ID`),
  KEY `unit_ibfk_1` (`UNIT_ID`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`CATEGORY_ID`),
  CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`UNIT_ID`) REFERENCES `unit` (`UNIT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","Sourdough","SOURDOUGH1001","2023-01-16","2023-01-31","Yummy","Y","25","100.00","1","2","2023-01-12 22:28 PM","1");
INSERT INTO product VALUES("2","Multigrain","MULTIGRAIN1001","2023-01-16","2023-01-31","Tasty","Y","3","200.00","1","2","2023-01-12 22:29 PM","1");
INSERT INTO product VALUES("3","Rye Bread","RYEBREAD1001","2023-01-16","2023-01-31","Taste good","Y","10","150.00","1","2","2023-01-12 22:31 PM","1");
INSERT INTO product VALUES("4","Yellow Cake","YELLOWCAKE1001","2023-01-10","2023-01-31","Tasty","Y","50","500.00","2","1","2023-01-12 22:35 PM","1");
INSERT INTO product VALUES("5","Pound Cake","POUNDCAKE1001","2023-01-09","2023-01-31","Tasty","Y","5","600.00","2","1","2023-01-12 22:35 PM","1");
INSERT INTO product VALUES("6","Red Velvet Cake","REDVELVETCAKE1001","2023-01-12","2023-01-31","Yummy","Y","38","800.00","2","1","2023-01-12 22:35 PM","1");
INSERT INTO product VALUES("7","Plain Bun","PLAINBUN1001","2023-01-11","2023-01-31","Yummy","Y","5","200.00","3","2","2023-01-12 22:42 PM","1");
INSERT INTO product VALUES("8","Sesame Seed Bun","SESAMESEEDBUN1001","2023-01-10","2023-01-31","Yummy","Y","34","300.00","3","2","2023-01-12 22:42 PM","1");
INSERT INTO product VALUES("9","Potato Bun","POTATOBUN1001","2023-01-05","2023-01-31","Tasty","Y","40","200.00","3","2","2023-01-12 22:43 PM","1");
INSERT INTO product VALUES("10","Brown Bread","BROWNBREAD1001","2023-01-06","2023-01-31","Taste good","Y","9","80.00","1","12","2023-01-12 22:46 PM","1");
INSERT INTO product VALUES("11","Macarons","MACARONS1001","2023-01-07","2023-01-31","Tasty","Y","25","400.00","4","2","2023-01-12 22:50 PM","1");
INSERT INTO product VALUES("12","Cannoli","CANNOLI1001","2023-01-07","2023-01-31","Yummy","Y","38","500.00","4","2","2023-01-12 22:51 PM","1");
INSERT INTO product VALUES("13","Pies","PIES1001","2023-01-11","2023-01-31","Yummy","Y","38","400.00","4","2","2023-01-12 22:53 PM","1");
INSERT INTO product VALUES("14","Sandwich biscuits","SANDWICHBISCUITS1001","2023-01-10","2023-01-31","Tasty","Y","46","100.00","5","12","2023-01-12 22:56 PM","1");
INSERT INTO product VALUES("15","Digestive biscuits","DIGESTIVEBISCUITS1001","2023-01-16","2023-01-31","Yummy","Y","47","200.00","5","12","2023-01-12 22:57 PM","1");
INSERT INTO product VALUES("16","Shortbread biscuits","SHORTBREADBISCUITS1001","2023-01-10","2023-01-31","Tasty","Y","38","200.00","5","12","2023-01-12 22:57 PM","1");
INSERT INTO product VALUES("17","Butter Cookies","BUTTERCOOKIES1001","2023-01-15","2023-01-31","Tasty","Y","46","200.00","6","12","2023-01-12 23:00 PM","1");
INSERT INTO product VALUES("18","Cake Mix Cookies","CAKEMIXCOOKIES1001","2023-01-15","2023-01-31","Tasty","Y","49","300.00","6","12","2023-01-12 23:00 PM","1");
INSERT INTO product VALUES("19","Chocolate Chip Cookies","CHOCOLATECHIPCOOKIES1001","2023-01-13","2023-01-31","Tasty","Y","49","400.00","6","12","2023-01-12 23:01 PM","1");
INSERT INTO product VALUES("20","Yeast Doughnut","YEASTDOUGHNUT1001","2023-01-14","2023-01-31","Tasty","Y","30","25.00","7","2","2023-01-12 23:02 PM","1");
INSERT INTO product VALUES("21","Jelly Doughnut","JELLYDOUGHNUT1001","2023-01-13","2023-01-31","Yummy","Y","48","30.00","7","2","2023-01-12 23:02 PM","1");
INSERT INTO product VALUES("22","Cream Doughnut","CREAMDOUGHNUT1001","2023-01-15","2023-01-31","Tasty","Y","47","40.00","7","2","2023-01-12 23:02 PM","1");
INSERT INTO product VALUES("23","Animal cracker","ANIMALCRACKER1001","2023-01-15","2023-01-31","Yummy","Y","28","400.00","8","12","2023-01-12 23:05 PM","1");
INSERT INTO product VALUES("24","Cream cracker","CREAMCRACKER1001","2023-01-12","2023-01-31","Yummy","Y","34","300.00","8","12","2023-01-12 23:06 PM","1");
INSERT INTO product VALUES("25","Cheese cracker","CHEESECRACKER1001","2023-01-10","2023-01-31","Tasty","Y","17","400.00","8","12","2023-01-12 23:06 PM","1");



DROP TABLE tbl_countries;

CREATE TABLE `tbl_countries` (
  `ID` int(11) NOT NULL,
  `COUNTRY_NAME` varchar(55) NOT NULL,
  `COUNTRY_NICENAME` varchar(55) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_countries VALUES("1","AFGHANISTAN","Afghanistan");
INSERT INTO tbl_countries VALUES("2","ALBANIA","Albania");
INSERT INTO tbl_countries VALUES("3","ALGERIA","Algeria");
INSERT INTO tbl_countries VALUES("4","AMERICAN SAMOA","American Samoa");
INSERT INTO tbl_countries VALUES("5","ANDORRA","Andorra");
INSERT INTO tbl_countries VALUES("6","ANGOLA","Angola");
INSERT INTO tbl_countries VALUES("7","ANGUILLA","Anguilla");
INSERT INTO tbl_countries VALUES("8","ANTARCTICA","Antarctica");
INSERT INTO tbl_countries VALUES("9","ANTIGUA AND BARBUDA","Antigua and Barbuda");
INSERT INTO tbl_countries VALUES("10","ARGENTINA","Argentina");
INSERT INTO tbl_countries VALUES("11","ARMENIA","Armenia");
INSERT INTO tbl_countries VALUES("12","ARUBA","Aruba");
INSERT INTO tbl_countries VALUES("13","AUSTRALIA","Australia");
INSERT INTO tbl_countries VALUES("14","AUSTRIA","Austria");
INSERT INTO tbl_countries VALUES("15","AZERBAIJAN","Azerbaijan");
INSERT INTO tbl_countries VALUES("16","BAHAMAS","Bahamas");
INSERT INTO tbl_countries VALUES("17","BAHRAIN","Bahrain");
INSERT INTO tbl_countries VALUES("18","BANGLADESH","Bangladesh");
INSERT INTO tbl_countries VALUES("19","BARBADOS","Barbados");
INSERT INTO tbl_countries VALUES("20","BELARUS","Belarus");
INSERT INTO tbl_countries VALUES("21","BELGIUM","Belgium");
INSERT INTO tbl_countries VALUES("22","BELIZE","Belize");
INSERT INTO tbl_countries VALUES("23","BENIN","Benin");
INSERT INTO tbl_countries VALUES("24","BERMUDA","Bermuda");
INSERT INTO tbl_countries VALUES("25","BHUTAN","Bhutan");
INSERT INTO tbl_countries VALUES("26","BOLIVIA","Bolivia");
INSERT INTO tbl_countries VALUES("27","BOSNIA AND HERZEGOVINA","Bosnia and Herzegovina");
INSERT INTO tbl_countries VALUES("28","BOTSWANA","Botswana");
INSERT INTO tbl_countries VALUES("29","BOUVET ISLAND","Bouvet Island");
INSERT INTO tbl_countries VALUES("30","BRAZIL","Brazil");
INSERT INTO tbl_countries VALUES("31","BRITISH INDIAN OCEAN TERRITORY","British Indian Ocean Territory");
INSERT INTO tbl_countries VALUES("32","BRUNEI DARUSSALAM","Brunei Darussalam");
INSERT INTO tbl_countries VALUES("33","BULGARIA","Bulgaria");
INSERT INTO tbl_countries VALUES("34","BURKINA FASO","Burkina Faso");
INSERT INTO tbl_countries VALUES("35","BURUNDI","Burundi");
INSERT INTO tbl_countries VALUES("36","CAMBODIA","Cambodia");
INSERT INTO tbl_countries VALUES("37","CAMEROON","Cameroon");
INSERT INTO tbl_countries VALUES("38","CANADA","Canada");
INSERT INTO tbl_countries VALUES("39","CAPE VERDE","Cape Verde");
INSERT INTO tbl_countries VALUES("40","CAYMAN ISLANDS","Cayman Islands");
INSERT INTO tbl_countries VALUES("41","CENTRAL AFRICAN REPUBLIC","Central African Republic");
INSERT INTO tbl_countries VALUES("42","CHAD","Chad");
INSERT INTO tbl_countries VALUES("43","CHILE","Chile");
INSERT INTO tbl_countries VALUES("44","CHINA","China");
INSERT INTO tbl_countries VALUES("45","CHRISTMAS ISLAND","Christmas Island");
INSERT INTO tbl_countries VALUES("46","COCOS (KEELING) ISLANDS","Cocos (Keeling) Islands");
INSERT INTO tbl_countries VALUES("47","COLOMBIA","Colombia");
INSERT INTO tbl_countries VALUES("48","COMOROS","Comoros");
INSERT INTO tbl_countries VALUES("49","CONGO","Congo");
INSERT INTO tbl_countries VALUES("50","CONGO, THE DEMOCRATIC REPUBLIC OF THE","Congo, the Democratic Republic of the");
INSERT INTO tbl_countries VALUES("51","COOK ISLANDS","Cook Islands");
INSERT INTO tbl_countries VALUES("52","COSTA RICA","Costa Rica");
INSERT INTO tbl_countries VALUES("53","COTE D\'IVOIRE","Cote D\'Ivoire");
INSERT INTO tbl_countries VALUES("54","CROATIA","Croatia");
INSERT INTO tbl_countries VALUES("55","CUBA","Cuba");
INSERT INTO tbl_countries VALUES("56","CYPRUS","Cyprus");
INSERT INTO tbl_countries VALUES("57","CZECH REPUBLIC","Czech Republic");
INSERT INTO tbl_countries VALUES("58","DENMARK","Denmark");
INSERT INTO tbl_countries VALUES("59","DJIBOUTI","Djibouti");
INSERT INTO tbl_countries VALUES("60","DOMINICA","Dominica");
INSERT INTO tbl_countries VALUES("61","DOMINICAN REPUBLIC","Dominican Republic");
INSERT INTO tbl_countries VALUES("62","ECUADOR","Ecuador");
INSERT INTO tbl_countries VALUES("63","EGYPT","Egypt");
INSERT INTO tbl_countries VALUES("64","EL SALVADOR","El Salvador");
INSERT INTO tbl_countries VALUES("65","EQUATORIAL GUINEA","Equatorial Guinea");
INSERT INTO tbl_countries VALUES("66","ERITREA","Eritrea");
INSERT INTO tbl_countries VALUES("67","ESTONIA","Estonia");
INSERT INTO tbl_countries VALUES("68","ETHIOPIA","Ethiopia");
INSERT INTO tbl_countries VALUES("69","FALKLAND ISLANDS (MALVINAS)","Falkland Islands (Malvinas)");
INSERT INTO tbl_countries VALUES("70","FAROE ISLANDS","Faroe Islands");
INSERT INTO tbl_countries VALUES("71","FIJI","Fiji");
INSERT INTO tbl_countries VALUES("72","FINLAND","Finland");
INSERT INTO tbl_countries VALUES("73","FRANCE","France");
INSERT INTO tbl_countries VALUES("74","FRENCH GUIANA","French Guiana");
INSERT INTO tbl_countries VALUES("75","FRENCH POLYNESIA","French Polynesia");
INSERT INTO tbl_countries VALUES("76","FRENCH SOUTHERN TERRITORIES","French Southern Territories");
INSERT INTO tbl_countries VALUES("77","GABON","Gabon");
INSERT INTO tbl_countries VALUES("78","GAMBIA","Gambia");
INSERT INTO tbl_countries VALUES("79","GEORGIA","Georgia");
INSERT INTO tbl_countries VALUES("80","GERMANY","Germany");
INSERT INTO tbl_countries VALUES("81","GHANA","Ghana");
INSERT INTO tbl_countries VALUES("82","GIBRALTAR","Gibraltar");
INSERT INTO tbl_countries VALUES("83","GREECE","Greece");
INSERT INTO tbl_countries VALUES("84","GREENLAND","Greenland");
INSERT INTO tbl_countries VALUES("85","GRENADA","Grenada");
INSERT INTO tbl_countries VALUES("86","GUADELOUPE","Guadeloupe");
INSERT INTO tbl_countries VALUES("87","GUAM","Guam");
INSERT INTO tbl_countries VALUES("88","GUATEMALA","Guatemala");
INSERT INTO tbl_countries VALUES("89","GUINEA","Guinea");
INSERT INTO tbl_countries VALUES("90","GUINEA-BISSAU","Guinea-Bissau");
INSERT INTO tbl_countries VALUES("91","GUYANA","Guyana");
INSERT INTO tbl_countries VALUES("92","HAITI","Haiti");
INSERT INTO tbl_countries VALUES("93","HEARD ISLAND AND MCDONALD ISLANDS","Heard Island and Mcdonald Islands");
INSERT INTO tbl_countries VALUES("94","HOLY SEE (VATICAN CITY STATE)","Holy See (Vatican City State)");
INSERT INTO tbl_countries VALUES("95","HONDURAS","Honduras");
INSERT INTO tbl_countries VALUES("96","HONG KONG","Hong Kong");
INSERT INTO tbl_countries VALUES("97","HUNGARY","Hungary");
INSERT INTO tbl_countries VALUES("98","ICELAND","Iceland");
INSERT INTO tbl_countries VALUES("99","INDIA","India");
INSERT INTO tbl_countries VALUES("100","INDONESIA","Indonesia");
INSERT INTO tbl_countries VALUES("101","IRAN, ISLAMIC REPUBLIC OF","Iran, Islamic Republic of");
INSERT INTO tbl_countries VALUES("102","IRAQ","Iraq");
INSERT INTO tbl_countries VALUES("103","IRELAND","Ireland");
INSERT INTO tbl_countries VALUES("104","ISRAEL","Israel");
INSERT INTO tbl_countries VALUES("105","ITALY","Italy");
INSERT INTO tbl_countries VALUES("106","JAMAICA","Jamaica");
INSERT INTO tbl_countries VALUES("107","JAPAN","Japan");
INSERT INTO tbl_countries VALUES("108","JORDAN","Jordan");
INSERT INTO tbl_countries VALUES("109","KAZAKHSTAN","Kazakhstan");
INSERT INTO tbl_countries VALUES("110","KENYA","Kenya");
INSERT INTO tbl_countries VALUES("111","KIRIBATI","Kiribati");
INSERT INTO tbl_countries VALUES("112","KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF","Korea, Democratic People\'s Republic of");
INSERT INTO tbl_countries VALUES("113","KOREA, REPUBLIC OF","Korea, Republic of");
INSERT INTO tbl_countries VALUES("114","KUWAIT","Kuwait");
INSERT INTO tbl_countries VALUES("115","KYRGYZSTAN","Kyrgyzstan");
INSERT INTO tbl_countries VALUES("116","LAO PEOPLE\'S DEMOCRATIC REPUBLIC","Lao People\'s Democratic Republic");
INSERT INTO tbl_countries VALUES("117","LATVIA","Latvia");
INSERT INTO tbl_countries VALUES("118","LEBANON","Lebanon");
INSERT INTO tbl_countries VALUES("119","LESOTHO","Lesotho");
INSERT INTO tbl_countries VALUES("120","LIBERIA","Liberia");
INSERT INTO tbl_countries VALUES("121","LIBYAN ARAB JAMAHIRIYA","Libyan Arab Jamahiriya");
INSERT INTO tbl_countries VALUES("122","LIECHTENSTEIN","Liechtenstein");
INSERT INTO tbl_countries VALUES("123","LITHUANIA","Lithuania");
INSERT INTO tbl_countries VALUES("124","LUXEMBOURG","Luxembourg");
INSERT INTO tbl_countries VALUES("125","MACAO","Macao");
INSERT INTO tbl_countries VALUES("126","MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF","Macedonia, the Former Yugoslav Republic of");
INSERT INTO tbl_countries VALUES("127","MADAGASCAR","Madagascar");
INSERT INTO tbl_countries VALUES("128","MALAWI","Malawi");
INSERT INTO tbl_countries VALUES("129","MALAYSIA","Malaysia");
INSERT INTO tbl_countries VALUES("130","MALDIVES","Maldives");
INSERT INTO tbl_countries VALUES("131","MALI","Mali");
INSERT INTO tbl_countries VALUES("132","MALTA","Malta");
INSERT INTO tbl_countries VALUES("133","MARSHALL ISLANDS","Marshall Islands");
INSERT INTO tbl_countries VALUES("134","MARTINIQUE","Martinique");
INSERT INTO tbl_countries VALUES("135","MAURITANIA","Mauritania");
INSERT INTO tbl_countries VALUES("136","MAURITIUS","Mauritius");
INSERT INTO tbl_countries VALUES("137","MAYOTTE","Mayotte");
INSERT INTO tbl_countries VALUES("138","MEXICO","Mexico");
INSERT INTO tbl_countries VALUES("139","MICRONESIA, FEDERATED STATES OF","Micronesia, Federated States of");
INSERT INTO tbl_countries VALUES("140","MOLDOVA, REPUBLIC OF","Moldova, Republic of");
INSERT INTO tbl_countries VALUES("141","MONACO","Monaco");
INSERT INTO tbl_countries VALUES("142","MONGOLIA","Mongolia");
INSERT INTO tbl_countries VALUES("143","MONTSERRAT","Montserrat");
INSERT INTO tbl_countries VALUES("144","MOROCCO","Morocco");
INSERT INTO tbl_countries VALUES("145","MOZAMBIQUE","Mozambique");
INSERT INTO tbl_countries VALUES("146","MYANMAR","Myanmar");
INSERT INTO tbl_countries VALUES("147","NAMIBIA","Namibia");
INSERT INTO tbl_countries VALUES("148","NAURU","Nauru");
INSERT INTO tbl_countries VALUES("149","NEPAL","Nepal");
INSERT INTO tbl_countries VALUES("150","NETHERLANDS","Netherlands");
INSERT INTO tbl_countries VALUES("151","NETHERLANDS ANTILLES","Netherlands Antilles");
INSERT INTO tbl_countries VALUES("152","NEW CALEDONIA","New Caledonia");
INSERT INTO tbl_countries VALUES("153","NEW ZEALAND","New Zealand");
INSERT INTO tbl_countries VALUES("154","NICARAGUA","Nicaragua");
INSERT INTO tbl_countries VALUES("155","NIGER","Niger");
INSERT INTO tbl_countries VALUES("156","NIGERIA","Nigeria");
INSERT INTO tbl_countries VALUES("157","NIUE","Niue");
INSERT INTO tbl_countries VALUES("158","NORFOLK ISLAND","Norfolk Island");
INSERT INTO tbl_countries VALUES("159","NORTHERN MARIANA ISLANDS","Northern Mariana Islands");
INSERT INTO tbl_countries VALUES("160","NORWAY","Norway");
INSERT INTO tbl_countries VALUES("161","OMAN","Oman");
INSERT INTO tbl_countries VALUES("162","PAKISTAN","Pakistan");
INSERT INTO tbl_countries VALUES("163","PALAU","Palau");
INSERT INTO tbl_countries VALUES("164","PALESTINIAN TERRITORY, OCCUPIED","Palestinian Territory, Occupied");
INSERT INTO tbl_countries VALUES("165","PANAMA","Panama");
INSERT INTO tbl_countries VALUES("166","PAPUA NEW GUINEA","Papua New Guinea");
INSERT INTO tbl_countries VALUES("167","PARAGUAY","Paraguay");
INSERT INTO tbl_countries VALUES("168","PERU","Peru");
INSERT INTO tbl_countries VALUES("169","PHILIPPINES","Philippines");
INSERT INTO tbl_countries VALUES("170","PITCAIRN","Pitcairn");
INSERT INTO tbl_countries VALUES("171","POLAND","Poland");
INSERT INTO tbl_countries VALUES("172","PORTUGAL","Portugal");
INSERT INTO tbl_countries VALUES("173","PUERTO RICO","Puerto Rico");
INSERT INTO tbl_countries VALUES("174","QATAR","Qatar");
INSERT INTO tbl_countries VALUES("175","REUNION","Reunion");
INSERT INTO tbl_countries VALUES("176","ROMANIA","Romania");
INSERT INTO tbl_countries VALUES("177","RUSSIAN FEDERATION","Russian Federation");
INSERT INTO tbl_countries VALUES("178","RWANDA","Rwanda");
INSERT INTO tbl_countries VALUES("179","SAINT HELENA","Saint Helena");
INSERT INTO tbl_countries VALUES("180","SAINT KITTS AND NEVIS","Saint Kitts and Nevis");
INSERT INTO tbl_countries VALUES("181","SAINT LUCIA","Saint Lucia");
INSERT INTO tbl_countries VALUES("182","SAINT PIERRE AND MIQUELON","Saint Pierre and Miquelon");
INSERT INTO tbl_countries VALUES("183","SAINT VINCENT AND THE GRENADINES","Saint Vincent and the Grenadines");
INSERT INTO tbl_countries VALUES("184","SAMOA","Samoa");
INSERT INTO tbl_countries VALUES("185","SAN MARINO","San Marino");
INSERT INTO tbl_countries VALUES("186","SAO TOME AND PRINCIPE","Sao Tome and Principe");
INSERT INTO tbl_countries VALUES("187","SAUDI ARABIA","Saudi Arabia");
INSERT INTO tbl_countries VALUES("188","SENEGAL","Senegal");
INSERT INTO tbl_countries VALUES("189","SERBIA AND MONTENEGRO","Serbia and Montenegro");
INSERT INTO tbl_countries VALUES("190","SEYCHELLES","Seychelles");
INSERT INTO tbl_countries VALUES("191","SIERRA LEONE","Sierra Leone");
INSERT INTO tbl_countries VALUES("192","SINGAPORE","Singapore");
INSERT INTO tbl_countries VALUES("193","SLOVAKIA","Slovakia");
INSERT INTO tbl_countries VALUES("194","SLOVENIA","Slovenia");
INSERT INTO tbl_countries VALUES("195","SOLOMON ISLANDS","Solomon Islands");
INSERT INTO tbl_countries VALUES("196","SOMALIA","Somalia");
INSERT INTO tbl_countries VALUES("197","SOUTH AFRICA","South Africa");
INSERT INTO tbl_countries VALUES("198","SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS","South Georgia and the South Sandwich Islands");
INSERT INTO tbl_countries VALUES("199","SPAIN","Spain");
INSERT INTO tbl_countries VALUES("200","SRI LANKA","Sri Lanka");
INSERT INTO tbl_countries VALUES("201","SUDAN","Sudan");
INSERT INTO tbl_countries VALUES("202","SURINAME","Suriname");
INSERT INTO tbl_countries VALUES("203","SVALBARD AND JAN MAYEN","Svalbard and Jan Mayen");
INSERT INTO tbl_countries VALUES("204","SWAZILAND","Swaziland");
INSERT INTO tbl_countries VALUES("205","SWEDEN","Sweden");
INSERT INTO tbl_countries VALUES("206","SWITZERLAND","Switzerland");
INSERT INTO tbl_countries VALUES("207","SYRIAN ARAB REPUBLIC","Syrian Arab Republic");
INSERT INTO tbl_countries VALUES("208","TAIWAN, PROVINCE OF CHINA","Taiwan, Province of China");
INSERT INTO tbl_countries VALUES("209","TAJIKISTAN","Tajikistan");
INSERT INTO tbl_countries VALUES("210","TANZANIA, UNITED REPUBLIC OF","Tanzania, United Republic of");
INSERT INTO tbl_countries VALUES("211","THAILAND","Thailand");
INSERT INTO tbl_countries VALUES("212","TIMOR-LESTE","Timor-Leste");
INSERT INTO tbl_countries VALUES("213","TOGO","Togo");
INSERT INTO tbl_countries VALUES("214","TOKELAU","Tokelau");
INSERT INTO tbl_countries VALUES("215","TONGA","Tonga");
INSERT INTO tbl_countries VALUES("216","TRINIDAD AND TOBAGO","Trinidad and Tobago");
INSERT INTO tbl_countries VALUES("217","TUNISIA","Tunisia");
INSERT INTO tbl_countries VALUES("218","TURKEY","Turkey");
INSERT INTO tbl_countries VALUES("219","TURKMENISTAN","Turkmenistan");
INSERT INTO tbl_countries VALUES("220","TURKS AND CAICOS ISLANDS","Turks and Caicos Islands");
INSERT INTO tbl_countries VALUES("221","TUVALU","Tuvalu");
INSERT INTO tbl_countries VALUES("222","UGANDA","Uganda");
INSERT INTO tbl_countries VALUES("223","UKRAINE","Ukraine");
INSERT INTO tbl_countries VALUES("224","UNITED ARAB EMIRATES","United Arab Emirates");
INSERT INTO tbl_countries VALUES("225","UNITED KINGDOM","United Kingdom");
INSERT INTO tbl_countries VALUES("226","UNITED STATES","United States");
INSERT INTO tbl_countries VALUES("227","UNITED STATES MINOR OUTLYING ISLANDS","United States Minor Outlying Islands");
INSERT INTO tbl_countries VALUES("228","URUGUAY","Uruguay");
INSERT INTO tbl_countries VALUES("229","UZBEKISTAN","Uzbekistan");
INSERT INTO tbl_countries VALUES("230","VANUATU","Vanuatu");
INSERT INTO tbl_countries VALUES("231","VENEZUELA","Venezuela");
INSERT INTO tbl_countries VALUES("232","VIET NAM","Viet Nam");
INSERT INTO tbl_countries VALUES("233","VIRGIN ISLANDS, BRITISH","Virgin Islands, British");
INSERT INTO tbl_countries VALUES("234","VIRGIN ISLANDS, U.S.","Virgin Islands, U.s.");
INSERT INTO tbl_countries VALUES("235","WALLIS AND FUTUNA","Wallis and Futuna");
INSERT INTO tbl_countries VALUES("236","WESTERN SAHARA","Western Sahara");
INSERT INTO tbl_countries VALUES("237","YEMEN","Yemen");
INSERT INTO tbl_countries VALUES("238","ZAMBIA","Zambia");
INSERT INTO tbl_countries VALUES("239","ZIMBABWE","Zimbabwe");



DROP TABLE type;

CREATE TABLE `type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO type VALUES("1","Admin");
INSERT INTO type VALUES("2","Manufacturer");
INSERT INTO type VALUES("3","Retailer");
INSERT INTO type VALUES("4","Distributor");



DROP TABLE unit;

CREATE TABLE `unit` (
  `UNIT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UNIT_NAME` varchar(50) COLLATE utf8_bin NOT NULL,
  `UNIT_DESCRIPTION` varchar(255) COLLATE utf8_bin NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `CREATED_BY` varchar(55) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`UNIT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO unit VALUES("1","KG","Kilogram","2022-12-22 11:01 AM","1");
INSERT INTO unit VALUES("2","PCS","Pieces","2022-12-22 11:03 PM","1");
INSERT INTO unit VALUES("7","LTR","Litre","2022-12-22 06:50 PM","1");
INSERT INTO unit VALUES("12","PCKT","Packet","2023-01-12 22:46 AM","1");



DROP TABLE users;

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_NAME` varchar(50) NOT NULL,
  `L_NAME` varchar(50) NOT NULL,
  `GENDER_ID` int(12) DEFAULT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PHONE_NUMBER` varchar(12) NOT NULL,
  `STREET_ADDRESS` varchar(55) NOT NULL,
  `COMPANY_NAME` varchar(255) DEFAULT NULL,
  `STATE` varchar(255) DEFAULT NULL,
  `POSTCODE` varchar(55) DEFAULT NULL,
  `COUNTRY_ID` int(12) DEFAULT NULL,
  `VAT_NUMBER` varchar(255) DEFAULT NULL,
  `TERMS` varchar(4) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `IMAGE_PATH` varchar(55) NOT NULL,
  `TYPE_ID` int(11) DEFAULT NULL,
  `AREA_ID` int(12) DEFAULT NULL,
  `TSV` varchar(4) NOT NULL,
  `VERIFIED` varchar(4) NOT NULL,
  `CREATED_DATE` varchar(255) NOT NULL,
  `CREATED_BY` int(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `usertype` (`TYPE_ID`),
  KEY `area_ibfk_1` (`AREA_ID`),
  KEY `gender_ibfk_1` (`GENDER_ID`),
  KEY `country` (`COUNTRY_ID`),
  CONSTRAINT `area_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `area` (`ID`),
  CONSTRAINT `country` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `tbl_countries` (`ID`),
  CONSTRAINT `gender_ibfk_1` FOREIGN KEY (`GENDER_ID`) REFERENCES `gender_code` (`GENDER_ID`),
  CONSTRAINT `usertype` FOREIGN KEY (`TYPE_ID`) REFERENCES `type` (`TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","Admin","Account","1","janampandey2@gmail.com","9866077949","Malekhu, Dhading","","","","","","","admin","d033e22ae348aeb5660fc2140aec35850c4da997","Janam1.jpg","1","","N","1","2022-06-28 15:02 PM","0");
INSERT INTO users VALUES("34","Distributor","User","1","distributor@gmail.com","9823389283","Malekhu, Dhading","","","","","","","","","","4","","N","1","2022-12-22 06:03 PM","0");
INSERT INTO users VALUES("37","Kushal","Bhattarai","","kushalbhattarai277@gmail.com","9813074888","Putalisadak chowk","IT Business Service Pvt. Ltd","Bagmati","44600","149","16235512","Y","kushal","d033e22ae348aeb5660fc2140aec35850c4da997","","3","11","N","1","2023-01-11 10:54 AM","0");
INSERT INTO users VALUES("38","Dipak","Nyaupane","1","nyaupane04@gmail.com","9861939061","Nepaltar, Tarkeshwor, Kathmandu","","","","","","","","","","4","","N","1","2023-01-18 01:06 AM","0");
INSERT INTO users VALUES("39","Jeevan","Pandey","","zeeeone143k@gmail.com","98236168201","","","","","","","","jeevan","d033e22ae348aeb5660fc2140aec35850c4da997","","2","","N","1","2023-01-18 23:16 PM","0");
INSERT INTO users VALUES("40","Sanjay","Acharya","1","sanjay1234@gmail.com","2737623872","Dang","","","","","","","","","","4","","N","1","2023-01-20 11:04 AM","0");
INSERT INTO users VALUES("41","Prajwal ","Acharya","","prajwal@gmail.com","9861256121","Malekhu, Dhading","No company yet","Bagmati","44600","149","N/A","Y","prajwal","d033e22ae348aeb5660fc2140aec35850c4da997","Prajwal 41.jpg","3","32","N","1","2023-01-22 22:25 PM","0");
INSERT INTO users VALUES("43","Jack","Pandey","","jack@gmail.com","9823677112","","","","","","","","jack","d033e22ae348aeb5660fc2140aec35850c4da997","","2","","N","1","2023-01-28 21:58 PM","0");
INSERT INTO users VALUES("44","Sandhya","Adhikari","","sandhyaadhikari976@gmail.com","9841093320","Dang","","Bagmati","44600","149","","Y","sandhya","f3417c26b9118b41bb2ed053ef9003effc0de721","","3","11","Y","1","2023-01-28 22:33 PM","0");
INSERT INTO users VALUES("52","Janam","Pandey","","itbs.imerp3@gmail.com","9866077949","Balaju","","Bagmati","44600","149","","Y","itbsjanam","bd45e797b1c0faffc9292fbbae0cdb2367366cc1","","3","11","Y","1","2023-01-31 13:45 PM","0");



