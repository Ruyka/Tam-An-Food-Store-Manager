<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "ProductFactory.php");
	require_once(CLASS_PATH . "Customer.php");
	require_once(CLASS_PATH . "Employee.php");
	
	///store the Receipt of customer and provider
	//Receipt of customer when they buy sth
	//Receipt of provider when the owner of the store receive supplyment from providers
	class Receipt{
		//list of products in the receipt
		// it is Sold Product if the customer buy sth
		// it is Import Product if the owner imports from providers
		private $list_product;

		//each receipt will has a unique id
		private $receipt_id;

		//time of the receipt has been mad
		private $time;

		//The Info of the Employee who receives the Receipt
		private $receiver;

		//The Info of the Customer or the Provider 
		private $clients;

		//constructer
		//Default value: receipt id = 1
						//time = ""
						//receiver and clients are NULL
		public function __construct($receipt_id = -1, $time = "", $receiver = NULL, $clients = NULL){
			$this->receipt_id = $receipt_id;
			$this->time = $time;

			//if receiver is NULL then create an empty receiver
			if (is_null($receiver))
				$this->receiver = new Employee();
			else	
				$this->receiver = $receiver;
			
			//if clients is null then create an empty clients
			if (is_null($clients))
				$this->clients = new Customer();
			else 
				$this->clients = $clients;
		}

		//Method:
		//add one or list of product to Receipt
		public function add($list_of_product){
			
			//check if list of product != NULL
			if (isset($list_of_product)){
				
				//if list_product = NULL, init it with an empty array
				if (!isset($this->list_product)){
					$this->list_product = array();
				}
				// if list of product has many value
				if (is_array($list_of_product)){
					//add value to the end of array list_product
					foreach ($list_of_product as $value){
						$this->list_product[] = $value;
					
					} 
				}
				//in case just 1 value at once
				else
					$this->list_product[] = $list_of_product;
	    			
    		}	
		}

		//convert data of Receipt to HTML to display
		public function convert_to_HTML(){

		}

		//calculate the price of the receipt by adding up all the price of product
		public function calc_price(){
			//check if list_product is NULL or not
			if (!isset($this->list_product)){
				//if NULL, return price 0
				return 0;
			}
			else{
				//set total price to 0
				$price = 0;
				//for every product, add its price to total price
				foreach ($this->list_product as $value) 
	    			$price += $value->calc_price();
	    		return $price;
			}
		}
		
		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){


			// basic elements of the product must have
			 
			$json = array(
				
		        'receipt_id' => $this->receipt_id,
		        'time' => $this->time,
		        // json_encode parameter = false, return object not encode with json
		        'receiver' => $this->receiver->json_encode(false),	
		        'clients'  => $this->clients->json_encode(false),	
	    	);
	    	
	    	//for each productm add and value that are encoding to array data
			$i = 0;
			foreach ($this->list_product as $value) {
				
				$json['list_product']["$i"] = $value->json_encode(false);
				++$i;
				
	    	}

	    	// json_encode parameter = false, return object not encode with json
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
			// a right Basic info array must have 5 properties
			// name, total_number, unit, trademark, dated
			if ( isset($data['name']) && isset($data['total_number']) && isset($data['unit']) 
					&& isset($data['trademark']) && isset($data['dated']) ){
				
				$this->get_data($data);
			}
		}

		// get data from array
		private function get_data($data){
			// get id
			$this->receipt_id = $data['receipt_id'];
			
			//get the time of receipt
			$this->time = $data['time'];
			
			// get clients data
			$this->clients->get_data_from_array($data['clients']);
			
			//get receiver data
			$this->receiver->get_data_from_array($data['receiver']);
			
			//get list of product 
			$list_data_product = $data['list_product'];
			// for each value in data list product, push into the list product
			foreach ($list_data_product as $value) {
				
				//get the product factory to get the right product object type
				$product = ProductFactory::create_product($value['object_type']);
				//get data from value array
				$product->get_data_from_array($value);
				//add product to list_product
				$this->add($product);
	    	}
		} 
	}

	
	//SAMPLE CODE TO TEST, READ FOR FUN lol :V

     // $tmp = new SoldProduct(113);
     // $tmp->addAttribute("Sữa",100,new Unit("hộp",10000), 
     // 		new Trademark(
     // 			new BasicInfo("Hồ Hữu Phát","hhphat@apcs.vn","0906332121","4 ABCD")
     // 			,"Việt Nam","google.com.vn"
     // 		)
     // 		,"17/11/2015");

     // $BasicInfo = new BasicInfo("Kim Nhật Thành","knthanh@apcs.vn","0923232121","4 ABCD");

     // $receipt = new Receipt(1,1,new Employee($BasicInfo,10000,1,"1313131"), new Customer($BasicInfo));
    
     // $receipt->add($tmp);
     // $receipt->add($tmp);
     // $receipt2 = new Receipt();
     // $receipt2->get_data_from_json($receipt->json_encode());
     // TEST($receipt2->json_encode(false));
?>
