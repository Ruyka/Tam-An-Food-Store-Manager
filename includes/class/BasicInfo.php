<?php
	//contain name email phone address
	class BasicInfo{
		//name of the object
		private $name;
		//phone number of the object lol
		private $phone;
		// email 
		private $email;
		//address
		private $address;
		//constructor with default value is empty string

		public function __construct($name = "", $email = "", $phone = "", $address = ""){
			$this->name = $name;
			$this->email = $email;
			$this->phone = $phone;
			$this->address = $address;			
		}
		
		//convert to HTML format to display
		public function convert_to_HTML(){
		  //dummy code for testing
            return $this->name . $this->email .$this->phone . $this->address;
		}
		
		//get the name
		public function get_name(){
			return $this->name;
		}
		
		// convert object to json format
		// code = true, return json encode, else just return object data encode as an array
		public function json_encode($code = true){

			//basic properties of Basic Info instance
			$json = array(
	        	'name' => $this->name,
	        	'phone' => $this->phone,
	        	'email' => $this->email,
	        	'address' => $this->address,
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
 				$this->name = $data['name'];
				$this->email = $data['email'];
				$this->phone = $data['phone'];
				$this->address = $data['address'];
 			}
		}
		
		//get data from array_data
		public function get_data_from_array($data){
			// a right Basic info array must have 4 properties name, email, phone and address
			if ( isset($data['name']) && isset($data['email']) && isset($data['phone']) && isset($data['address']){
 				$this->name = $data['name'];
				$this->email = $data['email'];
				$this->phone = $data['phone'];
				$this->address = $data['address'];
			}
		}   
	}
    


?>