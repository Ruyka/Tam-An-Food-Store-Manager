<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
	require_once(CLASS_PATH . "Product.php");

	class SoldProduct extends Product{
		//Properties:
		//number of product need to be sold
		private $number;

		//Method:
		// calculate the price of the number of product
		//price = number * product price
		public function calc_price(){
			return $this->number * $this->get_price();
		}
        // constructor whith the number of product to be sold
        public function __construct($number = 0){
        	//call constructor of parent to init value
        	parent::__construct();
            $this->number = $number;
            $this->object_type = "SoldProduct";
        }
        //convert to HTML to display 
        public function convert_to_HTML(){
            
        }

        // convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			// 2 basic properties of the sold product must have
	    	$json = parent::json_encode(false);
	    	$json['number'] = $this->number;
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
 			//get number to this instance property
			$this->number = $data['number'];
			$this->object_type= $data['object_type'];
		} 
	}
	 // $basic_info = new BasicInfo("aaaa","bbbb","cccc","ddddd");
  //    $tmp2 = new TradeMark($basic_info,"Viet Name", "google.com.vn");
  //    $product = new SoldProduct(10);
  //    $product->add_attribute("Sữa bò", "100", new Unit("hộp", 15000), $tmp2, "19/1/1995");
  //    print_r(json_decode($product->json_encode(),true));
  //    TEST("");	
  //    $product2 = new SoldProduct();
  //    $product2->get_data_from_json($product->json_encode());
  //    print_r(json_decode($product2->json_encode(),true));
	
?>