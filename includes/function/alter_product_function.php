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
        	$data = get_product_data_from_server($query);
        	if (is_object($data)){
        		echo $data->json_encode();
        	}
        	else
        		echo json_encode($data);
        	break;
        case 'send_data_to_server':
        if(isset($_SESSION['PREVIEW_SERVER_DATA'])){
            send_data_to_server($_SESSION['PREVIEW_SERVER_DATA']);
            unset($_SESSION['PREVIEW_SERVER_DATA']);
        }else{
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(array('message' => 'session data missing', 'code' => 1000));
        }
        break;
    }
}

function get_product_data_from_server($query){
	$manager = new Management();
    $data = $manager->get_list_of_product_info($query);
    if (!isset($data['error'])){
	    $list = new Receipt();
	    $list->get_data_from_array($data);
	    return $list;
	}
	else
		return $data;
}


?>
