<?php
	require_once($_SERVER["DOCUMENT_ROOT" . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Rest.inc.php");
	require_once(CLASS_PATH."Database.php");
	require_once(CLASS_PATH."HTML_View.php");
	class Server extends REST{
		private $db;
		
		public function __construct(){
				// Init parent contructor
				parent::__construct();				
				// obtain a new database Object to control database
				$this->db = new Database();
				// Initiate Database connection
				$this->db->connect();
		}
			
		/*
		 * Public method for access server.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function process(){
			//change value in $_REQUEST['request'] into lower case
			$func = strtolower(trim(str_replace("/","",$_REQUEST['request'])));
			//replace 'space' with '_'
			$func = str_replace(" ","_", $func);

			//if the method exist, call it
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);				
				// If the method not exist with in this class, response would be "Page not found".
		}

		//call the server directly to access database for init
		public function send_message($message){
			//change value in message into lower case
			$func = strtolower(trim(str_replace("/","",$message)));
			//replace 'space' with '_'
			$func = str_replace(" ","_", $func);

			//if the method exist, call it
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);				
				// If the method not exist with in this class, response would be "Page not found".
		}

		//get the list of product info (name, unit)
		private function get_list_of_product_info(){
			//access to database db, call function to query list of product info
			$list_product_info = $this->db->get_list_of_product_info();
			
			//call HTML_View to convert the list into HTML code
			$data = HTML_View::list_product_to_HTML_selection($list_product_info);
			
			//response with the data encode with json, status 200 = OK
			$this->response($this->json($data), 200);
		}

		//get list of user name
		public function get_list_of_user_name(){
			//access to database db, call function to query list of product info
			$list_of_user_name = $this->db->get_list_of_user_name();

			//call HTML_View to convert the list into HTML code
			$data = HTML_View::list_user_name_to_HTML_selection($list_of_user_name);
			
			//response with the data encode with json, status 200 = OK
			$this->response($this->json($data), 200);
		}
		
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
?>