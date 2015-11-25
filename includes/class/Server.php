<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Rest.inc.php");
	require_once(CLASS_PATH."Database.php");
	require_once(CLASS_PATH."View.php");
	require_once(CLASS_PATH."ListOfPeople.php");
	class Server extends REST{
		//Properties
		private $db;
		private $view;


		//Constructor
		public function __construct(){
				// Init parent contructor
				parent::__construct();				
				// obtain a new database Object to control database
				$this->db = new Database();
				// Initiate Database connection
				$this->db->connect();
				
				//call View to convert the list into json code
				$this->view =  View::get_view();
		}
			
		
		//Method
		/*
		 * Public method for access server.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function process(){
			
			//if has a request from submit button, then capture it
			$client_data = NULL;

			if (isset($_REQUEST['request']))
				$input = $_REQUEST['request'];
			else{
				//else, get the json data from input
				$json_data = file_get_contents('php://input');
				//decode data into array
				$data = json_decode($json_data, true);
				// get request
				$input = $data['request'];
				// get data of clients if available
				if (isset($data['data']))
					$client_data = $data['data']; 

			}
				
			//change value in $input into lower case
			$func = strtolower(trim(str_replace("/","",$input)));
			//replace 'space' with '_'
			$func = str_replace(" ","_", $func);
			
			//if the method exist, call it
			if((int)method_exists($this,$func) > 0)
				$this->$func($client_data);
			else
				$this->response('',404);				
				// If the method not exist with in this class, response would be "Page not found".
		}
		//add receipt to database
		public function add_receipt($client_data = NULL){
			if (!is_null($client_data))
				$this->db->add_receipt($client_data->json_encode(false));
		}

		//get the list of product info (name, unit)
		private function get_list_of_product_info($client_data = NULL){
			//access to database db, call function to query list of product info
			$list_product_info = $this->db->get_list_of_product_info();
			
			//call method convert list product into json
			$json_data = $this->view->list_product_to_json_data($list_product_info);
	
			//response with the data encode with json, status 200 = OK
			$this->response($json_data, 200);
			
		}

		//get list of user name
		private function get_list_of_user_name($client_data = NULL){
			//access to database db, call function to query list of product info
			$list_of_user_name = $this->db->get_list_of_user_name();

			//call View to convert the list of user name to json data
			$json_data = $this->view->list_user_name_to_json_data($list_of_user_name);
			
			//response with the data encode with json, status 200 = OK
			$this->response($json_data, 200);
		}
		//just testing lol
		private function test(){
			$data = "Connected";
			$this->response($this->json($data), 200);
		}
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			return json_encode($data);
		}
	}

	$server = new Server();
	$server->process();
	 // $tmp = new SoldProduct(113);
  //    $tmp->add_attribute("Sữa",100,new Unit("hộp",10000), "SUA1111",
  //    		new Trademark("RH11221",
  //    			new BasicInfo("Hồ Hữu Phát","hhphat@apcs.vn","0906332121","4 ABCD")
  //    			,"Việt Nam","google.com.vn"
  //    		)
  //    		,"17/11/2015");

  //    $BasicInfo = new BasicInfo("Kim Nhật Thành","knthanh@apcs.vn","0923232121","4 ABCD");

  //    $receipt = new Receipt(1,1,new Employee("31313",$BasicInfo,10000,1,"1313131"), new Customer($BasicInfo));
	
  //    $receipt->add($tmp);
  //    $receipt->add($tmp);
  //    $server->add_receipt($receipt);
?>	