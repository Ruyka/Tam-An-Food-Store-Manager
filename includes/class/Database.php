
<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	 
	class Database{
		// this infomation can be found in config file
		//Properties
		const DB_SERVER = SERVER;
		const DB_USER = USERNAME;
        const DB_PASSWORD = PASSWORD;
	   	const DB_NAME = DBNAME;
		private $db = NULL;
		

		//Method
		//connect to database
		public function connect(){
			//connect to SQl
			$this->db = mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD)
            or die("Couldn't connect to SQL Server") ;
            
            //if can connect to SQL, connect to Database 
			if($this->db){
				$isConnect = mysqli_select_db($this->db, self::DB_NAME);
				if (!$isConnect){
					$this->create_default_database();
					mysqli_select_db($this->db, self::DB_NAME);
				}
				//set Vietnamese
				mysqli_query($this->db, "SET character_set_results = 'utf8', character_set_client = 'utf8', 
	    		character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
				
            }
		}

		private function create_default_database(){
			$filename = DATABASE_PATH . "tam_an.sql";
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;

				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
    				// Perform the query
					mysqli_query($this->db,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    				// Reset temp variable to empty
					$templine = '';
				}
			}
		}


		//check database connectivity
		public function is_connect(){
			return !is_null($this->db);
		}
		
		public function check_username_existed($user_data){
			$username = $user_data['username'];
			$sql = mysqli_query($this->db,"SELECT Id FROM employee WHERE username = '$username'");
    					
            if($sql && mysqli_num_rows($sql)!=0){
             	//if account exist             
                $result = mysqli_fetch_array($sql,MYSQL_ASSOC);
				
	            $result = array('message' => "existed");			
               
			}
			else
				$result = array('message' => "not existed"); 

			return $result;
		}
		//check if user login are validated
		public function check_user_login($user_data){
			$username = $user_data['username'];
			$password = $user_data['password'];

			$sql = mysqli_query($this->db,"CALL check_user_login('$username', '".md5($password)."');");
					
            if($sql && mysqli_num_rows($sql)!=0){
                $result = mysqli_fetch_array($sql,MYSQL_ASSOC);
                return $result;
			}
		}
		


		//add receipt to database
		public function add_receipt($receipt_data){
			TEST($receipt_data);
		}


		//sign up
		public function sign_up($user_data){

			$name = $user_data['name'];
			$username = $user_data['username'];
			$password = $user_data['password'];

			//check if the account exist or not
			$sql = mysqli_query($this->db,"SELECT Id FROM employee WHERE username = '$username'");
    					
            if($sql && mysqli_num_rows($sql)!=0){
             	//if account exist             
                $result = mysqli_fetch_array($sql,MYSQL_ASSOC);
				
	            $result = array('message' => "existed");			
               
			}
            else{
            	
                //account not exist, ready to add into the database
                $sql = mysqli_query($this->db,"INSERT INTO employee (Name, Username, Password) 
                					VALUES ('$name', '$username', '".md5($password)."')");
				
                if($sql != false){
                    $result = array('message' => 'Success');
                    
				}
			}
			return $result;
		}
		public function get_list_of_product_info(){
            
            $sql = mysqli_query($this->db,"CALL get_list_of_product_info();");
    					
            if($sql && mysqli_num_rows($sql)!=0){    
                $result = array();
				while($rlt = mysqli_fetch_array($sql,MYSQL_ASSOC)){
					
					$result[] = $rlt;
				}          
            }
            return $result;
		}

		public function get_list_of_user_name(){
			
            
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
	
?>