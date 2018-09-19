<?php require_once("Include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_Login2(); ?>

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
                                    <li><a class="menu active" href="Patient_Mod.php">Basic Info</a></li>
                                    <li><a class="menu" href="Pat_BuyIns.php">Buy Insurance</a></li>
                                    <li><a class="menu" href="Pat_MedHist.php">Medical History</a></li>
                                    <li><a class="menu" href="Pat_Pres.php">Prescription</a></li>
                                    <!-- <li><a class="menu" href="Pat_Pharm.html">Pharmacy</a></li>   -->
                                    <li><a class="menu" href="User_logout.php">Log Out</a></li>  
                                </ul>
                            </div><!-- /navbar-collapse -->
                        </div><!-- / .container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </header> <!-- end of header area -->
    <section class="slider" id="home">
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
            <div class="table-responsive">
            <?php echo Message();
					echo SuccessMessage();
					?>
							<table class="table table-hover">
								<tr>
									<th>Sr No.</th>
									<th>Insurance Id.</th>
									<th>Features</th>
									<th>Cost</th>
									<th>Action</th>
								</tr>
								<?php
								global $ConnectingDB;								
								$ViewQuery="SELECT * FROM insuranceplan";
								$Execute=mysql_query($ViewQuery);
								$SrNo=0;
								while($DataRows =mysql_fetch_array($Execute)) {
									$insuranceid=$DataRows["insuranceid"];
									$features=$DataRows["features"];
									$cost=$DataRows["cost"];
									$SrNo++;
?>
<tr>
		<td><?php echo $SrNo; ?></td>
		<td><?php echo $insuranceid; ?></td>
		<td><?php echo $features; ?></td>
		<td><?php echo $cost; ?></td>
		<td><a href="selectinsurance.php?insuranceid=<?php echo $insuranceid; ?>">
			<span class="btn btn-danger">Buy</span></a></td>
</tr>

							<?php } ?>
							</table>
						</div> 
        </div>
        
    </section>
    </body>
</html>