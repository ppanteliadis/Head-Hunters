<?php 
	session_start();
	include_once("../connectdb.php");
	if (!isset($_SESSION['cid'])) {
		header("Location: ../login.php");
	}

	/*Get all the info you need here!!!*/
	$comp_name="";
	$s_cid = $_SESSION['cid'];
	$sql = "SELECT company_name
			FROM company 
			WHERE (cid = '$_SESSION[cid]')";

	if ($result = mysqli_query($dbconn, $sql)){
		$row = mysqli_fetch_row($result);
		$comp_name=$row[0];
	}

	$_SESSION['cid'] = $s_cid;
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
<script src="../js/jquery-2.0.3.min.js"></script>

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
			<a class="navigation-logo" href="company-profile.php">
				<img src="../images/logo.png" alt="logo">
			</a>	
		</div>
		
		<!-- NAVIGATION LINKS -->
		<ul class="navigation-links" data-navigation-handle=".navbar-header">
			<li><a href="#home">Home</a></li>
			
			<li><a href="#current">Current Employees</a></li>

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
		
	</div> <!-- /END WRAPPER -->
</nav>

<!-- =========================
	HOME
========================= -->
<header class="home dark-bg" id="home">
	<div class="color-overlay">
		<div class="wrapper">
			<!-- HEADING -->
			<h1>
				Welcome <span class="colored-text"><?php echo $comp_name;?></span>!
			</h1>
			<!-- SUB HEADING -->
			<p class="sub-heading">
				Ready to find a new <span class="colored-text">employee</span> today?
			</p>
			<!-- BUTTON -->
			<div class="btn-container">
				<a class="btn secondary-btn" href="profile-company/post_job.php">Post Job</a>
			</div>
			<!-- BUTTON -->
			<div class="btn-container">
				<a class="btn standard-btn" href="../logout.php">Logout</a>
			</div>
		</div> <!-- /END WRAPPER -->
	</div> <!-- /END COLOR OVERLAY -->
</header>

<!-- =========================
	Current Employess
========================= -->
<section class="about" id="current">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h2>Current Employess</h2>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../images/work.png" alt="work">
		</div>
		
		<div class="col-6">
			<!-- FEATURES LIST -->
			<ul class="styled-icon-list">
				<!-- SINGLE LIST ITEM -->
				<li>
					<!-- ICON -->
					<div class="icon">
						<i class="fa fa-briefcase"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/about/profession.php">Worker name</a>
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
						<i class="fa fa-money"></i>
					</div>
					<!-- CONTENT -->
					<a class="list-content" href="profile/bank/balance.php">Balance</a>
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