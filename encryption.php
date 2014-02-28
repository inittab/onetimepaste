<?php
$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
# $iv has to be the same on encryption and decryption
# store it with the message or use a fixed one
#$iv_size = mcrypt_enc_get_iv_size($cipher);
#$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

$iv="this is an init vector..........";

if(!mcrypt_generic_init($cipher, $key, $iv) != -1) {
	# TODO
	print "Encryption error";
}
?>
