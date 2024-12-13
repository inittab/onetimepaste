<form action="index.php" method="get">

<?php
if(isset($_GET["id"]) && strlen($_GET["id"]) > 0) {
?>
	<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
<?php
} elseif (isset($_GET["fileid"]) && strlen($_GET["fileid"]) > 0) {
?>
	<input type="hidden" name="fileid" value="<?php echo $_GET["fileid"]; ?>">
<?php
}
?>
Pulse para ver su mensaje o descargar el fichero:<br>
	<input type="hidden" name="ok" value="ok">
	<input type="submit" name="confirm" value="Ver mensaje">
</form>
