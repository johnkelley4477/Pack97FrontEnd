<?php
include("scoutsHeader.php");
?>

<script type="text/javascript">
	function Register(event_id){
		window.location.href = "registration_page1.php?event_id=" + event_id;
	}
</script>

<?php
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
	$result = mysql_query("SELECT ID,EventName,Description,EventDate,Enabled FROM Events WHERE Visible=1");
	if (!$result)
	{
		echo '<h2>No active events.</h2>';
		//echo 'Error returning the list of events: ' . mysql_error();
	}
	else
	{
		$num_rows = mysql_num_rows($result);
		
		if ($num_rows > 0)
		{
			echo '<div class="date_container">';
			echo '<h3 class="title">Pack97 Events</h3>';
			while ($row = mysql_fetch_array($result))
			{
				$event_id = $row['ID'];
				$event_name = $row['EventName'];
				$event_desc = $row['Description'];
				$event_date = $row['EventDate'];
				$enabled = $row['Enabled'];
				
				echo '<div class="card_container">';
				echo '	<div class="card_date">' . date("D, M jS, Y", strtotime($event_date)) . '</div>';
				echo '	<div class="card_info">';
				echo '		<h4>' . $event_name . '</h4>';
				echo '		<p>' . $event_desc . '</p>';
				echo '		<div class="w100">';
				echo '			<a href="participant_list.php?event_id=' . $event_id . '" class="card_button">View Event</a>';
				echo '		    <input type="button" value="Register" onclick="Register(' . $event_id . ')" class="card_button" ' . ($enabled==1 ? '' : 'disabled') . '>';
				echo '		</div>';
				echo '	</div>';
				echo '</div>';
			}
			
			// All done looping through the returned rows, close the connection.
			mysql_close($con);
			
			echo '</div>';
	     	}
	     	else
	     	{
	     		echo '<h2>No active events.</h2>';
	     	}
     	}
?>

<?php
include("scoutsFooter.php");
?>