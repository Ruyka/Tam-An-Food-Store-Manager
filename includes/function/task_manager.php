<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
?>

<?php 
    // list of option
    $task_option = array(array("blank",CONFIG_PATH("view")."blank.php","blank"), array("receipt",CONFIG_PATH("view")."receipt_task_view.php","In hóa đơn"), array("alter-product",CONFIG_PATH("view")."alter_product_task_view.php","Quản lý sản phẩm"));

	if(isset($_GET['q']) && !empty($_GET['q'])){
    	$get = json_decode($_GET['q'], true);
    	$action = $get['action'];
    	switch ($action) {
            case 'get_task_options';
                $user_type = $_SESSION['user_type'];
                if(strcmp($user_type, "admin") == 0){
                    echo json_encode($task_option);
                }
                else
                    echo json_encode(array($task_option[0],$task_option[1]));
                break;
    		case 'get_taskid_from_task':
    			$task = $get['task'];
    			if(isset($_SESSION['task'])){
    				$task_arr = $_SESSION['task'];
    				if(is_int(array_search($task, $task_arr)))
    					echo array_search($task, $task_arr);
    				else
    					echo -1;
    			}
    			else 
    				echo -1;
    			break;
    		
    		case 'update_taskid_task':
    			$id = intval($get['id']) - 1;
    			$task = $get['task'];
    			if(isset($_SESSION['task']))
    				$_SESSION['task'][$id] = $task;
    			else{
    				$_SESSION['task'] = array('blank', 'blank');
    				$_SESSION['task'][$id] = $task;
    			}
    			break;

    		case 'get_current_task':
    			$id = intval($get['id']) - 1;
    			if(isset($_SESSION['task']))
    				echo $_SESSION['task'][$id];
    			else{
    				$_SESSION['task'] = array('blank', 'blank');
    				echo $_SESSION['task'][$id];
    			}
    			break;
    	}
	}
?>