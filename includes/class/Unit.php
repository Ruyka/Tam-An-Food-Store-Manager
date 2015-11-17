<?php
	//this class store infomation about the Unit of product

	class Unit{
		//unit name of the product
		private $unit_name;
		//price of per unit of product, in Vietnam currency
		private $price;
		
		//constructor allow to create a Unit with name and price
		public function __construct($unit_name, $price){
			$this->unit_name = $unit_name;
			$this->price = $price;
		}

		//method to get name of the Unit
		public function get_name(){
			return $this->unit_name;
		}
		
		//methdo to get price of the Unit
		public function get_price(){
			return $this->price;
		}

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			//2 properties of Unit intance
			$json = array(
	        	'unit_name' => $this->unit_name,
	        	'price' => $this->price,
    		);

    		// code = true, return json encode, else just return object data encode as an array
    		if ($code)
    			return json_encode($json);
    		else
    			return $json;
		}

	}
    
?>