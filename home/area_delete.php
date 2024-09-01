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

<?php } if ($_GET['id']>0) {

	 $areaid = (isset($_GET['id']) ? $_GET['id'] : null);

     $DELETE = 'DELETE FROM area WHERE ID = "'.$areaid.'"';
	 $RESULT = $SCA->SCA_EXECUTE($DELETE);

	 if ($RESULT=='1'){
	 	$_SESSION['success'] = 'Area Deleted Successfully !';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>
            
<?php
	 }
	 else{
	 	$_SESSION['error'] = 'Error occured.';
?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "area.php";
            </script>
            
<?php
	 }		
}	

?>