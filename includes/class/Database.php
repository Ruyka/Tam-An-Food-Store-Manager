<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(VIEW_PATH."head.php");
	class Database{
		// this infomation can be found in config file
		const DB_SERVER = SERVER;
		const DB_USER = USERNAME;
        const DB_PASSWORD = PASSWORD;
	   	const DB_NAME = DBNAME;
		private $db = NULL;
		//connect to database
		public function connect(){
			//connect to SQl
			$this->db = mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD)
            or die("Couldn't connect to SQL Server") ;
			
            
            
            //if can connect to SQL, connect to Database 
			if($this->db){
				mysqli_select_db($this->db, self::DB_NAME);
            }
		}
		//check database connectivity
		public function is_connect(){
			return !is_null($this->db);
		}

		public function get_list_of_product_info(){
            
            $sql = mysqli_query($this->db,"SELECT * FROM Product");
    					
            if($sql && mysqli_num_rows($sql)!=0){    
                $result = array();
				while($rlt = mysqli_fetch_array($sql,MYSQL_ASSOC)){
					$result[] = $rlt;
				}          
            }
            return $result;
		}

		public function get_list_of_user_name(){
			mysqli_query($this->db, "SET character_set_results = 'utf16', character_set_client = 'utf16', 
            character_set_connection = 'utf16', character_set_database = 'utf16', character_set_server = 'utf16'");
            $sql = mysqli_query($this->db,"SELECT * FROM Employee");
    				
            if($sql && mysqli_num_rows($sql)!=0){    
                $result = array();
				while($rlt = mysqli_fetch_array($sql,MYSQL_ASSOC)){
					$result[] = $rlt;
				}          
            }
            return $result;
		}
	}
    $tmp = new Database;
    $tmp->connect();
    
    print_r($tmp->get_list_of_user_name());
    
    
 

?>