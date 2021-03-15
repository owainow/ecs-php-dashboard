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
				<h1>View Schedule</h1>
				</div>

				<!-- Main -->
				<section id="main" class="wrapper">
				<div class="inner">
				<div class="content">

				<!-- Elements -->
				<div class="row">
				<div class="col-6 col-12-medium">
				
<?php

				//Connection to server
				$con = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
				$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);
				if(!$con){
				die("failed to connect:" . mysqli_connect_error());
				}


			

				//Query to retrieve the start time of the event with the corresponding event ID
				$ID_Parameter= $_GET['ID'];
				$query1="SELECT Time_of_first_class,Classes FROM Events 
						WHERE Event_ID='$ID_Parameter'";
						$result = mysqli_query($con,$query1);
						($row = mysqli_fetch_assoc($result));
						//echo $query1;
						$StartTime=$row['Time_of_first_class'];
						$Heights=$row['Classes'];
						
						
									
				

										
//QUERIES FOR THE 2ft0

				
				//Query to return the number of rows in the table class1$Id											
				$query2="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%2ft0%') AS Count_row";
				$result2 = mysqli_query($con,$query2);
				($row2 = mysqli_fetch_assoc($result2));
				$Count_Rows=$row2['Count_row'];	
				

				//Insert into the table class1 with corresponding id all values required for the schedule.
				$Initial_Time=$StartTime;
				
				$query3 = "SELECT * FROM $ID_Parameter where Classes like '%2ft0%'"; 
				$result3 = mysqli_query($con,$query3);
				while($row = mysqli_fetch_assoc($result3)) {
															$query4= "INSERT INTO 2ft0$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%2ft0%'
															and NOT EXISTS (SELECT * FROM 2ft0$ID_Parameter); 
															"; 
															}
															$con->query($query4);



				//query to store rider_id in an array												
				$query5 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%2ft0%'"; 
				$result5 = mysqli_query($con,$query5);
				while($row = mysqli_fetch_assoc($result5)){
				$Riders[]=$row['Rider_ID'];
				}

				//iterates through each riderid and allocates a time 
				$event_time = $StartTime; 
				$time_block =$Count_Rows;
				$event_length = 3; // minutes 	
									
				foreach($Riders as $rider){
					unset($query6);
							$id=$rider;
								$query6="UPDATE 2ft0$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query6);
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}

	
				
	
							
	















