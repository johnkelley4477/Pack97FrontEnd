<?php
require("admin_ini.php");
require("db_ini.php");
require("host_ini.php");

$event_id = $_GET['event_id'];

// Include a bit of validation/protection.
if ((!isset($event_id)) || (is_nan($event_id)) || ($event_id <= 0))
{
	die("Error: invalid event_id: " . $event_id);
}

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
$result = mysql_query("SELECT * FROM Events WHERE ID=" . $event_id);
if (!$result)
{
	die('Error returning the data for event ID #' . $event_id . ': ' . mysql_error());
}

$num_rows = mysql_num_rows($result);

if ($num_rows <= 0)
{
	die('Error: This event does not exist, event ID #' . $event_id . '.<br /><br />');
}

$row = mysql_fetch_array($result);

$event_name = $row['EventName'];
$event_date = $row['EventDate'];
$event_time_start = $row['StartTime'];
$event_description = $row['Description'];
$eventlead_name = $row['EventLeadName'];
$eventlead_email = $row['EventLeadEmail'];
$other1_agerange_min = $row['CostOther1AgeMin'];
$other1_agerange_max = $row['CostOther1AgeMax'];
$include_other2 = $row['IncludeOther2'];
$other2_agerange_min = $row['CostOther2AgeMin'];
$other2_agerange_max = $row['CostOther2AgeMax'];
$include_onlinesales = $row['IncludeOnlineSales'];
$onlineitem_url = $row['OnlineItemURL'];
$is_hike = $row['IsHike'];
$is_backpacking = $row['IsBackpacking'];
$include_tshirt_size = $row['IncludeTShirtSize'];

// Load the list of registrations for this event.
$sql = "SELECT ID, Contact_LastName, Contact_FirstName, Contact_Email, Contact_Phone, Paid, Paid_DateTime FROM Registrations WHERE EventID=" . $event_id;

$reg_list = mysql_query($sql);
if (!$reg_list)
{
	die('Error returning the list of participants for event ID #' . $event_id . ': ' . mysql_error());
}

$num_registrations = mysql_num_rows($reg_list);

