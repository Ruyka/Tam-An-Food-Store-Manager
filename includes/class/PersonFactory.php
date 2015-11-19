<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Person.php");
	require_once(CLASS_PATH . "Customer.php");
	require_once(CLASS_PATH . "Employee.php");
	require_once(CLASS_PATH . "Provider.php");
	
	class PersonFactory(){
		const PERSON = "Person";
		const CUSTOMER = "Customer";
		const EMPLOYEE = "Employee";
		const PROVIDER = "Provider";

		static public function create_person($person){
			if (strcmp($person, self::PERSON) == 0)
				return new Person();
			
			else if (strcmp($person, self::CUSTOMER) == 0)
				return new Customer();
			
			else if (strcmp($person, self::EMPLOYEE) == 0)
				return new Employee();
			
			else if (strcmp($person, self::PROVIDER) == 0)
				return new Provider();
		}
	}


?>