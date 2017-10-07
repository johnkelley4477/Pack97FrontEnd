<?php
require("admin_ini.php");
require("db_ini.php");
require("host_ini.php");

// Keep track of the current page so that we can redirect the user here if they choose to log out.
$redirect = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
// Open the connection to the DB server.
$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
	
// Select the Events DB.
mysql_select_db($db_name, $con);

// For this page, we just want a simple list of active events.
// Later we will add links to allow the user to view a list of registered users/familes.

//define('SS', '/');

$result = mysql_query("SELECT * FROM Events WHERE Visible =1 AND DATE(NOW()) <= DATE(EventDate)");
if (!$result){
		echo '<h2>No active events.</h2>';
		//echo 'Error returning the list of events: ' . mysql_error();
}else{
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows > 0){
		echo '<div class="carousel">';
			while ($row = mysql_fetch_array($result)){
				$event_id = $row['ID'];
				$event_name = $row['EventName'];
				$event_date = $row['EventDate'];
				$event_desc = $row['Description'];
				$image_file = '/images/' . $event_id . '.png'; 
				echo '<div class="banner_conntainer">
					<h2 class="contentheading">' . $event_name . '</h2>
					<div class="banner_image" style="background-image:url(&#39;' . $image_file . '#39;);">
						<div class="banner_text">
							<p class="font_larger">
								' . $event_desc . '
							</p>
							<a class="font_larger" href="/events/events_home.php">Register Here</a>
						</div>
					</div>
				</div>';
			}
			mysql_close($con);
		echo '</div>';
	}
}
?>
<script type="text/javascript">
	addCarousel();
</script>