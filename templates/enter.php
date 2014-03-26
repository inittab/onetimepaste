<form action="index.php" method="post" enctype="multipart/form-data">
Mensaje:<br>
<textarea name="message" rows="4" cols="50"></textarea><br>
<input type="submit" name="submit" value="Enviar mensaje!">
<hr>
O envía un fichero (max: <?php echo $max_upload_size; ?> MB):
	<input type="file" name="file" />
	<br>
	<input type="submit" value="Enviar fichero!">

</form>
