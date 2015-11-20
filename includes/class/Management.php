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
		public function get_list_of_product_info(){
			return $this->get_response_from_message("get list of product info");
		}
		
		//send message to server to get the list of user name
		public function get_list_of_user_name(){
			return $this->get_response_from_message("get list of user name");
		}
		//send message to server and get response
		private function get_response_from_message($message){
			$url = 'http://localhost/Tam-An-Food-Store-Manager/includes/class/Server.php';
			$data = array('request' => $message);
			
			$options = array(
			  'http' => array(
			    'method'  => 'POST',
			    'content' => json_encode( $data ),
			    'header'=>  "Content-Type: application/json\r\n" .
			                "Accept: application/json\r\n"
			    )
			);

			$context  = stream_context_create( $options );
			$result = file_get_contents( $url, false, $context );

			$response = json_decode( $result,true );

			return $response;

		}
	}
	//test code
	 // $tmp = new Management();
	 // TEST($tmp->get_list_of_product_info());
?>