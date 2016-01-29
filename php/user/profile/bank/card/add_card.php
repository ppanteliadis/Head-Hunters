<?php 
	session_start();
	include_once("../../../../connectdb.php");
	error_reporting(E_ALL ^ E_NOTICE);
	if (!isset($_SESSION['pid'])) {
		header("Location: login.php");
	}

	$s_pid = $_SESSION['pid'];
	$account = "0";
	$sql = "SELECT account 
			FROM person
			WHERE (pid='".$s_pid."')";


	if ($result = mysqli_query($dbconn, $sql)){
		$row = mysqli_fetch_row($result);
		$account = $row[0];
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Head Hunters - Add Card</title>
	<meta name="viewport" content="initial-scale=1">
</head>
<body>
	<a href="../../../../user/profile.php">
		<div class="image" style="position: center">
			<style>
				div.image {
					content:url(../../../../images/logo.png);
				}​
			</style>	
		</div>
	</a>
	<style>
		.demo-container {
			width: 100%;
			max-width: 350px;
			margin: 50px auto;
		}

		form {
			margin: 30px;
		}
		input {
			width: 200px;
			margin: 10px auto;
			display: block;
		}
	</style>
	<div class="demo-container">
		<div class="card-wrapper"></div>
		<div class="form-container active">
			<form name="cardform" action="" method="post">
				<input placeholder="Card number" type="text" name="number">
				<input placeholder="Full name" type="text" name="name">
				<input placeholder="MM/YY" type="text" name="expiry">
				<input placeholder="CVC" type="text" name="cvc">
				<input type="submit" value="Submit" name="submit">

				<?php 
					$cc_number="";
					$cc_expire="";
					$cc_cvc="";
					$cc_number=$_POST['number'];
					$cc_expire=$_POST['expiry'];
					$cc_cvc=$_POST['cvc'];
					$cc_pid=$_SESSION['pid'];

					/*edit the expire date*/
					$pieces=explode("/", $cc_expire);
					$expire_dd = "01";
					$expire_mm = $pieces[0];
					$expire_yy = "20".$pieces[1];

					$expire_yy = trim($expire_yy, "\ ");

					$cc_expire = $expire_yy."-".$expire_mm."-".$expire_dd;

					if (isset($_POST["submit"])) {
						if (empty($cc_number) || empty($cc_cvc) || empty($cc_expire)) {
							echo "<p align='center'><font color='red'><br><br><br><br>All fields are mandatory.</font></p>";
						}
						else {
							$cc_expire = date('Y-m-d', strtotime($cc_expire));
							$sql = "INSERT INTO credit_card (credit_card_number, cvc, expiration_date, pid, account)
									VALUES ('$cc_number', '$cc_cvc', '$cc_expire', $cc_pid, $account)";

							if ($dbconn->query($sql)) {
								echo "<script> window.location.assign('../card.php'); </script>";
							}
							else {
								echo "<p align='center'><font color='red'><br><br><br><br>Something went wrong.</font></p>";
							}
						}
					}
				?>
			</form>
		</div>
	</div>

	<div style="position: relative">
		<p style="position: fixed; bottom: 0; width:100%; text-align: center; color:silver"> Credits to <a href="https://github.com/jessepollak/card">jessepolak</a> for this script
		</p>
	</div>
	<script src="../../../../css/card-master/lib/js/card.js"></script>
	<script>
		new Card({
			form: document.querySelector('form'),
			container: '.card-wrapper'
		});
	</script>
</body>
</html>
