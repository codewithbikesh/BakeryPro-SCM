<?php
    error_reporting(0);
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php 
if (($_SESSION['TYPE']=='3') OR ($_GET['id']==0)) { ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php }
         
	if (!isset($_GET['do']) || $_GET['do'] != 1) {
				
	 	$unitid = (isset($_GET['id']) ? $_GET['id'] : null);

    	$DELETE = 'DELETE FROM unit WHERE UNIT_ID = ' . $unitid;
		$RESULT = $SCA->SCA_EXECUTE($DELETE);

		if($RESULT=='1'){
			$_SESSION['success'] = 'Unit Deleted Successfully !';
?>
			
		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "unit.php";
            </script>
            
<?php
		}
		else{
			$_SESSION['error'] = 'Error occured.';
?>
			
		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "unit.php";
            </script>
            
<?php
		}
	}				

?>