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
$scout_id = $_GET['scoutId'];

$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $con);


$sql = "SELECT tbl_HIKE.HIKE_ID, tbl_HIKE.HIKE, tbl_HIKE_TYPE.HIKE_TYPE, tbl_HIKE.HIKE_DATE, tbl_HIKE.MILES 
    FROM tbl_SCOUT_HIKE INNER JOIN tbl_HIKE ON tbl_SCOUT_HIKE.HIKE_ID = tbl_HIKE.HIKE_ID 
    INNER JOIN tbl_HIKE_TYPE ON tbl_HIKE.HIKE_TYPE_ID = tbl_HIKE_TYPE.HIKE_TYPE_ID 
    WHERE tbl_SCOUT_HIKE.SCOUT_ID=" . $scout_id . " 
    ORDER BY tbl_HIKE.HIKE_DATE ASC;";

$result = mysql_query($sql);
echo '<span onclick="closeHikersDetail()" class="close_view" >X</span>';
echo '<div class="detail_title jsHike">Hikes</div>';
$total_miles = 0;
while($row = mysql_fetch_array($result))
{
    $hike_id= $row[HIKE_ID];
    $hike_name= $row[HIKE];
    $hike_type= $row[HIKE_TYPE];
    $hike_date= $row[HIKE_DATE];
    $miles= $row[MILES];
    
    $total_miles+=$miles;
    echo '<div class="hike_local"><a onclick=\'getData(' . $hike_id . ',"#hikeModal","#hike_details_modal","hikeDetailSQL.php","hikeId")\'>' . $hike_name . '</a></div>';
    echo '<div class="hike_info"><span class="hike_miles">A ' . $miles . ' mile </span>';
    echo '<span class="hike_type">' . $hike_type . ' hike on </span>';
    echo '<span class="hike_date">' . date("m-d-Y", strtotime($hike_date)) . '</span></div>';
}
    
mysql_close($con);
mysqli_close($con);
?>
</body>
</html>