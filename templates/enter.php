<form action="index.php" method="post">
Mensaje:<br>
	<textarea name="message" rows="4" cols="50"></textarea><br>
	<input type="submit" name="submitmsg" value="Enviar mensaje!">
</form>
<form action="index.php" method="post" enctype="multipart/form-data">
O envía un fichero (max: <?php echo $max_upload_size; ?> MB):
	<input type="file" name="file"> <br>
	<input type="submit" name="submitfile" value="Enviar fichero!">
</form>
