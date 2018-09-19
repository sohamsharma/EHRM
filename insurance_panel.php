<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login5(); ?>
<?php
if(isset($_POST["Submit"]))
{
	global $ConnectingDB;
    $insuranceid=mysql_real_escape_string($_POST["insuranceid"]);
    $features=mysql_real_escape_string($_POST["features"]);
    $cost=mysql_real_escape_string($_POST["cost"]);
    
	
	if(empty($insuranceid)|| empty($features)|| empty($cost)){
		$_SESSION["ErrorMessage"]="All Fields must be filled";
		Redirect_to("insurance_panel.php");
	 }
 else{
    {
        global $ConnectingDB;
        $Query="INSERT INTO insuranceplan(insuranceid,features,cost)VALUES('$insuranceid','$features','$cost')";
        $Execute=mysql_query($Query);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Insurance Added Successfully";
            Redirect_to("insurance_panel.php");
        }else{
            $_SESSION["ErrorMessage"]="Insurance failed to add";
         Redirect_to("insurance_panel.php");
        }
    }
	}
}
?>


<!DOCTYPE>
<html>
	<head>
		<title>Manage Insurance</title>
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
						<li class="active"><a href="insurance_panel.php">
							<span class="glyphicon glyphicon-user"></span>
						&nbsp;Manage Insurance</a></li>
						<!-- <li><a href="Comments.php">
							<span class="glyphicon glyphicon-comment"></span>
						&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>
						&nbsp;Live Blog</a></li> -->
						<li><a href="insurance_logout.php">
							<span class="glyphicon glyphicon-log-out"></span>
						&nbsp;Logout</a></li>
					</ul>


				</div><!-- ENDING OF SIDE -->
				<div class="col-sm-10">
                <?php echo Message();
					echo SuccessMessage();
					?>
                <h1>Add Insurance Plan</h1>
		<form action="insurance_panel.php" method="Post">
								<fieldset>
									<div class="form-group">
									<label for="Username"><span class="FieldInfo">Insurance Id:</span></label>
									<input class="form-control"type="text" name="insuranceid" id="insuranceid" placeholder="Insurance ID">
								</div>
								<br>
								<div class="form-group">
									<label for="Username"><span class="FieldInfo">Features:</span></label>
									<input class="form-control"type="text" name="features" id="features" placeholder="Features">
								</div>
								<br>
								<div class="form-group">
									<label for="Username"><span class="FieldInfo">Cost:</span></label>
									<input class="form-control"type="text" name="cost" id="cost" placeholder="Cost">
								</div>
								<br>
								<input  class="btn btn-success btn-block" type="Submit" name="Submit" value="Submit Insurance">
								</fieldset>
		</form>
						<br>

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