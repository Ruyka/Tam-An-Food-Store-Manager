<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
require_once(CLASS_PATH."AllClass.php");
require_once(CLASS_PATH."Management.php");
?>

<?php 
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'get_receipt_data_from_server':
        echo get_receipt_data_from_server()->json_encode();
        break;
        case 'get_data_from_submit':       
        echo json_encode(get_data_from_submit());
        break;
    }
}

// get data from server
function get_receipt_data_from_server(){
    $manager = new Management();
    $data = $manager->get_list_of_product_info();
    $receipt = new Receipt();
    $receipt->get_data_from_array($data);
    return $receipt;
}

// get data from submit
function get_data_from_submit(){
    $flag = true;
    $arr = $_GET;
    $maxID = $_POST['max'];
    $cur = 0;
    $ID_list = null;
    if(isset($arr['product']))
        $ID_list[$cur++] = '';
    for($i = 0; $i < $maxID; $i++){
        if(isset($arr['product'.$i]))
            $ID_list[$cur++] = $i;
    }
    for($i = 0; $i < $cur; $i++){
        for($j = $i + 1; $j < $cur; $j++){
            if(isset($ID_list[$i]) && isset($ID_list[$j]) && $arr['product'.$ID_list[$i]] == $arr['product'.$ID_list[$j]]){
                $arr['product'.$ID_list[$i].'_quantity'] = intval($arr['product'.$ID_list[$i].'_quantity']) + intval($arr['product'.$ID_list[$j].'_quantity']);
                unset($arr['product'.$ID_list[$j]]);
                unset($arr['product'.$ID_list[$j].'_quantity']);
                unset($ID_list[$j]);
            }
        }
    } 
    for($i = 0; $i < $cur; $i++){
        if(isset($ID_list[$i]) && $arr['product'.$ID_list[$i].'_quantity'] == 0){
            unset($arr['product'.$ID_list[$i]]);
            unset($arr['product'.$ID_list[$i].'_quantity']);
            unset($ID_list[$i]);
        }
    }
    if (count($arr) == 0)
        return "";

    $cur = 0;
    $ID_list = null;
    if(isset($arr['product']))
        $ID_list[$cur++] = '';
    for($i = 0; $i < $maxID; $i++){
        if(isset($arr['product'.$i]))
            $ID_list[$cur++] = $i;
    }

    $cur = 0;
    $reArr = null;
    foreach ($ID_list as $key => $value) {
        $reArr[$cur++] = array(json_decode($arr['product'.$value]), $arr['product'.$value.'_quantity']);
    }
    return $reArr;
}
?>