if ($num_registrations > 0)
{
	$reg_cnt = 0;
	while ($reg = mysql_fetch_array($reg_list))
	{
		// Need to make sure we clear out any old data from the previous record.
		unset($registration);
		
		$registration['reg_id'] = $reg['ID'];
		$registration['contact_lastname'] = $reg['Contact_LastName'];
		$registration['contact_firstname'] = $reg['Contact_FirstName'];
		$registration['contact_email'] = $reg['Contact_Email'];
		$registration['contact_phone'] = $reg['Contact_Phone'];
		$registration['paid'] = $reg['Paid'];
		$registration['paid_datetime'] = $reg['Paid_DateTime'];
		
		// =========================================================
		// Get the list of scouts for the current registration entry.
		$sql = "SELECT Scouts.ID, Scouts.LastName, Scouts.FirstName, Dens.Name AS DenName, Ranks.Name AS RankName,  CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize, Scouts.IsBackpacking, Scouts.HasPack FROM Reg_Scouts, Scouts, Dens, Ranks, TShirts WHERE Reg_Scouts.ScoutID = Scouts.ID AND Dens.ID = Scouts.DenID AND Dens.RankID = Ranks.ID AND Scouts.TShirtID = TShirts.ID AND Reg_Scouts.RegID = " . $registration['reg_id'];
		$scout_list = mysql_query($sql);
		if (!$scout_list)
		{
			die('Error returning the list of scouts for registration ID #' . $registration['reg_id'] . ': ' . mysql_error() . '<br /><br />sql = ' . $sql);
		}
		
		$num_scouts = mysql_num_rows($scout_list);
		if ($num_scouts > 0)
		{
			$cnt = 0;
			
			// I want to make sure that I get a clean array of scouts.
			unset($scouts);
			while ($scout = mysql_fetch_array($scout_list))
			{
				// Add this scout to the array of scouts.
				$scouts[$cnt] = $scout;
				
				// Increment the counter.
				$cnt++;
			}
			
			// Finished looping through the list of scouts.
			// Add the array to the registration.
			$registration['scouts'] = $scouts;
		}
		
		// =========================================================
		// Get the list of leaders for the current registration entry.
		$sql = "SELECT Leaders.ID, Leaders.LastName, Leaders.FirstName, Leaders.Gender, CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize FROM Reg_Leaders, Leaders, TShirts WHERE Reg_Leaders.LeaderID = Leaders.ID AND Leaders.TShirtID = TShirts.ID AND Reg_Leaders.RegID = " . $registration['reg_id'];
		$leader_list = mysql_query($sql);
		if (!$leader_list)
		{
			die('Error returning the list of leaders for registration ID #' . $registration['reg_id'] . ': ' . mysql_error() . '<br /><br />sql = ' . $sql);
		}
		
		$num_leaders = mysql_num_rows($leader_list);
		if ($num_leaders > 0)
		{
			$cnt = 0;
			
			// I want to make sure that I get a clean array of leaders.
			unset($leaders);
			while ($leader = mysql_fetch_array($leader_list))
			{
				// Add this leader to the array of leaders.
				$leaders[$cnt] = $leader;
				
				// Increment the counter.
				$cnt++;
			}
			
			// Finished looping through the list of leaders.
			// Add the array to the registration.
			$registration['leaders'] = $leaders;
		}

		// =========================================================
		// Get the list of adults for the current registration entry.
		$sql = "SELECT Adults.ID, Adults.LastName, Adults.FirstName, Adults.Gender, CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize FROM Reg_Adults, Adults, TShirts WHERE Reg_Adults.AdultID = Adults.ID AND Adults.TShirtID = TShirts.ID AND Reg_Adults.RegID = " . $registration['reg_id'];
		$adult_list = mysql_query($sql);
		if (!$adult_list)
		{
			die('Error returning the list of adults for registration ID #' . $registration['reg_id'] . ': ' . mysql_error() . '<br /><br />sql = ' . $sql);
		}
		
		$num_adults = mysql_num_rows($adult_list);
		if ($num_adults > 0)
		{
			$cnt = 0;
			
			// I want to make sure that I get a clean array of adults.
			unset($adults);
			while ($adult = mysql_fetch_array($adult_list))
			{
				// Add this adult to the array of adults.
				$adults[$cnt] = $adult;
				
				// Increment the counter.
				$cnt++;
			}
			
			// Finished looping through the list of adults.
			// Add the array to the registration.
			$registration['adults'] = $adults;
		}
				
		// =========================================================
		// Get the list of other1 for the current registration entry.
		$sql = "SELECT Other1.ID, Other1.LastName, Other1.FirstName, Other1.Gender, CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize FROM Reg_Other1, Other1, TShirts WHERE Reg_Other1.Other1ID = Other1.ID AND Other1.TShirtID = TShirts.ID AND Reg_Other1.RegID = " . $registration['reg_id'];
		$other1_list = mysql_query($sql);
		if (!$other1_list)
		{
			die('Error returning the list of other1 for registration ID #' . $registration['reg_id'] . ': ' . mysql_error() . '<br /><br />sql = ' . $sql);
		}
		
		$num_other1 = mysql_num_rows($other1_list);
		if ($num_other1 > 0)
		{
			$cnt = 0;
			
			// I want to make sure that I get a clean array of other1.
			unset($other1s);
			while ($other1 = mysql_fetch_array($other1_list))
			{
				// Add this other1 to the array of other1s.
				$other1s[$cnt] = $other1;
				
				// Increment the counter.
				$cnt++;
			}
			
			// Finished looping through the list of other1s.
			// Add the array to the registration.
			$registration['other1s'] = $other1s;
		}
		
		// =========================================================
		// Get the list of other2 for the current registration entry.
		$sql = "SELECT Other2.ID, Other2.LastName, Other2.FirstName, Other2.Gender, CONCAT(LEFT(TShirts.MajorSize, 1), TShirts.MinorSize) AS TShirtSize FROM Reg_Other2, Other2, TShirts WHERE Reg_Other2.Other2ID = Other2.ID AND Other2.TShirtID = TShirts.ID AND Reg_Other2.RegID = " . $registration['reg_id'];
		$other2_list = mysql_query($sql);
		if (!$other2_list)
		{
			die('Error returning the list of other2 for registration ID #' . $registration['reg_id'] . ': ' . mysql_error() . '<br /><br />sql = ' . $sql);
		}
		
		$num_other2 = mysql_num_rows($other2_list);
		if ($num_other2 > 0)
		{
			$cnt = 0;
			
			// I want to make sure that I get a clean array of other2.
			unset($other2s);
			while ($other2 = mysql_fetch_array($other2_list))
			{
				// Add this other2 to the array of other2s.
				$other2s[$cnt] = $other2;
				
				// Increment the counter.
				$cnt++;
			}
			
			// Finished looping through the list of other2s.
			// Add the array to the registration.
			$registration['other2s'] = $other2s;
		}
		
		// Now that we have finished getting all of the people associated with this registration,
		// add the registration to the array of all registrations.
		$registrations[$reg_cnt] = $registration;
		$reg_cnt++;
	}
}

