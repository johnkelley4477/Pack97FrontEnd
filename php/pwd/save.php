<?php
require("db_ini.php");


// Open the connection to the DB server.
$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

// Select the Events DB.
mysql_select_db($db_name, $con);


$sql = "INSERT INTO Derby_Cars(";
$sql = $sql . "CarNumber, ";
$sql = $sql . "DerbyType, ";
$sql = $sql . "LastName, ";
$sql = $sql . "FirstName, ";
$sql = $sql . "RankID, ";
$sql = $sql . "CarName, ";
$sql = $sql . "DateTime_Added";
$sql = $sql . ") VALUES (";
$sql = $sql . $_POST['car_number'] . ", ";
$sql = $sql . "'" . $_POST['derby_type'] . "', ";
$sql = $sql . "'" . $_POST['lastname'] . "', ";
$sql = $sql . "'" . $_POST['firstname'] . "', ";
$sql = $sql . "'" . $_POST['scout_rank'] . "', ";
$sql = $sql . "'" . $_POST['car_name'] . "', ";
$sql = $sql . "NOW()";
$sql = $sql . ")";

// Run the insert/update query
$return = mysql_query($sql);

if (!$return)
{
	$result = 'Error saving registration data: ' . mysql_error() . '/n/nSQL = "' . $sql . '"';
}
else
{
	// Get the ID of the new record.
	$reg_id = mysql_insert_id();
	$result = "ok";
}

mysql_close($con);

echo $result;

?>