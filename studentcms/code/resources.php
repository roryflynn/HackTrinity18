<?php
	$FLAG = "HackTrinity{DisappointinglyShortPassResetCodesAreBadMmkay}";

	$db_host = "db";
	$db_user = "tidal";
	$db_pass = "t1d3p0dzzzz";
	$db_dbname = "tidal";
	$conn = new PDO("mysql:host=$db_host;dbname=$db_dbname", $db_user, $db_pass);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
