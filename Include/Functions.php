<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php
function Redirect_to($New_Location){
	header("Location:".$New_Location);
	exit;
}
function Login_Attempt($Username,$Password){
	$ConnectingDB;
	$Query="SELECT * FROM registration WHERE username='$Username' AND password='$Password'";
	$Execute=mysql_query($Query);
	if($admin=mysql_fetch_assoc($Execute)){
		return $admin;
	}else{
		return null;
	}
}
function Login(){
	if(isset($_SESSION['User_Id'])){
		return true;
	}
}
function Login1(){
	if(isset($_SESSION["Username"])){
		return true;
	}
}
function Login2(){
	if(isset($_SESSION["Username"])){
		return true;
	}
}
function Login3(){
	if(isset($_SESSION["Username"])){
		return true;
	}
}
function Login4(){
	if(isset($_SESSION["Username"])){
		return true;
	}
}
function Confirm_Login(){
	if(!Login()){
		Redirect_to("Login.php");
	}
}
function Confirm_Login1(){
	if(!Login1()){
		Redirect_to("hospitals.php");
	}
}
function Confirm_Login2(){
	if(!Login2()){
		Redirect_to("Patient_Mod.php");
	}
}
function Confirm_Login3(){
	if(!Login3()){
		Redirect_to("doctor_panel.php");
	}
}
function Confirm_Login4(){
	if(!Login4()){
		Redirect_to("pharmacy_panel.php");
	}
}
function CheckEmailExitsOrNot($Email){
	global $ConnectingDB;
	$Query="SELECT * FROM user_panel WHERE email='$Email'";
	$Execute=mysql_query($Query);
	if(mysql_num_rows($Execute)>0){
		return true;
	}else{
		return false;
	}
}
function CheckHospitalExitsOrNot($Username){
	global $ConnectingDB;
	$Query="SELECT * FROM hospitallogin WHERE username='$Username'";
	$Execute=mysql_query($Query);
	if(mysql_num_rows($Execute)>0){
		return true;
	}else{
		return false;
	}
}
function CheckDoctorExitsOrNot($Username){
	global $ConnectingDB;
	$Query="SELECT * FROM doctors WHERE username='$Username'";
	$Execute=mysql_query($Query);
	if(mysql_num_rows($Execute)>0){
		return true;
	}else{
		return false;
	}
}
function CheckAdhar($Adhar){
	global $ConnectingDB;
	$Query="SELECT * FROM user_panel WHERE adhar='$Adhar'";
	$Execute=mysql_query($Query);
	if(mysql_num_rows($Execute)>0){
		return true;
	}else{
		return false;
	}
}
function Password_Encryption($Password){
	$BlowFish_Hash_Format = "$2y$10$";
	$Salt_Length = 22;
	$Salt  = Generate_Salt($Salt_Length);
	$Formating_BlowFish_With_Salt = $BlowFish_Hash_Format . $Salt;
	$Hash = crypt($Password, $Formating_BlowFish_With_Salt);
	return $Hash;
}

function Password_Check($Password, $Existing_Hash){
	$Hash= crypt($Password, $Existing_Hash);
	if($Hash === $Existing_Hash){
		return true;
	} else {
		return false;
	}
}



function Generate_Salt($length){
	$Unique_Random_String = md5(uniqid(mt_rand(),true));
	$Base64_String = base64_encode($Unique_Random_String);
	$Modified_Base64_String = str_replace('+', '.', $Base64_String);
	$Salt=substr($Modified_Base64_String, 0, $length);
	return $Salt;
}

function Login_Attempts($Email,$Password){
	$Query="SELECT * FROM user_panel WHERE email='$Email'";
	$Execute=mysql_query($Query);
	if($admin=mysql_fetch_assoc($Execute)){
		if(Password_Check($Password,$admin["password"])){
			return $admin;
		}
		}else
		return null;
}
function ConfirmingAccountActiveStatus(){
	global $ConnectingDB;
	$Query="SELECT * FROM user_panel WHERE token!='NULL'";
	$Execute=mysql_query($Query);
	if(mysql_num_rows($Execute)>0){
		return true;
	}else{
		return false;
	}

}

?>