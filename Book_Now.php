				<?php
				// Start the session
				session_start();
				//On page 1
				?>
				<!DOCTYPE HTML>
				<!--
					Industrious by TEMPLATED
					templated.co @templatedco
					Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
				-->
				<html>
				<head>
					<title>Equestrian Competition Schedular-Enter Competition</title>
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
				<h1>Enter Competition</h1>
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
				//Connection to the database
				$con = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
				$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);
				if(!$con){
				die("failed to connect:" . mysqli_connect_error());
				}
				//Pull data from the table events
				 $ID_Parameter= $_GET['ID'];
				$query = "SELECT * FROM Events WHERE Event_ID='$ID_Parameter'";
				$result = mysqli_query($con,$query);
				($row = mysqli_fetch_assoc($result));
				echo  '<section>';
				echo  '<div class="content">';
				echo  '<header>';
				echo  '<a href="#" class="icon fa-vcard-o"><span class="label">Icon</span></a>';
				echo  '<h3>'. $row['Showground_Name'] .'</h3>';
				echo  '</header>';
				echo  '<h4><b>Discipline:</b> 		'. $row['Discipline'] .'</h4>';
				echo  '<h4><b>Date of Event:</b> 	'. $row['Date_of_Event'] .'</h4>';
				echo  '<h4><b>Entries Close:</b> 	'. $row['Closing_Date'] .'</h4>';
				echo  '<h4><b>Show Ground:</b> 		'. $row['Showground_Address'] .'</h4>';
				echo  '<h4><b>Time of first class:</b> '. $row['Time_of_first_class'] .'</h4>';
				echo  '<h4><b>Cost Per Class:</b> £'. $row['Cost_per_class'] .'</h4>';
				echo  '<h4><b>Special Instructions:</b> '. $row['Special_Instructions'] .'</h4>';
				echo  '</div>';
				echo  '</section>';
				$CompHeights[]=$row['Classes'];

				


				$EventID="";
				$RiderName="";
				$HorseName="";
				$PhoneNumber="";
				$Email="";
				$Address="";
				$Postcode="";
				$Classes="";
				$Vaccination="";
				

				//Post the variables
				$EventID	=test_input($_POST["$ID_Parameter"]);
				$RiderName	=test_input($_POST["Name"]);
				$HorseName	=test_input($_POST["Horse"]);
				$PhoneNumber=test_input($_POST["Number"]);
				$Email		=test_input($_POST["email"]);
				$Address	=test_input($_POST["Address"]);
				$Postcode	=test_input($_POST["Postcode"]);
				$Classes    =test_input($_POST["Height"]);
				$Vaccination=test_input($_POST["Vaccination"]);
				
				
		
				
				//Trim the data 
				function test_input($data){
						$data=trim($data);
						$data=stripslashes($data);
						$data=htmlspecialchars($data);
						return $data;
				}
				// Comma deliminated height
				if(isset($_POST['submit'])){
					if(!empty($_POST['Height'])) {
					foreach($_POST['Height'] as $value){
					//echo "value : ".$value.'<br/>';
					}
					}
				}

				//Vaccination date validation
				//Adapted using https://stackoverflow.com/questions/1990321/date-minus-1-year
				$current_date = date("y-m-d");
				$lastyear = strtotime("-6 months", strtotime($current_date));
				 $datecompare= date("Y-m-d", $lastyear);

					
				?>		
								
				<!-- Form -->
				<h3>Form</h3>
				<form name="myForm" method="Post" onsubmit="return(validate());"  action="<?php echo 'Book.php?ID='.$row['Event_ID'].'';?>">
				<div class="row gtr-uniform">
					<div class="col-6 col-12-xsmall">
						<input type="text" name="Name" id="Name" value="<?php echo $RiderName;?>" placeholder="Name of rider" 
						onfocus="ShowHide('Message1','block')" onblur="ShowHide('Message1','none')" />
						<div 
						id="Message1" style="display:none">Please Enter rider name
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="Horse" id="Horse" value="<?php echo $HorseName;?>" placeholder="Name of Horse" 
						onfocus="ShowHide('Message2','block')" onblur="ShowHide('Message2','none')"/>
						<div 
						id="Message2" style="display:none">Please enter Your Horse's name!
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="Number" id="Number" value="<?php echo $PhoneNumber;?>" placeholder="Phone Number"
						onfocus="ShowHide('Message3','block')" onblur="ShowHide('Message3','none')" />
						<div 
						id="Message3" style="display:none">Please enter your phone number!
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="email" name="email" id="email" value="<?php echo $Email;?>" placeholder="E-mail" 
						onfocus="ShowHide('Message4','block')" onblur="ShowHide('Message4','none')"/>
						<div 
						id="Message4" style="display:none">Please enter your Email!
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="Address" id="Address" value="<?php echo $Address;?>" placeholder="Address" 
						onfocus="ShowHide('Message5','block')" onblur="ShowHide('Message5','none')"/>
						<div 
						id="Message5" style="display:none">Please enter your home Address!
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="text" name="Postcode" id="Postcode" value="<?php echo $Postcode;?>"  placeholder="Postcode" 
						onfocus="ShowHide('Message6','block')" onblur="ShowHide('Message6','none')"/>
						<div 
						id="Message6" style="display:none">Please enter your home Postcode!
						</div>
					</div>
					<div class="col-6 col-12-xsmall">
					<label> <h4>Last Vaccination Date</h4></label>
						<input type="text" name="Vaccination" id="Vaccination" value="<?php echo $Vaccination;?>" min="<?php $datecompare;?>" placeholder="YYYY-MM-DD" 
						onfocus="ShowHide('Message7','block')" onblur="ShowHide('Message7','none')"/>
						<div 
						id="Message7" style="display:none">Please enter your horse's last flue vaccine date!
						</div>
				    </div>
					<body>
					<div id="main">
						<div id="first">
						<h4>Select classes</h4>
						<div>





