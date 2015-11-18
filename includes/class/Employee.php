<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	//this class conatin information about Employee
	class Employee{

		//Properties:
		//basic infomation of employee
		private $basic_info;
		// role id indicates the role of employee in the company
		private $role_id;
		// the unique number of each person in VietNam country
		private $CMND;
		// salary in Vietnamese currency
		private $salary;
		

		//Constructor
		public function __construct($basic_info = NULL, $salary = 0, $role_id = 1, $CMND = ""){
			// if basic info not created yet, new it
 			if (is_null($basic_info))
 				$this->basic_info = new BasicInfo();
			else
				$this->basic_info = $basic_info;

			$this->salary = $salary;
			$this->role_id = $role_id;
			$this->CMND = $CMND;
		}
		public function convert_to_HTML(){
            //dummy code, for testing
			return $this->basic_info->convert_to_HTML() . $this->role_id . $this->CMND . $this->salary ;
		}


		//Method:
		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			
			//properties of TradeMark instance
			$json = array(
				//basic_info is an Object BasicInfo, so we must encode it to an array 
	        	'basic_info' => $this->basic_info->json_encode(false),
	        	'role_id' => $this->role_id,
	        	'CMND' => $this->CMND,
	        	'salary' =>	$this->salary,
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
 				$this->get_data($data);
 			}
		} 

		//get data from an array data 
		public function get_data_from_array($data){
			// a right Basic info array must have  property basic info role if salary and CMND
			if ( isset($data['basic_info']) && isset($data['role_id']) && isset($data['salary']) && isset($data['CMND'])){
 				$this->get_data($data);
			}
		} 

		//get data
		private function get_data($data){
			$this->basic_info->get_data_from_array($data['basic_info']);
			$this->role_id = $data['role_id'];
			$this->salary = $data['salary'];
			$this->CMND = $data['CMND'];
		}
	}
    
?>