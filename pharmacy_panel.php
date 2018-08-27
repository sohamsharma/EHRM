<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login4(); ?>
<?php
		$SrNo=mysql_real_escape_string(NULL);
        $Id=mysql_real_escape_string(NULL);
        $Aadhar=mysql_real_escape_string(NULL);
        $Name=mysql_real_escape_string(NULL);
        $Prescription=mysql_real_escape_string(NULL);
if(isset($_POST["Submit1"]))
{
	global $ConnectingDB;
	$Aadhar=mysql_real_escape_string($_POST["aadhar"]);	
	
	if(empty($Aadhar)){
		$_SESSION["ErrorMessage"]="All Fields must be filled";
		Redirect_to("pharmacy_panel.php");
	 }
	 else if(is_numeric($Aadhar)==0)
 {
	$_SESSION["ErrorMessage"]="Aadhar Number should be numeric!!";
	Redirect_to("pharmacy_panel.php");
	}
	else if (strlen($Aadhar)<13) {
		$_SESSION["ErrorMessage"]="Aadhar Number should include atleast 13 values!!";
		Redirect_to("pharmacy_panel.php");
 }
 else if (strlen($Aadhar)>13) {
	$_SESSION["ErrorMessage"]="Phone Number should include atleast 13 values!!";
	Redirect_to("pharmacy_panel.php");
}
 else{
    $SrNo=0;
	global $ConnectingDB;
	$ViewQuery="SELECT * FROM user_panel WHERE adhar='$Aadhar'";
	$Execute=mysql_query($ViewQuery);
	while($DataRows =mysql_fetch_array($Execute)) {
        $Id=mysql_real_escape_string($DataRows["id"]);
        $Aadhar=mysql_real_escape_string($DataRows["adhar"]);
        $Name=mysql_real_escape_string($DataRows["name"]);
        $Prescription=mysql_real_escape_string($DataRows["prescription"]);
        $SrNo++;
	}
}
}
?>


<!DOCTYPE>
<html>
	<head>
		<title>Manage Prescriptions</title>
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
						<li class="active"><a href="pharmacy_panel.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Prescriptions</a></li>
						<!-- <li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="pharmacy_logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10">
		<h1>Find Prescription</h1>
		<?php echo Message();
					echo SuccessMessage(); ?>
		<form action="pharmacy_panel.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">Aadhar No.:</span></label>
									<input class="form-control"type="text" name="aadhar" id="aadhar" placeholder="Aadhar No.">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit1" value="Search Prescription">
								</fieldset>
		</form>
						<br>
		<hr>
		<h1>View Prescription Data</h1>
		<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Aadhar No.</th>
									<th>Name</th>
									<th>Prescription</th>
								</tr>
<tr>
		<td><?php echo $SrNo; ?></td>
		<td><?php echo $Aadhar; ?></td>
        <td><?php echo $Name; ?></td>
        <td><?php echo $Prescription; ?></td>
</tr>
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