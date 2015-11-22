<?php 
$type = $_POST['submit_type'];

$KEY=md5("dob1depatodop7lipdaig7bebeaion9d");
$IV=md5("asdkjhfalkwjehfklsndvfakjsgasdkj");

function encrypt_get_url($arr, $IV, $KEY){
	$SERIAL=serialize($arr);
	$M=mcrypt_module_open('rijndael-256','','cbc','');
	mcrypt_generic_init($M,$KEY,$IV);
	$ENCRYPTEDDATA=mcrypt_generic($M,$SERIAL);
	mcrypt_generic_deinit($M);
	mcrypt_module_close($M);
	$q=base64_encode($ENCRYPTEDDATA);
	$q=str_replace(array('+','/','='),array('-','_','.'),$q);

	return $q;
}
?>