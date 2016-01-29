<?php 
	session_start();
	include_once("../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}

	error_reporting(0);
	$num_of_filled_positions = 0;
?>




<!DOCTYPE html>
<title>Head Hunters - History</title>
<html>
<body>
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

<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../login.php">
				<img src="../images/logo.png" alt="logo">
			</a>
		</div>
	</div> <!-- /END WRAPPER -->
</nav>

<!-- ================
	HOME
================== -->

<header class="signup dark-bg" id="signup">
	<div class="color-overlay">
		<div class="swrapper">
		<h2>Why</h2>
		<h1><span class="colored-text">Head Hunters</span>?</h1>
			<table style="float:center" class="table_center">
					<tr>
						<th id="top_left">Employee</th>
						<th>Hired by</th>
						<th>Field</th>
						<th>Studies</th>
						<th>Skills</th>
						<th>Languages</th>
						<th>City</th>
						<th>Salary per Year</th>
						<th id="top_right">Work Hours per Week</th>
					</tr>
			<?php 
			$sql1 = "SELECT DISTINCT * FROM filled_position";

			if ($result1 = mysqli_query($dbconn, $sql1)){
				$data = array();
				while ($row = mysqli_fetch_assoc($result1)) {
					$data[] = $row["posid"];
				}

				mysqli_free_result($result1);

				$size = count($data);
				$i = 0;
				$num_of_filled_positions = $size;
				$sql2 = "SELECT DISTINCT * FROM filled_position";
				if ($result2 = mysqli_query($dbconn, $sql2)) {
					while ($row2 = mysqli_fetch_array($result2)) {
						?>
						<tr>
							<td>
								<?php
									/* Person name */
									$person_name = "SELECT first_name, last_name FROM person WHERE pid=$row2[8]";
									if ($per_name = mysqli_query($dbconn, $person_name)) {
										$person_fields = mysqli_fetch_row($per_name);
										echo $person_fields[0]." ".$person_fields[1];
									}
								?>
							</td>
							<td>
								<?php
									/* Company name */
									$company_name = "SELECT company_name FROM company WHERE cid=$row2[7]";
									if ($company_name = mysqli_query($dbconn, $company_name)) {
										$comp_field = mysqli_fetch_row($company_name);
										echo $comp_field[0];
									}
								?>
							</td>
							<td>
								<?php
									echo $row2['field'];
								?>
							</td>
							<td>
								<?php
									echo $row2['studies'];
								?>
							</td>
							<td>
								<?php
									echo $row2['skills'];
								?>
							</td>
							<td>
								<?php
									echo $row2['pref_languages'];
								?>
							</td>
							<td>
								<?php
									echo $row2['city'];
								?>
							</td>
							<td>
								<?php
									echo $row2['salary_per_year']." $";
								?>
							</td>
							<td>
								<?php
									echo $row2['workhours_per_week'];
								?>
							</td>
						</tr>
						<?php
					}
				}
				?></table><?php
			}
		?>
		</div>
	</div>
</header>

<!-- =========================
	ABOUT
========================= -->
<section class="about" id="about">
	<div class="wrapper">
	
		<!-- HEADING -->
		<h1>SUCCESS RATIO</h1>
		
		<!-- LINE -->
		<div class="main-line"></div>
		
		<div class="col-6">
			<!-- SIDE IMAGE -->
			<img src="../images/percentage.png" alt="percentage">
		</div>
		
		<div class="col-6">
			<!-- HEADING -->
			<h3>We have managed to successfully complete</h3>
			<?php 
				$opn_size = 0;
				$opn = "SELECT posid FROM open_position";
				if ($opn_result = $dbconn->query($opn)) {
					$data2 = array();
					while ($opn_row = mysqli_fetch_assoc($opn_result)) {
						$data2[] = $opn_row['posid'];
					}
					mysqli_free_result($opn_result);
					$opn_size = count($data2);
				}
			?>
			<h1>
				<?php 
					$denominator = ($num_of_filled_positions + $opn_size);
					$numerator = $num_of_filled_positions;
					if ($denominator!=0) {
						echo floatval(($numerator*100)/$denominator);
					}
					else {
						echo "100";
					}
					?> %</h1>
			<h3>off the tasks assigned to us!</h3>
		</div>
	</div> <!-- /END WRAPPER -->
</section>

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


<?php
	mysqli_close($dbconn);
?>
</body>
</html>



