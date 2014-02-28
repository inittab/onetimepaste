<?php
include_once "storage/$backend.php";

# check id is set in case this php is not called thru index.php
if (isset($_GET["id"])) {
	# validate id
	if(preg_match('/^[A-Za-z0-9]{30}$/', $_GET["id"])) {
		$id=substr($_GET["id"],0,20);
		$key=substr($_GET["id"],20,10);

		if($encrypted=read_msg($id)) {
			include "encryption.php";
			$message=mdecrypt_generic($cipher, hex2bin($encrypted));
			mcrypt_generic_deinit($cipher);
		}
	} 
}

if(isset($message)) {
	include "templates/recover_head.php";
	include "templates/recover.php";
} else {
	include "templates/recover_fail.php";
}

include "templates/recover_foot.php";
?>
