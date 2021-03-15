<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

	<head>
		<title>Equestrian Competition Schedular-View Events</title>

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
				<h1>View Competitions</h1>

			</div>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<div class="content">

					<!-- Elements -->
						<div class="row">
							<div class="col-6 col-12-medium">


						

<?php
'<html>

</html>';

//Connection to database
$con = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);
if(!$con){
	die("failed to connect:" . mysqli_connect_error());
}

//Updates table so any events that are closed the status is updated to closed
$today2 = date("yy-m-d");
//$sql = "UPDATE Events SET Event_Status='Closed' WHERE Closing_Date<='$today2'";
//$con->query($sql);
					

//Displays Database information using select statements
$query = "SELECT * FROM Events"; 
$result = mysqli_query($con,$query);
$today = date("yy-m-d");
while($row = mysqli_fetch_assoc($result)) {
echo  '<section>';
echo  '<div class="content">';
echo  '<header>';
echo  '<a href="#" class="icon fa-vcard-o"><span class="label">Icon</span></a>';
echo  '<h3>'. $row['Showground_Name'] .'</h3>';
echo  '</header>';
echo  '<h4><b>Discipline:</b> '. $row['Discipline'] .'</h4>';
echo  '<h4><b>Date of Event:</b> '. $row['Date_of_Event'] .'</h4>';
echo  '<h4><b>Entries Close:</b> '. $row['Closing_Date'] .'</h4>';
echo  '<h4><b>Show Ground:</b> '. $row['Showground_Address'] .'</h4>';
echo  '<ul class="actions">';

//Only allows you to book into an event if the closing date is greater than todays date
if ($row['Closing_Date']>$today){
echo  '<li><a href="Book_Now.php?ID='. $row['Event_ID'] .' " class="button primary icon">Book Now</a></li>';
}
//Does not allow for a user to book into the event if the closing date for entries is less than todays date
else {
	echo '<li><a href="#" class="button ">Closed for entries </a></li>';
}
//If the event status is closed then you can select the download schedule button
if ($row['Event_Status']=="Closed"){
	echo  '<li><a href="Algorithm.php?ID='. $row['Event_ID'] .'" class="button icon fa-download">Download Schedule</a></li>';
	}
//If the event status is open then you can not view the schedule
	else {
		echo  '<li><a href="#" class="button icon fa-download">Schedule Not available</a></li>';
	}

echo  '</ul>';
echo  '<ul class="actions">';
echo  '</ul>';
echo  '</div>';
echo  '</section>';
}
mysqli_close($con);



?>
</section>

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

