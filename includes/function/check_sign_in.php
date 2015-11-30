<?php
	session_start();
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Management.php");
	//check if POST contain any login info of user
	$arr = array();
	$arr['message'] ="";
	if (isset($_POST['username']) && isset($_POST['password'])){
		
		$manage = new Management();
		//if yes check the login with the database, get user data on success
		//else return nothing
		$user_data = $manage->check_user_login($_POST['username'], $_POST['password']);
		//if user data has nothing
		if (!isset($user_data)){
			//show err
			$arr['message'] = "Tên đăng nhập hoặc mật khẩu không hợp lệ.";		
		}
		else
		{
			//otherwise, remember the login of user
			$_SESSION['is_login'] = true;
			$_SESSION['username'] = $user_data['Name'];
			$_SESSION['user_id'] = $user_data['Id'];
		}
		
	}
	
	echo json_encode($arr);

?>