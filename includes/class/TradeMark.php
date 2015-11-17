<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	
	//this class will give us the infomation of trademark
	class TradeMark{

		//Properties:
		//basic infomation of the trademark
		private $basic_info;
		// nation of the trademark
		private $nation;
		// website of the trademark
		private $website;

		//Function:
		//construct the object with data
		//default values: basic_info = NULL
		//				  nation and website =""

		public function __construct($basic_info = NULL, $nation = "", $website = ""){
			$this->basic_info = $basic_info;
			$this->nation = $nation;
			$this->website = $website;
		}

		//get the name of TradeMark
		public function get_name(){
			//get the name in basic infomation by using method get_name in BasicInfo Object
			return $this->basic_info->get_name();
		}

		//convert Object into HTML, to display to users
		public function convert_to_HTML(){
		  //dummy code, for testing
            return "Trade Mark " . $this->basic_info->convert_to_HTML(). " " . $this->nation . $this->website;
		}

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			
			//properties of TradeMark instance
			$json = array(
				//basic_info is an Object BasicInfo, so we must encode it to an array 
	        	'basic_info' => $this->basic_info->json_encode(false),
	        	'nation' => $this->nation,
	        	'website' => $this->website,
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
 				// if basic info not created yet, new it
 				if (is_null($this->basic_info))
 					$this->basic_info = new BasicInfo();
 				//else use the old one
 				//get the data from the array that contain the data of basic infomation
 				$this->basic_info->get_data_from_array($data['basic_info']);
				$this->nation = $data['nation'];
				$this->website = $data['website'];
 			}
		} 

		//get data from an array data 
		public function get_data_from_array($data){
			// a right Basic info array must have 3 properties basic info, nation an website
			if ( isset($data['basic_info']) && isset($data['nation']) && isset($data['website']) ){
 				$this->basic_info->get_data_from_array($data['basic_info']);
				$this->nation = $data['nation'];
				$this->website = $data['website'];
			}
		} 
	}
    
    
?>