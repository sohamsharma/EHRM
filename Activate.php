<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 
global $ConnectingDB;
if(isset($_GET['token'])){
	$TokenFromURL=$_GET['token'];
	$Query="UPDATE user_panel SET active='ON' WHERE token='TokenFromURL'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"]="Account Activated Successfully";
		Redirect_to("User_Login.php");
	}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong";
		Redirect_to("User_Login.php");
	}
}

?>