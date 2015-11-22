<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
?>

<!-- PHP code start here -->
<?php 

// know which button is press
$type = $_POST['submit_type'];
// know current maximum id
$current_id = $_POST['current_id'];

// unset both
unset($_POST['submit_type']);
unset($_POST['current_id']);
unset($_POST['product'.$current_id]);
unset($_POST['product'.$current_id.'_quantity']);

// array to return
$ARRAY[0] = array('id'=>$_POST['product'], 'quantity'=>$_POST['product_quantity']);
for($cur = 1; $cur < $current_id; $cur++)	
	$ARRAY[$cur] = array('id'=>$_POST['product'.$cur], 'quantity'=>$_POST['product'.$cur.'_quantity']);

// key for encrypt/decrypt
$KEY=md5("dob1depatodop7lipdaig7bebeaion9d");
$IV=md5("asdkjhfalkwjehfklsndvfakjsgasdkj");

// encrypt
$encrypted = encrypt_get_url($ARRAY, $IV, $KEY);
$_SESSION['encrypted'] = $encrypted;
header('Location: '.CONFIG_PATH('public_HTML'));
?>

<?php 
// encrypt to use get on url (copied code ! dont ask)
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