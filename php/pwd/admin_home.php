<?php
require("admin_header.php");
?>

<script type="text/javascript">
function btnExport_OnClick()
{
	window.location.href = "export.php";
}

function btnDelete_OnClick()
{
	var r=confirm("This will delete all derby registration data in the database.\n\nAre you sure you want to proceed?");
	if (r==true)
	{
		window.location.href = "delete.php";
	}
}

</script>

<table cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td align="center"><h2>Pinewood Derby<br />Administrator Home</h2></td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><input type="button" name="btnExport" id="btnExport" value="Export Derby Roster" onclick="btnExport_OnClick()" /></td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><input type="button" name="btnDelete" id="btnDelete" value="Delete All Data" onclick="btnDelete_OnClick()" /></td>
	</tr>
	<!-- Spacer row. -->
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>

<?php
include("pwd_footer.php");
?>