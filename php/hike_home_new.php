<?php
	require("header.php");
?>
<style>
	hr{
		width:400px;
	}
	body{
		font-family: sans-serif;
	}
	div#search {
	    width: 300px;
	    margin: 30px auto 10px auto;
	}
	span.close_view {
	    font-size: 20px;
	    color: #fff;
	    float: right;
	    padding-right: 20px;
	    width: 20px;
		cursor: pointer;
	}
	#search #scout_search {
	   font-size: 16px;
	}
	#search label{
		font-weight: bold;
	}
	.hike_details_card{
		background: #002266;
	    color: white;
	    font-size: 30px;
	    padding: 30px 10px;
	    font-family: sans-serif;
	    text-align: center;
	    margin: 0px;
	    margin-bottom: 15px;
	}
	.hike_detail_blocks{
		margin: auto;
	    max-width: 400px;
	    margin-bottom: 15px;
	}
	.hike_detail_info{
		font-size:20px;
		margin-bottom: 10px;
		color:#555;
	}
	.hike_detail_info label{
		color:#000;
		font-weight: bold;
	}
	.hike_levels {
	    color: #026;
	    text-align: center;
	    font-size: 30px;
	    box-shadow: 0px 0px 50px 30px rgba(255, 255, 255, 0.9);
	    background-color: rgba(255, 255, 255, 0.9);
	    width: 300px;
	    margin-left:auto;
	    margin-right:auto;
	}
	.hiker button {
	    border: none;
    	background-color: rgba(255,255,255,0);
    	font-size: 24px;
    	font-weight: bold;
	    color: #026;
		text-decoration: underline;
	}
	.hiker_stats a {
	    text-decoration: underline;
	    color: #026;
	    font-weight: bold;
		cursor: pointer;
	}
	.denInfo{
		padding-bottom: 10px;
	}
	.hikerScout{
	    color: #555;
	    font-size: 20px;
	    margin-bottom: 10px;
	}
	.hikerScout a{
		text-decoration: underline;
		color: #000;
	}
	.denScout{
	    color: #ddd;
	    font-size: 20px;
	}
	.denScout a{
		text-decoration: underline;
		color: #fff;
	}
	.detail_title {
	    color: #ff0;
	    font-size: 24px;
	    margin-bottom: 10px;
	    margin-left: 20px;
	}
	.hikers_details{
		background-color: rgba(0, 34, 102, 0.9);
		text-align: center;
	    padding-top: 20px;
	    padding-bottom: 20px;
	    box-shadow: inset 0px 10px 10px #000, inset 0px -10px 10px #000;
        margin-bottom: 40px;
	}
	.hike_local a {
	    text-decoration: underline;
		cursor: pointer;
	    font-size: 20px;
	    color: #fff;
	}
	.hike_info {
	    margin-bottom: 10px;
	    color: #ddd;
	}
	.hiker_text{
		padding: 2px;
    	box-shadow: 0px 0px 50px 30px rgba(255, 255, 255, 0.9);
	    background-color: rgba(255, 255, 255, 0.9);
	    width: 300px;	    
		margin-left: auto;
		margin-right: auto;
	}
	.range{
		min-height: 225px;
	    background-repeat: no-repeat;
	    background-position-y: center;
		background-position-x: 25%;
	    width: 100%;
    	display: table;
	}
	.hikers {
	    padding: 2px;
	    margin-left: auto;
	    margin-right: auto;
	}
	.hiker {
	    font-size: 24px;
	    font-weight: bold;
	}
	.hiker_stats {
	    margin-bottom: 10px;
	}
	.teens{
	    background-image: url(/images/hiking10mile.png);
	}
	.twenty{
	    background-image: url(/images/hiking20mile.png);
	}
	.thirty{
	    background-image: url(/images/hiking30mile.png);
	}
	.fourty{
	    background-image: url(/images/hiking40mile.png);
	}
	.fifty{
	    background-image: url(/images/hiking50mile.png);
	}
	.sixty{
	    background-image: url(/images/hiking60mile.png);
	}
	.seventy{
	    background-image: url(/images/hiking70mile.png);
	}
	.eighty{
	    background-image: url(/images/hiking80mile.png);
	}
	.ninty{
	    background-image: url(/images/hiking90mile.png);
	}
	.hundred{
	    background-image: url(/images/hiking30mile.png);
	}
