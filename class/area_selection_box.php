<?php

    error_reporting(0);
    include 'connection.php';

    $BXID = strtoupper($TBID);
    if (strlen($LABEL_ID)==0) { $LABEL_ID = "Select"; } 
    if ($REQUIRED=="NONE") { $REQURIED=""; } else { $REQUIRED = "REQUIRED"; } 

    $QRY = "SELECT * FROM " . $TBID;

    $rsSharedList = mysqli_query($db, $QRY);

?>

<SELECT id="<?php print $BXID; ?>" name="<?php print $BXID; ?>" class="form-control" <?php print $REQUIRED; ?>>
<OPTION VALUE=""><?php print $LABEL_ID; ?></OPTION>
<?php

     while ($rowSharedList = mysqli_fetch_assoc($rsSharedList)) { 
		    $SHARED_ID = $rowSharedList['ID'];  
		    $SHARED_NAME = $rowSharedList['AREA_CODE'] . '-' . $rowSharedList['AREA_NAME'];

?>

<OPTION VALUE="<?php print $SHARED_ID; ?>"><?php print $SHARED_NAME; ?></OPTION>

<?php } ?>

</SELECT>