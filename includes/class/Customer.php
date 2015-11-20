<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Person.php");
	//this class conatin information about customer
	class Customer extends Person{
		
		//Constructor
		// constructor receive basic info object
		/// dafault value of basic_info will be NULL
		public function __construct($basic_info = NULL){
 			parent::__construct($basic_info);
 			$this->object_type = "Customer";
		}
		

		//Method:
		//convert to HTML for publication
		public function convert_to_HTML(){
			//dummy code for testing
			return $this->basic_info->convert_to_HTML();
		}

		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){
			//call parent to encode the basic info part
			$json = parent::json_encode(false);
	        $json['object_type'] = $this->object_type;

    		// code = true, return json encode, else just return object data encode as an array
			if ($code)
    			return json_encode($json);
    		else 
    			return $json;
		
		}
		
	}

	//test code
    // $basic = new BasicInfo("Trịnh Hoàng Triều","0903302234","thtrieu@apcs.vn","asdsadsad");
    // $e = new Customer($basic);
    // TEST($e->json_encode(false));
    // $ee = new Customer();
    // $ee->get_data_from_json($e->json_encode());
    // TEST($ee->json_encode(false));
?>