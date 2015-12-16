<?php
	
	class Package{
		private $message;
		private $data;

		//method
		//constructor
		public function __construct($message="", $data = NULL){
			$this->message = $message;
			$this->data = $data;
		}

		
		//get message of the package
		public function get_message(){
			return $this->message;
		}


		//get data of the package
		public function get_data(){
			return $this->data;
		}
	}

?>