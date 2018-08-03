<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Title=mysql_real_escape_string($_POST["Title"]);
$Category=mysql_real_escape_string($_POST["Category"]);
$Post=mysql_real_escape_string($_POST["Post"]);
date_default_timezone_set("Asia/kolkata");
$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H-%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H-%M:%S",$CurrentTime);
$DateTime;
$Admin="JOY";
$Image=$_FILES["Image"]["name"];
$Target="‪Uploads/".basename($_FILES["Image"]["name"]);
if(isset($_POST['Submit'])){
	$filetmp = $_FILES["Image"]["tmp_name"];
	$filename = $_FILES["Image"]["name"];
	$filetype = $_FILES["Image"]["type"];
	$filepath = "Upload/".$filename;

	

}
if(empty($Title)){
	$_SESSION["ErrorMessage"]="Title must be filled";
	Redirect_to("AddNewPost.php");

 }elseif(strlen($Category)<2){
 	$_SESSION["ErrorMessage"]="Title should be at-least 2 characters";
 	Redirect_to("AddNewPost.php");

 }else{
	global $ConnectingDB;
	$EditFromURL=$_GET['Edit'];
	$Query="UPDATE admin_panel SET datetime='$DateTime', title='$Title', category='$Category', author='$Admin', image='$Image',post='$Post' WHERE id='$EditFromURL' ";
	$Execute=mysql_query($Query);
	move_uploaded_file($_FILES["Image"]["temp_name"],$Target);
	 move_uploaded_file($filetmp, $filepath);

	if($Execute){
		$_SESSION["SuccessMessage"] = "Post Updated Successfully";
		Redirect_to("Dashboard.php");
	}else{
		$_SESSION["ErrorMessage"]="Failed to add";
 	Redirect_to("Dashboard.php");
	}
}
}

?>


<!DOCTYPE>
<html>
	<head>
		<title>Edit Post</title>
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
						<!-- <li class="active"><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Record</a></li> -->
						<!-- <li ><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li> -->
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
					<h1>Update Post</h1>
					<?php echo Message();
					echo SuccessMessage();
					?>
						<div >
							<?php 
							$SearchQueryParameter=$_GET['Edit'];
							$ConnectingDB;
							$Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
							$ExecuteQuery=mysql_query($Query);
							while ($DataRows=mysql_fetch_array($ExecuteQuery)) {
								$TitleToBeUpdated=$DataRows['title'];
								$CategoryToBeUpdated=$DataRows['category'];
								$ImageToBeUpdated=$DataRows['image'];
								$PostToBeUpdated=$DataRows['post'];
							}

							?>
							<form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
								<fieldset>
									<div class="form-group">
									<label for="title"><span class="FieldInfo">Title:</span></label>
									<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="categoryname" placeholder="Title">
								</div>
								<div class="form-group">
									<span class="FieldInfo">Existing Category:</span>
									<?php echo $CategoryToBeUpdated; ?>
									<br>
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
								</div>
								<div class="form-group">
									<span class="FieldInfo">Existing Image:</span>
									<img src="Upload/<?php echo $ImageToBeUpdated; ?>" width="170px;" height="50px";> 
									<br>
									<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
									<input type="file" class="form-control" name="Image" id="imageselect">

									<div class="form-group">
									<label for="postarea"><span class="FieldInfo">Post:</span></label>
									<textarea class="form-control" name="Post" id="postarea">
										<?php echo "$PostToBeUpdated"; ?>
									</textarea>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">
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
			<hr><p>BLOCKED REVIEWER |  JOY RAKESH  | &copy;2018-2020 ---- All Rights Reserved.</p>
			<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;">
				<p>
					This is a site for reviewing products.
				</p>
			</a>
		</div>
		<div style="height: 10px; background: #27AAE1;"></div>
		</div>
	</body>
</html>