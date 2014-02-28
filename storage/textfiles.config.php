<?php
/*
* Directory to keep messages
* 
* Must be writeable by the webserver user (i.e. www-data or apache)
* Optionally only readable by the webserver user
* DO NOT use a directory under you web root (DocumentRoot)!
* Warning, /tmp could be purged by your operating system (i.e. on a reboot)
*/
$textfiles_dir="/tmp";
$textfiles_prefix="otp_";
?>
