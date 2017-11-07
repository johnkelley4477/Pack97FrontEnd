<?php
require("pwd_header.php");

if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1)
{
	// The user is logged in as an admin.
	// Do nothing.
}
else
{
	// Keep track of the current page so that we can redirect the user here after they have logged in.
	$redirect = $_SERVER['PHP_SELF'];
	
	echo "You are being redirected to the login page.<br />";
	echo "If you are not redirected, please <a href=\"admin_login.php?redirect=" . $redirect . "\">click here</a>.<br /><br />";
	?>
	<script type="text/javascript">
	setTimeout(function(){window.location.href="admin_login.php?redirect=<?php echo $redirect; ?>"},1);
	</script>
		<?php
	die();
}
?>