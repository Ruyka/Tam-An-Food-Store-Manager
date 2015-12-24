<?php

	abstract class SQL{
		
		private $sql_query = NULL;
		private $data = NULL;
		private $return_data = NULL;

		//constructor
		public function __construct($data){
			$this->data = $data;
		}


		//get the result of query
		public function get_return_data(){
			return $this->return_data;
		}


		//set the result of query
		protected function set_return_data($data){
			$this->return_data = $data;	
		}


		//execute the SQl query 
		//return: desired data
		public function execute($db){
			
			if (is_null($this->sql_query))
				$this->sql_query = $this->build_director();
			
			return mysqli_query($db, $this->sql_query);
		}


		//build the SQL query
		public function build_director(){

		}


		//get sql query
		protected function get_sql_query(){
			return $this->sql_query;
		}

		
		//get data 
		protected function get_data(){
			return $this->data;
		}
	}

?>