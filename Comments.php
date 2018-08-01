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
	<a class="navbar-brand" href="Blog.php"><img style="margin-top: -14px" src="images/img1.png" width="220" height="50";></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
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
		</div>
			</div>



		</nav>
		<div class="Line" style="height: 10px; background: #27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<br>
					<br>
					<ul  id="side_Menu" class="nav nav-pills nav-stacked">
						<li><a href="Dashboard.php">
							<span class="glyphicon glyphicon-th"></span>
						&nbsp;Dashboard</a></li>
						<li><a href="AddNewPost.php">
							<span class="glyphicon glyphicon-list-alt"></span>
						&nbsp;Add New Post</a></li>
						<li><a href="Categories.php">
							<span class="glyphicon glyphicon-tags"></span>
						&nbsp;Categories</a></li>
						<li><a href="Admins.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Admins</a></li>
						<li class="active"><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li>
						<li><a href="Logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10"><!-- Main -->
					<div><?php echo Message();
					echo SuccessMessage(); ?></div>
					<h1>Un-Approved Comments</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Date</th>
								<th>Comment</th>
								<th>Approve</th>
								<th>Delete Comment</th>
								<th>Details</th>
							</tr>
							<?php
							$ConnectingDB;
							$Query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
							$Execute=mysql_query($Query);
							$SrNo=0;
							while($DataRows=mysql_fetch_array($Execute)) {
								$CommentId=$DataRows['id'];
								$DateTimeofComment=$DataRows['datetime'];
								$PersonName=$DataRows['name'];
								$PersonComment=$DataRows['comment'];
								$CommentedPostId=$DataRows['admin_panel_id'];
								$SrNo++;
							
								if(strlen($PersonName) > 10) { $PersonName  = substr($PersonName, 0, 10).'....';}

							?>
							<tr>
								<td><?php echo htmlentities($SrNo); ?></td>
								<td style="color: #5e5eff"><?php echo htmlentities($PersonName); ?></td>
								<td><?php echo htmlentities($DateTimeofComment); ?></td>
								<td><?php echo htmlentities($PersonComment); ?></td>
								<td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
								<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>">
									<span class="btn btn-danger">Delete</span></a></td>
								<td><a href="FullPost.php?id= <?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>

							</tr>
						<?php } ?>
						</table>
					</div>
					
					<h1>Approved Comments</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Date</th>
								<th>Comment</th>
								<th>Approved by</th>
								<th>Revert Approve</th>
								<th>Delete Comment</th>
								<th>Details</th>
							</tr>
							<?php
							$ConnectingDB;
							$Admin="JOY";
							$Query="SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
							$Execute=mysql_query($Query);
							$SrNo=0;
							while($DataRows=mysql_fetch_array($Execute)) {
								$CommentId=$DataRows['id'];
								$DateTimeofComment=$DataRows['datetime'];
								$PersonName=$DataRows['name'];
								$PersonComment=$DataRows['comment'];
								$CommentedPostId=$DataRows['admin_panel_id'];
								$SrNo++;
								
								if(strlen($PersonName) > 10) { $PersonName  = substr($PersonName, 0, 10).'....';}

							?>
							<tr>
								<td><?php echo htmlentities($SrNo); ?></td>
								<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
								<td><?php echo htmlentities($DateTimeofComment); ?></td>
								<td><?php echo htmlentities($PersonComment); ?></td>
								<td><?php echo $Admin; ?></td>
								<td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
								<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>">
									<span class="btn btn-danger">Delete</span></a></td>
								<td><a href="FullPost.php?id= <?php echo $CommentedPostId; ?> target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>

							</tr>
						<?php } ?>
						</table>
					</div>
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