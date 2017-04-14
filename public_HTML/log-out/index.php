<?php
	include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(FUNCTION_PATH . "general_function.php");
	deleteSession();
	redirect_to(CONFIG_PATH('public_HTML')."login/");
?>