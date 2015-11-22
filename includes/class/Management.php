<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	
	//use this class to control data frrom server
	class Management{
		
		public function __construct(){
			//$server = new Server;

		}
		public function look_up( $from, $to) {

		} 
		public function edit ( $old_product, $new_product){

		}
		public function add_receipt( $receipt){

		}

		//send the message to server to get the list of product info
		//return array type
		public function get_list_of_product_info(){
			return $this->get_response_from_message("get list of product info");
		}
		
		//send message to server to get the list of user name
		//return array type
		public function get_list_of_user_name(){
			return $this->get_response_from_message("get list of user name");
		}
		//send message to server and get response
		private function get_response_from_message($message, $is_get_response = true, $json_data = NULL){
			//set the url of the server we need to request
			$url = 'http://localhost/Tam-An-Food-Store-Manager/includes/class/Server.php';
			
			//put request into data
			$data = array();
			$data['request'] = $message;
			
			//if there is the data that need to be push in server, push it in
			if (!is_null($json_data)) 
				$data['data'] = $json_data;
			
			$options = array(
			  'http' => array(
			    'method'  => 'POST',
			    'content' => json_encode( $data ),
			    'header'=>  "Content-Type: application/json\r\n" .
			                "Accept: application/json\r\n".
			                "Connection: close\r\n"
			    )
			);

			$context  = stream_context_create( $options );
			$result = file_get_contents( $url, false, $context );
			
			//if we need to get respone from server, return respone after get it
			if ($is_get_response){
				$response = json_decode( $result,true );
				return $response;
			}

		}

	}
	//test code
	 // $tmp = new Management();
	 // TEST($tmp->get_list_of_product_info());
?>