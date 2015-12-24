<?php
	
	//this class store the infomation of Features 	
	class Feature{	
		
		const CHECK_USERNAME_EXISTED = "check_username_existed";
		const CHECK_USER_LOGIN = "check_user_login";
		const ADD_RECEIPT = "add_receipt";
		const REMOVE_PRODUCT = "remove_product";
		const PUSH_ALTER_PRODUCT_DATA = "push_alter_product_data";
		const PUSH_NEW_PRODUCT_DATA = "push_new_product_data";
		const GET_LIST_OF_PRODUCT_INFO = "get_list_of_product_info";
		
		//do not need to create this object
		private function __construct(){}

		//if the string is Feature::CHECK_USER_LOGIN -> true
		public static function is_check_user_login( $str ){
			return ($str === self::CHECK_USER_LOGIN);
		}


		//if the string is Feature::ADD_RECEIPT-> true
		public static function is_add_receipt( $str ){
			return ($str === self::ADD_RECEIPT);
		}


		//if the string is Feature::REMOVE_PRODUCT -> true
		public static function is_remove_product( $str ){
			return ($str === self::REMOVE_PRODUCT);
		}


		//if the string is Feature::PUSH_ALTER_PRODUCT_DATA -> true
		public static function is_push_alter_product_data( $str ){
			return ($str === self::PUSH_ALTER_PRODUCT_DATA);
		}


		//if the string is Feature::PUSH_NEW_PRODUCT_DATA -> true
		public static function is_push_new_product_data( $str ){
			return ($str === self::PUSH_NEW_PRODUCT_DATA);
		}


		//if the string is Feature::GET_LIST_OF_PRODUCT_INFO -> true
		public static function is_get_list_of_product_info( $str){
			return ($str === self::GET_LIST_OF_PRODUCT_INFO);
		}
	}

	//test
	//echo Feature::is_add_receipt(Feature::ADD_RECEIPT);
	// if (Feature::is_add_receipt(Feature::GET_LIST_OF_PRODUCT_INFO))
	// 	echo "aaa";
	// else echo "bbb";
?>