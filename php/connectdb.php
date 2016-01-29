
<?php
	$dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "projectDB";
    // Create connection
    $dbconn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    //Check connection
    if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
    }
?>