<?php
include_once "random.php";
include_once "storage/$backend.php";

$id=random_text('alnum', 20);
$key=random_text('alnum', 10);

include_once "encryption.php";
$encrypted=bin2hex(mcrypt_generic($cipher, $_POST["message"]));
mcrypt_generic_deinit($cipher);

if(save_msg($encrypted, $id)) {
	$recover_url=$base_url."/index.php?id=".$id.$key;
	include "templates/save_head.php";
	include "templates/save.php";
	include "templates/save_foot.php";
} else {
	include "templates/enter_head.php";
	include "templates/enter.php";
	include "templates/enter_foot.php";
}
?>
