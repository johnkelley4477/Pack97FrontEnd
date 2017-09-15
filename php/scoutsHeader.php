<?php
require("admin_ini.php");
require("db_ini.php");
require("host_ini.php");

// Keep track of the current page so that we can redirect the user here if they choose to log out.
$redirect = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head profile="http://www.w3.org/2005/10/profile">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pack 97 - Event Registration</title>
  <META NAME="keywords" CONTENT="pack 97 activities, events, fun, Blue, gold">
  <!-- <link REL="STYLESHEET" HREF="style.css" TYPE="text/css"> -->
  <link rel="icon" type="image/gif" href="../images/favicon.ico">
  <style type="text/css">
    div.hidden {display:none;}
  </style>
</head>
<body >
	<header>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/modernize.css">
		<link rel="stylesheet" href="/css/datecard.css">
	 	<div class="imgHeader">
	 		<i class="item84 fa fa-bars">
	 			<span class="icon_menu">menu</span>
	 		</i>
	 		<p class="item84">Menu</p>
	 		<img src="/images/patches.png" class="logo">
	 		<div class="text_container">
		        <h1>Cub Scout Pack 97</h1>
		       	<h2>Huntersville, Mecklenburg County, NC<br>at St. Mark Catholic Church</h2>
		    </div>
		<ul class="main_menu">
			<div id="mm" style="">
				<li class="item1">Home</li>
				<li class="item27">Program Overview</li>
				<li class="item58">Pack Committee</li>
				<li class="item66">Event Registration</li>
				<li class="item83">Scout Hike Totals</li>
				<li class="item59">Leaders</li>
				<li class="item48">Resources</li>
				<li class="item69">Scout Camps</li>
				<li class="item81">Den Meeting Times</li>
				<li class="item82">ScoutTrack</li>
				<li class="item86">Multimedia Gallery</li>
			</div>
		</ul>
		</div>
	</header>