//QUERIES FOR THE 2FT3 CLASS





				//Query to return the number of rows in the entries table that contain 2ft3									
				$query7="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%2ft3%') AS Count_row";
				$result7 = mysqli_query($con,$query7);
				($row7 = mysqli_fetch_assoc($result7));
				$Count_Rows2ft3=$row7['Count_row'];
				
				



				//Insert into the table class1 with corresponding id all values required for the schedule.
				$query8 = "SELECT * FROM $ID_Parameter where Classes like '%2ft3%'"; 
				$result8 = mysqli_query($con,$query8);
				while($row8 = mysqli_fetch_assoc($result8)) {
															$query8= "INSERT INTO 2ft3$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%2ft3%'
															and NOT EXISTS (SELECT * FROM 2ft3$ID_Parameter); 
															"; 
															}
															$con->query($query8);



				//query to store rider_id in an array												
				$query9 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%2ft3%'"; 
				$result9 = mysqli_query($con,$query9);
				while($row = mysqli_fetch_assoc($result9)){
				$Riders9[]=$row['Rider_ID'];
				}



				
				$query90="SELECT Time FROM 2ft0$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result90 = mysqli_query($con,$query90);
				($row = mysqli_fetch_assoc($result90));
				$previousTime=$row['Time'];
				$endTime = strtotime("+15 minutes", strtotime($previousTime));
				$class1time=date('h:i:s', $endTime);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class1time; 
				$time_block =$Count_Rows2ft3;
				$event_length = 3; // minutes 	
									
				foreach($Riders9 as $rider){
					unset($query10);
							$id=$rider;
								$query10="UPDATE 2ft3$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query10);
								//echo $query6;
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}



















								
//QUERIES FOR THE 2FT6 CLASS




				//Query to return the number of rows in the entries table that contain 2ft3									
				$query11="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%2ft6%') AS Count_row";
				$result11 = mysqli_query($con,$query11);
				($row11 = mysqli_fetch_assoc($result11));
				$Count_Rows2ft6=$row11['Count_row'];
				//echo $Count_Rows;		
				



				//Insert into the table class1 with corresponding id all values required for the schedule.
				$query12 = "SELECT * FROM $ID_Parameter where Classes like '%2ft6%'"; 
				$result12 = mysqli_query($con,$query12);
				while($row = mysqli_fetch_assoc($result12)) {
															$query121= "INSERT INTO 2ft6$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%2ft6%'
															and NOT EXISTS (SELECT * FROM 2ft6$ID_Parameter); 
															"; 
															}
															$con->query($query121);



				//query to store rider_id in an array												
				$query13 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%2ft6%'"; 
				$result13 = mysqli_query($con,$query13);
				while($row = mysqli_fetch_assoc($result13)){
				$Riders13[]=$row['Rider_ID'];
				}



				//Query to return the last time from the previous table and adds a 15 minuet time interval
				$query91="SELECT Time FROM 2ft3$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result91 = mysqli_query($con,$query91);
				($row = mysqli_fetch_assoc($result91));
				$previousTime2=$row['Time'];
				$endTime2 = strtotime("+15 minutes", strtotime($previousTime2));
				$class2time=date('h:i:s', $endTime2);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class2time; 
				$time_block =$Count_Rows2ft6;
				$event_length = 3; // minutes 	
									
				foreach($Riders13 as $rider){
					unset($query14);
							$id=$rider;
								$query14="UPDATE 2ft6$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query14);
								//echo $query6;
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}
							







								
//QUERIES FOR THE 2FT9 CLASS





				//Query to return the number of rows in the entries table that contain 2ft9								
				$query15="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%2ft9%') AS Count_row";
				$result15 = mysqli_query($con,$query15);
				($row = mysqli_fetch_assoc($result15));
				$Count_Rows2ft9=$row['Count_row'];
				



				//Insert into the table class1 with corresponding id all values required for the schedule.
				$query16 = "SELECT * FROM $ID_Parameter where Classes like '%2ft9%'"; 
				$result16 = mysqli_query($con,$query16);
				while($row = mysqli_fetch_assoc($result16)) {
															$query161= "INSERT INTO 2ft9$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%2ft9%'
															and NOT EXISTS (SELECT * FROM 2ft9$ID_Parameter)"; 
															}
															$con->query($query161);



				//query to store rider_id in an array												
				$query17 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%2ft9%'"; 
				$result17 = mysqli_query($con,$query17);
				while($row = mysqli_fetch_assoc($result17)){
				$Riders17[]=$row['Rider_ID'];
				}



				//Query to return the last time from the previous table and adds a 15 minuet time interval
				$query92="SELECT Time FROM 2ft6$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result92 = mysqli_query($con,$query92);
				($row = mysqli_fetch_assoc($result92));
				$previousTime3=$row['Time'];
				$endTime3 = strtotime("+15 minutes", strtotime($previousTime3));
				$class3time=date('h:i:s', $endTime3);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class3time; 
				$time_block =$Count_Rows2ft9;
				$event_length = 3; // minutes 	
									
				foreach($Riders17 as $rider){
					unset($query18);
							$id=$rider;
								$query18="UPDATE 2ft9$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query18);
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}
							



