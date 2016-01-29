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
<title>Head Hunters - Possible Candidates </title>
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
								<td>
									<a href='matchmaking.php?pid=<?=$row2['pid'];?>'><input type='button' value='hire' /></a>
								</td>
							</tr>
							<?php
						}
					}
					$i = $i + 1;
				}
				?></table>
				<?php
					$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$segs = explode('=', $url);
					$comp_id="";
					if (!empty($segs)) {
						$url = $segs[1]; /* call me pid */
						$qposid = $_SESSION['posid'];
						$sq = "SELECT * FROM open_position WHERE posid='$qposid'";
						if ($result3 = mysqli_query($dbconn, $sq)) {
							while ($row3 = mysqli_fetch_array($result3)) {
								$ins="INSERT INTO filled_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid, pid)
								VALUES ('$row3[0]', '$row3[1]', '$row3[2]', '$row3[3]', '$row3[4]', $row3[5], $row3[6], $row3[7], $url)";
								$comp_id = $row3[7];
								if ($dbconn->query($ins)) {
									/* THE DUDE WITH pid = $url WAS HIRED. FILLED_POSITION updated. */
									/* we need to remove it from the open positions afterwards */
									$_SESSION['hired_pid'] = $url;
									$job="UPDATE company SET jobs=jobs+1 WHERE cid = $row3[7]";
									if ($dbconn->query($job)) {
										//echo "JOB updated";

										$disc = "SELECT jobs FROM company WHERE cid = $row3[7]";
										if ($result4 = mysqli_query($dbconn, $disc)) {
											$row4 = mysqli_fetch_row($result4);
											if ($row4[0]>=5) {
												$disc5="UPDATE company SET discount=0.2 WHERE cid = $row3[7]";
												if ($dbconn->query($disc5)) {
													//echo "discount set to 0.2";
												}
											}
											else if ($row4[0]>=3) {
												$disc3="UPDATE company SET discount=0.1 WHERE cid = $row3[7]";
												if ($dbconn->query($disc3)) {
													//echo "discount set to 0.1";
												}
											}
										}

									}
									$hrd="UPDATE person SET hired=1 WHERE pid = $url";
									if ($dbconn->query($hrd)) {
										//echo "person hired";
									}
									$del="DELETE FROM open_position WHERE posid = '$qposid'";
									if ($dbconn->query($del)) {
										/* Record deleted successfully */
										/* we update */
										//echo "Delete success";
										//echo "<script> window.location.assign('matchmaking/matchmaking-success.php');</script>";
									}
								}
							}
						}
					}
					$kurwa = "SELECT DISTINCT account FROM company WHERE cid=$comp_id";

					

					if ($japerdiole = mysqli_query($dbconn, $kurwa)) {
						$accounts = mysqli_fetch_row($japerdiole);
						
						$cyka  = "SELECT DISTINCT balance FROM credit_card WHERE account=$accounts[0]";
						if ($blyat = mysqli_query($dbconn, $cyka)) {
							$balances = mysqli_fetch_row($blyat);
							
							if ($balances[0] < 500) {
								echo "Not enough money in the account.";
								/* PROMT TO SCREEN FOR FAIL. NO MONEY */
								//echo "<script> window.location.assign('../../profile-company.php');</script>";
							}
							else {
								$gamw = "SELECT discount FROM company WHERE cid=$comp_id";
								if ($result9 = mysqli_query($dbconn, $gamw)) {
									$row9 = mysqli_fetch_row($result9);
									//echo "que re lotse row9[0] = ".$row9[0]."<br>";
									$pay="UPDATE credit_card SET balance=balance-500*(1-$row9[0]) WHERE account = $accounts[0]";
									if ($result8 = mysqli_query($dbconn, $pay)) {
										//echo "Payed";
										$hacc = "SELECT account FROM head_hunters";
										if ($head_result = mysqli_query($dbconn, $hacc)){
											$head_row = mysqli_fetch_row($head_result);
											$head = "UPDATE credit_card SET balance=balance+500*(1-$row9[0]) WHERE account = $head_row[0]";
											if ($pay_head = mysqli_query($dbconn, $head)) {
												//echo "Head Hunters Payed";
											}
										}
									}
								}
							}
						}
					}

					/* Person has to pay */
					$kurwa2 = "SELECT DISTINCT account FROM person WHERE pid=$url";

					if ($japerdiole2 = mysqli_query($dbconn, $kurwa2)) {
						$accounts2 = mysqli_fetch_row($japerdiole2);
						
						$cyka2  = "SELECT DISTINCT balance FROM credit_card WHERE account=$accounts[0]";
						if ($blyat2 = mysqli_query($dbconn, $cyka2)) {
							$balances2 = mysqli_fetch_row($blyat2);
							
							if ($balances2[0] < 100) {
								echo "Not enough money in the account.";
								/* PROMT TO SCREEN FOR FAIL. NO MONEY */
							}
							else {
								$pay2="UPDATE credit_card SET balance=balance-100 WHERE account = $accounts2[0]";
								if ($result10 = mysqli_query($dbconn, $pay2)) {
									//echo "Payed";

									$hacc2 = "SELECT account FROM head_hunters";
									if ($head_result2 = mysqli_query($dbconn, $hacc2)){
										$head_row2 = mysqli_fetch_row($head_result2);
										$head2 = "UPDATE credit_card SET balance=balance+100 WHERE account = $head_row2[0]";
										if ($pay_head2 = mysqli_query($dbconn, $head2)) {
											//echo "Head Hunters Payed by Person";
										}
									}
								}
							}
						}
					}
					echo "<script> window.location.assign('matchmaking/matchmaking-success.php');</script>";
				}
			else {
				echo "<p align='center'><font color='red'><br><br><br><br>Something went wrong.</font></p>";
			}
			$dbconn->close();
		?>
		</div>
		<div class="btn-container">
				<a class="btn secondary-btn" href="../post_job.php">Post Another Job</a>
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





