<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login1(); ?>
<?php
if(isset($_POST["Submit1"]))
{
	$Aadhar=mysql_real_escape_string($_POST["aadhar"]);	
	$Admin=$_SESSION["Username"];
	if(empty($Aadhar)){
		$_SESSION["ErrorMessage"]="All Fields must be filled";
		Redirect_to("hospitals.php");
	 }
	 else if(is_numeric($Aadhar)==0)
 {
	$_SESSION["ErrorMessage"]="Aadhar Number should be numeric!!";
	Redirect_to("hospitals.php");
	}
	else if (strlen($Aadhar)<13) {
		$_SESSION["ErrorMessage"]="Aadhar Number should include atleast 13 values!!";
		Redirect_to("hospitals.php");
 }
 else if (strlen($Aadhar)>13) {
	$_SESSION["ErrorMessage"]="Phone Number should include atleast 13 values!!";
	Redirect_to("hospitals.php");
}
 else{
	global $ConnectingDB;
	$ViewQuery="SELECT admittedto FROM user_panel WHERE adhar='$Aadhar'";
	$Execute=mysql_query($ViewQuery);
	while($DataRows =mysql_fetch_array($Execute)) {
		$His=mysql_real_escape_string($DataRows["admittedto"]);
	}
	if($His==$Admin)
	{
		$_SESSION["SuccessMessage"] = "Patient Already Admitted!";
		Redirect_to("hospitals.php");
	}
	else{
	$Query="UPDATE user_panel SET admittedto='$Admin' WHERE adhar='$Aadhar'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Patient Admitted Successfully";
		Redirect_to("hospitals.php");
	}else{
		$_SESSION["ErrorMessage"]="Failed to Admit!";
 	Redirect_to("hospitals.php");
	}
}
}
}
if(isset($_POST["Submit"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Password=mysql_real_escape_string($_POST["Password"]);
$ConfirmPassword=mysql_real_escape_string($_POST["ConfirmPassword"]);
date_default_timezone_set("Asia/kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H-%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H-%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];

if(empty($Username || empty($Password) || empty($ConfirmPassword))){
	$_SESSION["ErrorMessage"]="All Fields must be filled";
	Redirect_to("hospitals.php");

 }
 elseif (CheckDoctorExitsOrNot($Username)) {
	$_SESSION["ErrorMessage"]="Username already in use";
	Redirect_to("hospitals.php");}
	
 elseif(strlen($Password)<4){
 	$_SESSION["ErrorMessage"]="Password should be atleast 4 characters";
 	Redirect_to("hospitals.php");

 }elseif($Password!==$ConfirmPassword){
 	$_SESSION["ErrorMessage"]="Password / ConfirmPassword does not match";
 	Redirect_to("hospitals.php");

 }
 else{
	global $ConnectingDB;
	$Query="INSERT INTO doctors(datetime,username,password,addedby)VALUES('$DateTime','$Username','$Password','$Admin')";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Doctor Added Successfully";
		Redirect_to("hospitals.php");
	}else{
		$_SESSION["ErrorMessage"]="Doctor failed to add";
 	Redirect_to("hospitals.php");
	}
}
}

?>


<!DOCTYPE>
<html>
	<head>
		<title>Manage</title>
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
	<a class="navbar-brand"><img style="margin-top: -14px" src="images/img11.png" width="220" height="50";></a>
				</div>
				<!-- <div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>
					<li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Features</a></li>
				</ul>
				<form action="Blog.php" class="navbar-form navbar-right">
					<div class="form-group">
					<input type="text" name="Search" class="form-control" placeholder="Search">
				</div>
				<button class="btn btn-default" name="SearchButton">Go</button>
			</form>
		</div> -->
			</div>



		</nav>
		<div class="Line" style="height: 10px; background: #27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<br>
					<br>
					<!-- <h1>Blocked Reviewer</h1> -->
					<ul  id="side_Menu" class="nav nav-pills nav-stacked"><!-- 
						<li><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Dashboard</a></li> -->
						<!-- <li><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Record</a></li> -->
						<!-- <li><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li> -->
						<li class="active"><a href="hospitals.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage</a></li>
						<!-- <li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="Logout_hospital.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10">
					<h1>Manage Doctors Access</h1>
					<?php echo Message();
					echo SuccessMessage();
					?>
						<div >
							<form action="hospitals.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">UserName:</span></label>
									<input class="form-control"type="text" name="Username" id="Username" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="Password"><span class="FieldInfo">Password:</span></label>
									<input class="form-control"type="Password" name="Password" id="Password" placeholder="Password">
								</div>
								<div class="form-group">
									<label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
									<input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Doctor">
								</fieldset>	


							</form>



						</div>
						<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Date & Time</th>
									<th>Doctor Name</th>
									<th>Added By</th>
									<th>Action</th>
								</tr>
								<?php
								global $ConnectingDB;
								$Admin=$_SESSION["Username"];
								$ViewQuery="SELECT * FROM doctors WHERE addedby='$Admin' ORDER BY datetime desc";
								$Execute=mysql_query($ViewQuery);
								$SrNo=0;
								while($DataRows =mysql_fetch_array($Execute)) {
									$Id=$DataRows["id"];
									$DateTime=$DataRows["datetime"];
									$Username=$DataRows["username"];
									$Admin=$DataRows["addedby"];
									$SrNo++;
?>
<tr>
		<td><?php echo $SrNo; ?></td>
		<td><?php echo $DateTime; ?></td>
		<td><?php echo $Username; ?></td>
		<td><?php echo $Admin; ?></td>
		<td><a href="DeleteDoctor.php?id=<?php echo $Id; ?>">
			<span class="btn btn-danger">Delete</span></a></td>
</tr>

							<?php } ?>
							</table>
						</div> 
						<br>
		<hr>
		<h1>Admit Patient</h1>
		<form action="hospitals.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">Aadhar No.:</span></label>
									<input class="form-control"type="text" name="aadhar" id="aadhar" placeholder="Aadhar No.">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit1" value="Admit Patient">
								</fieldset>
		</form>
		<br>
		<hr>
		<h1>View Patient Data</h1>
		<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Username</th>
									<th>Email</th>
									<th>Aadhar No.</th>
									<th>Name</th>
									<th>Phone No.</th>
									<th>DOB</th>
									<th>Gender</th>
									<th>Address</th>
									<th>Medical History</th>
									<th>Insurance</th>
									<th>Doctor</th>
									<th>Treatment</th>
									<th>Prescription</th>
								</tr>
								<?php
								global $ConnectingDB;
								$Id=$_SESSION["Username"];
								$ViewQuery="SELECT * FROM user_panel WHERE admittedto='$Id'";
								$Execute=mysql_query($ViewQuery);
								$SrNo=0;
								while($DataRows =mysql_fetch_array($Execute)) {
									$Id=$DataRows["id"];
									$Username=$DataRows["username"];
									$Email=$DataRows["email"];
									$Aadhar=$DataRows["adhar"];
									$Name=$DataRows["name"];
									$Phone=$DataRows["phone"];
									$Dob=$DataRows["dob"];
									$Gender=$DataRows["gender"];
									$Address=$DataRows["address"];
									$History=$DataRows["history"];
									$Insurance=$DataRows["insurance"];
									$Doctor=$DataRows["currentdoctor"];
									$Treatment=$DataRows["treatment"];
									$Prescription=$DataRows["prescription"];
									$SrNo++;
?>
<tr>
		<td><?php echo $SrNo; ?></td>
		<td><?php echo $Username; ?></td>
		<td><?php echo $Email; ?></td>
		<td><?php echo $Aadhar; ?></td>
		<td><?php echo $Name; ?></td>
		<td><?php echo $Phone; ?></td>
		<td><?php echo $Dob; ?></td>
		<td><?php echo $Gender; ?></td>
		<td><?php echo $Address; ?></td>
		<td><?php echo $History; ?></td>
		<td><?php echo $Insurance; ?></td>
		<td><?php echo $Doctor; ?></td>
		<td><?php echo $Treatment; ?></td>
		<td><?php echo $Prescription; ?></td>
</tr>

							<?php } ?>
							</table>
						</div> 
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->

		<div id="Footer">
			<hr><p>Electronic Health Record Managment |  EHRM  | &copy;2018-2020 ---- All Rights Reserved.</p>
			<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;">
				<p>
					This is a site for managing health records.
				</p>
			</a>
		</div>
		<div style="height: 10px; background: #27AAE1;"></div>
		</div>
	</body>
</html>