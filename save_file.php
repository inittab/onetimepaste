<?php
# Do not allow direct call of this php
if(!defined('INCLUDED_FROM_INDEX')){ die(); }
include_once "random.php";
include_once "storage/$backend.php";

# Check $_FILES array
if(isset($_FILES) && sizeof($_FILES) > 0) {
	if($max_upload_size > 0 && $_FILES['file']['size'] > $max_upload_size * 1024 * 1024) {
		include "templates/file_too_large.php";
	}
	elseif(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) {
		$id=random_text('alnum', 20);
		$key=random_text('alnum', 10);
		include "encryption.php";
		$filename = encrypt_message($_FILES['file']['name'], $key);
		$filecontents = encrypt_message(file_get_contents($_FILES['file']['tmp_name']), $key);
		$filesize = $_FILES['file']['size'];
		$encrypted = sprintf("%s:%s:%s", $filename, $filesize, $filecontents);
	}
}

if($encrypted != "" && save_msg($encrypted, $id)) {
	$recover_url=$base_url."/index.php?fileid=".$id.$key;
	include "templates/save_head.php";
	include "templates/save_file.php";
	include "templates/save_foot.php";
} else {
	include "templates/enter_head.php";
	include "templates/enter.php";
	include "templates/enter_foot.php";
}
?>
