<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
				<html>
				<head>
					<title>Equestrian Competition Schedular</title>
					<meta charset="utf-8" />
					<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
					<meta name="description" content="" />
					<meta name="keywords" content="" />
					<link rel="stylesheet" href="assets/css/main.css" />
				</head>
				<body class="is-preload">

				<!-- Header -->
				<header id="header">
					<a class="logo" href="index.html">Equestrian Competition Schedular</a>
					<nav>
					<a href="#menu">Menu</a>
					</nav>
				</header>

				<!-- Nav -->
				<nav id="menu">
				<ul class="links">
					<li><a href="index.html">Home</a></li>
					<li><a href="Event_Creation.php">Create an Event</a></li>
					<li><a href="Competition_Entry.php">View Competitions</a></li>
					<li><a href="#">Register</a></li>
					<li><a href="#">Login</a></li>
				</ul>
				</nav>

				<!-- Heading -->
				<div id="heading" >
				<h1>Create an Event</h1>
				</div>

				<!-- Main -->
				<section id="main" class="wrapper">
				<div class="inner">
				<div class="content">

				<!-- Elements -->
				<div class="row">
				<div class="col-6 col-12-medium">

				<!-- Text -->
				<h3>Your Event Has been successfully created</h3>
				<p>To create more events visit the create event page</p>
				</section>
				<?php
                    $con = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
					$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);
                if(!$con){
                die("failed to connect:" . mysqli_connect_error());
				}
				

				// Escape user inputs for security
				//$EventID = mysqli_real_escape_string($con, $_REQUEST['EventID']);
				$EventID           = uniqid(ECS-Event);
				$ShowGroundName    = mysqli_real_escape_string($con, $_REQUEST['ShowGroundName']);
				$email 			   = mysqli_real_escape_string($con, $_REQUEST['email']);
				$ShowgroundAddress = mysqli_real_escape_string($con, $_REQUEST['ShowGroundAddress']);
				$Postcode 		   = mysqli_real_escape_string($con, $_REQUEST['Postcode']);
				$DateOfComp 	   = mysqli_real_escape_string($con, $_REQUEST['DateOfComp']);
				$ClosingDate 	   = mysqli_real_escape_string($con, $_REQUEST['ClosingDate']);
				$Time 			   = mysqli_real_escape_string($con, $_REQUEST['Time']);
				$Discipline 	   = mysqli_real_escape_string($con, $_REQUEST['Discipline']);
				$Classes 		   = mysqli_real_escape_string($con, $_REQUEST['Height']);
				$Cost 			   = mysqli_real_escape_string($con, $_REQUEST['Cost']);
				$Instructions 	   = mysqli_real_escape_string($con, $_REQUEST['Instructions']);
				
			
					//PHP to split comma deliminated values
					//https://www.w3schools.com/php/func_string_explode.asp
					//Adapted from w3 schools tutorial
					  $Class = implode(",",$_POST['Height']);
				
					 

				$sql= "INSERT INTO Events (Event_ID,Showground_Name,Email,Showground_Address,Postcode,Date_of_Event,Closing_date,Time_of_first_class,Discipline,Classes,Cost_per_class,Special_Instructions,Event_Status) 
						VALUES('$EventID','$ShowGroundName','$email','$ShowgroundAddress','$Postcode','$DateOfComp','$ClosingDate','$Time','$Discipline','$Class','$Cost','$Instructions','open')";
						$con->query($sql);
				
				

				// sql to create table 
				//https://www.w3schools.com/php/php_mysql_create_table.asp
				//Adapted from the w3 schools tutorial 
				$sql2 = "CREATE TABLE ".$EventID." (
						 Event_ID VARCHAR(20),
						 Rider_ID VARCHAR(20),
						 Rider VARCHAR(100),
						 Horse VARCHAR(100),
						 Number VARCHAR(11),
						 Email VARCHAR(100),
						 Address VARCHAR(150),
						 Postcode VARCHAR(8),
						 Classes VARCHAR(100),
						 Vaccination_Date date
						 )";
						 $con->query($sql2);
					



						$NewClass=($_POST['Height']);
						foreach($NewClass as $heights){
								$id=$heights;
								$sql11="CREATE TABLE ".$id.$EventID." (
									Event_ID Varchar(20),
									Rider_ID VARCHAR(20),
									Rider VARCHAR(100),
									Horse VARCHAR(100),
									Time time )";
									$con->query($sql11);	
						}
						

						

				
				?>


	<!-- Footer -->
<footer id="footer">
<div class="inner">
<div class="content">
<section>
<h3>Terms and Conditions</h3>
<p>It is your responsibility to periodically review these Terms and Conditions to stay informed of updates. You will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised Terms and Conditions by your continued use of the Site after the date such revised Terms and Conditions are posted.</p>
</section>
<section>
<h4>Helpful Information</h4>
<ul class="alt">
	<li><a href="CompetitorFAQ.php">Competitor FAQ's.</a></li>
	<li><a href="OrganiserFAQ.php">Organiser FAQ's.</a></li>
	<li><a href="Contact.php">Contact Us.</a></li>
	<li><a href="PrivacyPolicy.php">Privacy Policy.</a></li>
</ul>
</section>
<section>
<h4>Find Us On</h4>
<ul class="plain">
	<li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
	<li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
	<li><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
	<li><a href="#"><i class="icon fa-github">&nbsp;</i>Github</a></li>
</ul>
</section>
</div>
<div class="copyright">
&copy; Untitled. Photos <a href="https://unsplash.co">Unsplash</a>, Video <a href="https://coverr.co">Coverr</a>.
</div>
</div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
				</html>







				//Warning: Use of undefined constant Event - assumed 'Event' (this will throw an Error in a future version of PHP) in /opt/app-root/src/Submit.php on line 64

//Warning: mysqli_real_escape_string() expects parameter 2 to be string, array given in /opt/app-root/src/Submit.php on line 73