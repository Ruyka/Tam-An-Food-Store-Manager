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

		public function check_username_existed($data){
			$user_info = array('username' => $data);
			return $this->get_response_from_message("check username existed", true, json_encode($user_info));
		}

		// signup an account push data to database
		public function sign_up($data){
			return $this->get_response_from_message("sign up",true, json_encode($data));
		}

		public function add_receipt( $receipt){
			$this->get_response_from_message("add receipt", false, $receipt->json_encode(true));
		}

		//check user login info with server
		public function check_user_login($username, $password){
			$user_info = array();
			$user_info['username'] = $username;
			$user_info['password'] = $password;
			return $this->get_response_from_message("check user login",true, json_encode($user_info));
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
			$url = CONFIG_PATH('class'). 'Server.php';
			
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
	
	//test product receipt...
	
	// $tmp = new SoldProduct(113);
 //     $tmp->add_attribute("Sữa",100,new Unit("hộp",10000), 
 //     		new Trademark(
 //     			new BasicInfo("Hồ Hữu Phát","hhphat@apcs.vn","0906332121","4 ABCD")
 //     			,"Việt Nam","google.com.vn"
 //     		)
 //     		,"17/11/2015");

 //     $BasicInfo = new BasicInfo("Kim Nhật Thành","knthanh@apcs.vn","0923232121","4 ABCD");

 //     $receipt = new Receipt(1,1,new Employee($BasicInfo,10000,1,"1313131"), new Customer($BasicInfo));
	
 //     $receipt->add($tmp);
 //     $receipt->add($tmp);
	
 //     $m->add_receipt($receipt);
     
	 
?>