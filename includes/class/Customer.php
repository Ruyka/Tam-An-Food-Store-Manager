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
		//convert to HTML for publication
		public function convert_to_HTML(){
			//dummy code for testing
			return $this->basic_info->convert_to_HTML();
		}

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			
			//properties of TradeMark instance
			$json = array(
				//basic_info is an Object BasicInfo, so we must encode it to an array 
	        	'basic_info' => $this->basic_info->json_encode(false),
    		);

    		// code = true, return json encode, else just return object data encode as an array
			if ($code)
    			return json_encode($json);
    		else 
    			return $json;
		
		}

	}
    
?>