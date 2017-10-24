<?php
	require("scoutsHeader.php");
?>
<style>
	.titleContainer{
		width:600px;
	}
	.titleCopy h1{
		color:#026;
	}
	.sub_title{
		color:#026;
		text-align:left;
		font-size: 25px;
		margin-left: -10px;
	}
	.read_rules{
		width:130.3px;
	}
	.reg_button{
		width:260px;
	}
	@media only screen and (max-width: 625px) {
		.titleContainer{
			width:400px;
		}
		.titleContainer img{
			float:none;
			margin-right: auto;
			margin-left: auto;
			display: block;
		}
		.titleCopy{
			float:none;
			margin-right: auto;
			margin-left: auto;
		}
	}
</style>
<script type="text/javascript">
function ReadRules()
{
window.location.href = "/PDF/PWD_Rules_and_Procedures.pdf";
}

function Register()
{
// Deactivated once registration closed the night of the derby check-in.
window.location.href = "register.php";
}

function ViewRoster()
{
window.location.href = "reg_list.php";
}

</script>
<div class="horCenter titleContainer">
	<img class="floatLeft" src="../images/derby_gar.jpg" alt="" border="0" />
	<div class="floatRight titleCopy">
		<h1 align="center">Pinewood Derby</h1>
		<p align="center">Welcome to your Pack 97's Pinewood Derby headquarters.<br />Here you will find race rules, registration instructions and results.</p>
	</div>
</div>
<div class="clearBoth m20">
	<p>We have updated the Derby rules from last year. Please be sure to read them <b>before</b> beginning to work on your race cars. In order to maintain a fair and competitive race these rules will be enforced from check-in inspection thru the race. Any car that fails to meet the rules during inspection will not be allowed entry into the race, however you will be given the chance to modify your car to meet the rules during check-in. If rules violations are found at any time after check-in to the end of the event the car may be disqualified at the discretion of the race officials. If you have any questions regarding the rules or legality of a potential modification please contact the <a href="mailto:PinewoodDerby@CubScoutPack97.org">Pinewood Derby Co-Chairpersons</a>.</p>
	<div class="horCenter read_rules">
		<input class="btn" type="button" value="Read the Rules" OnClick="ReadRules()" />
	</div>
</div>
<div class="m20">
	<h2 class="sub_title">Schedule of Events</h2>
	<div>
		<b>Check-in</b> - Friday, January 27<sup>th</sup> from 6:30pm-8:00pm. A workroom will be available if a car fails inspection. Cars will be impounded following check-in.
	</div>
	<div>
		<b>Race Day</b> - Saturday, January 28<sup>th</sup> the festivities will begin at 12:00pm. Racing is expected to last an hour and a half. Awards will be presented following the last race. A small concession stand will be available during the race.
	</div>
</div>
<div class="m20">
	<h2 class="sub_title">Registration</h2>
	<p>After you have read the Race Rules, you may register your car. Numbers are assigned on a first come, first served basis. Once assigned, car numbers can not be changed.</p>	
	<div class="horCenter reg_button">
		<!-- Register button disable after derby check-in night. -->
		<input class="btn" type="button" value="Register" OnClick="Register()" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input class="btn" type="button" value="View Derby Roster" OnClick="ViewRoster()" />
	</div>
</div>
<?php
	include("scoutsFooter.php");
?>
