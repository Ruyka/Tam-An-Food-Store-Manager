<?php
	//this class store infomation about the Unit of product

	class Unit{

		//Properties:
		//unit name of the product
		private $unit_name;
		//price of per unit of product, in Vietnam currency
		private $price;

		//Constructor:
		//constructor allow to create a Unit with name and price
		//Default parameter, Unit_name = "" , price = 0
		public function __construct($unit_name = "", $price = 0){
			$this->unit_name = $unit_name;
			$this->price = $price;
		}


		//Method
		//method to get name of the Unit
		public function get_name(){
			return $this->unit_name;
		}
		
		//method to get price of the Unit
		public function get_price(){
			return $this->price;
		}


		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			//2 properties of Unit intance
			$json = array(
	        	'unit_name' => $this->unit_name,
	        	'price' => $this->price
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
 				$this->unit_name = $data['unit_name'];
				$this->price = $data['price'];
 			}
		}
		
		//get data from array_data
		public function get_data_from_array($data){
			// a right Basic info array must have 2 properties unit_name and price
			if ( isset($data['unit_name']) && isset($data['price']) ){
 				$this->unit_name = $data['unit_name'];
				$this->price = $data['price'];
			}
		} 

	}
    
?>