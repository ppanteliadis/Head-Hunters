<?php 
	session_start();
	include_once("../connectdb.php");

	error_reporting(0);

	if (!isset($_SESSION['pid'])) {
		header("Location: ../login.php");
	}

	/*Get all the info you need here!!!*/
	$firstname = "";
	$lastname = "";
	$balance="0";
	$s_pid=$_SESSION['pid'];
	$sql1 = "SELECT first_name, last_name
			FROM person 
			WHERE (pid = '$_SESSION[pid]')";


	if ($result1 = mysqli_query($dbconn, $sql1)){
		$row1 = mysqli_fetch_row($result1);
		$firstname = $row1[0];
		$lastname = $row1[1];
	}

?>




<!-- SITE TITLE -->
<title>Head Hunters - profile</title>

<!-- =========================
	FAV AND TOUCH ICONS  
========================= -->	
<link rel="icon" href="../images/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png">

<!-- =========================
	STYLESHEET
========================= -->	
<!-- FONT AWESOME -->
<link rel="stylesheet" href="../css/font-awesome.min.css">

<!-- FORMSTONE NAVIGATION -->
<link rel="stylesheet" href="../css/navigation.css">

<!-- COLORS -->
<link rel="stylesheet" href="../css/colors/blue.css">

<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="../css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="../css/responsive.css">

<!-- Jquery -->
<script src="js/jquery-2.0.3.min.js"></script>

<script>
//make sure that js is enabled
$('html').addClass('js');
</script>

<!--[if lt IE 9]>
	<style>
	* {
		font-size:16px;
	}
	
	label {
		display:block;
	}
	</style>
<![endif]-->

</head>

<body>
<!-- =========================
	PRELOADER
========================== -->
<div class="preloader"></div>

<!-- =========================
	NAVIGATION 
========================== -->
<nav class="navigation dark-bg">
	<div class="wrapper">
		
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="profile.php">
				<img src="../images/logo.png" alt="logo">
			</a>	
		</div>
		
		<!-- NAVIGATION LINKS -->
		<ul class="navigation-links"  data-navigation-handle=".navbar-header">
			<li><a href="#home">Home</a></li>
			
			<li><a href="#about">About</a></li>

			<li><a href="#bank">My Bank</a></li>

			<li>
				<a href="#" class="external">Features</a> <!-- external link (out of this page) -->
				<!-- DROP DOWN -->
				<ul>
					<li><a href="single-portfolio.html">Single Portfolio</a></li>
					<li><a href="404.html">404 Page</a></li>
					<li><a href="shortcodes.html">Shortcodes</a></li>
				</ul>
			</li>
		</ul>
		
	</div><!-- /END WRAPPER -->
</nav>

<!-- =========================
	HOME
========================= -->
<header class="home dark-bg" id="home">
	<div class="color-overlay">
		<div class="wrapper">
			<!-- HEADING -->
			<h1>
				Welcome <span class="colored-text"><?php echo $firstname;?></span>
			</h1>
			<!-- SUB HEADING -->
			<p class="sub-heading">
				Ready to find a new <span class="colored-text">job</span> today!
			</p>
			<!-- BUTTON -->
			<div class="btn-container">
				<a class="btn secondary-btn" href="profile/possible-jobs.php">Find Job</a>
			</div>
			<!-- BUTTON -->
			<div class="btn-container">
				<a class="btn standard-btn" href="../logout.php">Logout</a>
			</div>
		</div> <!-- /END WRAPPER -->
	</div> <!-- /END COLOR OVERLAY -->
</header>

<!-- =========================
	ABOUT
========================= -->
<section class="about" id="about">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h2>ABOUT ME</h2>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../images/about.jpg" alt="about">
		</div>
		
		<div class="col-6">
			<!-- HEADING -->
			<h3>What am I doing</h3>

			<!-- PARAGRAPH -->
			<p>
				Nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan dolore te feugait nulla facilisi.
			</p>

			<!-- HEADING -->
			<h3>Why me</h3>

			<!-- FEATURES LIST -->
			<ul class="styled-icon-list">
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-briefcase"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/about/profession.php">Profession</a>
				</li>

				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-graduation-cap"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/about/studies.php">Studies</a>
				</li>
				
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-bar-chart"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/about/skills.php">Skills</a>
				</li>
				
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-globe"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/about/languages.php">Languages</a>
				</li>
			</ul>
		</div>
		
	</div> <!-- /END WRAPPER -->
</section>



<!-- =========================
	BANK
========================= -->
<section class="bank" id="bank">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h2>My Bank</h2>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../images/bank.png" alt="bank">
		</div>
		
		<div class="col-6">
			<!-- Credit Cards list -->
			<ul class="styled-icon-list">
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-university" onclick="account.php"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/bank/account.php">Account</a>
				</li>

				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-credit-card"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/bank/card.php">Card</a>
				</li>

			</ul>

		</div>

	</div> <!-- /END WRAPPER -->
</section>



<!-- =========================
	CONTACT
========================= -->
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


