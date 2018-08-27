<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login2(); ?>

<?php
if(isset($_POST["Submit"])){
$Name=mysql_real_escape_string($_POST["Name"]);
$Phone=mysql_real_escape_string($_POST["Phone"]);
$Dob = date('Y-m-d', strtotime($_POST['Dob']));
$Gender=mysql_real_escape_string($_POST["Gender"]);
$Address=mysql_real_escape_string($_POST["Address"]);
$History=mysql_real_escape_string($_POST["History"]);
$Id=$_SESSION["Username"];

if(empty($Name || empty($Phone || empty($Dob || empty($Gender || empty($Address || empty($History)))))))
{
	$_SESSION["ErrorMessage"]="All Fields must be filled";
	Redirect_to("Patient_Mod.php");

 }
 else if(is_numeric($Phone)==0)
 {
	$_SESSION["ErrorMessage"]="Invalid Phone Number!";
	Redirect_to("Patient_Mod.php");
	}
	else if (strlen($Phone)<10) {
		$_SESSION["ErrorMessage"]="Phone Number should include atleast 10 values!!";
		Redirect_to("Patient_Mod.php");
 }
 else if (strlen($Phone)>10) {
	$_SESSION["ErrorMessage"]="Phone Number should include atleast 10 values!!";
	Redirect_to("Patient_Mod.php");
}
 else{
	global $ConnectingDB;
	$Query="UPDATE user_panel SET name='$Name',phone='$Phone',dob='$Dob',gender='$Gender',address='$Address',history='$History' WHERE email='$Id'";
	$Execute=mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Updated Successfully";
		Redirect_to("Patient_Mod.php");
	}else{
		$_SESSION["ErrorMessage"]="Failed to update!";
 	Redirect_to("Patient_Mod.php");
	}
}
}

?>




<html lang="en">
<head>
    <title>Electronic Health Record Management System</title>
    <link rel="stylesheet" href="csss/font-awesome.min.css">
    <link rel="stylesheet" href="csss/bootstrap.min.css">
    <link rel="stylesheet" href="csss/style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,800,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=BenchNine:300,400,700' rel='stylesheet' type='text/css'>
    
    
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <!-- ====================================================
    header section -->
    <header class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-5 header-logo">
                    <br>
                    <a><img src="imgs/logo1.png" alt="" class="img-responsive logo"></a>
                </div>
                <div class="col-md-7">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid nav-bar">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="nav navbar-nav navbar-right">
                                    <li><a class="menu active" href="Patient_Mod.html">Basic Info</a></li>
                                    <li><a class="menu" href="Pat_BuyIns.php">Buy Insurance</a></li>
                                    <li><a class="menu" href="Pat_MedHist.php">Medical History</a></li>
                                    <li><a class="menu" href="Pat_Pres.php">Prescription</a></li>
                                    <!-- <li><a class="menu" href="Pat_Pharm.html">Pharmacy</a></li> -->  
                                    <li><a class="menu" href="User_logout.php">Log Out</a></li>  
                                </ul>
                            </div><!-- /navbar-collapse -->
                        </div><!-- / .container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </header> <!-- end of header area -->
        <div class="container-fluid">
            <center>
            	
    <img id="top" src="top.png" alt="">
    
    <br />
    <br />
    <br />
    <br />

    <br />
    <br />
    <br />
    <br />
            </center>
        </div>
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-sm-offset-4 col-sm-4">
					<br><br><br><br>
					<?php echo Message();
					echo SuccessMessage();
					?>
					<h2>Add Basic Info</h2>
						<div >
							<form action="Patient_Mod.php" method="Post">
								<fieldset>
									<div class="form-group">
										<label for="Name"><span class="FieldInfo">Name:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-user text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Name" id="Name" placeholder="Name">
									</div>
								</div>
<!--  								<div class="form-group">
										<label for="Aadhar"><span class="FieldInfo">Aadhar Number:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-star text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Aadhar" id="Aadhar" placeholder="Aadhar Number">
									</div>
								</div> -->
<!--  									<label for="Email"><span class="FieldInfo">Email:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Email" id="Email" placeholder="Email">
									</div> -->
								<div class="form-group">
									<label for="Phone"><span class="FieldInfo">Phone Number:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Phone" id="Phone" placeholder="Phone Number">
								</div>
								</div>
								<div class="form-group">
									<label for="Dob"><span class="FieldInfo">DOB:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar text-primary"></span>
											</span>
									<input class="form-control" type="date" name="Dob" id="Dob" placeholder="DOB">
								</div>
                                    <br>
                                
									<div class="form-group">
										<label for="Gender"><span class="FieldInfo">Gender:</span></label><br>
										<div class="radio">		
												<label><input type="radio" name="Gender" checked id="Male" value="Male">Male</label>
												<label><input type="radio" name="Gender" id="Female" value="Female">Female</label>
												<label><input type="radio" name="Gender" id="Others" value="Others">Others</label>
											  </div>
									</div>	
                                <div class="form-group">
									<label for="Address"><span class="FieldInfo">Address:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="tect" name="Address" id="Address" placeholder="Address">
								</div>
								</div>
                                <div class="form-group">
									<label for="History"><span class="FieldInfo">Medical History:</span></label>
									<div class="input-group input-group-lg">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="text" name="History" id="History" placeholder="Medical History">
								</div>
								</div>
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit" value="Submit">



						</div>
                                </fieldset>
                            </form>
							
						
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->
		</div>
		<hr>
		<div class="table-responsive">
		<center><h3>User Details</h3></center>
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
									<th>Insurance</th>
									<th>Hospital</th>
									<th>Doctor</th>
								</tr>
								<?php
								global $ConnectingDB;
								$Id=$_SESSION["Username"];
								$ViewQuery="SELECT * FROM user_panel WHERE email='$Id'";
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
									$Insurance=$DataRows["insurance"];
									$Hospital=$DataRows["admittedto"];
									$Doctor=$DataRows["currentdoctor"];
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
		<td><?php echo $Insurance; ?></td>
		<td><?php echo $Hospital; ?></td>
		<td><?php echo $Doctor; ?></td>
</tr>

							<?php } ?>
							</table>
						</div> 
   
    <!-- script tags
    ============================================================= -->
    <script src="jss/jquery-2.1.1.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="jss/gmaps.js"></script>
    <script src="jss/smoothscroll.js"></script>
    <script src="jss/bootstrap.min.js"></script>
    <script src="jss/custom.js"></script>
</body>
</html>
