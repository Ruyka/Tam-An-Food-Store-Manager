<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."AllClass.php");
	
	//convert input get from Database into Class Object 
	// then convert it into View { json Format} to transfer for user
	
	class View{
		//unique view
		static $view = NULL;
		//private constructor
		private function __construct(){}
		//get object view
		public static function get_view(){
			// if do not have any object view, create one
			if (is_null(View::$view))
				View::$view = new View();
			//return view
			return View::$view;
		}

		// convert list of product get from database into object
		//return: array of Product
		public function list_product_to_json_data($data){
			//new a new receipt
			//basically, a Reiceipt is a list of product...
			$receipt = new Receipt();
			foreach ($data as $value) {
				//new Product
				$product = new Product();
				// add attribute to it
				$product->add_attribute($value['Name'],1000,new Unit($value['UnitName'],$value['Price']),$value['Id'],$value['ProductId']);
				//add the product to the receipt
				$receipt->add($product);
			}	
			// return the receipt in json format
			return $receipt->json_encode();
		}
		
		//this function create a list of user name
		//return: array of user Name
		public function list_user_name_to_json_data($data){
			$list_user_name = array();
			foreach ($data as $value) {
				$list_user_name[] = $value['Name'];
			}
			return json_encode($list_user_name);
		}
	}
	
	// $view =  View::get_view();
	// $tmp = new Database();
	// $tmp->connect();
	// $list_product_info = $tmp->get_list_of_product_info();
	// TEST(json_decode($view->list_product_to_json_data($list_product_info),true);
?>