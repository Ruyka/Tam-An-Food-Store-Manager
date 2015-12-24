<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Feature.php");
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."Check_user_login_sql.php");
	require_once(CLASS_PATH."Get_list_of_product_info_sql.php");
	require_once(CLASS_PATH."Push_alter_product_data_sql.php");
	require_once(CLASS_PATH."Push_new_product_data_sql.php");
	require_once(CLASS_PATH."Remove_product_sql.php");
	require_once(CLASS_PATH."Add_receipt_sql.php");

	class SQLFactory{
		

		public function create_sql( $sql_type, $data) {
			if (Feature::is_check_user_login($sql_type)){
				return new Check_user_login_sql($data);
			}
			else if (Feature::is_add_receipt($sql_type)){
				return new Add_receipt_sql($data);
			}
			else if (Feature::is_remove_product($sql_type)){
				return new Remove_product_sql($data);
			}
			else if (Feature::is_push_alter_product_data($sql_type)){
				return new Push_alter_product_data_sql($data);
			}
			else if (Feature::is_push_new_product_data($sql_type)){
				return new Push_new_product_data_sql($data);
			}
			else if (Feature::is_get_list_of_product_info($sql_type)){
				return new Get_list_of_product_info_sql($data);
			}
		}

	}

	
?>