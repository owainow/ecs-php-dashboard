
<?php
session_start();
if(!isset($_SESSION['user_id'])) {
	$_SESSION['user_id'] = uniqid();
}
?>



<script>
function addCart(item){
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
           
       }
 };
//https://www.w3schools.com/xml/ajax_intro.asp
xhttp.open("GET", "addcart.php?value="+item, true);
xhttp.send();
}
</script>
<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
	<html>
	<head>
		<title>Equestrian Competition Schedular-Create an Event</title>
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
	<h3>Create an Event</h3>
	<p>Use the below form to create an event. For any queries view event organisers FAQ's</p>
					
	<?php
	    $conn = new mysqli($_ENV["MYSQL_IP_ADDRESS"], $_ENV["MYSQL_USER"], 
		$_ENV["MYSQL_PASSWORD"],$_ENV["MYSQL_DATABASE"]);

	if(!$con){
	die("failed to connect:" . mysqli_connect_error());
	}

$ShowGroundName="";
$email="";
$ShowGroundAddress="";
$Postcode="";
$DateOfComp="";
$ClosingDate="";
$Time="";
$Discipline="";
$Cost="";
$Instructions="";
$EventID="";
$Classes="";

$ShowGroundName   =test_input($_POST["ShowGroundName"]);
$email			  =test_input($_POST["email"]);
$ShowGroundAddress=test_input($_POST["ShowGroundAddress"]);
$Postcode         =test_input($_POST["Postcode"]);
$DateOfComp       =test_input($_POST["DateOfComp"]);
$ClosingDate      =test_input($_POST["ClosingDate"]);
$Time             =test_input($_POST["Time"]);
$Discipline       =test_input($_POST["Discipline"]);
$Cost             =test_input($_POST["Cost"]);
$Instructions     =test_input($_POST["Instructions"]);
$Classes          =implode(",",$_POST["Height"]);
//$EventID=test_input($_POST["EventID"]);

function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

if(isset($_POST['submit'])){

    if(!empty($_POST['Height'])) {

        foreach($_POST['Height'] as $value){
            //echo "value : ".$value.'<br/>';
        }

    }

}
	?>
				
				

<!-- Form -->
<h3>Form</h3>
<form name="myForm" method="POST" onsubmit="return(validate());" action="Submit.php">
<div class="row gtr-uniform">
<div class="col-6 col-12-xsmall">
	<input type="text" name="ShowGroundName" id="ShowGroundName" value="<?php echo $ShowGroundName;?>" placeholder="Show Ground Name"
	onfocus="ShowHide('Message1','block')" onblur="ShowHide('Message1','none')" />
	<div 
	id="Message1" style="display:none">Please Enter Showground name!
	</div>
</div>
<div class="col-6 col-12-xsmall">
	<input type="email" name="email" id="email" value="<?php echo $email;?>" placeholder="Email" 
	onfocus="ShowHide('Message2','block')" onblur="ShowHide('Message2','none')"/>
	<div 
	id="Message2" style="display:none">Please enter an email address!
	</div>
</div>
<div class="col-6 col-12-xsmall">
	<input type="text" name="ShowGroundAddress" id="ShowGroundAddress" value="<?php echo $ShowGroundAddress;?>" placeholder="Show Ground Address" 
	onfocus="ShowHide('Message3','block')" onblur="ShowHide('Message3','none')"/>
	<div 
	id="Message3" style="display:none">Please enter the Showground address!
	</div>
</div>
<div class="col-6 col-12-xsmall">
	<input type="text" name="Postcode" id="Postcode" value="<?php echo $Postcode;?>" placeholder="Postcode"
	onfocus="ShowHide('Message4','block')" onblur="ShowHide('Message4','none')" />
	<div 
	id="Message4" style="display:none">Please enter the Showgrounds postcode!
	</div>
</div>

<!-- Break -->
<label><h4>Date Of competition   </h4></label>
<div class="col-6 col-12-medium">
	<input type="text" name="DateOfComp" id="DateOfComp" value="<?php echo $DateOfComp;?>" placeholder="YYYY-MM-DD"
	onfocus="ShowHide('Message5','block')" onblur="ShowHide('Message5','none')" />
	<div 
	id="Message5" style="display:none">Please enter the date of the competition!
	</div>
</div>
<!-- Break -->

<label> <h4>Closing Date for entries</h4></label>
<div class="col-6 col-12-medium">
	<input type="text" name="ClosingDate" id="ClosingDate" value="<?php echo $ClosingDate;?>" placeholder="YYYY-MM-DD"
	onfocus="ShowHide('Message6','block')" onblur="ShowHide('Message6','none')" />
	<div 
	id="Message6" style="display:none">Please enter closing date for entries!
	</div>
</div>

