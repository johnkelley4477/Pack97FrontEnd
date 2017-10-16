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
$den_name = $_GET['denName'];

$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $con);
echo '<span onclick="closeHikersDetail()" class="close_view" >X</span>';
echo '<div class="detail_title jsDen">Den</div>';
$result = mysql_query("SELECT tbl_SCOUT.SCOUT_ID, tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME, tbl_SCOUT.DEN, Sum( tbl_HIKE.MILES ) AS TOTAL_MILES
                FROM tbl_SCOUT
                LEFT JOIN tbl_SCOUT_HIKE ON tbl_SCOUT.SCOUT_ID = tbl_SCOUT_HIKE.SCOUT_ID
                LEFT JOIN tbl_HIKE ON tbl_SCOUT_HIKE.HIKE_ID = tbl_HIKE.HIKE_ID
                WHERE tbl_SCOUT.DEN='" . $den_name . "' AND tbl_SCOUT.NON_ACTIVE_SCOUT = 0 
                GROUP BY tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME, tbl_SCOUT.DEN
                ORDER BY tbl_SCOUT.SCOUT_LAST_NAME");
        
while($row = mysql_fetch_array($result))
{
    $scout_id = $row[SCOUT_ID];
    $first_name = $row[SCOUT_FIRST_NAME];
    $last_name = substr($row[SCOUT_LAST_NAME],0,1);
    $den = $row[DEN];
    $total_miles = $row[TOTAL_MILES];
    if ($total_miles == '')
        $total_miles = 0;
    
    echo '<div class="denInfo">';
    echo '<span class="denScout"><a href="#' . $scout_id . '">' . $first_name . ' ' . $last_name . '.</a> </span>';
    echo '<span class="denScout">' . $total_miles . ' miles</span>';
    echo '</div>';
}
    
mysql_close($con);
mysqli_close($con);
?>
</body>
</html>