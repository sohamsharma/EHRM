<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php 
$_SESSION["User_Id"]=null;
session_destroy();
Redirect_to("Login.php");
?>