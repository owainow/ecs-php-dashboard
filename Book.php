<?php
				// Start the session
				session_start();
				//On page 1
				
				?>
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
				<h3>You Have been booked into the event </h3>
				<p>To book in for more events please visit the bookings page</p>
				</section>
				<?php
                    $con = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
					$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);
                if(!$con){
                die("failed to connect:" . mysqli_connect_error());
				}
               
				// Escape user inputs for security
				$ID_Parameter= $_GET['ID'];
                $RiderName         = mysqli_real_escape_string($con, $_REQUEST['Name']);
                $HorseName         = mysqli_real_escape_string($con, $_REQUEST['Horse']);
                $Number            = mysqli_real_escape_string($con, $_REQUEST['Number']);
                $Email 			   = mysqli_real_escape_string($con, $_REQUEST['email']);
                $Address		   = mysqli_real_escape_string($con, $_REQUEST['Address']);
				$Postcode 		   = mysqli_real_escape_string($con, $_REQUEST['Postcode']);
				$Classes 		   = mysqli_real_escape_string($con, $_REQUEST['Height']);
				$Vaccination	   = mysqli_real_escape_string($con, $_REQUEST['Vaccination']);
				
                $RiderID           = uniqid(Rider);
				$Class = implode(",",$_POST['Height']);
				
			

				$sql= "INSERT INTO $ID_Parameter (Event_ID,Rider_ID,Rider,Horse,Number,Email,Address,Postcode,Classes,Vaccination_Date) 
						VALUES('$ID_Parameter','$RiderID','$RiderName','$HorseName','$Number','$Email','$Address','$Postcode','$Class','$Vaccination')";
						$con->query($sql);

				
		
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