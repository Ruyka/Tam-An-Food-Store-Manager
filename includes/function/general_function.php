<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');  
?>

<?php 
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'JS_CONFIG_PATH':
            echo JS_CONFIG_PATH($_POST['directory'],$_POST['file']);  
            break;
        case 'get_username':
            if(isset($_SESSION['username']))
                echo   $_SESSION['username'];
            else
                echo "Tâm An";
            break;
    }
}
// get path
function JS_CONFIG_PATH($directory, $file){
    echo CONFIG_PATH($directory).$file;
}

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

// decrypt to use get on url (copied code ! dont ask)
function decrypt_get_url($arr, $IV, $KEY){
    $arr=str_replace(array('-','_','.'),array('+','/','='),$arr);
    $ENCRYPTEDDATA=base64_decode($arr);
    $M=mcrypt_module_open('rijndael-256','','cbc','');
    mcrypt_generic_init($M,$KEY,$IV);
    $SERIAL=mdecrypt_generic($M,$ENCRYPTEDDATA);
    mcrypt_generic_deinit($M);
    mcrypt_module_close($M);
    $ARRAY=unserialize($SERIAL);

    return $ARRAY;
}
?>