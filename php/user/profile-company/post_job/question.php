<?php
	session_start();
	error_reporting(0);
	include_once("../../../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}

	$s_posid = "";

	$s_cid 			= $_SESSION['cid'];
	$s_job_title	= $_SESSION['job_title'];
	$s_city			= $_SESSION['city'];
	$s_studies 		= $_SESSION['studies'];
	$s_languages	= $_SESSION['languages'];
	$s_skillz		= $_SESSION['skillz'];


	$_SESSION['cid'] = $s_cid;
?>
<!DOCTYPE html>
<title>Head Hunters - Question </title>
<html>
<body>
<!-- FONT AWESOME -->
<link rel="stylesheet" href="../../../css/font-awesome.min.css">

<!-- FORMSTONE NAVIGATION -->
<link rel="stylesheet" href="../../../css/navigation.css">

<!-- COLORS -->
<link rel="stylesheet" href="../../../css/colors/blue.css"> 
<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="../../../css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="../../../css/responsive.css">

<!-- Jquery -->
<script src="../../../js/jquery-2.0.3.min.js"></script>

<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../../../user/profile-company.php">
				<img src="../../../images/logo.png" alt="logo">
			</a>
		</div>
	</div> <!-- /END WRAPPER -->
</nav>

<!-- =========================
	HOME
========================= -->

<header class="signup dark-bg" id="signup">
	<div class="color-overlay">
		<div class="swrapper">
		<h1>These are the <span class="colored-text">Candidates</span></h1>
		<h3> that match your criteria!</h3>
		<?php 
			$sql1 = "SELECT DISTINCT pid FROM open_position, person
					 WHERE open_position.cid=$s_cid AND (person.prof=open_position.field 
						OR person.studies LIKE '%open_position.studies%'
						OR person.skillz LIKE '%open_position.skillz%' 
						OR person.languages LIKE '%open_position.pref_languages%')";

			if ($result1 = mysqli_query($dbconn, $sql1)){
				$data = array();
				while ($row = mysqli_fetch_assoc($result1)) {
					$data[] = $row["pid"];
				}

				mysqli_free_result($result1);

				?>
				<table style="float:center" class="table_center">
					<tr>
						<th id="top_left">pid</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Studies</th>
						<th>Skills</th>
						<th>Languages</th>
						<th>Hired</th>
						<th id="top_right">Available From</th>
					</tr>

				<?php
				$size = count($data);
				$i = 0;
				while ($i < $size) {
					$sql2 = "SELECT * FROM person WHERE pid = '$data[$i]'";
					if ($result2 = mysqli_query($dbconn, $sql2)) {
						while ($row2 = mysqli_fetch_array($result2)) {
							?>
							<tr>
								<td>
									<?php 
										echo $row2['pid'];
									?>
								</td>
								<td>
									<?php 
										echo $row2['first_name'];
									?>
								</td>
								<td>
									<?php
										echo $row2['last_name'];
									?>
								</td>
								<td>
									<?php
										echo $row2['address'];
									?>
								</td>
								<td>
									<?php
										echo $row2['studies'];
									?>
								</td>
								<td>
									<?php
										echo $row2['skillz'];
									?>
								</td>
								<td>
									<?php
										echo $row2['languages'];
									?>
								</td>
								<td>
									<?php
										if ($row2['hired'] == "1"){
											echo "YES";
										}
										else {
											echo "NO";
										}
									?>
								</td>
								<td>
									<?php
										echo $row2['availability'];
									?>
								</td>
							</tr>
							<?php
						}
					}
					$i = $i + 1;
				}
				?></table><?php
			}
			$dbconn->close();
		?>
		</div>
	</div>
</header>






<!-- ==================
	CONTACT
=================== -->
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


<!-- ====================
	FOOTER
===================== -->
<footer class="dark-bg">
	<!-- BACK TO TOP -->
	<a class="icon back-to-top" href="#home"><i class="fa fa-home"></i></a>
</footer>


<script>
//make sure that js is enabled
$('html').addClass('js');
</script>

</body>
</html>









