<?php
require("admin_header.php");

// Open the connection to the DB server.
$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
	
// Select the Events DB.
mysql_select_db($db_name, $con);

// Get the list of current ranks.
$sql = 'DELETE FROM Derby_Cars';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error deleting the roster of derby cars: ' . mysql_error());
}

mysql_close($con);

?>

<script type="text/javascript">
	window.location.href = 'admin_home.php';
</script>

<?php
require("pwd_footer.php");
?>