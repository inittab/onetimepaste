<p>
<h2>Envíe el siguiente enlace a su destinatario: <input type="text" readonly value="<?php print $recover_url; ?>" size="<?php print strlen($recover_url); ?>"><br>
En cuanto el enlace sea visitado, el mensaje será destruido.
</p>
</h2>
<p class="normal">El mensaje almacenado:</p>
<pre><?php print htmlspecialchars($_POST["message"],ENT_QUOTES | ENT_HTML401,'UTF-8'); ?></pre>
