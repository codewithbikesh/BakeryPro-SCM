<?php

session_start();

// 2. Unset all the session variables
unset($_SESSION['MEMBER_ID']);
unset($_SESSION['FIRST_NAME']);
unset($_SESSION['LAST_NAME']);
unset($_SESSION['GENDER_ID']);
unset($_SESSION['EMAIL']);
unset($_SESSION['USERNAME']);
unset($_SESSION['PHONE_NUMBER']);
unset($_SESSION['JOB_TITLE']);
unset($_SESSION['ADDRESS']);
unset($_SESSION['TYPE']);
?>
<script type="text/javascript">
    window.location = "../index.php";
</script>