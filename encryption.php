<?php
# Open crypt module
function open_crypt_module($key){
	$algorithm=MCRYPT_RIJNDAEL_256;
	$algorithm_mode=MCRYPT_MODE_CBC;
	$cipher=mcrypt_module_open($algorithm, '', $algorithm_mode, '');
	# $iv has to be the same on encryption and decryption
	# store it with the message or use a fixed one
	#$iv_size = mcrypt_enc_get_iv_size($cipher);
	#$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$iv="this is an init vector..........";

	if(!mcrypt_generic_init($cipher,$key,$iv) != -1) {
		close_crypt_module();
		exit(0);
	}
	return $cipher;
}

# Close crypt module
function close_crypt_module() {
	global $cipher;

	if (isset($cipher)) {
		mcrypt_generic_deinit($cipher);
		mcrypt_module_close($cipher);
	}
}

# Encrypt message
function encrypt_message($message,$key) {
	(string) $encrypted = '';

	if(isset($message) && isset($key)) {
		$cipher=open_crypt_module($key);
		$encrypted=bin2hex(mcrypt_generic($cipher,$message));
		close_crypt_module();
	}
	return $encrypted;
}

# Decrypt message
function decrypt_message($message,$key) {
	(string) $decrypted = '';

	if(isset($message) && isset($key)) {
		$cipher=open_crypt_module($key);
		$decrypted=mdecrypt_generic($cipher,hex2bin($message));
		close_crypt_module();
	}
	return $decrypted;
}
?>
