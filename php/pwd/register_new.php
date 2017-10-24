
<?php
require("scoutsHeader.php");


// Open the connection to the DB server.
$con = mysql_connect($hostname,$db_username,$db_password);
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}
	
// Select the Events DB.
mysql_select_db($db_name, $con);

// Get the list of current ranks.
// Exclude Web II scouts. They cross over to Boy Scouts prior to the derby.
// If we ever change this in the Pack's schedule this will need to be changed here.
$sql = 'SELECT * FROM Ranks';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of ranks: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_array($result))
{
	$ranks[$i] = $row;
	
	$i++;
}

// Get the list of car numbers in use by the scout derby.
$sql = 'SELECT CarNumber FROM Derby_Cars WHERE DerbyType = "Scout" ORDER BY CarNumber ASC';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of car numbers for the scout derby: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_array($result))
{
	$car_numbers_scout[$i] = $row[0];
	$i++;
}

// Get the list of car numbers in use by the family derby.
$sql = 'SELECT CarNumber FROM Derby_Cars WHERE DerbyType = "Family" ORDER BY CarNumber ASC';

// Run the select query.
$result = mysql_query($sql);

if (!$result)
{
	die('Error returning the list of car numbers for the family derby: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_array($result))
{
	$car_numbers_family[$i] = $row[0];
	$i++;
}

mysql_close($con);
?>

<script type="text/javascript">
function ChangeDerbyType()
{
	var carNumbersScout = new Array();
	<?php
	$cnt = 0;
	// For the Scout derby, use numbers 1-99.
	for ($i=1; $i<=99; $i++)
	{
		// Exclude car numbers that are already in use.
		$in_use = false;
		if (isset($car_numbers_scout))
			$in_use = in_array($i, $car_numbers_scout);
		
		if (!$in_use)
		{
			echo 'carNumbersScout[' . $cnt . '] = "' . $i . '";';
			$cnt++;
		}
	}
	?>
	
	var carNumbersFamily = new Array();
	<?php
	$cnt = 0;
	// For the Family derby, use numbers 100-150.
	for ($i=100; $i<=150; $i++)
	{
		// Exclude car numbers that are already in use.
		$in_use = false;
		if (isset($car_numbers_family))
			$in_use = in_array($i, $car_numbers_family);
		
		if (!$in_use)
		{
			echo 'carNumbersFamily[' . $cnt . '] = "' . $i . '";';
			echo '';
			$cnt++;
		}
	}
	?>
	
	ddwnDerbyType = document.getElementById("derby_type");
	ddwnCarNumber = document.getElementById("car_number");
	div = document.getElementById("divRanks");
	
	if (ddwnDerbyType.value == "Scout")
	{
		div.style.display = "block";
		AddOptionsToSelect(carNumbersScout, ddwnCarNumber);
	}
	else
	{
		div.style.display = "none";
		AddOptionsToSelect(carNumbersFamily, ddwnCarNumber);
	}
}

// Add the array of options to the Select element,
// removing all existing option elements first.
function AddOptionsToSelect(optArray, ddwn)
{
	for (var x=ddwn.options.length - 1; x>=0; x--)
		ddwn.remove(x);
	
	for (var i=0; i<optArray.length; i++)
	{
		var option = document.createElement("option");
		option.text = optArray[i];
		option.value = optArray[i];
		
		try
		{
			// for IE earlier than version 8
			ddwn.add(option,ddwn.options[null]);
		}
		catch (e)
		{
			ddwn.add(option,null);
		}
	}
}

function AgreeToRules()
{
	chk = document.getElementById("rules_agree");
	btn = document.getElementById("btnRegister");
	
	btn.disabled = !chk.checked;
}

function btnRegister_OnClick()
{
// Validate the user data.
// The character counts used below mathc those in the DB fields
// as well as the HTML form controls on the page itself.
txtLastName = document.getElementById('lastname');
txtFirstName = document.getElementById('firstname');
txtCarName = document.getElementById('car_name');

if (txtLastName.value == '')
{
	alert("Please enter a last name.");
	return false;
}

if (txtLastName.value.length > 15)
{
	alert("Last name must be less than 15 characters.");
	return false;
}

if (txtFirstName.value == '')
{
	alert("Please enter a first name.");
	return false;
}

if (txtFirstName.value.length > 15)
{
	alert("First name must be less than 15 characters.");
	return false;
}

if (txtCarName.value == '')
{
	alert("Please enter a car name.");
	return false;
}

if (txtCarName.value.length > 20)
{
	alert("Car name must be less than 20 characters.");
	return false;
}

// This should not happen, but just in case.
if (document.getElementById('rules_agree').checked == false)
{
	alert("You must agree to the Derby rules before you may register.");
	return false;
}

// Everything checks out, save the data.
var xmlhttp;

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      if (xmlhttp.responseText == "ok")
      {
      	window.location.href = "reg_list.php";
      }
      else
      {
      	alert(xmlhttp.responseText);
      }
    }
  }

xmlhttp.open("POST","save.php",true);

var data="";
data = data + "save_type=add&";
data = data + "derby_type=" + document.getElementById('derby_type').value + "&";
data = data + "lastname=" + document.getElementById('lastname').value + "&";
data = data + "firstname=" + document.getElementById('firstname').value + "&";

if (document.getElementById('derby_type').value == "Scout")
	data = data + "scout_rank=" + document.getElementById('scout_rank').value + "&";
else
	data = data + "scout_rank=0&";

data = data + "car_number=" + document.getElementById('car_number').value + "&";
data = data + "car_name=" + document.getElementById('car_name').value;

xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(data);

}
</script>
<style>
	input, select {
	    width: 400;
	    font-size: 18px;
	    margin-bottom: 10px;
	}
	.center_container{
		width:425px;
	}
</style>
<h1>Pinewood Derby Registration</h1>
<div class="horCenter center_container">
	<label>Derby Type:</label>
	<select name="derby_type" id="derby_type" onclick="ChangeDerbyType()">
		<option value="Scout" selected="selected">Scout</option>
		<option value="Family">Family</option>
	</select>
	<label>First Name:</label>
	<input type="text" name="firstname" id="firstname"/>
	<label>Last Name:</label>
	<input type="text" name="lastname" id="lastname" maxlength="15" />
	<div id="divRanks">
		<label>Scout Rank:</label>
		<select name="scout_rank" id="scout_rank">
			<?php
				for ($j=0; $j<=count($ranks) - 1; $j++)
				{
					$info = $ranks[$j];
					
					echo '<option value=' . $info['ID'] . '>' . $info['Name'] . '</option>';
				}
			?>
		</select>
	</div>
	<label>Car Name:</label>
	<input type="text" name="car_name" id="car_name" maxlength="20" /></td>
	<label>Car Number:</label>
	<select name="car_number" id="car_number">
	</select>
	<input type="checkbox" name="rules_agree" id="rules_agree" onclick="AgreeToRules()" />&nbsp;I have read and agree to the <a href="/PDF/PWD_Rules_and_Procedures.pdf" target="_blank">Pinewood Derby rules</a>.
	<input type="button" name="btnRegister" id="btnRegister" value="Register" onclick="btnRegister_OnClick()" />
</div>
<script type="text/javascript">
document.getElementById("btnRegister").disabled = true;

ChangeDerbyType();
</script>

<?php
require("scoutsFooter.php");
?>
