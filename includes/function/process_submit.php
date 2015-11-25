<?php 
header('Content-Type: text/html');
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
$ARRAY = array();
$cur = 0;
if(isset($_POST['product_quantity']) && $_POST['product_quantity'] > 0)
	$ARRAY[$cur++] = array('id'=>$_POST['product'], 'quantity'=>floatval($_POST['product_quantity']));
for($i = 1; $i < $current_id; $i++)	{
	if(isset($_POST['product'.$i.'_quantity']) && floatval($_POST['product'.$i.'_quantity']) > 0)
		$ARRAY[$cur++] = array('id'=>$_POST['product'.$i], 'quantity'=> floatval($_POST['product'.$i.'_quantity']));
}
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