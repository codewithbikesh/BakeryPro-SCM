<?php
error_reporting(0);
include'../class/connection.php';
include'../libraries/sidebar.php';

if(isset($_POST['backup'])){

$tables = array();
$result = mysqli_query($db,"SHOW TABLES");
while($row = mysqli_fetch_row($result)){
  $tables[] = $row[0];
}
$return = '';
foreach($tables as $table){
  $result = mysqli_query($db,"SELECT * FROM ".$table);
  $num_fields = mysqli_num_fields($result);
  
  $return .= 'DROP TABLE '.$table.';';
  $row2 = mysqli_fetch_row(mysqli_query($db,"SHOW CREATE TABLE ".$table));
  $return .= "\n\n".$row2[1].";\n\n";
  
  for($i=0;$i<$num_fields;$i++){
    while($row = mysqli_fetch_row($result)){
      $return .= "INSERT INTO ".$table." VALUES(";
      for($j=0;$j<$num_fields;$j++){
        $row[$j] = addslashes($row[$j]);
        if(isset($row[$j])){ $return .= '"'.$row[$j].'"';}
        else{ $return .= '""';}
        if($j<$num_fields-1){ $return .= ',';}
      }
      $return .= ");\n";
    }
  }
  $return .= "\n\n\n";
}
//save file
$handle = fopen("../database/data_backup.sql","w+");
fwrite($handle,$return);
fclose($handle);
$_SESSION['success'] = "Backup Created Successfully";

}

if(isset($_POST['restore'])){

if (file_exists('../database/data_backup.sql')) {
$filename = '../database/data_backup.sql';
$handle = fopen($filename,"r+");
$contents = fread($handle,filesize($filename));
$sql = explode(';',$contents);
foreach($sql as $query){
  $result = mysqli_query($db,$query);
  if($result){
    $_SESSION['success'] = "Database restored successfully";
  }
}
fclose($handle);
print $result;
}else{
    $_SESSION['error'] = "Uh Oh! No backup file found on the current directory!";
}

}

?>

<?php

  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='alert alert-success alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['success']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['success']);
  		}

  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='alert alert-danger alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['error']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
	
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="index.php">Dashboard</a>
</li>
<li class="breadcrumb-item active">Data Privacy</li>
</ol>

            <center>
		<div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Data Backup and Restore</h4>
            </div>


		<form action="" method="POST" class="form">
            <div class="card-body">

			<button name="backup" class="btn btn-primary">
            	Backup
        	</button>
        	<button name="restore" class="btn btn-success">
            	Restore
        	</button>

			</div>
		</form>
		</div>


<?php
include'../libraries/footer.php';
?>
