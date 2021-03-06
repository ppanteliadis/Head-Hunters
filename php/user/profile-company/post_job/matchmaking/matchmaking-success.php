<title>Head Hunters - Matchmaking Success!</title>
<?php

	session_start();
	include_once("../../../../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}

	$person_pid = $_SESSION['hired_pid'];

?>

<!DOCTYPE html>
<html>
<body>
<!-- FONT AWESOME -->
<link rel="stylesheet" href="../../../../css/font-awesome.min.css">

<!-- FORMSTONE NAVIGATION -->
<link rel="stylesheet" href="../../../../css/navigation.css">

<!-- COLORS -->
<link rel="stylesheet" href="../../../../css/colors/blue.css"> 
<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="../../../../css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="../../../css/responsive.css">

<!-- Jquery -->
<script src="js/jquery-2.0.3.min.js"></script>

<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../login.php">
				<img src="../../../../images/logo.png" alt="logo">
			</a>
		</div>
	</div> <!-- /END WRAPPER -->
</nav>

<header class="signupsuccess dark-bg" id="signupsuccess">
	<div class="color-overlay">
		<div class="sswrapper">
			<!-- HEADING -->
			<h1>
				<span class="colored-text">CONGRATULATIONS</span>!
			</h1>
			<h2>
				<?php
					$sql = "SELECT first_name, last_name FROM person WHERE pid = $person_pid";
					if ($result = mysqli_query($dbconn, $sql)) {
						$row = mysqli_fetch_row($result);
						$name = $row[0];
						$surname = $row[1];
						?>
						<span class="colored-text"><?php echo $name." ".$surname;?></span>
						<?php
					}
				?>
				is now <span class="colored-text"> hired</span>!
			</h2>
			<p class="sssignup">
				<a href="../../../profile-company.php" class="colored-text">Return to Profile</a>
			</p>
	</div> <!-- /END COLOR OVERLAY -->
</header>


<!-- ==================
	FOOTER
=================== -->
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
<script src="../js/core.js"></script>
<script src="../js/mediaquery.js"></script>
<script src="../js/swap.js"></script>
<script src="../js/touch.js"></script>
<script src="../js/navigation.js"></script>

<!-- Smoothscroll -->
<script src="../js/smoothscroll.js"></script>

<!-- Jquery Nav -->
<script src="../js/jquery.nav.js"></script>

<!-- ImagesLoaded -->
<script src="../js/jquery.imagesloaded.js"></script>

<!-- Wookmark -->
<script src="../js/jquery.wookmark.min.js"></script>

<!-- Retina -->
<script src="../js/retina.min.js"></script>

<!-- Custom Script -->
<script src="../js/custom.js"></script>

</body>
</html>