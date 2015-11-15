<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	
	class Database{
		// this infomation can be found in config file
		const DB_SERVER = HOST;
		const DB_USER = USERNAME;
        const DB_PASSWORD = PASSWORD;
	   	const DB_NAME = DBNAME;
		private $db = NULL;
		//connect to database
		public function connect(){
			//connect to SQl
			$this->db = mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD);
			//if can connect to SQL, connect to Database 
			if($this->db)
				mysqli_select_db($this->db, self::DB);
		}
		//check database connectivity
		public function is_connect(){
			return !is_null($this->db);
		}

		public function get_list_of_product_info(){

		}

		public function get_list_of_user_name(){
			
		}
	}



?>