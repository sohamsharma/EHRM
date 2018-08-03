<?php require_once("include/Sessions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<!DOCTYPE>
<html>
	<head>
		<title>Admin Dashboard</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script scr="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/adminstyles.css">
		<style type="text/css">
			.navbar-nav li{
	font-weight: bold;
	font-family: Bitter,Georgia,Times,"Times New Roman",serif;
	font-size: 1.2em;
}

.Line{
	margin-top: -20px;
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
					<ul  id="side_Menu" class="nav nav-pills nav-stacked">
						<li class="active"><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Dashboard</a></li>
						<!-- <li><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Record</a></li>
 -->						<!-- <li><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li> -->
						<li><a href="Admins.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Admins</a></li>
						<!-- <li><a href="#">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments
						<?php
			$ConnectingDB;
			$QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
			$ExecuteTotal=mysql_query($QueryTotal);
			$RowsTotal=mysql_fetch_array($ExecuteTotal);
			$Total=array_shift($RowsTotal);
			if($Total>0){
			?>
			<span class="label pull-right label-warning">
			<?php echo $Total;?>

			</span>

		<?php } ?>
					</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="Logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10"><!-- Main -->
					<div><?php echo Message();
					echo SuccessMessage(); ?></div>
					<h1>Patients Details</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Date &Time</th>
								<!-- <th>Admin</th> -->
								<!-- <th>Category</th> -->
								<th>Image</th>
								<!-- <th>Comments</th> -->
								<th>Action</th>
								<!-- <th>Details</th> -->
							</tr>
<?php
$ConnectingDB;
$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc;";
$Execute=mysql_query($ViewQuery);
$srNo=0;
while ($DataRows=mysql_fetch_array($Execute)) {
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$Title=$DataRows["title"];
	// $Category=$DataRows["category"];
	$Admin=$DataRows["author"];
	$Image=$DataRows["image"];
	$Post=$DataRows["post"];
	$srNo++;
	?>
	<tr>
		<td><?php echo $srNo; ?></td>
		<td style="color: #5e5eff;"><?php
		if(strlen($Title)>20){$Title=substr($Title,0,20).'..';} 
		echo $Title;
		 ?></td>
		<td>
			<?php
		if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,11).'..';}
		 echo $DateTime; ?></td>
		<!-- <td>
			<?php
		if(strlen($Admin)>6){$Admin=substr($Admin,0,6).'..';}
		 echo $Admin; ?></td> -->
		<!-- <td><?php 
		if(strlen($Category)>8){$Category=substr($Category,0,15);}
		echo $Category; ?></td> -->
		<td><img src="Upload/<?php echo $Image; ?>" width="170px;" height="50px;"></td>
		<!-- <td>
			<?php
			$ConnectingDB;
			$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
			$ExecuteApproved=mysql_query($QueryApproved);
			$RowsApproved=mysql_fetch_array($ExecuteApproved);
			$TotalApproved=array_shift($RowsApproved);
			if($TotalApproved>0){
			?>
			<span class="label pull-right label-success">
			<?php echo $TotalApproved;?>

			</span>

		<?php } ?>
		<?php
			$ConnectingDB;
			$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
			$ExecuteUnApproved=mysql_query($QueryUnApproved);
			$RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
			$TotalUnApproved=array_shift($RowsUnApproved);
			if($TotalUnApproved>0){
			?>
			<span class="label label-danger">
			<?php echo $TotalUnApproved;?>

			</span>

		<?php } ?>
		</td> -->
		<td>
		<!-- <a href="EditPost.php?Edit=<?php echo $Id; ?>">
		<span class="btn btn-warning">	Edit</span></a>  -->
		<a href="DeletePost.php?Delete=<?php echo $Id; ?>"><span class="btn btn-danger">	Delete</span></a>
	</td>
		<!-- <td><a href="Post.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></td> -->
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
					<br>
					<br>
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