<!-- Break -->
<div class="col-12">
<select name="Time" id="Time" value="<?php echo $Time;?>"  >
	<option value="">-Time Of First Class-</option>
	<option value="9:00:00">9.00</option>
	<option value="9:30:00">9.30</option>
	<option value="10:00:00">10.00</option>
	<option value="10:30:00">10.30</option>
	<option value="11:00:00">11.00</option>
	<option value="11:30:00">11.30</option>
	<option value="12:00:00">12.00</option>
	<option value="12:30:00">12.30</option>
</select>
</div>
<div class="col-6 col-12-xsmall">
	<input type="text" name="Discipline" id="Discipline" value="<?php echo $Discipline;?>" placeholder="Discipline"
	onfocus="ShowHide('Message7','block')" onblur="ShowHide('Message7','none')" />
	<div 
	id="Message7" style="display:none">Please enter the discipline of the competition
	</div>
</div>
<div class="col-6 col-12-xsmall">
	<input type="text" name="Cost" id="Cost" value="<?php echo $Cost;?>" placeholder="£ Cost per class" 
	onfocus="ShowHide('Message8','block')" onblur="ShowHide('Message8','none')" />
	<div 
	id="Message8" style="display:none">Please enter a cost per class!
	</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Break -->

<body>
  <div id="main">
    <div id="first">
	  <h4>Select classes to run</h4>
	  <div>
      <div class="col-6 col-12-small" name="Classes" id="Classes" value="<?php echo $Classes;?>">
        <input class="first" id="Item 1" name='Height[]' value="2ft0" type="checkbox">
        <label class="label1" for="Item 1">2ft0</label>
        <input class="first" id="Item 2" name='Height[]' value="2ft3" type="checkbox">
        <label class="label1" for="Item 2">2ft3</label>
        <input class="first" id="Item 3" name='Height[]' value="2ft6" type="checkbox">
        <label class="label1" for="Item 3">2ft6</label>
        <input class="first" id="Item 4" name='Height[]' value="2ft9" type="checkbox">
		<label class="label1" for="Item 4">2ft9</label>
		<input class="first" id="Item 5" name='Height[]' value="3ft0" type="checkbox">
		<label class="label1" for="Item 5">3ft0</label>
		<input class="first" id="Item 6" name='Height[]' value="3ft3" type="checkbox">
		<label class="label1" for="Item 6">3ft3</label>
		<input class="first" id="Item 7" name='Height[]' value="3ft6" type="checkbox">
		<label class="label1" for="Item 7">3ft6</label>
	  </div>
</div>
	  <div>
	  
	  </div>
	  <br>
</br>
</body>
<!-- Break -->
<div class="col-12">
	<textarea name="Instructions" id="Instructions" value="<?php echo $Instructions;?>"  placeholder="Additional Venue information" rows="6"></textarea>
</div>
<br>
</br>
<!-- Break -->
<div class="col-12">
<ul class="actions">
	<li><input type="submit" name="submit" value="Submit Form" class="primary" /></li>
	<li><input type="reset" value="Reset" /></li>
</ul>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>

<script type="text/javascript">
			
				
					function ShowHide(theDiv,how){
					document.getElementById(theDiv).style.display = how;
					}
					function validate()
					{
					if( document.myForm.ShowGroundName.value == "" )
					{
					alert( "Please Enter the Showground Name" );
					document.myForm.ShowGroundName.focus() ;
					return false;
					}

					if( document.myForm.email.value == "" )
					{
					alert( "Please Enter the Shwoground's Email address" );
					document.myForm.email.focus() ;
					return false;
					}
					
					if( document.myForm.ShowGroundAddress.value == "" )
					{
					alert( "Please Enter the ShowGround's Address" );
					document.myForm.ShowGroundAddress.focus() ;
					return false;
					}

					if( document.myForm.Postcode.value == "" )
					{
					alert( "Please Enter the Showground's Postcode" );
					document.myForm.Postcode.focus() ;
					return false;
					}

					if( document.myForm.DateOFComp.value == "" )
					{
					alert( "Please Enter the desired date for the competition" );
					document.myForm.DateOfComp.focus() ;
					return false;
					}

					if( document.myForm.ClosingDate.value == "" )
					{
					alert( "Please Enter the closing date for entries" );
					document.myForm.ClosingDate.focus() ;
					return false;
					} 

					if( document.myForm.Discipline.value == "" )
					{
					alert( "Please Enter the Discipline for the Competition" );
					document.myForm.Discipline.focus() ;
					return false;
					} 

					if( document.myForm.Cost.value == "" )
					{
					alert( "Please Enter the Cost for a competitors entry" );
					document.myForm.Cost.focus() ;
					return false;
					} 

					return( true );
                     }
        			</script>

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
