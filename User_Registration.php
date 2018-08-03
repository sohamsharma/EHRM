<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Email=mysql_real_escape_string($_POST["Email"]);
$Password=mysql_real_escape_string($_POST["Password"]);
$ConfirmPassword=mysql_real_escape_string($_POST["ConfirmPassword"]);
$Token=bin2hex(openssl_random_pseudo_bytes(40));
$Adhar=mysql_real_escape_string($_POST["Adhar"]);
if(empty($Username) || empty($Email) || empty($Password) || empty($Adhar) || empty($ConfirmPassword)){
	$_SESSION["ErrorMessage"]="All Fields must be filled";
	Redirect_to("User_Registration.php");

 }elseif ($Password!==$ConfirmPassword) {
 	$_SESSION["ErrorMessage"]="Both value should be same!!";
 	Redirect_to("User_Registration.php");
 }elseif (strlen($Password)<4) {
 	$_SESSION["ErrorMessage"]="Password should include atleast 4 values!!";
 	Redirect_to("User_Registration.php");
 }elseif (CheckEmailExitsOrNot($Email)) {
 	$_SESSION["ErrorMessage"]="Email already in use";
 	Redirect_to("User_Registration.php");
 }elseif (strlen($Adhar)<11) {
 	$_SESSION["ErrorMessage"]="AdharNumber should include atleast 12 values!!";
 	Redirect_to("User_Registration.php");
 }elseif (CheckAdhar($Adhar)) {
 	$_SESSION["ErrorMessage"]="Adhar Number already in use";
 	Redirect_to("User_Registration.php");
 }
 else{
 		global $ConnectingDB;
 		$Hashed_Password = Password_Encryption($Password);
 		$Query="INSERT INTO user_panel(username,email,password,token,active,adhar)VALUES('$Username','$Email','$Hashed_Password','$Token','OFF','$Adhar')";
 		$Execute=mysql_query($Query);
 		if($Execute){
			$subject="Confirm Account";
			      $body='Hi'.$Username.'Here is the link to confirm your account http://localhost/PHPCMS/Activate.php?token='.$Token;
			$Sender="From:joyrakesh09@gmail.com";
			if(mail($Email, $subject, $body, $Sender)){
	$_SESSION["SuccessMessage"]="Check Email for Activation";
 	Redirect_to("User_Login.php");
	}else{
		$_SESSION["ErrorMessage"]="Something Went Wrong";
 	Redirect_to("User_Login.php");
	}

 		}else{
 			$_SESSION["ErrorMessage"]="Error..Something Went Wrong!";
 	Redirect_to("User_Registration.php");
 		}
	}
}


?>


<!DOCTYPE>
<html>
	<head>
		<title>Register Now</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script scr="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/adminstyles.css">
		<style type="text/css">
			.FieldInfo{
				color: rgb(251, 174 , 44);
				font-family: Bitter,Georgia,"Times New Roman",Times,serif;
				font-size: 1.2em;
			}
		body{
			background-color: #ffffff;
		}

		</style>
	</head>
	<body>
		<div style="height: 10px; background: #27aae1;"></div>
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<!-- <button type="button" class="navbar-toogle collapsed" data-toggle="collapse" data-target="#collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>

					</button> -->
	<a class="navbar-brand" href="Blog.php"><img style="margin-top: -14px" src="images/img11.png" width="220" height="50";></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
		</div>
			</div>



		</nav>
		<div class="Line" style="height: 10px; background: #27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-sm-offset-4 col-sm-4">
					<br><br><br><br>
					<?php echo Message();
					echo SuccessMessage();
					?>
					<h2>Register Now !</h2>
						<div >
							<form action="User_Registration.php" method="Post">
								<fieldset>
									<div class="form-group">
										<label for="Username"><span class="FieldInfo">UserName:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-user text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Username" id="Username" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
										<label for="Adhar"><span class="FieldInfo">AadharNumber:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-star text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Adhar" id="Adhar" placeholder="AdharNumber">
									</div>
								</div>
									<label for="Email"><span class="FieldInfo">Email:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Email" id="Email" placeholder="Email">
									</div>
								</div>

								<div class="form-group">
									<label for="Password"><span class="FieldInfo">Password:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-lock text-primary"></span>
											</span>
									<input class="form-control"type="Password" name="Password" id="Password" placeholder="Password">
								</div>
								</div>
								<div class="form-group">
									<label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-lock text-primary"></span>
											</span>
									<input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
								</div>
								<!-- <div class="form-group">
									<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
									<input type="file" class="form-control" name="Image" id="imageselect">
								</div>
									<div class="form-group">
									<label for="postarea"><span class="FieldInfo">Health Info:</span></label>
									<textarea class="form-control" name="Post" id="postarea"></textarea>
								</div> -->
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit" value="Register">
								</fieldset>	


							</form>



						</div>
						
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->
		</div>
	</body>
</html>