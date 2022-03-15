<?php
$logout=false;
session_start();
session_unset();
session_destroy();
$logout=true;
header("location:login.php");
?>