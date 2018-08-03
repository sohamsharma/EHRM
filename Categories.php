<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Category=mysql_real_escape_string($_POST["Category"]);
date_default_timezone_set("Asia/kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H-%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H-%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];

if(empty($Category)){
	$_SESSION["ErrorMessage"]="All Fields must be filled";
	Redirect_to("Categories.php");

 }elseif(strlen($Category)>99){
 	$_SESSION["ErrorMessage"]="Too Long Name";
 	Redirect_to("Categories.php");

 }else{
	global $ConnectingDB;
	$Query="INSERT INTO category(datatime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Category Added Successfully";
		Redirect_to("Categories.php");
	}else{
		$_SESSION["ErrorMessage"]="Category failed to add";
 	Redirect_to("Categories.php");
	}
}
}

?>


<!DOCTYPE>
<html>
	<head>
		<title>Admin Dashboard</title>
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
				<div class="col-sm-2">
					<br>
					<br>
					<!-- <h1>Blocked Reviewer</h1> -->
					<ul  id="side_Menu" class="nav nav-pills nav-stacked">
						<li><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Dashboard</a></li>
						<!-- <li><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Record</a></li> -->
						<li class="active"><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li>
						<li><a href="Admins.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Admins</a></li>
						<!-- <li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="Logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10">
					<h1>Manage Categories</h1>
					<?php echo Message();
					echo SuccessMessage();
					?>
						<div >
							<form action="Categories.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="categoryname"><span class="FieldInfo">Name:</span></label>
									<input class="form-control"type="text" name="Category" id="categoryname" placeholder="Name">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
								</fieldset>	


							</form>



						</div>
						<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Date & Time</th>
									<th>Category Name</th>
									<th>Creator Name</th>
									<th>Action</th>
								</tr>
								<?php
								global $ConnectingDB;
								$ViewQuery="SELECT * FROM category ORDER BY datatime desc";
								$Execute=mysql_query($ViewQuery);
								$SrNo=0;
								while($DataRows =mysql_fetch_array($Execute)) {
									$Id=$DataRows["id"];
									$DateTime=$DataRows["datatime"];
									$CategoryName=$DataRows["name"];
									$CreatorName=$DataRows["creatorname"];
									$SrNo++;
?>
<tr>
		<td><?php echo $SrNo; ?></td>
		<td><?php echo $DateTime; ?></td>
		<td><?php echo $CategoryName; ?></td>
		<td><?php echo $CreatorName; ?></td>
		<td><a href="DeleteCategory.php?id=<?php echo $Id; ?>">
			<span class="btn btn-danger">Delete</span></a></td>
</tr>

							<?php } ?>
							</table>
						</div> 
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->
		<br>
					<br>
					<br>
					<br>
					<br>
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