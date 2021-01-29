<?php
@ob_start();
@session_start();

//require_once("../includes/config.php");
echo "<script>window.location = '/financeiro/view/login.php';</script>";
session_destroy();
?>