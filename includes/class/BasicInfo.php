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
		//constructor
		public function __construct($name, $email, $phone, $address){
			$this->name = $name;
			$this->email = $email;
			$this->phone = $phone;
			$this->address = $address;			
		}
		//convert to HTML format to display
		public function convert_to_HTML(){

		}
		//get the name
		public function get_name(){
			return $this->name;
		}
	}

?>