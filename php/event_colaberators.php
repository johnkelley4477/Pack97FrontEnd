<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
require("admin_ini.php");
require("db_ini.php");

// Keep track of the current page so that we can redirect the user here if they choose to log out.
$redirect = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];

$contact_email = $_GET['contactEmail'];
$contact_list = "";

$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $con);


$sql = "SELECT ID FROM Registrations WHERE Contact_Email=" . contact_email;

$result = mysql_query($sql);
$count = 1;
$sql_total = count($result);

while($row = mysql_fetch_array($result)){
    $contact_id= $row[ID];
    $contact_list .= $contact_id;
    $count = $count + 1;
    if($count < $sql_total){
        $contact_list .= ","
    }
}
    
$sql_scouts = "SELECT Scouts.ID as ID, Scouts.LastName as LastName, Scouts.FirstName as FirstName, Dens.Name AS Den, Ranks.Name AS Rank,  CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize, Scouts.IsBackpacking as Backpacking, Scouts.HasPack as HasPack FROM Reg_Scouts, Scouts, Dens, Ranks, TShirts WHERE Reg_Scouts.ScoutID = Scouts.ID AND Dens.ID = Scouts.DenID AND Dens.RankID = Ranks.ID AND Scouts.TShirtID = TShirts.ID AND Reg_Scouts.RegID in (" . $contact_list . ") GROUP BY Scouts.LastName, Scouts.FirstName;"

$result_scouts = mysql_query($sql_scouts);

while($row = mysql_fetch_array($result)){
    $scout_id = $row[ID];
    $scout_last_name = $row[LastName];
    $scout_first_name = $row[FirstName];
    $scout_den = $row[Den];
    $scout_rank = $row[Rank];

    echo "<input type='checkbox' name='ID" . $scout_id . "' id=" . $scout_id . "/><span ></span>";
}

mysql_close($con);
?>
</body>
</html>