//QUERIES FOR THE 3FT0 CLASS





				//Query to return the number of rows in the entries table that contain 3ft0							
				$query19="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%3ft0%') AS Count_row";
				$result19 = mysqli_query($con,$query19);
				($row = mysqli_fetch_assoc($result19));
				$Count_Rows3ft0=$row['Count_row'];
				



				//Insert into the table 3ft with corresponding id all values required for the schedule.
				$query20 = "SELECT * FROM $ID_Parameter where Classes like '%3ft0%'"; 
				$result20 = mysqli_query($con,$query20);
				while($row = mysqli_fetch_assoc($result20)) {
															$query201= "INSERT INTO 3ft0$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%3ft0%'
															and NOT EXISTS (SELECT * FROM 3ft0$ID_Parameter)"; 
															}
															$con->query($query201);



				//query to store rider_id in an array												
				$query21 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%3ft0%'"; 
				$result21 = mysqli_query($con,$query21);
				while($row = mysqli_fetch_assoc($result21)){
				$Riders21[]=$row['Rider_ID'];
				}



				//Query to return the last time from the previous table and adds a 15 minuet time interval
				$query93="SELECT Time FROM 2ft9$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result93 = mysqli_query($con,$query93);
				($row = mysqli_fetch_assoc($result93));
				$previousTime4=$row['Time'];
				$endTime4 = strtotime("+15 minutes", strtotime($previousTime4));
				$class4time=date('h:i:s', $endTime4);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class4time; 
				$time_block =$Count_Rows3ft0;
				$event_length = 3; // minutes 	
									
				foreach($Riders21 as $rider){
					unset($query22);
							$id=$rider;
								$query22="UPDATE 3ft0$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query22);
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}










//QUERIES FOR THE 3ft3 CLASS





				//Query to return the number of rows in the entries table that contain 3ft3								
				$query23="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%3ft3%') AS Count_row";
				$result23 = mysqli_query($con,$query23);
				($row = mysqli_fetch_assoc($result23));
				$Count_Rows3ft3=$row['Count_row'];
				
				



				//Insert into the table 3ft3 with corresponding id all values required for the schedule.
				$query24 = "SELECT * FROM $ID_Parameter where Classes like '%3ft3%'"; 
				$result24 = mysqli_query($con,$query24);
				while($row = mysqli_fetch_assoc($result24)) {
															$query241= "INSERT INTO 3ft3$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%3ft3%'
															and NOT EXISTS (SELECT * FROM 3ft3$ID_Parameter)"; 
														
															}
															$con->query($query241);



				//query to store rider_id in an array												
				$query25 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%3ft3%'"; 
				$result25 = mysqli_query($con,$query25);
				while($row = mysqli_fetch_assoc($result25)){
				$Riders25[]=$row['Rider_ID'];
				}



				//Query to return the last time from the previous table and adds a 15 minuet time interval
				$query93="SELECT Time FROM 3ft0$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result93 = mysqli_query($con,$query93);
				($row = mysqli_fetch_assoc($result93));
				$previousTime5=$row['Time'];
				$endTime5 = strtotime("+15 minutes", strtotime($previousTime5));
				$class5time=date('h:i:s', $endTime5);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class5time; 
				$time_block =$Count_Rows3ft3;
				$event_length = 3; // minutes 	
									
				foreach($Riders25 as $rider){
					unset($query26);
							$id=$rider;
								$query26="UPDATE 3ft3$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query26);
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}