// Get the list of current dens.
// This is required to drive the totals section at the bottom of the table.
$sql = 'SELECT * FROM Dens WHERE ACTIVE != 0 ORDER BY Name';

// Run the select query to get the list of dens.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of dens: ' . mysql_error());
}

while ($row = mysql_fetch_array($result))
{
	$total_dens[$row['Name']] = 0;
}


// Get the list of ranks.
// This is required to drive the totals section at the bottom of the table.
$sql = 'SELECT * FROM Ranks ORDER BY ID';

// Run the select query to get the list of ranks.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of ranks: ' . mysql_error());
}

while ($row = mysql_fetch_array($result))
{
	$total_ranks[$row['Name']] = 0;
}




// All done, close the connection.
mysql_close($con);
?>

<label>Event Lead:</label>
<div><a href='mailto:<?php echo $eventlead_email; ?>' target='_blank'><?php echo $eventlead_name; ?></a></div>
<?php if($include_onlinesales) { ?>
	<label>Online Payment:</label>
	<a href="<?php echo $onlineitem_url; ?>" target="_blank"><img src="../images/square_logo.jpg" width="50" height="50" /></a>
	<p>Note that you may not see your registration confirmed below if payment has not been verified.</p>
<?php } ?>
<?php if($is_hike) { ?>
	<label>Event Type:</label>
	<div><?php if ($is_backpacking) {echo "Backpacking Hike";} else {echo "Hike";} ?></div>
<?php } ?>
<?php if($admin) { ?>
	<input type="button" id="btnEmailParticipants" value="Email Participant List" onclick="EmailParticipantList()" />
<?php } ?>

