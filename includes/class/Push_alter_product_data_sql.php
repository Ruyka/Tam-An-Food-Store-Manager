<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."Receipt.php");
	require_once(CLASS_PATH."SQLBuilder.php");
	require_once(CLASS_PATH."SQLLexical.php");


	// update an existing rows
	// UPDATE tam_an.product
	// SET Name = '...', Bought = '...', Price = '...', Unit = '...'
	// WHERE ID = ...;
	// UPDATE ....
	
	class Push_alter_product_data_sql extends SQL{
		
		public function execute($db){
			if (is_null($this->sql_query)){	
				$this->sql_query = $this->build_director();
			}
			return mysqli_multi_query($db, $this->sql_query);
		}

		public function build_director(){
			//get data from SQL
			$data = $this->get_data();

			$input = SQLLexical::make_product_list($data['list_product']);
			//use sql builder
			$sql_builder = new SQLBuilder();
			
			$id_array = array("Name", "Bought", "Price", "Unit");

			foreach ($input as $key => $value) {
				$sql_builder->update('tam_an.product')
					 		->set($id_array, $value)
					 		->where()
					 		->equals('ID',$key)
					 		->end_query();
			}

			return $sql_builder->to_string();
		}

	}

?>