.jsCopyHide{
	display: none;
	color:#026;
	cursor: pointer;
	text-decoration: underline;
}
.jsCopyShow{
	display: none;
	color:#026;
	cursor: pointer;
	text-decoration: underline;
}
.jsCopy{
	display: inline;
}
@media only screen and (max-width: 900px) {
	.range{
		background-size: 50px;
		background-position-y: 40px;
		background-position-x: 25%;
	}
	.hike_levels, .hiker_text{
	    box-shadow: none;
		background-color: initial;
	}
}
@media only screen and (max-width: 570px) {
	.jsCopyShow{
		display: inline;
	}
	.jsCopy{
		display: none;
	}
	.grid50.hike_detail_blocks{
		width:95%;
	}
	.range{
	    background-position-x: 20%;
	}
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    margin-right: 20px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}



</style>
<p>The hiking program runs year round and consists of monthly hikes at interesting locations around the Charlotte area.<span class="jsCopyShow"> more...</span></p>
<p class="jsCopy">Most hikes are within an hour's drive although sometimes we venture farther afield and are about 2 to 4 miles long. They are appropriate for all ranks from Tiger to Webelos. All scouts, families and siblings of Pack 97 are welcome to participate.</p>
<p class="jsCopy"><a href="../PDF/hiking/The Pack 97 Hiking Program.pdf" target="_blank">Click here</a> for complete details on the hiking program including a list of the medallions that are awarded.</p>
<p class="jsCopy">The <a href="../PDF/hiking/2016-2017 Hiking Schedule.pdf">hiking schedule for 2016-2017</a> is now available. The online calendar has also been updated to reflect this schedule of pack hikes.</p>
<p class="jsCopy">Contact Pack 97's Hike Chief at <a href="mailto:HikeChief@CubScoutPack97.org">HikeChief@CubScoutPack97.org</a></p>					
<span class="jsCopyHide"> less...</span>				
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




<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
/*
* The following bind actions to items specific to this page.
*/

/* When the user clicks on the Hike Name, a modal will fire displaying that 
*  hike's details
*/ 
$(".hike_local a").bind('click',() => {
    $('#hikeModal').show();
});

// When the user clicks on <span> (x), close the modal
$(".close").bind('click',() => {
    $('#hikeModal').hide();
});

//When the user clicks on the 'less...' span the copy will be truncated
$('.jsCopyHide').bind('click',() => {
	$('.jsCopy').hide()
	$('.jsCopyHide').hide();
	$('.jsCopyShow').show();
});

//When the user clicks on the 'more...' span the copy will be displayed
$('.jsCopyShow').bind('click',() => {
	$('.jsCopy').show()
	$('.jsCopyHide').show();
	$('.jsCopyShow').hide();
});

/* When the user clicks on the scout's name in the modal. The modal will be closed
*  and the page will jump to the scout's name.
*/
function closeModal(){
	$('#hikeModal').hide();
};


/*
* The getData function will call a defined page and inject that page in the 
* targetd localtion
*
* Params
* @dataId (number) This is the key field for the SQL call
* @hideTarget (string) This is the element to show or hide when this is called
* @dataTarget (string) This is the element that will display the template page.
* @page (string) The template page
* @param (string) the name of the param to be used.
*
*/

function closeHikersDetail(){
	$('.hikers_details').fadeOut(200);
}

function getData(dataId,hideTarget,dataTarget,page,param) {

    if (dataId == "") {
        $(hideTarget).hide();
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                $(dataTarget).fadeIn(200).html(this.responseText);
            }
        };
        let p = "";
        if(param.length > 0){
        	p = "?" + param + "=" + dataId;
        }
        xmlhttp.open("GET",page + p,true);
        xmlhttp.send();
    }
}
function jumpToScout(){
	var scoutId = $('#scout_search').val();
	console.log(scoutId);
	$(document).scrollTop( $('#' + scoutId).offset().top - 20 );
	$('#' + scoutId).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200);
}
</script>
<?php
	require("footer.php");
?>
