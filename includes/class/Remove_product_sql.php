<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."ProductFactory.php");
	require_once(CLASS_PATH."SQLBuilder.php");


	// delete an existing rows
	// DELETE FROM tam_an.product
	// WHERE ID IN (...)

	class Remove_product_sql extends SQL{
		
		public function build_director(){
			$sql_builder = new SQLBuilder();
			
			$data = $this->get_data();

			return $sql_builder->sql_delete()
					->from("tam_an.product")->where()
					->in('ID', $data)
					->to_string();
		}

	}
?>