<?php
error_reporting(0);
include("../class/sca_function.php");
$SCA = new sca_function();
include'session.php';

?>

<?php 
                
if (($_SESSION['TYPE']=='2') OR ($_GET['id']==0) OR ($_SESSION['TYPE']=='3')){ ?>

			<script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php   }

	if (!isset($_GET['do']) || $_GET['do'] != 1) {
					
	 	$manufacturerid = (isset($_GET['id']) ? $_GET['id'] : null);

    	$DELETE = 'DELETE FROM users WHERE ID = ' . $manufacturerid;
		$RESULT = $SCA->SCA_EXECUTE($DELETE);

		if ($RESULT=='1'){
				$_SESSION['success'] = 'Manufacturer Deleted Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "manufacturer.php";
            </script>
            
<?php
		}
		else{
				$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "manufacturer.php";
            </script>
            
<?php
		}
	}			

?>