<table cellpadding="3" cellspacing="0" border="1" bordercolor="#CCCCCC" width="100%" >
	<tr valign="bottom">
		<td><b>Contact</td>
		<?php if ($admin) { ?>
			<td><b>Contact Email</b></td>
			<td width="100"><b>Contact Phone</b></td>
			<td><b>Date/Time</b></td>
		<?php } ?>
		<td><b>Confirmed</b></td>
		<td><b>Scout</b></td>
		<td width="50"><b>Den</b></td>
		<?php if ($is_backpacking) { ?>
			<td><b>Backpacking?</b></td>
			<td><b>Has<br />pack?</b></td>
		<?php } ?>		
		<?php if ($include_tshirt_size) { ?>
			<td><b>Shirt<br />Size</b></td>
		<?php } ?>
		<td><b>Leader</b></td>
		<td><b>Gender</b></td>
		<?php if ($include_tshirt_size) { ?>
			<td><b>Shirt<br />Size</b></td>
		<?php } ?>
		<td><b>Adult</b></td>
		<td><b>Gender</b></td>
		<?php if ($include_tshirt_size) { ?>
			<td><b>Shirt<br />Size</b></td>
		<?php } ?>
		<td><b>Child</b> <i>(Ages <?php echo $other1_agerange_min; ?>-<?php echo $other1_agerange_max; ?>)</i></td>
		<td><b>Gender</b></td>
		<?php if ($include_tshirt_size) { ?>
			<td><b>Shirt<br />Size</b></td>
		<?php } ?>
		<?php if ($include_other2) { ?>
			<td><b>Child</b> <i>(Ages <?php echo $other1_agerange_min; ?>-<?php echo $other1_agerange_max; ?>)</i></td>
			<td><b>Gender</b></td>
			<?php if ($include_tshirt_size) { ?>
				<td><b>Shirt<br />Size</b></td>
			<?php } ?>
		<?php } ?>
		<?php if ($admin && ($num_registrations > 0)) { ?>
			<td>&nbsp;</td>
		<?php } ?>
	</tr>
	
	
	<?php if ($num_registrations > 0)
	{
		$reg_cnt = 0;
		$total_scouts = 0;
		$total_leaders = 0;
		$total_adults = 0;
		$total_other1 = 0;
		$total_other2 = 0;
		$total_males = 0;
		$total_females = 0;
		$contact_email_list = '';
		
		foreach ($registrations as $reg)
		{
			if ($reg_cnt % 2)
				echo '<tr valign="top">';
			else
				echo '<tr bgcolor="#FBF8EC" valign="top">';
			//echo '<td>' . $reg['contact_lastname'] . '</td>';
			echo '<td>' . $reg['contact_firstname'] . ' ' . substr($reg['contact_lastname'],0,1) . '</td>';
			
			
			if ($admin)
			{
				echo '<td><a href="mailto:' . $reg['contact_email'] . '">' . $reg['contact_email'] . '</a></td>';
				echo '<td>' . $reg['contact_phone'] . '</td>';
				
				$contact_email_list .= $reg['contact_email'] . ",";
				
				echo '<td>' . $paid_datetime . '</td>';
			}
			
			$paid_imgpath = '../images/round_x.png';
			$paid_datetime = '';
			if ($reg['paid'] == 1)
			{
				$paid_imgpath = '../images/tick.png';
				$paid_datetime = $reg['paid_datetime'];
			}
			
			// If admin then allow the admin to toggle the confirmed status.
			// If not an admin then the image/state is ready only.
			if ($admin)
			{
				echo '<td align="center"><img src=\'' . $paid_imgpath . '\' border=0 onclick="TogglePaid(' . $reg['reg_id'] . ', ' . $reg['paid'] . ')" onmouseover="this.style.cursor = \'hand\';" onmouseout="this.style.cursor = \'auto\';"/></td>';
			} else {
				echo '<td align="center"><img src=\'' . $paid_imgpath . '\' border=0 /></td>';
			}
			
			$scouts = array();
			$leaders =array();
			$adults = array();
			$other1s = array();
			$other2s = array();
			
			if (isset($reg['scouts'])) $scouts = $reg['scouts'];
			if (isset($reg['leaders'])) $leaders = $reg['leaders'];
			if (isset($reg['adults'])) $adults = $reg['adults'];
			if (isset($reg['other1s'])) $other1s = $reg['other1s'];
			if (isset($reg['other2s'])) $other2s = $reg['other2s'];
			
			$total_scouts += count($scouts);
			$total_leaders += count($leaders);
			$total_adults += count($adults);
			$total_other1 += count($other1s);
			$total_other2 += count($other2s);
			
			// Assume that all scouts are male
			$total_males += count($scouts);
			
			$max_cnt = max(array(count($scouts), count($leaders), count($adults), count($other1s), count($other2s)));
			
			for ($x = 0; $x < $max_cnt; $x++)
			{
				// If not on the first row of participants,
				// close out the previous row, add a new one and pad it to the right.
				if ($x > 0)
				{
					// Before we close out the first row, put the buttons into the last column.
					if ($admin)
					{
						if ($x == 1)
							echo '<td><input type="button" value="Delete" onclick="DeleteRegistration(' . $reg['reg_id'] . ',\'' . $reg['contact_lastname'] . ', ' . $reg['contact_firstname'] . '\')" /></td>';
						else
							echo '<td>&nbsp;</td>';
					}
					
					echo '</tr>';
					
					if ($reg_cnt % 2)
						echo '<tr valign="top">';
					else
						echo '<tr bgcolor="#FBF8EC" valign="top">';
					
					if ($admin)
					{
						echo '<td colspan="6">&nbsp</td>';
					}
					else
					{
						echo '<td colspan="2">&nbsp</td>';
					}
				}
				
				// ======================
				if ($x < count($scouts))
				{
					$scout = $scouts[$x];
					
					//echo '<td>' . $scout['LastName'] . '</td>';
					echo '<td>' . $scout['FirstName'] . ' ' . substr($scout['LastName'],0,1) . '</td>';
					echo '<td>' . $scout['DenName'] . '</td>';
					if ($is_backpacking)
					{
						echo '<td>';
						if($scout['IsBackpacking'] == 1)
						{echo 'Yes';}
						else
						{echo 'No';}
						echo '</td>';
						echo '<td>';
						if($scout['HasPack'] == 1)
						{echo 'Yes';}
						else
						{echo 'No';}
						echo '</td>';
					}
					if ($include_tshirt_size)
					{
						echo '<td>' . $scout['TShirtSize'] . '</td>';
					}
					
					// Look for the den and rank in the totals array.
					$total_dens[$scout['DenName']]++;
					$total_ranks[$scout['RankName']]++;
				}
				else
				{
					// No scout data, insert a placeholder column.
					$col_span = 2;
					if ($include_tshirt_size) { $col_span++;}
					echo '<td colspan=' . $col_span . '>&nbsp;</td>';
				}

				// ======================
				if ($x < count($leaders))
				{
					$leader = $leaders[$x];
					
					//echo '<td>' . $leader['LastName'] . '</td>';
					echo '<td>' . $leader['FirstName'] . ' ' . $leader['LastName'] . '</td>';
					echo '<td>' . $leader['Gender'] . '</td>';
					if ($include_tshirt_size)
					{
						echo '<td>' . $leader['TShirtSize'] . '</td>';
					}
					
					if ($leader['Gender'] == "Male") $total_males++; else $total_females++;
				}
				else
				{
					// No leader data, insert a placeholder column.
					$col_span = 2;
					if ($include_tshirt_size) { $col_span++;}
					echo '<td colspan=' . $col_span . '>&nbsp;</td>';
				}
				
				// ======================
				if ($x < count($adults))
				{
					$adult = $adults[$x];
					
					//echo '<td>' . $adult['LastName'] . '</td>';
					echo '<td>' . $adult['FirstName'] . ' ' . substr($adult['LastName'],0,1) . '</td>';
					echo '<td>' . $adult['Gender'] . '</td>';
					if ($include_tshirt_size)
					{
						echo '<td>' . $adult['TShirtSize'] . '</td>';
					}
					
					if ($adult['Gender'] == "Male") $total_males++; else $total_females++;
				}
				else
				{
					// No adult data, insert a placeholder column.
					$col_span = 2;
					if ($include_tshirt_size) { $col_span++;}
					echo '<td colspan=' . $col_span . '>&nbsp;</td>';
				}
				
				// ======================
				if ($x < count($other1s))
				{
					$other1 = $other1s[$x];
					
					//echo '<td>' . $other1['LastName'] . '</td>';
					echo '<td>' . $other1['FirstName'] . ' ' . substr($other1['LastName'],0,1) . '</td>';
					echo '<td>' . $other1['Gender'] . '</td>';
					if ($include_tshirt_size)
					{
						echo '<td>' . $other1['TShirtSize'] . '</td>';
					}
					
					if ($other1['Gender'] == "Male") $total_males++; else $total_females++;
				}
				else
				{
					// No other1 data, insert a placeholder column.
					$col_span = 2;
					if ($include_tshirt_size) { $col_span++;}
					echo '<td colspan=' . $col_span . '>&nbsp;</td>';
				}
				
				// ======================
				if ($include_other2)
				{
					if ($x < count($other2s))
					{
						$other2 = $other2s[$x];
						
						//echo '<td>' . $other2['LastName'] . '</td>';
						echo '<td>' . $other2['FirstName'] . ' ' . substr($other2['LastName'],0,1) . '</td>';
						echo '<td>' . $other2['Gender'] . '</td>';
						if ($include_tshirt_size)
						{
							echo '<td>' . $other2['TShirtSize'] . '</td>';
						}
						
						if ($other2['Gender'] == "Male") $total_males++; else $total_females++;
					}
					else
					{
						// No other2 data, insert a placeholder column.
						$col_span = 2;
						if ($include_tshirt_size) { $col_span++;}
						echo '<td colspan=' . $col_span . '>&nbsp;</td>';
					}
				}
			}
			
			// This condition should never happen because we do not allow registrations to be saved with no participants,
			// but I still want to make sure that I cover the bases and ensure that the table will be formatted correctly.
			if ($max_cnt <= 0)
			{
				$participant_col = 12;
				if ($include_other2) { $participant_col += 3; }
				if ($include_tshirt_size)
				{
					$participant_col += 4;
					if ($include_other2) { $participant_col++; }
				}
				echo '<td colspan="' . $participant_col . '">&nbsp;</td>';
			}
			
			// If there is only a single row for this registration,
			// must add the column(s) for the control buttons.
			// This code is duplicated at the top of the registration loop.
			if ($admin)
			{
				if ($max_cnt <= 1)
					echo '<td><input type="button" value="Delete" onclick="DeleteRegistration(' . $reg['reg_id'] . ',\'' . $reg['contact_lastname'] . ', ' . $reg['contact_firstname'] . '\')" /></td>';
				else
					echo '<td>&nbsp;</td>';
			}
			
			echo '</tr>';
			$reg_cnt++;
		}
		
		// ================================================
		// Include a totals section.
		$grand_total = $total_males + $total_females;
		?>
		
		<tr height="50">
			<td colspan="27">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="27"><input type="button" name="btnTotals" id="btnTotals" onclick="btnTotals_OnClick();" value="Show Totals" /></td>
		</tr>
		<tr bgcolor="#EEEEEE">
			<td colspan="27">
		
			<div id="divTotals" style="display: none;">
		
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<!-- Left indent. -->
						<td width="20">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<tr>
									<td>Registrations:</td>
									<td><?php echo $num_registrations; ?></td>
								</tr>
							</table>
						</td>
						
						<!-- Spacer column. -->
						<td width="35">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<tr>
									<td>Scouts:</td>
									<td><?php echo $total_scouts; ?></td>
								</tr>
								<tr>
									<td>Leaders:</td>
									<td><?php echo $total_leaders; ?></td>
								</tr>
								<tr>
									<td>Adults:</td>
									<td><?php echo $total_adults; ?></td>
								</tr>
								<tr>
									<td>Children (<i><?php echo $other1_agerange_min; ?>&nbsp;-&nbsp;<?php echo $other1_agerange_max; ?></i>):&nbsp;</td>
									<td><?php echo $total_other1; ?></td>
								</tr>
								
								<?php if ($include_other2) { ?>
									<tr>
										<td>Children (<i><?php echo $other2_agerange_min; ?>&nbsp;-&nbsp;<?php echo $other2_agerange_max; ?></i>):&nbsp;</td>
										<td><?php echo $total_other2; ?></td>
									</tr>
								<?php } ?>
								
							</table>
						</td>
						
						<!-- Spacer column. -->
						<td width="35">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<?php
									$den_names = array_keys($total_dens);
									
									for ($x=0; $x<count($den_names); $x++)
									{
									?>
										<tr>
											<td><?php echo $den_names[$x]; ?>:</td>
											<td><?php echo $total_dens[$den_names[$x]]; ?></td>
										</tr>
									<?php
									}
								?>
							</table>
						</td>
						
						<!-- Spacer column. -->
						<td width="35">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<?php
									$rank_names = array_keys($total_ranks);
									
									for ($x=0; $x<count($rank_names); $x++)
									{
									?>
										<tr>
											<td><?php echo $rank_names[$x]; ?>:</td>
											<td><?php echo $total_ranks[$rank_names[$x]]; ?></td>
										</tr>
									<?php
									}
								?>
							</table>
						</td>
						
						<!-- Spacer column. -->
						<td width="35">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<tr>
									<td>Males:</td>
									<td><?php echo $total_males; ?></td>
								</tr>
								<tr>
									<td>Females:</td>
									<td><?php echo $total_females; ?></td>
								</tr>
							</table>
						</td>
						
						<!-- Spacer column. -->
						<td width="35">&nbsp;&nbsp;</td>
						
						<td valign="top">
							<table border="0" cellpadding="2" cellspacing="0">
								<tr>
									<td><b>Grand Total:</b></td>
									<td><b><?php echo $grand_total; ?></b></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		
			</td>
		</tr>
		
		<?php
		// End of the totals section.
		// ================================================
	}
	else
	{ ?>
		<tr>
			<td align="center" colspan="27"><i>There are no registered participants for this event.</i></td>
		</tr>
	<?php }	?>
