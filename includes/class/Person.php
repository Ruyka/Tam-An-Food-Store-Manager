<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	
	//store data of an person
	class Person{
		//Properties
		private $basic_info;
		protected $object_type;
		private $id;
		//Constructor
		public function __construct($id="" , $basic_info = NULL){
			$this->id = $id;
			// if there is no basic info -> create an empty one
			
			if (is_null($basic_info))
				$this->basic_info = new BasicInfo();
			else
				//else, assign it
				$this->basic_info = $basic_info;
			//set object type
			$object_type = "Person";
		}

		//Method:
		//get id of person
		public function get_id(){
			return $this->id;
		}
		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			
			$json = array(
				//basic_info is an Object BasicInfo, so we must encode it to an array 
	        	'id' => $this->id,
	        	'basic_info' => $this->basic_info->json_encode(false),
	        	'object_type' => $this->object_type,
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
			$this->id = $data['id'];
		}
	}

?>	