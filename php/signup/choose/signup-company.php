<?php
	session_start();
	error_reporting(0);
	include_once("../../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}

	$qcompany_name 	 = "";
	$qusername 		 = "";
	$qpassword		 = "";
	$qaddress 		 = "";
	$qphone 		 = "";
	$qmail 			 = "";
	$qaccount 		 = "";

?>

<!DOCTYPE html>
<title>Head Hunters - Signup</title>
<html>
<body>
<!-- FONT AWESOME -->
<link rel="stylesheet" href="../../css/font-awesome.min.css">

<!-- FORMSTONE NAVIGATION -->
<link rel="stylesheet" href="../../css/navigation.css">

<!-- COLORS -->
<link rel="stylesheet" href="../../css/colors/blue.css"> 
<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="../../css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="../../css/responsive.css">

<!-- Jquery -->
<script src="js/jquery-2.0.3.min.js"></script>

<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="profile.php">
				<img src="../../images/logo.png" alt="logo">
			</a>
		</div>
	</div> <!-- /END WRAPPER -->
</nav>

<!-- =========================
	HOME
========================== -->
<header class="signup dark-bg" id="signup">
	<div class="color-overlay">
		<div class="swrapper">
		<h1>Join Head Hunters <span class="colored-text">NOW</span>!</h1>
			<form class="sform" method="post">
				<input type="text" name="username" value="" placeholder="Username" maxlength="30">
				<input type="password" name="password" value="" placeholder="Password" maxlength="30">
				<input type="text" name="company_name" value="" placeholder="Company name" maxlength="50">
				<input type="text" name="address" value="" placeholder="Address" maxlength="80">
				<input type="text" name="phone" value="" placeholder="Phone"maxlength="60">
				<input type="text" name="mail" value="" placeholder="email" maxlength="40" method="post">
				<input type="text" name="account" value="" placeholder="Bank Account">

				<input type="submit" class="button" name='create_account' value="Create Account"></input>

				<?php
					if (isset($_POST["create_account"])) {

						$qcompany_name 	 = $_POST['company_name'];
						$qusername 		 = $_POST['username'];
						$qpassword		 = $_POST['password'];
						$qaddress 		 = $_POST['address'];
						$qphone 		 = $_POST['phone'];
						$qmail 			 = $_POST['mail'];
						$qaccount 		 = $_POST['account'];

						$sql1 = "INSERT INTO company (company_name, username, password, address, phone, mail, account) 
								VALUES ('$qcompany_name', '$qusername', '$qpassword', '$qaddress', '$qphone', '$qmail', '$qaccount')";
						$sql2 = "SELECT username, mail FROM company
								 WHERE (username = '".$qusername."' OR mail = '".$qmail."')";


						if ($dbconn->query($sql2)) {
							if ($dbconn->query($sql1)) {
								echo "<script> window.location.assign('../signupsuccess.php');</script>";
							}
						}
						else {
							//FIXME check if variables are empty
							echo "<p align='center'><font color='red'><br><br><br><br>The selected username || email is already in use.</font></p>";
						}

						$dbconn->close();
					}
				?>
			</form>
	</div> <!-- /END COLOR OVERLAY -->
</header>


<!-- =========================
	CONTACT
========================== -->
<section class="contact dark-bg" id="contact">
	<div class="color-overlay">
		<div class="wrapper">
	
			<!-- HEADING -->
			<h2>Contact Us</h2>
			
			<!-- LINE -->
			<div class="main-line"></div>
			
			<!-- CONTACT INFORMATION -->
			<ul class="styled-icon-list">
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-envelope-o"></i>
					</div>
					<!-- CONTENT -->
					<p class="list-content"><span><a href="mailto:panteliad@csd.uoc.gr">panteliad@csd.uoc.gr</a></span></p>
				</li>

				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-envelope-o"></i>
					</div>
					<!-- CONTENT -->
					<p class="list-content"><span><a href="mailto:koropulis@csd.uoc.gr">koropulis@csd.uoc.gr</a></span></p>
				</li>
				
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-map-marker"></i>
					</div>
					<!-- CONTENT -->
					<p class="list-content"><span>Heraklion, Crete</span></p>
				</li>
				
			</ul>
			
		</div> <!-- /END WRAPPER -->
	</div> <!-- /END OVERLAY -->
</section>


<!-- =========================
	FOOTER   
========================= -->	
<footer class="dark-bg">
	<!-- BACK TO TOP -->
	<a class="icon back-to-top" href="#home"><i class="fa fa-home"></i></a>
</footer>


<script>
//make sure that js is enabled
$('html').addClass('js');
</script>



<!-- =========================
	SCRIPTS   
========================= -->   
<!-- Formstone Navigation -->
<script src="js/core.js"></script>
<script src="js/mediaquery.js"></script>
<script src="js/swap.js"></script>
<script src="js/touch.js"></script>
<script src="js/navigation.js"></script>

<!-- Smoothscroll -->
<script src="js/smoothscroll.js"></script>

<!-- Jquery Nav -->
<script src="js/jquery.nav.js"></script>

<!-- ImagesLoaded -->
<script src="js/jquery.imagesloaded.js"></script>

<!-- Wookmark -->
<script src="js/jquery.wookmark.min.js"></script>

<!-- Retina -->
<script src="js/retina.min.js"></script>

<!-- Custom Script -->
<script src="js/custom.js"></script>


</body>
</html>