</table>

<!-- Add a bit of white space under the table for better formatting. -->
<br /><br />

</td>
</tr>
</table>



<!-- Dummy form to help me post the toggle paid action to the proper PHP page. -->
<form name="frmTogglePaid" id="frmTogglePaid" method="post" action="admin_savereg.php">
	<input type="hidden" name="mod_type" id="mod_type" value="togglepaid" />
	<input type="hidden" name="event_id" id="paid_event_id" />
	<input type="hidden" name="reg_id" id="paid_reg_id" />
	<input type="hidden" name="paid" id="paid" />
</form>

<!-- Dummy form to help me post the delete registration action to the proper PHP page. -->
<form name="frmDelete" id="frmDelete" method="post" action="admin_savereg.php">
	<input type="hidden" name="mod_type" id="mod_type" value="delete" />
	<input type="hidden" name="event_id" id="del_event_id" />
	<input type="hidden" name="reg_id" id="del_reg_id" />
</form>



<script type="text/javascript">
function btnTotals_OnClick()
{
	var div = document.getElementById('divTotals');
	var btn = document.getElementById('btnTotals');
	
	if (div.style.display == "none")
	{
		div.style.display = "block";
		btn.value = "Hide Totals";
	}
	else
	{
		div.style.display = "none";
		btn.value = "Show Totals";
	}
}

