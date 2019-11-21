<?php
# Encrypt message
function encrypt_message($message,$key) {
	(string) $encrypted = '';

	if(isset($message) && isset($key)) {
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted_msg = openssl_encrypt($message, 'aes-256-cbc', $key, 0, $iv);
		$encrypted=base64_encode($encrypted_msg . '::' . $iv);
	}
	return $encrypted;
}

# Decrypt message
function decrypt_message($message,$key) {
	(string) $decrypted = '';

	if(isset($message) && isset($key)) {
		list($encrypted_data, $iv) = explode('::', base64_decode($message), 2);
		$decrypted=openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
	}
	return $decrypted;
}
?>
