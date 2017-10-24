<?php
	require("scoutsHeader.php");
?>
<div class="hike_copy">
	<p>The hiking program runs year round and consists of monthly hikes at interesting locations around the Charlotte area.<span class="jsCopyShow"> more...</span></p>
	<p class="jsCopy">Most hikes are within an hour's drive although sometimes we venture farther afield and are about 2 to 4 miles long. They are appropriate for all ranks from Tiger to Webelos. All scouts, families and siblings of Pack 97 are welcome to participate.</p>
	<p class="jsCopy"><a href="../PDF/hiking/The Pack 97 Hiking Program.pdf" target="_blank">Click here</a> for complete details on the hiking program including a list of the medallions that are awarded.</p>
	<p class="jsCopy">The <a href="../PDF/Pack_97_Hiking_Schedule_for_2017.pdf">hiking schedule for 2017-2018</a> is now available. The online calendar has also been updated to reflect this schedule of pack hikes.</p>
	<p class="jsCopy">Contact Pack 97's Hike Chief at <a href="mailto:HikeChief@CubScoutPack97.org">HikeChief@CubScoutPack97.org</a></p>					
	<span class="jsCopyHide"> less...</span>	
</div>			
<?php
	$hundred = true;
	$ninty = true;
	$eighty = true;
	$seventy = true;
	$sixty = true;
	$fifty = true;
	$fourty = true;
	$thirty = true;
	$twenty = true;
	$teens = true;
	$ones = true;
	function buildScout($scout_id, $first_name, $last_name, $den, $total_miles){
		echo '<div class="hiker_text" align="center"><div class="hiker"><button id="' . $scout_id . '" onclick=\'getData(' . $scout_id . ',"#hikes' . $scout_id . '","#hikes' . $scout_id . '","hikerSQL.php","scoutId")\'>' .  $first_name . ' ' . $last_name . '.</a></div>';
		echo '<div class="hiker_stats"> '.$total_miles.' miles <a onclick=\'getData("' . $den . '","#hikes' . $scout_id . '","#hikes' . $scout_id . '","denSQL.php","denName")\'>' . $den . '</a></div></div><div class="hikers_details " id="hikes' . $scout_id . '" style="display:none;"></div>';
	}
	function getLastInitial($lastName){
		$last = "";
		if(substr($lastName,0,2) == "Mc"){
			$last = substr($lastName,0,3);
		}else if(substr($lastName,0,3) == "Mac"){
			$last = substr($lastName,0,4);
		}else{
			$last = substr($lastName,0,1);
		}
		return $last;
	}
	$con = mysql_connect($hostname,$db_username,$db_password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db($db_name, $con);
	$sql_scout_hikes = "SELECT tbl_SCOUT.SCOUT_ID, tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME, tbl_SCOUT.DEN, Sum( tbl_HIKE.MILES ) AS TOTAL_MILES
					FROM tbl_SCOUT
					LEFT JOIN tbl_SCOUT_HIKE ON tbl_SCOUT.SCOUT_ID = tbl_SCOUT_HIKE.SCOUT_ID
					LEFT JOIN tbl_HIKE ON tbl_SCOUT_HIKE.HIKE_ID = tbl_HIKE.HIKE_ID
					WHERE tbl_SCOUT.NON_ACTIVE_SCOUT = 0 
					GROUP BY tbl_SCOUT.SCOUT_FIRST_NAME, tbl_SCOUT.SCOUT_LAST_NAME
					ORDER BY TOTAL_MILES DESC, tbl_SCOUT.DEN";
	$sql_scouts = "SELECT SCOUT_ID, SCOUT_FIRST_NAME, SCOUT_LAST_NAME
					FROM tbl_SCOUT
					WHERE NON_ACTIVE_SCOUT = 0
					GROUP BY SCOUT_FIRST_NAME, SCOUT_LAST_NAME
					ORDER BY SCOUT_LAST_NAME, SCOUT_FIRST_NAME";
	
	$result_search = mysql_query($sql_scouts);

	echo "<div id='search'><label>Find your scout: </label><select id='scout_search' onchange ='jumpToScout()'>" ;
	while($row = mysql_fetch_array($result_search)){
		$scout_id = $row[SCOUT_ID];
		$first_name = $row[SCOUT_FIRST_NAME];
		$last_name = getLastInitial($row[SCOUT_LAST_NAME]);
		echo "<option value='" . $scout_id . "'>" . $last_name . ", " . $first_name . "</option>";
	}
	echo "</select></div>";

	$result = mysql_query($sql_scout_hikes);
			
	while($row = mysql_fetch_array($result)){
		$scout_id = $row[SCOUT_ID];
		$first_name = $row[SCOUT_FIRST_NAME];
		$den = $row[DEN];
		$total_miles = $row[TOTAL_MILES];
		$last_name = getLastInitial($row[SCOUT_LAST_NAME]);
		
		if ($total_miles == ''){
			$total_miles = 0;
		}
		if($total_miles >= 100){
			if($hundred === true){	
				echo '<div class="hundred range"> <hr><div class="hikers"><h3 class="hike_levels">100 Milers Club</h3>';
				$hundred = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 100 && $total_miles >= 90){
			if($ninty === true){	
				echo '</div></div><div class="ninty range"> <hr><div class="hikers"><h3 class="hike_levels">90 Milers</h3>';
				$ninty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 90 && $total_miles >= 80){
			if($eighty === true){	
				echo '</div></div><div class="eighty range"> <hr><div class="hikers"><h3 class="hike_levels">80 Milers</h3>';
				$eighty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 80 && $total_miles >= 70){
			if($seventy === true){	
				echo '</div></div><div class="seventy range"> <hr><div class="hikers"><h3 class="hike_levels">70 Milers</h3>';
				$seventy = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 70 && $total_miles >= 60){
			if($sixty === true){	
				echo '</div></div><div class="sixty range"> <hr><div class="hikers"><h3 class="hike_levels">60 Milers</h3>';
				$sixty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 60 && $total_miles >= 50){
			if($fifty === true){	
				echo '</div></div><div class="fifty range"> <hr><div class="hikers"><h3 class="hike_levels">50 Milers</h3>';
				$fifty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 50 && $total_miles >= 40){
			if($fourty === true){	
				echo '</div></div><div class="fourty range"> <hr><div class="hikers"><h3 class="hike_levels">40 Milers</h3>';
				$fourty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 40 && $total_miles >= 30){
			if($thirty === true){	
				echo '</div></div><div class="thirty range"> <hr><div class="hikers"><h3 class="hike_levels">30 Milers</h3>';
				$thirty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 30 && $total_miles >= 20){
			if($twenty === true){	
				echo '</div></div><div class="twenty range"> <hr><div class="hikers"><h3 class="hike_levels">20 Milers</h3>';
				$twenty = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 20 && $total_miles >= 10){
			if($teens === true){	
				echo '</div></div><div class="teens range"> <hr><div class="hikers"><h3 class="hike_levels">10 Milers</h3>';
				$teens = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}else if($total_miles < 10 && $total_miles >= 0){
			if($ones === true){	
				echo '</div></div><div class="ones range"> <hr><div class="hikers"><h3 class="hike_levels">New Hikers</h3>';
				$ones = false;
			}
			buildScout($scout_id, $first_name, $last_name, $den, $total_miles);
		}
	}
		echo '</div></div>';
	mysql_close($con);
?>





<div id="hikeModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="hike_details_modal"><p>Hike info here</p></div>
  </div>

</div>	

<?php
	require("footer.php");
?>
<script type="text/javascript" src="/js/hikes.js"></script>
