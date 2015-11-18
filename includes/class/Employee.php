<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	//this class conatin information about Employee
	class Employee{
		//basic infomation of employee
		private $basic_info;
		// role id indicates the role of employee in the company
		private $role_id;
		// the unique number of each person in VietNam country
		private $CMND;
		// salary in Vietnamese currency
		private $salary;
		public function __construct($basic_info, $salary, $role_id, $CMND){
			$this->basic_info = $basic_info;
			$this->salary = $salary;
			$this->role_id = $role_id;
			$this->CMND = $CMND;
		}
		public function convert_to_HTML(){
            //dummy code, for testing
			return $this->basic_info->convert_to_HTML() . $this->role_id . $this->CMND . $this->salary ;
		}

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
	}
    
?>