<?php
	//if receive request from signup, call server to insert user info to database
  require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
  
  if (isset($_POST['request'])){
    require_once(CLASS_PATH."Management.php");
    require_once(FUNCTION_PATH."functions.php");

    $data = array();
    $data['username'] = $_POST['username'];
    $data['name'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['password'] = $_POST['password'];
    $data['password_confirm'] = $_POST['password_confirm'];
    TEST(json_encode($data));
    $manage = new Management();
    print_r($manage->sign_up($data));
    redirect_to(CONFIG_PATH("public_HTML")."login/");
  }

?>