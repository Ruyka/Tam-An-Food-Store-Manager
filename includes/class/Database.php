
<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Receipt.php");
	require_once(CLASS_PATH."SQLBuilder.php");
	
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
				// if (!$isConnect){
				// 	$this->create_default_database();
				// 	mysqli_select_db($this->db, self::DB_NAME);
				// }
				if ($isConnect)
				//set Vietnamese
				mysqli_query($this->db, "SET character_set_results = 'utf8', character_set_client = 'utf8', 
	    		character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
				
            }
		}

		private function create_default_database(){
			$filename = DATABASE_PATH . "tam_an.sql";
			$host =self::DB_SERVER;
			$db = new PDO("mysql:host=$host;", self::DB_USER, self::DB_PASSWORD);

			$sql = file_get_contents($filename);

			$qr = $db->exec($sql);
			
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
			//new receipt
			$receipt = new Receipt();
			// get data
			$receipt->get_data_from_array($receipt_data);
			TEST($receipt->json_encode(false));
			//compute the sequence of sql to add this receipt to db
			$comma_seperated_list = $receipt->get_seperated_list();
			TEST($comma_seperated_list);
			//mysqli_query($this->db, "CALL test('$comma_seperated_list');");
			
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
		public function get_list_of_product_info($data = NULL){
            if (is_null($data))
            	$sql = mysqli_query($this->db,"CALL get_list_of_product_info();");
            else{
            	$sqlbuilder = new SQLBuilder;
            	$sql = mysqli_query($this->db, $sqlbuilder->alter_product_query($data));
            }
    		$result = NULL;
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

	 //$db = new Database();
	 //$db->connect();
	 //TEST($db->get_list_of_product_info('Bánh tráng'));
	// $tmp = new SoldProduct(113);
 //     $tmp->add_attribute("Sữa",100, NULL, "100", "SUA1111",
 //     		NULL,"17/11/2015");

 //     $BasicInfo = new BasicInfo("Kim Nhật Thành","knthanh@apcs.vn","0923232121","4 ABCD");

 //     $receipt = new Receipt(1,1,new Employee("EM011",$BasicInfo,10000,1,"1313131"));
    
 //     $receipt->add($tmp);
 //     $receipt->add($tmp);
     
	//  $db->add_receipt($receipt->json_encode(false));	
?>