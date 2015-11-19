<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."AllClass.php");
	
	//convert input into HTML View to Display for user
	
	class View{
		static $view = NULL;
		private function __construct(){}
		
		public static function get_view(){
			if (is_null(View::$view))
				View::$view = new View();
			return View::$view;
		}
		public function list_product_to_json_data($data){
			$receipt = new Receipt();
			foreach ($data as $value) {
				$product = new Product();
				$product->add_attribute($value['Name'],$value['Remain'],new Unit($value['UnitName'],$value['Price']));
				$receipt->add($product);
			}	

			return $receipt->json_encode();
		}
		public function list_user_name_to_json_data($data){
			$list_user_name = array();
			foreach ($data as $value) {
				
				$e = new Employee(new BasicInfo($data["Name"]));
				$list_user_name[] = $e;
			}
		}
	}
	
	// $view =  View::get_view();
	// $tmp = new Database();
	// $tmp->connect();
	// $list_product_info = $tmp->get_list_of_product_info();
	// TEST(json_decode($view->list_product_to_json_data($list_product_info),true);

?>