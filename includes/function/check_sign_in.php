<?php
	session_start();
	require_once(CLASS_PATH."Management.php");
	require_once(FUNCTION_PATH. "functions.php");
	//check if POST contain any login info of user
	if (isset($_POST['username']) && isset($_POST['password'])){
		
		$manage = new Management();
		//if yes check the login with the database, get user data on success
		//else return nothing
		$user_data = $manage->check_user_login($_POST['username'], $_POST['password']);
		//if user data has nothing
		if (!isset($user_data))
			//goes back to login page
			redirect_to(CONFIG_PATH("public_HTML")."login/");
		else
		{
			//otherwise, remember the login of user
			$_SESSION['is_login'] = true;
			$_SESSION['username'] = $user_data['Name'];
			$_SESSION['user_id'] = $user_data['Id'];
		}
		//Reload page
		redirect_to(CONFIG_PATH("public_HTML"));
	}
	// if a login of user has sucess or the user is not log out in the previous time
	// get the User Info to GLOBal variable
	if (isset($_SESSION['is_login'])){
		$USER_NAME = $_SESSION['username'];
		$ID = $_SESSION['user_id'];
		// if already login then we can not open login page again
		if (strpos($_SERVER['PHP_SELF'],'login') !== false) {
    		redirect_to(CONFIG_PATH("public_HTML"));		
		}
	}
	else
		//else head back if the page we are in not login page
		if (strpos($_SERVER['PHP_SELF'],'login') == false) {
			redirect_to(CONFIG_PATH("public_HTML")."login/");
		}
?>