<?php
$query2 = "SELECT Classes FROM Events WHERE Event_ID='$ID_Parameter'";
$result2 = mysqli_query($con,$query2);
while($row = mysqli_fetch_array($result2)) {
	$Prod=$row['Classes'];
	$Temp=explode(",",$Prod);
	
	}
	foreach($Temp as $p) {
							?>
							<div class="col-6 col-12-small" name="Classes" id="Classes" value="<?php echo $Classes;?>">
							<input class="first" id="<?php echo $p;?>" name='Height[]' value=<?php echo $p;?> type="checkbox">
							<label class="label1" for="<?php echo $p;?>"><?php echo $p;?></label>

							<?php
	}
	?>
						</div>
						</div>
	
						<br>
						</br>
						</div>
				
					</body>
				
					<div class="col-12">
					<ul class="actions">
						<li><input type="submit"  name="submit"  value="Enter Competition" class="primary" /></li>
						<li><input type="reset" value="Reset" /></li>
					</ul>
					</div>
					</div>
					</form>
					 
					<script type="text/javascript">
			
				
					function ShowHide(theDiv,how){
					document.getElementById(theDiv).style.display = how;
					}
					function validate()
					{
					if( document.myForm.Name.value == "" )
					{
					alert( "Please Enter your name" );
					document.myForm.Name.focus() ;
					return false;
					}

					if( document.myForm.Horse.value == "" )
					{
					alert( "Please Enter your Horse's name" );
					document.myForm.Horse.focus() ;
					return false;
					}
					
					if( document.myForm.Number.value == "" )
					{
					alert( "Please Enter your preferred number to be contacted on" );
					document.myForm.Number.focus() ;
					return false;
					}

					if( document.myForm.email.value == "" )
					{
					alert( "Please Enter your Email address" );
					document.myForm.email.focus() ;
					return false;
					}

					if( document.myForm.Address.value == "" )
					{
					alert( "Please Enter your Address" );
					document.myForm.Address.focus() ;
					return false;
					}

					if( document.myForm.Postcode.value == "" )
					{
					alert( "Please Enter your Postcode" );
					document.myForm.Postcode.focus() ;
					return false;
					}
					var datetest='<?php echo $datecompare; ?>';
					var currentdate='<?php echo $current_date; ?>';
					if( document.myForm.Vaccination.value == "" ||
					 document.myForm.Vaccination.value < datetest )
					{
					alert( "Your Horse's Flue vaccine is out of date. Unfortunately you are unable to enter into the competition." );
					document.myForm.Vaccination.focus() ;
					return false;		
					}
					return( true );
                     }
        			</script>

					</div>
					</div>
					</div>
					</div>
					</section>
					</section>				
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