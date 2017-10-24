<?php
session_start();

// Need to identify if the current user is an admin (have they logged in).
$admin = false;
if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) { $admin = true; }


?>