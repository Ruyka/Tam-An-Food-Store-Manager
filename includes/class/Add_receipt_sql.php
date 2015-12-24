<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."Receipt.php");
	require_once(CLASS_PATH."SQLBuilder.php");

	class Add_receipt_sql extends SQL{
		
		public function build_director(){
			$sql_builder = new SQLBuilder();
			
			$data = $this->get_data();

			return $sql_builder->select(array(SQLBuilder::sql_as('ID','Id'), 'Name', 'User_type'))
					->from('tam_an.user')
					->where()
					->and_recursive('LIKE',array('Username', 'Password'), array($data['username'], $data['password']))
					->to_string();
		}

	}
?>