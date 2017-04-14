<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
require_once(CLASS_PATH."AllClass.php");
require_once(CLASS_PATH."Management.php");

// function switcher for ajax call
// check which "action" ajax call
if(isset($_GET['q']) && !empty($_GET['q'])) {
    $get = json_decode($_GET['q'], true);
    $action = $get['action'];
    switch ($action) {
        case 'get_data_with_query_from_server':
        	//get query out of POST
    	    $query = $_POST['query'];
        	$data = get_import_product_data_from_server($query);
        	if (is_object($data)){
        		echo $data->json_encode();
        	}
        	else
        		echo json_encode($data);
        	break;
        case 'push_alter_product_data_to_server':
            $array_product = $_POST['array_product'];
            $array_product = json_decode($array_product,true);
            push_alter_product_data_to_server($array_product);
            break;
        case 'push_new_product_data_to_server':
            $array_product = $_POST['array_product'];
            $array_product = json_decode($array_product,true);
            push_new_product_data_to_server($array_product);
            break;
    }
}

function push_alter_product_data_to_server($array){
    if (sizeof($array)==0) return;
    $receipt = new Receipt();
    $array_id = array();

    foreach ($array as $product){
        if (isset($product['id'])){    
            if (strcmp($product['action'],'Xóa sản phẩm')==0){
                $array_id[]=$product['id'];
            }
            else{
                $import_product = new ImportProduct($product['bought']);
                $import_product->add_attribute($product['name'],new Unit($product['unit_name'], $product['sale']),$product['id']);
                $receipt->add($import_product);
            }
        }
    }

    $manage = new Management();
    $manage->remove_product($array_id);
    $manage->push_alter_product_data_to_server($receipt);
}

function push_new_product_data_to_server($array){
    if (sizeof($array)==0) return;

    $receipt = new Receipt();

    foreach ($array as $key => $product){
        if (isset($product['name']))
        {
            $import_product = new ImportProduct($product['bought']);
            $import_product->add_attribute($product['name'],new Unit($product['unit_name'], $product['sale']));
            $receipt->add($import_product);
        }
    }
    echo $receipt->json_encode(true);
    $manage = new Management();
    $manage->push_new_product_data_to_server($receipt);
    
}


function get_import_product_data_from_server($query){
	$manager = new Management();
    $data = $manager->get_list_of_import_product_info($query);
    if (!isset($data['error'])){
	    $list = new Receipt();
	    $list->get_data_from_array($data);
	    return $list;
	}
	else
		return $data;
}


?>
