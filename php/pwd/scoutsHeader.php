<?php
require("admin_ini.php");
require("db_ini.php");

// Keep track of the current page so that we can redirect the user here if they choose to log out.
$redirect = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
?>

<style type="text/css">
</style>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head profile="http://www.w3.org/2005/10/profile">
  <title>Pack 97 - PineWood Derby</title>
  <META NAME="keywords" CONTENT="pack 97 activities, events, fun, race, Pinewood, Derby">
  <!-- <link REL="STYLESHEET" HREF="style.css" TYPE="text/css"> -->
  <link rel="icon" type="image/gif" href="../images/favicon.ico">
  <style type="text/css">
    div.hidden {display:none;}
    font.section {
	font-size:24px;
	font-weight:bold;
	text-decoration:underline;
    }
  </style>
</head>
<body leftmargin="0" topmargin="10" marginwidth="0" 
marginheight="0">
<?php
	require("../header.php");
?>