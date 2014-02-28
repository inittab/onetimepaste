<?php
include_once "config.php";
include_once "storage/$backend.php";

if(!purge_old()) {
	print "Error";
}
?>
