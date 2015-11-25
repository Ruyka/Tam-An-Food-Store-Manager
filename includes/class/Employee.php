<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Person.php");
	//this class conatin information about Employee
	class Employee extends Person{

		//Properties:
		//employee id
		private $employee_id;
		// role id indicates the role of employee in the company
		private $role_id;
		// the unique number of each person in VietNam country
		private $CMND;
		// salary in Vietnamese currency
		private $salary;

		//Constructor
		public function __construct($employee_id="",$basic_info = NULL, $salary = 0, $role_id = 1, $CMND = ""){
			//call parent to construct
			parent::__construct($basic_info);
			$this->salary = $salary;
			$this->role_id = $role_id;
			$this->CMND = $CMND;
			$this->employee_id = $employee_id;
			$this->object_type = "Employee";
		}
		public function convert_to_HTML(){
            
		}


		//Method:
		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			
			//call parent to encode the basic info part
			$json = parent::json_encode(false);
			
			//add properties to json
	        $json['employee_id'] = $this->employee_id;
	        $json['role_id'] = $this->role_id;
	        $json['CMND'] = $this->CMND;
	        $json['salary'] = $this->salary;
    		
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
			//get baisc info to Employee
			parent::get_data_from_array($data);
			$this->employee_id = $data['employee_id'];
			$this->role_id = $data['role_id'];
			$this->salary = $data['salary'];
			$this->CMND = $data['CMND'];
		}
	}
    

    //test code
    // $basic = new BasicInfo("Trịnh Hoàng Triều","0903302234","thtrieu@apcs.vn","asdsadsad");
    // $e = new Employee("3D1SSA13",$basic,10000,1,"131313");
    // TEST($e->json_encode(false));
    // $ee = new Employee();
    // $ee->get_data_from_json($e->json_encode());
    //  TEST($ee->json_encode(false));
?>