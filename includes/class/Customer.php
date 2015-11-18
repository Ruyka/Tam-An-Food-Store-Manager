<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	//this class conatin information about customer
	class Customer{
		//Properties
		//customer only has the basic infomation
		private $basic_info;

		//Constructor
		// constructor receive basic info object
		/// dafault value of basic_info will be NULL
		public function __construct($basic_info = NULL){
			// if basic info not created yet, new it
 			if (is_null($basic_info))
 				$this->basic_info = new BasicInfo();
			else
				$this->basic_info = $basic_info;
		}
		

		//Method:
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
		//get data from json_data 
		public function get_data_from_json($json_data){
			// decode input using json decode
			$data = json_decode($json_data,true);
	 		// if json last error is equal to NONE -> get the data from it
 			if (json_last_error() == JSON_ERROR_NONE){
 				//get the data 
 				$this->get_data($data);
 			}
		} 

		//get data from an array data 
		public function get_data_from_array($data){
			// a right Basic info array must have  property basic info
			if ( isset($data['basic_info'])){
 				$this->get_data($data);
			}
		} 
		private function get_data($data){
			$this->basic_info->get_data_from_array($data['basic_info']);
		}
	}
    
?>