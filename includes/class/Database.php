
<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."Receipt.php");
	require_once(CLASS_PATH."SQLFactory.php");
	require_once(CLASS_PATH."Package.php");
	require_once(CLASS_PATH."Feature.php");

	class Database{
		// this infomation can be found in config file
		//Properties
		const DB_SERVER = SERVER;
		const DB_USER = USERNAME;
        const DB_PASSWORD = PASSWORD;
	   	const DB_NAME = DBNAME;
		

		//store the database object
		private $db = NULL;
		
		//store the previous executed data;
		private $executed_data = NULL;
		
		
		//execute the Package
		public function execute($package){

			//get the message inside the package
			$feature_name = $package->get_message();

			//get data of the package
			$data = $package->get_data();

			//SQL Factory to create SQL 
			$sql_factory = new SQLFactory();
			
			//create feature type SQL
			$sql = $sql_factory->create_sql($feature_name, $data);
			
			//execute the SQL            
            $sql->execute($this->db);
        	
        	//get the data
            $this->executed_data = $sql->get_return_data();

		}


		//GET THE LATEST RESULT OF QUERY
		public function get_package(){
			return $this->executed_data;
		}


		//connect to database
		public function connect(){
			//connect to SQl
			$this->db = mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB_NAME)
            or die("Couldn't connect to My Server") ;
            
            //if can connect to SQL, connect to Database 
			if($this->db){

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
		//TESTING method
		public function executeQuery($tmp){
			TEST($tmp);
			mysqli_multi_query($this->db,$tmp);
		}
	}

	  // $db = new Database();
	  
	  // $query = "UPDATE tam_an.product SET Name = 'Đèn đá tượng phật32ASD33' , Bought = '132' , Price = '17480000000.76' , Unit = 'kgeee' WHERE ID = '19' ; UPDATE tam_an.product SET Name = 'Đèn đá xây dựng323ASD23' , Bought = '133242' , Price = '17480000000.76' , Unit = 'kgeee' WHERE ID = '21' "; 
	  
	  // $db->connect();
	  // $db->executeQuery($query);
	  // $data = array('username' =>'ltkmai', 'password' => '870814');
	  // $db->check_user_login($data);
	  // TEST($db->get_package());
 	  
	// $tmp = new SoldProduct(113);
 //     $tmp->add_attribute("Sữa",100, NULL, "100", "SUA1111",
 //     		NULL,"17/11/2015");
 //     $BasicInfo = new BasicInfo("Kim Nhật Thành","knthanh@apcs.vn","0923232121","4 ABCD");
 //     $receipt = new Receipt(1,1,new Employee("EM011",$BasicInfo,10000,1,"1313131"));
    
 //     $receipt->add($tmp);
 //     $receipt->add($tmp);
     
	//  $db->add_receipt($receipt->json_encode(false));	
?>