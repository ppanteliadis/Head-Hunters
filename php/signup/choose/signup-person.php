<?php
	session_start();
	error_reporting(0);
	include_once("../../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}
?>

<!DOCTYPE html>
<title>Head Hunters - Signup</title>
<html>
<body>

<!-- =========================
	STYLESHEET
========================== -->
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
<script src="../../js/jquery-2.0.3.min.js"></script>

<!-- =========================
	NAVIGATION 
========================== -->
<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../../login.php">
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
				<input type="text" name="first_name" value="" placeholder="First name" maxlength="30">
				<input type="text" name="last_name" value="" placeholder="Last name" maxlength="30">
				<input type="text" name="address" value="" placeholder="Address" maxlength="80">
				<input type="text" name="phone" value="" placeholder="Phone"maxlength="60">
				<input type="text" name="mail" value="" placeholder="email" maxlength="40" method="post">
				<input type="text" name="prof" value="" placeholder="Profession">
				<input type="text" name="account" value="" placeholder="Bank Account">
				<input type="text" name="availability" value="" placeholder="Available from: YYYY/MM/DD">

				<label for="studies"></label>
				<select multiple="multiple" id="studies" class="specialColor" name="studies[]">
					<option value='highschool degree'>Highschool Degree</option>
					<option value='MSc'>MSc</option>
					<option value='PhD'>PhD</option>
					<option value='MD'>MD</option>
					<option value='EdD'>EdD</option>
					<option value='JD'>JD</option>
				</select>
				
				<label for="skillz"></label>
				<select multiple="multiple" id="skillz" name="skillz[]">
					<option value='administering programs'>Administering Programs</option>
					<option value='advising people'>Advising people</option>
					<option value='analyzing data'>Analyzing data</option>
					<option value='assembling apparatus'>Assembling apparatus</option>
					<option value='auditing financial reports'>Auditing financial reports</option>
					<option value='budgeting expenses'>Budgeting expenses</option>
					<option value='calculating numerical data'>Calculating numerical data</option>
					<option value='finding information'>Finding information</option>
					<option value='handling complaints'>Handling complaints</option>
					<option value='imagining new solutions'>Imagining new solutions</option>
					<option value='interpreting languages'>Interpreting languages</option>
					<option value='speaking to the public'>Speaking to the public</option>
					<option value='writing letters/papers/proposals'>Writing letters/papers/proposals</option>
					<option value='listening to others'>Listening to others</option>
					<option value='deciding uses of money'>Deciding uses of money</option>
					<option value='determining a problem'>Determining a problem</option>
					<option value='setting work/committee goals'>Setting work/committee goals</option>
					<option value='maintaining emotional control under stress'>Maintaining emotional control under stress</option>
				</select>
				
				<label for="languages"></label>
				<select multiple="multiple" id="languages" name="languages[]">
					<option value='english'>English</option>
					<option value='greek'>Greek</option>
					<option value='german'>German</option>
					<option value='japanese'>Japanese</option>
					<option value='spanish'>Spanish</option>
					<option value='italian'>Italian</option>
					<option value='french'>French</option>
					<option value='wookie'>Wookie</option>
					<option value='klingon'>Klingon</option>
					<option value='other'>Other</option>
				</select>

				<input type="submit" class="button" name='create_account' value="Create Account"></input>

				<?php
					if (isset($_POST["create_account"])) {

						$qfirst_name 	 = $_POST['first_name'];
						$qlast_name 	 = $_POST['last_name'];
						$qusername 		 = $_POST['username'];
						$qpassword		 = $_POST['password'];
						$qaddress 		 = $_POST['address'];
						$qphone 		 = $_POST['phone'];
						$qmail 			 = $_POST['mail'];
						$qprof 			 = $_POST['prof'];
						$qaccount 		 = $_POST['account'];
						$qavailability	 = $_POST['availability'];

						if (empty($qavailability)) {
							date_default_timezone_set('Europe/Athens');
							$qavailability = date('Y/m/d', time());
						}
						else {
							$qavailability	 = date('Y/m/d', strtotime($qavailability));
						}

						$qstudies 		 = "'" . implode("','", $_POST['studies']) . "'";
						$qlanguages 	 = "'" . implode("','", $_POST['languages']) . "'";
						$qskillz		 = "'" . implode("','", $_POST['skillz']) . "'";

						$qstudies = str_replace('\'', '', $qstudies);
						$qlanguages = str_replace('\'', '', $qlanguages);
						$qskillz = str_replace('\'', '', $qskillz);

						$qstudies='\''.$qstudies.'\'';
						$qlanguages='\''.$qlanguages.'\'';
						$qskillz='\''.$qskillz.'\'';


						$sql1 = "INSERT INTO person (first_name, last_name, username, password, address, phone, mail, prof, account, languages, skillz, studies, availability) 
										VALUES ('$qfirst_name', '$qlast_name', '$qusername', '$qpassword', '$qaddress', '$qphone', '$qmail', '$qprof', '$qaccount', $qlanguages, $qskillz, $qstudies, '$qavailability')";
						$sql2 = "SELECT username, mail FROM person
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