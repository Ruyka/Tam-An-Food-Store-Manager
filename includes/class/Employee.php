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
			return $this->basic_info->convert_to_HTML();
		}
	}

?>