<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<!-- <?php Confirm_Login(); ?> -->
<?php
if(isset($_POST["Submit"])){
$Title=mysql_real_escape_string($_POST["Title"]);
$Adhar=mysql_real_escape_string($_POST["Adhar"]);
$Phone=mysql_real_escape_string($_POST["Phone"]);
$Dob=mysql_real_escape_string($_POST["Dob"]);
$Gender=mysql_real_escape_string($_POST["Gender"]);
$Address=mysql_real_escape_string($_POST["Address"]);
//$Category=mysql_real_escape_string($_POST["Category"]);
$Post=mysql_real_escape_string($_POST["Post"]);
date_default_timezone_set("Asia/kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H-%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H-%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];

$Image=$_FILES["Image"]["name"];
$Target="‪Uploads/".basename($_FILES["Image"]["name"]);
if(isset($_POST['Submit'])){
	$filetmp = $_FILES["Image"]["tmp_name"];
	$filename = $_FILES["Image"]["name"];
	$filetype = $_FILES["Image"]["type"];
	$filepath = "Upload/".$filename;

	

}
if(empty($Title) || empty($Adhar) || empty($Phone) || empty($Dob) || empty($Gender) || empty($Address)){
	$_SESSION["ErrorMessage"]="All fields must be filled";
	Redirect_to("AddNewPost.php");

 }elseif(strlen($Phone)<10){
 	$_SESSION["ErrorMessage"]="Phone should be at-least 10 characters";
 	Redirect_to("AddNewPost.php");

 }elseif(strlen($Adhar)<11){
 	$_SESSION["ErrorMessage"]="Adhar Number should be at-least 12 characters";
 	Redirect_to("AddNewPost.php");

 }else{
	global $ConnectingDB;
	$Query="INSERT INTO admin_panel(author,image,post,datetime,title,category,adhar,phone,dob,gender,address) VALUES('$Admin','$Image','$Post','$DateTime','$Title','$Category','$Adhar','$Phone','$Dob','$Gender','$Address')";
	$Execute=mysql_query($Query);
	move_uploaded_file($_FILES["Image"]["temp_name"],$Target);
	 move_uploaded_file($filetmp, $filepath);

	if($Execute){
		$_SESSION["SuccessMessage"] = "Record Added Successfully";
		Redirect_to("index.php");
	}else{
		$_SESSION["ErrorMessage"]="Failed to add";
 	Redirect_to("AddNewPost.php");
	}
}
}

?>


<!DOCTYPE>
<html>
	<head>
		<title>Add Patients Details</title>
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
				<!-- <div class="col-sm-2">
					<h1>Blocked Reviewer</h1> 
					<ul  id="side_Menu" class="nav nav-pills nav-stacked">
						<li><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Dashboard</a></li>
						<li class="active"><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Post</a></li>
						<li ><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li>
						<li><a href="Admins.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Admins</a></li>
						<li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li>
						<li><a href="Logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div> ENDING OF SIDE -->
				<div class="col-sm-offset-4 col-sm-4">
					<h1>Enter the Patients Details</h1>
					<?php echo Message();
					echo SuccessMessage();
					?>
						<div >
							<form action="AddNewPost.php" method="Post" enctype="multipart/form-data">
								<fieldset>
									<div class="form-group">
									<label for="title"><span class="FieldInfo">Name:</span></label>
									<input class="form-control" type="text" name="Title" id="categoryname" placeholder="Name">
								</div>
								<div class="form-group">
									<label for="title"><span class="FieldInfo">Aadhaar Number:</span></label>
									<input class="form-control" type="text" name="Adhar" id="adhar" placeholder="Adhar No">
								</div>
								<div class="form-group">
									<label for="title"><span class="FieldInfo">Phone Number:</span></label>
									<input class="form-control" type="text" name="Phone" id="phone" placeholder="Phone No">
								</div>
								<div class="form-group">
									<label for="title"><span class="FieldInfo">Date Of Birth:</span></label>
									<input class="form-control" type="date" name="Dob" id="dob" placeholder="Date Of Birth">
								</div>
								<div class="form-group">
									<label for="title"><span class="FieldInfo">Gender:</span></label>
									<select class="element select medium" id="gender" name="Gender" required> 
									<option value="" selected="selected"></option>
									<option value="1" >Male</option>
									<option value="2" >Female</option>
									<option value="3" >Third Gender</option>

									</select>
								</div>
								<div class="form-group">
									<label for="title"><span class="FieldInfo">Address</span></label>
									<input class="form-control" type="text" name="Address" id="address" placeholder="Address">
								</div>

								<!-- <div class="form-group">
									<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
									<select class="form-control" id="categoryselect" name="Category">
								<?php
								global $ConnectingDB;
								$ViewQuery="SELECT * FROM category ORDER BY datatime desc";
								$Execute=mysql_query($ViewQuery);
								while($DataRows =mysql_fetch_array($Execute)) {
									$Id=$DataRows["id"];
									$CategoryName=$DataRows["name"];	
								?>
								<option><?php echo $CategoryName; ?></option>
								<?php } ?>
								</select>
								</div> -->
								<div class="form-group">
									<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
									<input type="file" class="form-control" name="Image" id="imageselect">

									<div class="form-group">
									<label for="postarea"><span class="FieldInfo">Medical Record:</span></label>
									<textarea class="form-control" name="Post" id="postarea"></textarea>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Submit">
								</fieldset>	


							</form>



						</div>
						<!-- <div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Date & Time</th>
									<th>Category Name</th>
									<th>Creator Name</th>
								</tr>
 -->

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