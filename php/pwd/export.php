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
$sql = 'SELECT d.*, r.Name AS RankName FROM Derby_Cars as d LEFT JOIN Ranks as r ON d.RankID = r.ID ORDER BY d.DerbyType DESC, LastName ASC';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the roster of derby cars: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_array($result))
{
	$roster[$i] = $row;
	
	$i++;
}

mysql_close($con);


$file = fopen("derby_roster.csv","w");

// First write the line of column headers to the file.
// Make sure to include a newline at the end of each write.
fwrite($file, "LastName,FirstName,Group,Subgroup,VehicleNumber,VehicleName,PassedInspection,Image,Exclude\n");

// Now loop through the array of car data from our database and write each to the file.
// I am hard coding the PassedInspection, Image and Exclude fields.
for ($i=0; $i<count($roster); $i++)
{
	$car_data = $roster[$i];
	fwrite($file, $car_data["LastName"] . "," . $car_data["FirstName"] . "," . $car_data["DerbyType"] . "," . $car_data["RankName"] . "," . $car_data["CarNumber"] . "," . $car_data["CarName"] . ",N,,N\n");
}

// All finished writing to the file, close it out.
fclose($file);

?>

<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center"><h2>Pinewood Derby<br />Roster Export</h2></td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>The roster export should start in just a moment.<br /><br />If it does not, click here to <a href="derby_roster.csv" target="_blank">download the roster</a>.</td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>

<script type="text/javascript">
	// Start the file download.
	window.location.href = 'derby_roster.csv';
</script>


<?php
require("pwd_footer.php");
?>