<?php
/**
 * Must provide: read_msg, save_msg and purge_old
 */
include_once "$backend.config.php";

function save_msg($message='',$id='') {
	global $textfiles_dir, $textfiles_prefix;
	$filename = $textfiles_dir . "/" . $textfiles_prefix . $id;

	umask(0077);
	if ($fh = @fopen($filename, "x")) {
		if (fwrite($fh, $message)) {
			fclose($fh);
			return True;
		}
		fclose($fh);
	}
	return False;
}

function read_msg($id='') {
	global $textfiles_dir, $textfiles_prefix;
	$filename = $textfiles_dir . "/" . $textfiles_prefix . $id;
	
	if ($fh = @fopen($filename, "r")) {
		if ($message = fread($fh, filesize($filename))) {
			fclose($fh);
			if (unlink ($filename)) {
				return $message;
			} else {
				return $false;
			}
		}
		fclose($fh);
	}
	return False;
}

function purge_old() {
	global $textfiles_dir;
	# TODO ! system() or use crontab entry??
}
