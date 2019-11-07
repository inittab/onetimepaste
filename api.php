<?php
include "config.php";
include_once "random.php";
include_once "storage/$backend.php";

$id=random_text('alnum', 20);
$key=random_text('alnum', 10);
$encrypted="";

if(isset($_POST["type"]) && $_POST["type"] == "message") {
	# check message not empty
	if (strlen(trim($_POST["message"])) > 0){
		include "encryption.php";
		$encrypted= encrypt_message($_POST["message"], $key);
	}
	if($encrypted != "" && save_msg($encrypted, $id)) {
		$recover_url=$base_url."/index.php?id=".$id.$key;
		print $recover_url;
	}
} elseif(isset($_POST["type"]) && $_POST["type"] == "file") {
	if($max_upload_size > 0 && $_FILES['file']['size'] > $max_upload_size * 1024 * 1024) {
		include "templates/file_too_large.php";
	}
	elseif(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0 ) {
		$id=random_text('alnum', 20);
		$key=random_text('alnum', 10);
		include "encryption.php";
		$filename = encrypt_message($_FILES['file']['name'], $key);
		$filecontents = encrypt_message(file_get_contents($_FILES['file']['tmp_name']), $key);
		$filesize = $_FILES['file']['size'];
		$encrypted = sprintf("%s:%s:%s", $filename, $filesize, $filecontents);
	}
	if($encrypted != "" && save_msg($encrypted, $id)) {
		$recover_url=$base_url."/index.php?fileid=".$id.$key;
		print $recover_url;
	}
}
else {
	# TODO
	print "Error";
}
?>
