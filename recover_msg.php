<?php
include_once "storage/$backend.php";

# validate $id
$message=False;
if(preg_match("/^[A-Za-z0-9]+$/", $_GET["id"])) {
	$id=substr($_GET["id"],0,20);
	$key=substr($_GET["id"],20,10);

	if($encrypted=read_msg($id)) {
		include "encryption.php";
		$message=mdecrypt_generic($cipher, hex2bin($encrypted));
		mcrypt_generic_deinit($cipher);
	}
} 

if($message) {
	include "templates/recover_head.php";
	include "templates/recover.php";
} else {
	include "templates/recover_fail.php";
}

include "templates/recover_foot.php";
?>
