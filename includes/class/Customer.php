<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	//this class conatin information about customer
	class Customer{
		//customer only has the basic infomation
		private $basic_info;
		// constructor receive basic info object
		public function __construct($basic_info){
			$this->basic_info = $basic_info;
		}
		public function convert_to_HTML(){
			return $this->basic_info->convert_to_HTML();
		}
	}
    
?>