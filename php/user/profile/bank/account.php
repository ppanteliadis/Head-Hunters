<?php 
	session_start();
	include_once("../../../connectdb.php");
	if (!isset($_SESSION['pid'])) {
		header("Location: login.php");
	}

	/*Get all the info you need here!!!*/
	$s_pid=$_SESSION['pid'];
	$balance="0";
	$account="0";
	$card="0";

?>


<!-- SITE TITLE -->
<title>Head Hunters - My Account</title>

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
			<li><a href="../../../profile.php">Home</a></li>
		</ul>
		
	</div> <!-- /END WRAPPER -->
</nav>


<!-- =========================
	Main stuff
========================= -->
<section class="about" id="about">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h2>My Account</h2>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../../../images/dollar.png" alt="about">
		</div>
		
		<div class="col-6">
			<!-- HEADING -->
			<h2>My Balance</h2>
			<?php 
				$sql = "SELECT balance, credit_card_number, account 
						FROM credit_card
						WHERE (pid='".$s_pid."')";
				if ($result = mysqli_query($dbconn, $sql)) {
					$row = mysqli_fetch_row($result);

					$balance=$row[0];
					$card=$row[1];
					$account=$row[2];
				}
			?>
			<!-- FEATURES LIST -->
			<ul class="styled-icon-list">
				<li>
					<h4>Account:</h4>
					<?php 
						echo "<p>$account</p>";
					?>
				</li>
				<li>
					<h4>Available Balance:</h4>
					<?php 
						echo "<p>$balance$</p>";
					?>
				</li>
				<li>
					<h4>Card Number:</h4>
					<?php 
						echo "<p>$card</p>";
					?>
				</li>
			</ul>
		</div>

	</div> <!-- /END WRAPPER -->
</section>

</body>