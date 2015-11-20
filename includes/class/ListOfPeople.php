<?php

	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "PersonFactory.php");

	class ListOfPeople{
		//properties
		private $list_of_people;

		//constructor
		public function __construct(){
			$this->list_of_people = array();
		}

		//method:
		//add a or many Person to the list
		public function add($person){
			//if there are many people, add them all
			if (is_array($person)){
				foreach ($person as $value) {
					$this->list_of_people[] = $value;		
				}
			}
			else
				//has only one person
				$this->list_of_people[] = $person;

		}

		//convert to HTML for publication
		public function convert_to_HTML(){
			
		}

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			$json = array();
			//for each element in listOfPeople
			// add data of that element to json key
			foreach ($this->list_of_people as $key => $value) {
				$json[$key] = $value->json_encode(false);	
			}
			
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
 			$this->get_data($data);
		} 
		private function get_data($data){
			foreach ($data as $key => $value) {
				$person = PersonFactory::create_person($value['object_type']);
				$person->get_data_from_array($value);
				$this->add($person);
			}
		}
	}

	//Test code
	// $basic = new BasicInfo("Trịnh Hoàng Triều","0903302234","thtrieu@apcs.vn","asdsadsad");
 //    $e = new Customer($basic);
    
 //    $l = new ListOfPeople();
 //    $l->add($e);
 //    $e2 = new Employee($basic,10000,10,"21321424");
 //    $l->add($e2);
 //    $l2 = new ListOfPeople();
 //    $l2->get_data_from_json($l->json_encode());
 //    TEST($l->json_encode(false));
 //    TEST($l2->json_encode(false));
?>