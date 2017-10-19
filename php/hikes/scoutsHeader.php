<?php
require("admin_ini.php");
require("db_ini.php");

// Keep track of the current page so that we can redirect the user here if they choose to log out.
$redirect = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head profile="http://www.w3.org/2005/10/profile">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pack 97 - Event Registration</title>
  <META NAME="keywords" CONTENT="pack 97 Hikes">
  <!-- <link REL="STYLESHEET" HREF="style.css" TYPE="text/css"> -->
  <link rel="icon" type="image/gif" href="../images/favicon.ico">
  <style type="text/css">
    div.hidden {display:none;}
  </style>
  <link rel="stylesheet" href="/css/hikepage.css">
</head>
<body >	
<?php
	include("../header.php");
?>