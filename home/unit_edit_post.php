<?php
  	include("../class/sca_function.php");
  	$SCA = new sca_function();
	include'session.php';
?>

<?php

if (($_POST['id']==0) OR ($_SESSION['TYPE']=='3')) { ?>

		    <script type="text/javascript">
                      //then it will be redirected
                      window.location = "index.php";
            </script>

<?php } if ($_POST['id']>0) {

		$unitid = (isset($_POST['id']) ? $_POST['id'] : null);
		$unitname = (isset($_POST['unitname']) ? $_POST['unitname'] : null);
		$unitdescription = (isset($_POST['unitdescription']) ? $_POST['unitdescription'] : null);
	   	
	 	$UPDATE = 'UPDATE unit set UNIT_NAME ="'.$unitname.'",
				  UNIT_DESCRIPTION ="'.$unitdescription.'" WHERE
				  UNIT_ID ="'.$unitid.'"';
		$RESULT = $SCA->SCA_EXECUTE($UPDATE);

		if ($RESULT=='1'){
				$_SESSION['success'] = 'Unit Updated Successfully !';
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

