<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Product.php");
	class ImportProduct extends Product{
		private $import_price;

		// constructor whith the import_price of product to be sold
        public function __construct($import_price){
        	//call constructor of parent to init value
        	parent::__construct();
            $this->import_price = $import_price;
            $this->object_type = "ImportProduct";
        }
        

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			// 2 basic properties of the sold product must have
	    	$json = parent::json_encode(false);
	    	$json['import_price'] = $this->import_price;
	    	$json['object_type'] = $this->object_type;
 	    	// code = true, return json encode, else just return object data encode as an array
	    	if ($code)
	    		return json_encode($json);
	    	else
	    		return $json;
		}

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
		
 				$this->get_data($data);
		}

		// get data from array
		private function get_data($data){
			//call previous parent, get the data from data[product] to its properties
 			parent::get_data_from_array($data);
 			//get import_price to this instance property
			$this->import_price = $data['import_price'];
			$this->object_type= $data['object_type'];
		} 
	}
?>