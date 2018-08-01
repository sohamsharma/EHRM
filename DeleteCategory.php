<?php require_once("include/Sessions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if(isset($_GET['id'])){
	$IdFromURL=$_GET["id"];
	$ConnectingDB;
	$Query="DELETE FROM category WHERE id='$IdFromURL' ";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"]="Category Deleted Successfully";
		Redirect_to("Categories.php?id=($PostId)");
	}else{
		$_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
		Redirect_to("Categories.php?id=($PostId)");
	}
}

?>