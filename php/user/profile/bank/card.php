<?php 
	session_start();
	include_once("../../../connectdb.php");
	if (!isset($_SESSION['pid'])) {
		header("Location: login.php");
	}

	/*Get all the info you need here!!!*/
	$s_pid=$_SESSION['pid'];
	$card_number="";
	$cvv="";
	$expires="";
	$type="";

?>


<!-- SITE TITLE -->
<title>Head Hunters - card</title>

<!-- =========================
	STYLESHEET
========================= -->	
<!-- FONT AWESOME -->
<link rel="stylesheet" href="../../../css/font-awesome.min.css">

<!-- COLORS -->
<link rel="stylesheet" href="../../../css/colors/blue.css">

<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="../../../css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="../../../css/responsive.css">

<!-- Jquery -->
<script src="js/jquery-2.0.3.min.js"></script>

<script>
//make sure that js is enabled
$('html').addClass('js');
</script>

<body>
<!-- =========================
	PRELOADER
========================== -->
<div class="preloader"></div>
<nav class="navigation dark-bg">
	<div class="wrapper">
		
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../../profile.php">
				<img src="../../../images/logo.png" alt="logo">
			</a>	
		</div>
		
		<!-- NAVIGATION LINKS -->
		<ul class="navigation-links"  data-navigation-handle=".navbar-header">
			<li><a href="../../profile.php">Home</a></li>
		</ul>
		
	</div> <!-- /END WRAPPER -->
</nav>


<!-- =========================
	Main stuff
========================= -->
<section class="about" id="about">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h2>My Card</h2>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../../../images/card.png" alt="card">
		</div>
		
		<div class="col-6">
			<!-- HEADING -->
			<h2>My Card</h2>

			<!-- FEATURES LIST -->
			<ul class="styled-icon-list">
				<li>
					<?php
						$sql = "SELECT credit_card_number, cvc, expiration_date FROM credit_card
								WHERE (pid='".$s_pid."')";
						if ($result = mysqli_query($dbconn, $sql)) {
							$row = mysqli_fetch_row($result);

							$card_number=$row[0];
							$cvv=$row[1];
							$expires=$row[2];
						}
					?>
					<h4>Card number:</h4>
					<?php 
						echo "<p>$card_number</p>";
					?>
				</li>

				<li>
					<h4>CVC:</h4>
					<?php 
						echo "<p>$cvv</p>";
					?>
				</li>
				<li>
					<h4>Expires:</h4>
					<?php 
						echo "<p>$expires</p>";
					?>
				</li>
			</ul>
			<p><a href="card/add_card.php">Add Card</a><p>
			<p><a href="card/delete_card.php">Delete Card</a><p>
		</div>

	</div> <!-- /END WRAPPER -->
</section>

</body>