//QUERIES FOR THE 3ft6 CLASS





				//Query to return the number of rows in the entries table that contain 3ft6							
				$query27="SELECT(SELECT COUNT(*)FROM $ID_Parameter where Classes like '%3ft6%') AS Count_row";
				$result27 = mysqli_query($con,$query27);
				($row = mysqli_fetch_assoc($result27));
				$Count_Rows3ft6=$row['Count_row'];
				//echo $Count_Rows;		
				



				//Insert into the table 3ft3 with corresponding id all values required for the schedule.
				$query28 = "SELECT * FROM $ID_Parameter where Classes like '%3ft6%'"; 
				$result28 = mysqli_query($con,$query28);
				while($row = mysqli_fetch_assoc($result28)) {
															$query281= "INSERT INTO 3ft6$ID_Parameter (Event_ID,Rider_ID,Rider,Horse)
															SELECT Event_ID,Rider_ID,Rider,Horse
															FROM $ID_Parameter
															WHERE Classes like '%3ft6%'
															and NOT EXISTS (SELECT * FROM 3ft6$ID_Parameter)"; 
															}
															$con->query($query281);



				//query to store rider_id in an array												
				$query29 = "SELECT Rider_ID FROM $ID_Parameter where Classes like '%3ft6%'"; 
				$result29 = mysqli_query($con,$query29);
				while($row = mysqli_fetch_assoc($result29)){
				$Riders29[]=$row['Rider_ID'];
				}



				//Query to return the last time from the previous table and adds a 15 minuet time interval
				$query94="SELECT Time FROM 3ft3$ID_Parameter ORDER BY Time DESC LIMIT 1";
				$result94 = mysqli_query($con,$query94);
				($row = mysqli_fetch_assoc($result94));
				$previousTime6=$row['Time'];
				$endTime6 = strtotime("+15 minutes", strtotime($previousTime6));
				$class6time=date('h:i:s', $endTime6);
				
				
						

				//iterates through each riderid and allocates a time 
				$event_time = $class6time; 
				$time_block =$Count_Rows3ft3;
				$event_length = 3; // minutes 	
									
				foreach($Riders29 as $rider){
					unset($query30);
							$id=$rider;
								$query30="UPDATE 3ft6$ID_Parameter SET Time='$event_time' WHERE Rider_ID='$id'"; 
								$con->query($query30);
								$eTime = strtotime($event_time);
								$eTime = strtotime("+$event_length minutes", $eTime);
								$event_time = date('H:i:s', $eTime);
						
								}
							











//QUERIES TO DISPLAY THE TABLES
//Adapted using https://stackoverflow.com/questions/37175907/php-mysqliquery-if-returns-true
						


								
									
			//This query shows the schedule for the 2ft0		
			if ($result83=mysqli_query($con,"SELECT  * FROM 2ft0$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result83)){
					echo '<h3>Schedule for the 2ft0 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result83->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}
		
			//This query shows the schedule for the 2ft3
			if ($result84=mysqli_query($con,"SELECT  * FROM 2ft3$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result84)){
					echo '<h3>Schedule for the 2ft3 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result84->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}
	
					

			//This query shows the schedule for the 2ft6			
			if ($result85=mysqli_query($con,"SELECT  * FROM 2ft6$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result85)){
					echo '<h3>Schedule for the 2ft6 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result85->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}


				
			//This query shows the schedule for the 2ft9
			if ($result86=mysqli_query($con,"SELECT  * FROM 2ft9$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result86)){
					echo '<h3>Schedule for the 2ft9 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result86->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}
					
					
			//This query shows the schedule for the 3ft0
			if ($result87=mysqli_query($con,"SELECT  * FROM 3ft0$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result87)){
					echo '<h3>Schedule for the 3ft0 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result87->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}
					
			
			//This query displays the schedule for the 3ft3
			if ($result88=mysqli_query($con,"SELECT  * FROM 3ft3$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result88)){
					echo '<h3>Schedule for the 3ft3 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result88->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}
					



					
				


			//This query displays the schedule for the 3ft6
			if ($result89=mysqli_query($con,"SELECT  * FROM 3ft6$ID_Parameter
			WHERE Event_ID='$ID_Parameter'")){
				if(mysqli_num_rows($result89)){
					echo '<h3>Schedule for the 3ft6 </h3>';
					echo '<div class="table-wrapper"><table><thead><tr><th>Rider Name</th><th>Horse Name</th><th>Time</th></thead>';
					while($row = $result89->fetch_assoc()) {
						echo				'<tr><td>'. $row['Rider'] .'</td><td>'. $row['Horse'] .'</td><td>'. $row['Time'] .'</td>';
					}	
						echo	'</table></div>';
				}
			}



				
?>
</section>
</section>
<!-- Footer -->
<br> </br>
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

