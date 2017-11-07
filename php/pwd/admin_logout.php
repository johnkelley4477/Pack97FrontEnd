<?php
session_start();

// Clear out the session variable that we use to store the admin logged state.
$_SESSION['logged'] = 0;

// Set up to redirect the user back whence they came.
$redirect = $_GET['redirect'];

?>


<html>
<body>
<script type="text/javascript">
	setTimeout(function(){window.location.href="<?php echo $redirect; ?>"},1);
</script>
</body>
</html>