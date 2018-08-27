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
					<ul  id="side_Menu" class="nav nav-pills nav-stacked">
						<li class="active"><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Manage Users</a></li>
						<!-- <li><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Record</a></li>
 -->						<!-- <li><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li> -->
						<li><a href="Admins.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Hospitals</a></li>
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
					<h1>Patient Details</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Sr No. </th>
								<th>User Name</th>
								<th>Password</th>
							</tr>
<?php
$ConnectingDB;
$ViewQuery="SELECT * FROM user_panel";
$Execute=mysql_query($ViewQuery);
$srNo=0;
while ($DataRows=mysql_fetch_array($Execute)) {
	$Username=$DataRows["username"];
	// $Category=$DataRows["category"];
	$Password=$DataRows["password"];
	$srNo++;
	?>
	<tr>
		<td><?php echo $srNo; ?></td>
		<td style="color: #5e5eff;"><?php
		echo $Username;
		 ?></td>
		<td>
			<?php
		 echo $Password; ?></td>
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