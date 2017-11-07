<?php
require("pwd_header.php");


// Open the connection to the DB server.
$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
	
// Select the Events DB.
mysql_select_db($db_name, $con);


// Get the list of registered cars.
$sql = 'SELECT ID, DerbyType, CarNumber, CarName, LastName, FirstName, RankID FROM Derby_Cars ORDER BY DerbyType DESC, CarNumber ASC';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of registered cars: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_array($result))
{
	$cars[$i] = $row;
	
	$i++;
}

// Get the list of current ranks.
$sql = 'SELECT * FROM Ranks';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of ranks: ' . mysql_error());
}

while ($row = mysql_fetch_array($result))
{
	$ranks[$row["ID"]] = $row["Name"];
}



mysql_close($con);
?>

<style type="text/css">
font.colheader {
	color:#F1C232;
	font-weight:bold;
</style>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="20"></td>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td align="center"><font class="section">Pinewood Derby Registered Cars</font></td>
				</tr>
				<!-- Spacer row. -->
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="0" border="1" bordercolor="#CCCCCC" width="100%">
							<tr bgcolor="#0B5394">
								<td><font class="colheader">Derby Type</font></td>
								<td><font class="colheader">Car #</font></td>
								<td><font class="colheader">Car Name</font></td>
								<td><font class="colheader">Racer's Name</font></td>
								<td><font class="colheader">Scout Rank</font></td>
							</tr>
							<?php
							for ($i=0; $i<count($cars); $i++)
							{
								echo '<tr>';
								
								echo '<td>' . $cars[$i]["DerbyType"] . '</td>';
								echo '<td>' . $cars[$i]["CarNumber"] . '</td>';
								echo '<td>' . $cars[$i]["CarName"] . '</td>';
								echo '<td>' . $cars[$i]["FirstName"] . ' ' . $cars[$i]["LastName"] . '</td>';
								
								if ($cars[$i]["RankID"] == 0)
									echo '<td>&nbsp;--&nbsp;</td>';
								else
									echo '<td>' . $ranks[$cars[$i]["RankID"]] . '</td>';
								
								echo '</tr>';
							}
							
							?>
						</table>
					</td>
				</tr>
				<!-- Spacer row. -->
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td width="20"></td>
	</tr>
</table>


<?php
require("pwd_footer.php");
?>