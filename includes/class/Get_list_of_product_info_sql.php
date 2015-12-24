<?php
	
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH."SQL.php");
	require_once(CLASS_PATH."SQLBuilder.php");
	require_once(CLASS_PATH."SQLLexical.php");

	// this return SQL command to query searching for product in alter product view
	// SELECT ....
	// FROM tam_an.product
	// WHERE Name = '...' OR ....

	class Get_list_of_product_info_sql extends SQL{
		
		//Override
		public function execute($db){
			$sql_result = parent::execute($db);

			$result = NULL;
            
            if($sql_result && mysqli_num_rows($sql_result)!=0){    
                
                $result = array();
				
				while($rlt = mysqli_fetch_array($sql_result, MYSQL_ASSOC)){	
					$result[] = $rlt;
				}          
            }

            $this->set_return_data($result);
		}


		//Overrid build director function
		public function build_director(){
			$sql_builder = new SQLBuilder();
			
			$data = $this->get_data();

			///format key word to tokens
			$keywords = SQLLexical::format_product_query_to_array($data);
	    	$keywords = SQLLexical::make_keywords($keywords);
	    	
	    	//make query
	    	$len = sizeof($keywords);
	    	$tempID = array();
	    	for($i = 0; $i < $len; $i++)
	    		$tempID[$i] = 'Name';

			            	
			return $sql_builder
						->select(array("Name", SQLBuilder::sql_as("Unit", "UnitName"), "Price"
											 , SQLBuilder::sql_as("ID", "Id")
											 , SQLBuilder::sql_as("Product_ID", "ProductId")
											 , SQLBuilder::sql_as("Bought","Import_Price")))
						->from("tam_an.product")->where()
						->or_recursive('like', $tempID, $keywords)
						->to_string();
		}

	}
?>
