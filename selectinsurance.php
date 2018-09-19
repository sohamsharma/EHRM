<?php require_once("include/Sessions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if(isset($_GET['insuranceid'])){
    $IdFromURL=$_GET["insuranceid"];
    $Admin=$_SESSION["Username"];
    $ConnectingDB;
    $Query="UPDATE user_panel SET insurance='$IdFromURL' WHERE email='$Admin'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"]="Insurance Purchased!";
		Redirect_to("Pat_buyIns.php?id=($PostId)");
	}else{
		$_SESSION["ErrorMessage"]="Failed to purchase!";
		Redirect_to("Pat_buyIns.php?id=($PostId)");
	}
}

?>