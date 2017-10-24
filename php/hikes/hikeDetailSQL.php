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
$hike_id = $_GET['hikeId'];

$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_name, $con);


echo '<h3 class="hike_details_card">Hike Details</h3>';
$sql = "SELECT tbl_HIKE.HIKE, tbl_HIKE_TYPE.HIKE_TYPE, tbl_HIKE.HIKE_DATE, tbl_HIKE.MILES, tbl_HIKE.HIKE_LEAD, tbl_HIKE.HIKE_COMMENTS 
    FROM tbl_HIKE 
    INNER JOIN tbl_HIKE_TYPE ON tbl_HIKE.HIKE_TYPE_ID = tbl_HIKE_TYPE.HIKE_TYPE_ID
    WHERE tbl_HIKE.HIKE_ID=" . $hike_id . ";";

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
{
    $hike_name= $row[HIKE];
    $hike_type= $row[HIKE_TYPE];
    $hike_date= $row[HIKE_DATE];
    $miles= $row[MILES];
    $hike_lead= $row[HIKE_LEAD];
    $comments= $row[HIKE_COMMENTS];
}
echo '<div class="grid50 hike_detail_blocks">';
echo '<div class="hike_detail_info"><label>Hike Name: </label><br>' . $hike_name . '</div>';
echo '<div class="hike_detail_info"><label>Hike Type: </label><br>' . $hike_type . '</div>';
echo '<div class="hike_detail_info"><label>Hike Date: </label><br>' . date("m-d-Y", strtotime($hike_date)) . '</div>';
echo '<div class="hike_detail_info"><label>Hiked Miles: </label><br>' . $miles . '</div>';
echo '<div class="hike_detail_info"><label>Hike Lead: </label><br>' . $hike_lead . '</div>';
echo '<div class="hike_detail_info"><label>Comments: </label><br>' . $comments . '</div>';
echo '</div>';


//mysql_close($con);

    $sqlh = "SELECT tbl_SCOUT.SCOUT_ID, tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME, tbl_SCOUT.DEN
        FROM tbl_SCOUT
        INNER JOIN tbl_SCOUT_HIKE ON tbl_SCOUT.SCOUT_ID = tbl_SCOUT_HIKE.SCOUT_ID
        INNER JOIN tbl_HIKE ON tbl_SCOUT_HIKE.HIKE_ID = tbl_HIKE.HIKE_ID
        WHERE tbl_HIKE.HIKE_ID=" . $hike_id . "
        GROUP BY tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME, tbl_SCOUT.DEN
        ORDER BY tbl_SCOUT.SCOUT_LAST_NAME";
        
    // echo($sql);
    
    $resulth = mysql_query($sqlh);
    
    echo '<div class="grid50 hike_detail_blocks">';
    echo '<h3 class="hike_levels ">Hikers</h3>';
    while($rowh = mysql_fetch_array($resulth))
    {
        $scout_id= $rowh[SCOUT_ID];
        $first_name= $rowh[SCOUT_FIRST_NAME];
        $last_name= substr($rowh[SCOUT_LAST_NAME],0,1);
        $den= $rowh[DEN];
        
        echo '<div class="hikerScout"><a href="#' . $scout_id . '" onclick="closeModal()">' . $first_name . ' ' . $last_name . '</a>. <span>' . $den . '</span></div>';
    }
    echo '</div>'; 
    mysql_close($con);
?>
</body>
</html>