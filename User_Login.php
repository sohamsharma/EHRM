<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Email=mysql_real_escape_string($_POST["Email"]);
$Password=mysql_real_escape_string($_POST["Password"]);
if(empty($Email) || empty($Password)){
	$_SESSION["ErrorMessage"]="All Fields must be filled";
	Redirect_to("User_Login.php");

 }
 else{
 		if(ConfirmingAccountActiveStatus()){
 		$Found_Account=Login_Attempts($Email,$Password);
 		if($Found_Account){
 		Redirect_to("AddNewPost.php");	
 		}else{
 		$_SESSION["ErrorMessage"]="Invalid Email / Password";
	Redirect_to("User_Login.php");
	
 		}
 		}else{
 			$_SESSION["ErrorMessage"]="Account Conformation Required";
	Redirect_to("User_Login.php");
 		}
 		}
	}



?>


<!DOCTYPE>
<html>
	<head>
		<title>Sign-In</title>
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
					<h2>Sign-In Now !</h2>
						<div >
							<form action="User_Login.php" method="Post">
								<fieldset>
									<div class="form-group">
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
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit" value="Submit">
								</fieldset>	


							</form>



						</div>
						
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->
		</div>
	</body>
</html>