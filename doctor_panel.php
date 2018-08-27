<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login3(); ?>
<?php
if(isset($_POST["Submit"]))
{
	$Adhar=mysql_real_escape_string($_POST["adhar"]);	
	$Medical=mysql_real_escape_string($_POST["medical"]);
	$Current=mysql_real_escape_string($_POST["current"]);
	$Pres=mysql_real_escape_string($_POST["pres"]);
	$Admin=$_SESSION["Username"];
	if(empty($Adhar)){
		$_SESSION["ErrorMessage"]="All Fields must be filled";
		Redirect_to("doctor_panel.php");
	 }
	 else if(is_numeric($Adhar)==0)
 {
	$_SESSION["ErrorMessage"]="Aadhar Number should be numeric!!";
	Redirect_to("doctor_panel.php");
	}
	else if (strlen($Adhar)<13) {
		$_SESSION["ErrorMessage"]="Aadhar Number should include atleast 13 values!!";
		Redirect_to("doctor_panel.php");
 }
 else if (strlen($Adhar)>13) {
	$_SESSION["ErrorMessage"]="Phone Number should include atleast 13 values!!";
	Redirect_to("doctor_panel.php");
}
else{
	global $ConnectingDB;
	$ViewQuery="SELECT history FROM user_panel WHERE adhar='$Adhar'";
	$Execute=mysql_query($ViewQuery);
	while($DataRows =mysql_fetch_array($Execute)) {
		$His=mysql_real_escape_string($DataRows["history"]);
	}
	$Query="UPDATE user_panel SET history=CONCAT('$His',',','$Medical'), treatment='$Current', prescription='$Pres' WHERE adhar='$Adhar' && currentdoctor='$Admin'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Treatment Added Successfully";
		Redirect_to("doctor_panel.php");
	}else{
		$_SESSION["ErrorMessage"]="Treatment failed to add";
 	Redirect_to("doctor_panel.php");
	}
}
}	
if(isset($_POST["Submit1"]))
{
	global $ConnectingDB;
	$Admin=$_SESSION["Username"];
	$ViewQuery="SELECT addedby FROM doctors WHERE username='$Admin'";
	$Execute=mysql_query($ViewQuery);
	while($DataRows =mysql_fetch_array($Execute)) {
		$Hospital=$DataRows["addedby"];
	}


	$Aadhar=mysql_real_escape_string($_POST["aadhar"]);	
	
	if(empty($Aadhar)){
		$_SESSION["ErrorMessage"]="All Fields must be filled";
		Redirect_to("doctor_panel.php");
	 }
	 else if(is_numeric($Aadhar)==0)
 {
	$_SESSION["ErrorMessage"]="Aadhar Number should be numeric!!";
	Redirect_to("doctor_panel.php");
	}
	else if (strlen($Aadhar)<13) {
		$_SESSION["ErrorMessage"]="Aadhar Number should include atleast 13 values!!";
		Redirect_to("doctor_panel.php");
 }
 else if (strlen($Aadhar)>13) {
	$_SESSION["ErrorMessage"]="Phone Number should include atleast 13 values!!";
	Redirect_to("doctor_panel.php");
}
 else{
	global $ConnectingDB;
	$ViewQuery="SELECT currentdoctor FROM user_panel WHERE adhar='$Aadhar'";
	$Execute=mysql_query($ViewQuery);
	while($DataRows =mysql_fetch_array($Execute)) {
		$Hiss=mysql_real_escape_string($DataRows["currentdoctor"]);
	}
	if($Hiss==$Admin)
	{
		$_SESSION["SuccessMessage"] = "Patient Already Admitted!";
		Redirect_to("doctor_panel.php");
	}
	else{
	$Query="UPDATE user_panel SET currentdoctor='$Admin' WHERE adhar='$Aadhar' && admittedto='$Hospital'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Patient Added Successfully";
		Redirect_to("doctor_panel.php");
	}else{
		$_SESSION["ErrorMessage"]="Patient failed to add";
 	Redirect_to("doctor_panel.php");
	}
}
}
}
?>


<!DOCTYPE>
<html>
	<head>
		<title>Manage Patients</title>
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
						<li class="active"><a href="doctor_panel.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Patients</a></li>
						<!-- <li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="doctor_logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10">
		<h1>Operate Patient</h1>
		<?php echo Message();
					echo SuccessMessage(); ?>
		<form action="doctor_panel.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">Aadhar No.:</span></label>
									<input class="form-control"type="text" name="aadhar" id="aadhar" placeholder="Aadhar No.">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit1" value="Operate Patient">
								</fieldset>
		</form>
		<hr>
		<br>
		<h1>Treatment</h1>
		<form action="doctor_panel.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">Aadhar No.:</span></label>
									<input class="form-control"type="text" name="adhar" id="adhar" placeholder="Aadhar No.">
								</div>
								<br>
								<div class="form-group">
									<label for="Username"><span class="FieldInfo">Medical History:</span></label>
									<input class="form-control"type="text" name="medical" id="medical" placeholder="Medical History">
								</div>
								<br>
								<div class="form-group">
									<label for="Username"><span class="FieldInfo">Current Treatment:</span></label>
									<input class="form-control"type="text" name="current" id="current" placeholder="Current Treatment">
								</div>
								<br>
								<div class="form-group">
									<label for="Username"><span class="FieldInfo">Prescription:</span></label>
									<input class="form-control"type="text" name="pres" id="pres" placeholder="Prescription">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Submit Treatment">
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
									<th>Treatment</th>
									<th>Prescription</th>
								</tr>
								<?php
								global $ConnectingDB;
								$Id=$_SESSION["Username"];
								$ViewQuery="SELECT * FROM user_panel WHERE currentdoctor='$Id'";
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