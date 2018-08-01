<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>

<!DOCTYPE>
<html>
	<head>
		<title>Blog Page</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script scr="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicstyles.css">
		<style type="text/css">
			
			
			#Footer{
	padding: 10px;
	border-top: 1px solid black;
	color: #eeeeee;
	background-color: #211f22;
	text-align: center;
}
.blogpost{
		background-color: #f5f5f5;
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 10px;
		overflow: hidden;
}
#heading{
	font-family: Bitter,Georgia,"Times New Roman",Times,serif;
	font-weight: bold;
	color: #005E90;
}
#heading:hover{
	color: #0090DB;
}
.description{
	color: #868686;
	font-weight: bold;
	margin-top: -2px;
}
.post{
	font-size: 1.1em;
	font-family: "Lucida Sans Unicode","Lucida Grande", sans-serif;
	text-align: justify;
}
.btn-info{
	float: right;
}
.imageicon{
	max-width: 150px;
	margin: 0 auto;
	display: block;
}
.background{
	background-color: #F6F7F9;
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
					<li class="active"><a href="Blog.php">Blog</a></li>
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
		<div class="container"><!-- Container Area -->
			<div class="blog-header">
			<h1>The Blocked Reviewer</h1>
			<p class="lead">The Complete blog by JOY RAKESH</p>
		</div>
		<div class="row"><!-- Row Area  -->
			<div class="col-sm-8"><!-- Main Area  -->
				<?php 
				global $ConnectingDB;
				//Query when search is active
				if(isset($_GET["SearchButton"])){
					$Search=$_GET["Search"];
					$ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
				}
				//Query Catgory is active
				elseif (isset($_GET["Category"])) {
					$Category=$_GET["Category"];
					$ViewQuery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc";
				}
				//pagnitation is active
				elseif (isset($_GET["Page"])){
					$Page=$_GET["Page"];
					if($Page == 0 || $Page<1){
						$ShowPostFrom=0;
					}else{

					$ShowPostFrom= ($Page*5)-5;}
					

					$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc 
					LIMIT $ShowPostFrom,5";
				}
				// The default query for Blog.php
				else{
					
				$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";}
				$Execute=mysql_query($ViewQuery);
				while ($DataRows=mysql_fetch_array($Execute)) {

					$PostId=$DataRows["id"];
					$DateTime=$DataRows["datetime"];
					$Title=$DataRows["title"];
					$Category=$DataRows["category"];
					$Admin=$DataRows["author"];
					$Image=$DataRows["image"];
					$Post=$DataRows["post"];
				
				?>
				<div class="blogpost thumbnail">
					<img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>" >
					<div class="caption">
						<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
						<p class="description">Category:<?php echo htmlentities($Category);?> Published on <?php echo htmlentities($DateTime);?></p>
						<p class="post"><?php
						if(strlen($Post)>150){$Post=substr($Post,0,150).'...';}

						 echo $Post ?></p>
					</div>
					<a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read More &rsaquo;</span></a>
				</div>
			<?php } ?>
			<nav>
				<ul class="Pagination pull-left Pagination-lg">
					<?php 
					if(isset($Page)){
					if($Page>1){
						?>
						<li><a href="Blog.php?Page=<?php echo $Page-1;?>">&laquo;</a></li>
					<?php } 
				} ?>
			<?php 
			global $ConnectingDB;
			$QueryPagination="SELECT COUNT(*) FROM admin_panel";
			$ExecutePagination=mysql_query($QueryPagination);
			$RowPagination=mysql_fetch_array($ExecutePagination);
			$TotalPosts=array_shift($RowPagination);
			//echo $TotalPosts;
			$PostPagination=$TotalPosts/5;
			$PostPagination=ceil($PostPagination);
			//echo $PostPerPage;
			for($i=1;$i<=$PostPagination;$i++){
				if(isset($Page)){
				if($i==$Page){
			?>
			
			<li class="active"><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
		<?php } else{ ?>
			<li><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
		<?php 
	}
}
	 } ?>
	 <?php 
					if(isset($Page)){
					if($Page+1 <= $PostPagination){
						?>
						<li><a href="Blog.php?Page=<?php echo $Page+1;?>">&raquo;</a></li>
					<?php } 
				} ?>
	</ul>
	</nav>
			</div><!-- Main Area Ending -->
			<div class="col-sm-offset-1 col-sm-3"><!--Side Area -->
				<h2><center>About Me</center></h2>
				<img class="img-responsive img-circle imageicon" src="images/pro.jpg">
				<p >I am a developer and web designer with the great passion for building beautiful new Desktop/Web Applications from scratch. I’ve been working as a Freelancer since 2017.</p>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Categories</h2>
					</div>
					<div class="panel-body">
						<?php 
						global $ConnectingDB;
						$ViewQuery="SELECT * FROM category ORDER BY datatime desc";
						$Execute=mysql_query($ViewQuery);
						while($DataRows=mysql_fetch_array($Execute)){
							$Id=$DataRows['id'];
							$Category=$DataRows['name'];

						 ?>
						 <a href="Blog.php?Category=<?php echo $Category;?>">
						 <span id="heading"><?php echo $Category."<br>"; ?></span></a>
						<?php } ?>
					</div>
					<div class="panel-footer"></div>

				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Post</h2>
					</div>
					<div class="panel-body background">
						<?php 
						$ConnectingDB;
						$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
						$Execute=mysql_query($ViewQuery);
						while ($DataRows=mysql_fetch_array($Execute)) {
							$Id=$DataRows["id"];
							$Title=$DataRows["title"];
							$DateTime=$DataRows["datetime"];
							$Image=$DataRows["image"];
							if(strlen($DateTime)>11){
								$DateTime=substr($DateTime, 0,11);
							}
						?>
						<div >
							<img class="pull-left" style="margin-top: 10px; margin-left: 10px;" src="Upload/<?php echo $Image; ?>" width=90 height=70;>
							<a href="FullPost.php?id=<?php echo $Id; ?>">
							<p id="heading" style="margin-left: 90px;"><?php echo htmlentities($Title); ?></p></a>
							<p class="description"style="margin-left: 90px;"><?php echo htmlentities($DateTime); ?></p>
						</div>
					<?php } ?>
					</div>
					<div class="panel-footer"></div>

				</div>
			</div><!-- Side Area Ending -->
		</div><!-- Row Ending -->


		</div><!-- Container Ending -->
		<div id="Footer">
			<hr><p>BLOCKED REVIEWER |  JOY RAKESH  | &copy;2018-2020 ---- All Rights Reserved.</p>
			<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;">
				<p>
					This is a site for reviewing products.
				</p>
			</a>
		</div>
		<div style="height: 10px; background: #27AAE1;"></div>
	</body>
</html>