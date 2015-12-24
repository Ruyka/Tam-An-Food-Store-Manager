<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."SQLLexical.php");
	require_once(CLASS_PATH."SQLBuilder.php");

	class Push_new_product_data_sql extends SQL{
		
		// add new product 
		// INSERT INTO tam_an.product VALUES
		// (Name, Bought, Price, Unit),
		// ...
		// (Name, Bought, Price, Unit);
		
		public function build_director(){
			$sql_builder = new SQLBuilder();
			
			$data = $this->get_data();

			$input = SQLLexical::make_product_list($data['list_product']);
		            	
			return $sql_builder->sql_insert('tam_an.product',array('Name','Bought','Price', 'Unit'))
							->sql_insert_values_recursive($input)
							->end_query()
							->to_string();
		}

	}
?>