<?php
if ($admin)
{
	if (strlen($contact_email_list) == 0)
	{
		echo 'document.getElementById(\'btnEmailParticipants\').disabled = true;';
	}
	else
	{ ?>
		function EmailParticipantList()
		{
			var email_addresses = "<?php echo $contact_email_list; ?>";
			var subject = "Pack 97 Event: <?php echo $event_name; ?>";
			
			var mailto_link = 'mailto:' + email_addresses + '?subject=' + subject;
			
			win = window.open(mailto_link, 'emailWindow');
			//if (win && win.open &&!win.closed) win.close();
		}
	<?php }
	
	?>
	
	function TogglePaid(reg_id, paid)
	{
		document.getElementById('paid_event_id').value = <?php echo $event_id; ?>;
		document.getElementById('paid_reg_id').value = reg_id;
		document.getElementById('paid').value = paid;
		document.getElementById('frmTogglePaid').submit();
	}
	
	function DeleteRegistration(reg_id, contact_name)
	{
		var result = confirm("You are about to delete the registration for '" + contact_name + "'.\nThis cannot be undone.\n\nAre you sure you want to delete this registration?");
		if (result == true)
		{
			document.getElementById('del_event_id').value = <?php echo $event_id; ?>;
			document.getElementById('del_reg_id').value = reg_id;
			document.getElementById('frmDelete').submit();
		}
		else
		{
			// User canceled action.  Do nothing.
		}
	}
	<?php
} ?>

</script>

<?php
include("events_footer.php");
?>