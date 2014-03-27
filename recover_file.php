<?php
# Do not allow direct call of this php
if(!defined('INCLUDED_FROM_INDEX')){ die(); }
include_once "storage/$backend.php";

# check 'fileid' is set in case this php is not called thru index.php
if (isset($_GET["fileid"])) {
	# validate 'fileid'
	if(preg_match('/^[A-Za-z0-9]{30}$/', $_GET["fileid"])) {
		$id=substr($_GET["fileid"],0,20);
		$key=substr($_GET["fileid"],20,10);

		if($encrypted=read_msg($id)) {
			# check there is a colon in the recovered string
			if(strstr($encrypted, ":")) {
				include "encryption.php";

				$encrypted_fields = explode(":", $encrypted);
				$filename = rtrim( decrypt_message($encrypted_fields[0], $key));
				$filesize = $encrypted_fields[1];
				$filecontents = decrypt_message($encrypted_fields[2], $key);
				$filecontents = substr($filecontents, 0, $filesize);

				header("Content-type: application/octet-stream");
				header('Content-Disposition: attachment; filename="'.urlencode($filename).'"');
				print $filecontents;
				exit();
			}
		}
	}
}

include "templates/head.php";
include "templates/recover_fail.php";
include "templates/recover_foot.php";
?>
