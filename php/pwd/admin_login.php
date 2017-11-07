<?php
require('pwd_header.php');

$_SESSION['logged'] = 0;

if (isset($_POST['submit']))
{
	$redirect = $_POST['redirect'];
	
	if ($_POST['username'] == "cubscout" && $_POST['password'] == "SaintMark")
	{
		$_SESSION['logged'] = 1;
		
		echo "The login was successful!<br /><br />";
		echo "You are being redirected to your original page.<br />";
		echo "If you are not redirected, please <a href='" . $redirect . "'>click here</a>.<br /><br />";
		?>
		<script type="text/javascript">
			setTimeout(function(){window.location.href="<?php echo $redirect; ?>"},1);
		</script>
		<?php
		require('events_footer.php');
		
		die();
	}
	else
	{
		$invalid_login = 1;
	}
}
else
{
	if (isset($_GET['redirect']))
	{
		$redirect = $_GET['redirect'];
	}
	else
	{
		$redirect = "admin_home.php";
	}
}

?>

<form method="POST" action="admin_login.php">
	<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
	<table cellpadding="2" cellspacing="2" border="0">
		<tr>
			<td colspan="3">Please log in to gain access to the adminstrator pages.</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<?php
		if ($invalid_login)
		{
			echo '<tr>';
			echo '<td colspan="3"><font color="red">Invalid username/password. Please try again.</font></td>';
			echo '</tr>';
		}
		?>
		<tr>
			<td>Username:</td>
			<td>&nbsp;</td>
			<td><input type="text" name="username" /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td>&nbsp;</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td align="right" colspan="3"><input type="submit" name="submit" value="Log In" /></td>
		</tr>
	</table>
</form>

<?php
require('pwd_footer.php');
?>