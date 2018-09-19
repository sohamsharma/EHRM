<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
            global $Id;
			global $Username3;
			global $Username6;
			global $Username4;
			global $Username5;
			global $Username2;
			global $Username1;
            global $Email;
            global $Aadhar;
            global $Name;
            global $Phone;
            global $Dob;
            global $Gender;
            global $Address;
            global $History;
            global $Insurance;
            global $Hospital;
            global $Doctor;
            global $Treatment;
            global $Prescription;
			global $SrNo;
			global $SrNo1;
			global $SrNo4;
			global $Hos;
if(isset($_POST["Submit1"])){
	$Username3=mysql_real_escape_string($_POST["Doctor"]);
	$Hos=mysql_real_escape_string($_POST["Hos"]);
    if(empty($Username3)||empty($Hos)){
        $_SESSION["ErrorMessage"]="All Fields must be filled";
        Redirect_to("report.php");}
        else if(is_numeric($Username3)==1 || is_numeric($Hos)==1)
     {
        $_SESSION["ErrorMessage"]="Invalid Data Type!";
	    Redirect_to("report.php");
     }
     else
     {
        global $ConnectingDB;
        $ViewQuery="SELECT * FROM user_panel WHERE currentdoctor='$Username3' && admittedto='$Hos'";
        $Execute=mysql_query($ViewQuery);
        $SrNo1=0;
        while($DataRows =mysql_fetch_array($Execute)) {
            $Id=$DataRows["id"];
            $Username6=$DataRows["username"];
            $Email=$DataRows["email"];
            $Aadhar=$DataRows["adhar"];
            $Name=$DataRows["name"];
            $Phone=$DataRows["phone"];
            $Dob=$DataRows["dob"];
            $Gender=$DataRows["gender"];
            $Address=$DataRows["address"];
            $History=$DataRows["history"];
            $Treatment=$DataRows["treatment"];
            $Prescription=$DataRows["prescription"];
            $Insurance=$DataRows["insurance"];
            $Hospital=$DataRows["admittedto"];
            $Doctor=$DataRows["currentdoctor"];
            $SrNo1++;
     }
    }
    }
if(isset($_POST["Submit2"])){
    $Username1=mysql_real_escape_string($_POST["Hospital"]);
    if(empty($Username1)){
        $_SESSION["ErrorMessage"]="All Fields must be filled";
        Redirect_to("report.php");
     }
     else if(is_numeric($Username1)==1)
     {
        $_SESSION["ErrorMessage"]="Invalid Data Type!";
	    Redirect_to("report.php");
     }
     else
     {
		global $ConnectingDB;
        $ViewQuery="SELECT * FROM doctors WHERE addedby='$Username1'";
        $Execute=mysql_query($ViewQuery);
        $SrNo=0;
        while($DataRows =mysql_fetch_array($Execute)) {
            $Id=$DataRows["id"];
            $Username5=$DataRows["username"];
            $SrNo++;
		}
	 }
}
if(isset($_POST["Submit3"])){
$Username2=mysql_real_escape_string($_POST["Insurance"]);
if(empty($Username2)){
    $_SESSION["ErrorMessage"]="All Fields must be filled";
    Redirect_to("report.php");
 }
 else{
	global $ConnectingDB;
	$ViewQuery="SELECT * FROM user_panel WHERE insurance='$Username2'";
	$Execute=mysql_query($ViewQuery);
	$SrNo4=0;
	while($DataRows =mysql_fetch_array($Execute)) {
		$Id=$DataRows["id"];
		$Username4=$DataRows["username"];
		$SrNo4++;
    }
}
}


?>


<!DOCTYPE>
<html>
	<head>
    <style>
	th
	{
		background: aqua;
		height:30px;
	}
	table,th,td
	{
		border:2px solid blue;
	}
	table
	{
		width:30%;
		color:black;
		text-align:center;
	}

</style>
		<title>Report Generator</title>
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
	<a class="navbar-brand" href="index.php"><img style="margin-top: -14px" src="images/img11.png" width="220" height="50";></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
		</div>
			</div>



		</nav>
		<div class="Line" style="height: 10px; background: #27aae1;"></div>
		<div class="container-fluid">
			<div class="row">
			
				<div class="col-sm-offset-4 col-sm-4">
					<br><br><br><br>
					<?php echo Message();
					echo SuccessMessage();
					?>
					<h2>Report Generator</h2>
						<div>
							<form action="report.php" method="Post">
								<fieldset>
									<div class="form-group">
                                    <h4>Patients being treated by the following doctor:</h4>
										<label for="Doctor"><span class="FieldInfo">Doctor Name:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-user text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Doctor" id="Doctor" placeholder="Doctor">
									<input class="form-control"type="text" name="Hos" id="Hos" placeholder="Hospital">
									</div>
                                    
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit1" value="Search">
                                <br>
                                <table>
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
									<th>Treatment</th>
									<th>Prescription</th>
								</tr>
                                <tr>
                                        <td><?php echo $SrNo1; ?></td>
                                        <td><?php echo $Username6; ?></td>
                                        <td><?php echo $Email; ?></td>
                                        <td><?php echo $Aadhar; ?></td>
                                        <td><?php echo $Name; ?></td>
                                        <td><?php echo $Phone; ?></td>
                                        <td><?php echo $Dob; ?></td>
                                        <td><?php echo $Gender; ?></td>
                                        <td><?php echo $Address; ?></td>
                                        <td><?php echo $History; ?></td>
                                        <td><?php echo $Treatment; ?></td>
                                        <td><?php echo $Prescription; ?></td>

                                </tr>
                                </table>
								</div>
								<div class="form-group">
                                <h4>Patients admitted in the following hospital:</h4>
										<label for="Hospital"><span class="FieldInfo">Hospital Name:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-star text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Hospital" id="Hospital" placeholder="Hospital">
									</div>
                                    
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit2" value="Search">
								<br>
								<table>
                                <tr>
									<th>Sr No.</th>
									<th>Username</th>
								</tr>
                                <tr>
                                        <td><?php echo $SrNo; ?></td>
                                        <td><?php echo $Username5; ?></td>                                </tr>
                                </table>
								</div>
                                <h4>Patients who've opted for the following insurance plan:</h4>
									<label for="Insurance"><span class="FieldInfo">Insurance Id:</span></label>
									<div class="input-group input-group-lg" >
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-edit text-primary"></span>
											</span>
									<input class="form-control"type="text" name="Insurance" id="Insurance" placeholder="Insurance">
									</div>
								</div>
								<br>
								<input  class="btn btn-info btn-block" type="Submit" name="Submit3" value="Search">
								<br>
								<table>
                                <tr>
									<th>Sr No.</th>
									<th>Username</th>
								</tr>
                                <tr>
                                        <td><?php echo $SrNo4; ?></td>
                                        <td><?php echo $Username4; ?></td>                                </tr>
                                </table>
								</fieldset>	
							</form>
						</div>
						
				</div><!-- ENDING OF MAIN -->
			</div><!-- ROW -->
		</div><!-- Container Fluid -->
		</div>
	</body>
</html>