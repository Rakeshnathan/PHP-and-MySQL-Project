<?php
//logging out of home page makes session user fresh --> login page
session_start();
session_unset();
session_destroy();
header("location:index.php");
?>
