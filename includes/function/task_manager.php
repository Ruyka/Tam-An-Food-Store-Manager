<?php 
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
?>

<?php 
	if(isset($_GET['q']) && !empty($_GET['q'])){
    	$get = json_decode($_GET['q'], true);
    	$action = $get['action'];
    	switch ($action) {
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