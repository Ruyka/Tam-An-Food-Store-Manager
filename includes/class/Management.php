<?
	require_once($_SERVER["DOCUMENT_ROOT" . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH .'Server.php');
	//use this class to control data frrom server
	class Management{
		
		private $server;
		
		public function __construct(){
			$server = new Server;

		}
		public function look_up( $from, $to) {

		} 
		public function edit ( $old_product, $new_product){

		}
		public function add_receipt( $receipt){

		}

		//send the message to server to get the list of product info
		public function get_list_of_product_info(){
			$this->server->send_message("get list of product info");
			return decode_data();
		}
		
		//send message to server to get the list of user name
		public function get_list_of_user_name(){
			$this->server->send_message("get list of user name");
			return decode_data();	
		}
		
		//decode data by json
		private function decode_data(){
			//get data from server
			$data = $this->server->get_data();
			//decode json
			$html_code = json_decode($data, true);
			//return the data
			return $html_code;
		}
	}


?>