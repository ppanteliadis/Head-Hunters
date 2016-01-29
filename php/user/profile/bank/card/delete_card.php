<?php 
	session_start();
	include_once("../../../../connectdb.php");
	error_reporting(E_ALL ^ E_NOTICE);
	

	/*Get all the info you need here!!!*/
	$firstname = "";
	$lastname = "";
	$s_pid = $_SESSION['pid'];
	$sql = "SELECT first_name, last_name
			FROM person 
			WHERE (pid = '$_SESSION[pid]')";

	if ($result = mysqli_query($dbconn, $sql)){
		$row = mysqli_fetch_row($result);
		$firstname = $row[0];
		$lastname = $row[1];
	}

	$sql = "DELETE FROM credit_card
			WHERE (pid = '".$s_pid."')";
	if ($dbconn->query($sql)) {
		echo "<script> window.location.assign('../card.php'); </script>";
	}
	else {
		echo "<p align='center'><font color='red'><br><br><br><br>Something went wrong.</font></p>";
	}

?>

