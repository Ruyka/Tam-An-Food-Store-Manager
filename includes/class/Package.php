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

		//get data from an array 
		public function get_data_from($package, $is_json_data = false){
			$this->message = $package['message'];
			// if the data is in json form then decode it 
			if ( $is_json_data && !is_null($package['data']) ){
				$this->data = json_decode($package['data'],true);
			}
			else{
				$this->data = $package['data'];
			}
		}
		//encode to json data
		public function json_encode(){
			$data = array();
			$data['message'] = $this->message;
			$data['data'] = $this->data;
			return json_encode($data);
		}
	}

?>