<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."Receipt.php");
	require_once(CLASS_PATH."SQLBuilder.php");

	// sql query to check if user exist
	// SELECT ID AS 'Id', Name
	// FROM tam_an.user
	// WHERE username LIKE $username AND password LIKE $password
	

	class Check_user_login_sql extends SQL{
		
		//Override
		public function execute($db){
			$sql_result = parent::execute($db);

			$result = NULL;

			if($sql_result && mysqli_num_rows($sql_result)!=0){
                $result = mysqli_fetch_array($sql_result, MYSQL_ASSOC);
			}

            $this->set_return_data($result);
		}


		//Override
		public function build_director(){
			$sql_builder = new SQLBuilder();
			
			$data = $this->get_data();

			return $sql_builder->select(array(SQLBuilder::sql_as('ID','Id'), 'Name', 'User_type'))
					->from('tam_an.user')
					->where()
					->and_recursive('LIKE',array('Username', 'Password')
						, array($data['username'], md5($data['password'])))
					->to_string();
		}

	}
	// $data = array();
	// $data['username'] = "aaaa";
	// $data['password'] = 'bbbb';
	// $test = new Check_user_login_sql($data);
	// TEST($test->build_director());
	// require_once(CLASS_PATH."Database.php");

	// TEST($test->execute());

?>