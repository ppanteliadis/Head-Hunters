
<?php
	session_start();
	include_once("../../connectdb.php");
	if(!empty($_GET['message'])) {
		$message = $_GET['message'];
		print "<CENTER><font color='white'>$message</font></CENTER>"; 
	}

	$s_cid = $_SESSION['cid'];
	$job_title = "";
	$city = "";
	$studies = "";
	$skillz = "";
	$languages = "";
	$salary_per_year = "";
	$workhours_per_week = "";
	$_SESSION['cid'] = $s_cid;
?>

<!DOCTYPE html>
<title>Head Hunters - Post Job</title>
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
<script src="../../js/jquery-2.0.3.min.js"></script>

<nav class="navigation dark-bg">
	<div class="wrapper">
		<!-- NAVIGATION HEADER -->
		<div class="navbar-header">
			<!-- LOGO -->
			<a class="navigation-logo" href="../profile-company.php">
				<img src="../../images/logo.png" alt="logo">
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
		<h1>POST <span class="colored-text">JOB</span>!</h1>
			<form class="sform" method="post">	
				<input type="text" name="job_title" value="" placeholder="Job Title">
				<input type="number" min="1" name="salary" placeholder="Salary per Year">
				<input type="number" min="1" name="workhours" placeholder="Workhours per week">


				<label for="city"></label>
				<select id="city" name="city">
					<option value="">City</option>
					<option value="Athens">Athens</option>
					<option value="Agrinio">Agrinio</option>
					<option value="Chania">Chania</option>
					<option value="Heraklion">Heraklion</option>
					<option value="Ioannina">Ioannina</option>
					<option value="Larissa">Larissa</option>
					<option value="Patras">Patras</option>
					<option value="Rhodos">Rodos</option>
					<option value="Thessaloniki">Thessaloniki</option>
					<option value="Volos">Volos</option>
				</select>

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

				<input type="submit" class="button" name='question' value="QUESTION"></input>
				<input type="submit" class="button" name='post_job' value="POST"></input>

				<?php
					if (isset($_POST["post_job"])) {

						$job_title = $_POST['job_title'];
						$city = $_POST['city'];

						$salary_per_year = $_POST['salary'];
						$salary_per_year = intval($salary_per_year);

						$workhours_per_week = $_POST['workhours'];
						$workhours_per_week = intval($workhours_per_week);

						$studies = "'" . implode("','", $_POST['studies']) . "'";
						$skillz = "'" . implode("','", $_POST['skillz']) . "'";
						$languages 	 = "'" . implode("','", $_POST['languages']) . "'";

						$studies = str_replace('\'', '', $studies);
						$skillz = str_replace('\'', '', $skillz);
						$languages = str_replace('\'', '', $languages);

						$studies = '\''.$studies.'\'';
						$skillz = '\''.$skillz.'\'';
						$languages = '\''.$languages.'\'';

						$_SESSION['job_title'] = $job_title;
						$_SESSION['city'] = $city;
						$_SESSION['studies'] = $studies;
						$_SESSION['skillz'] = $skillz;
						$_SESSION['languages'] = $languages;
						$_SESSION['salary_per_year'] = $salary_per_year;
						$_SESSION['workhours_per_week'] = $workhours_per_week;

						$sql = "INSERT INTO open_position (field, skillz, studies, pref_languages, city, salary_per_year, workhours_per_week, cid) VALUES ('$job_title', $skillz, $studies, $languages, '$city', $salary_per_year, $workhours_per_week, '$s_cid')";



						if ($dbconn->query($sql)) {
							$qposid = mysqli_insert_id($dbconn);

							$_SESSION['posid'] = $qposid;
							echo "<script>window.location.assign('post_job/matchmaking.php');</script>";
						}
						else {
							echo "<p align='center'><font color='red'><br><br><br><br>Something went wrong.</font></p>";
						}

						$dbconn->close();
					}
					else if (isset($_POST["question"])) {
						$job_title = $_POST['job_title'];
						$city = $_POST['city'];

						$salary_per_year = $_POST['salary'];
						$salary_per_year = intval($salary_per_year);

						$workhours_per_week = $_POST['workhours'];
						$workhours_per_week = intval($workhours_per_week);

						$studies = "'" . implode("','", $_POST['studies']) . "'";
						$skillz = "'" . implode("','", $_POST['skillz']) . "'";
						$languages 	 = "'" . implode("','", $_POST['languages']) . "'";

						$studies = str_replace('\'', '', $studies);
						$skillz = str_replace('\'', '', $skillz);
						$languages = str_replace('\'', '', $languages);

						$studies = '\''.$studies.'\'';
						$skillz = '\''.$skillz.'\'';
						$languages = '\''.$languages.'\'';

						$_SESSION['job_title'] = $job_title;
						$_SESSION['city'] = $city;
						$_SESSION['studies'] = $studies;
						$_SESSION['skillz'] = $skillz;
						$_SESSION['languages'] = $languages;
						$_SESSION['salary_per_year'] = $salary_per_year;
						$_SESSION['workhours_per_week'] = $workhours_per_week;

						
						echo "<script>window.location.assign('post_job/question.php');</script>";
					}
				?>
			</form>
	</div> <!-- /END COLOR OVERLAY -->
</header>


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


<script>
//make sure that js is enabled
$('html').addClass('js');
</script>



</body>
</html>