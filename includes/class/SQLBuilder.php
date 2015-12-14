<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
require_once(CLASS_PATH."SQLLexical.php");
Class SQLBuilder{
	// hold sql query
	private $query;

	// default sql query = ""
	public function __construct($query = ""){
		$this->query = $query;
	}

	// query = ""
	public function reset(){
		$this->query = "";

		return $this;
	}

	// this return SQL command to query searching for product in alter product view
	// SELECT ....
	// FROM tam_an.product
	// WHERE Name = '...' OR ....
	public function alter_product_query($data){
		///format key word to tokens
		$keywords = SQLLexical::format_product_query_to_array($data);
    	$keywords = SQLLexical::make_keywords($keywords);
    	//make query
    	$len = sizeof($keywords);
    	$tempID = array();
    	for($i = 0; $i < $len; $i++)
    		$tempID[$i] = 'Name';

		            	
		return $this->select(array("Name", SQLBuilder::sql_as("Unit", "UnitName"), "Price", SQLBuilder::sql_as("ID", "Id"), SQLBuilder::sql_as("Product_ID", "ProductId"), SQLBuilder::sql_as("Bought","Import_Price")))
					->from("tam_an.product")->where()
					->or_recursive('like', $tempID, $keywords)
					->to_string();
	}

	// delete an existing rows
	// DELETE FROM tam_an.product
	// WHERE ID IN (...)
	public function alter_product_remove_product_query($data){		            	
		return $this->sql_delete()
					->from("tam_an.product")->where()
					->in('ID', $data)
					->to_string();
	}

	// update an existing rows
	// UPDATE tam_an.product
	// SET Name = '...', Bought = '...', Price = '...', Unit = '...'
	// WHERE ID = ...;
	// UPDATE ....
	public function alter_product_update_product_query($data){
		$input = SQLLexical::make_product_list($data['list_product']);

		$id_array = array("Name", "Bought", "Price", "Unit");

		foreach ($input as $key => $value) {
			$this->update('tam_an.product')
				 ->set($id_array, $value)
				 ->where()
				 ->equals('ID',$key)
				 ->end_query();
		}

		return $this->to_string();
	}

	// add new product 
	// INSERT INTO tam_an.product VALUES
	// (Name, Bought, Price, Unit),
	// ...
	// (Name, Bought, Price, Unit);
	public function alter_product_new_product_query($data){
		$input = SQLLexical::make_product_list($data['list_product']);
		            	
		return $this->sql_insert('tam_an.product',array('Name','Bought','Price', 'Unit'))
					->sql_insert_values_recursive($input)
					->end_query()
					->to_string();
	}

	// sql query to check if user exist
	// SELECT ID AS 'Id', Name
	// FROM tam_an.user
	// WHERE username LIKE $username AND password LIKE $password
	public function check_user_login($username, $password){

		return $this->select(array(SQLBuilder::sql_as('ID','Id'), 'Name', 'User_type'))
					->from('tam_an.user')
					->where()
					->and_recursive('LIKE',array('Username', 'Password'), array($username, $password))
					->to_string();
	}

	public function get_list_of_product_info(){
		return $this->select(array("Name", SQLBuilder::sql_as("Unit", "UnitName"), "Price", SQLBuilder::sql_as("ID", "Id"), SQLBuilder::sql_as("Product_ID", "ProductId"), SQLBuilder::sql_as("Bought","Import_Price")))
			->from("tam_an.product")->where()
			->not_equals('Price',0)
			->to_string();
	}

	//PRIVATE method
	// SELECT param 1,...,param n
	private function select($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "SELECT ".implode(', ', $param).' ';
		
		return $this;
	}

	// DELETE
	private function sql_delete(){

		$this->query .= "DELETE ";
		
		return $this;
	}

	// SET ID = Value,....
	private function set($id_array, $value_array){
		if(!is_array($id_array))
			$id_array = array($id_array);

		if(!is_array($value_array))
			$value_array = array($value_array);

		$this->query .= "SET ";

		foreach (array_map(null, $id_array, $value_array) as $key => $value) {
			$this->equals($value[0], $value[1]);
			$this->query .= ", ";
		}

		$len = strlen($this->query) - 2;
		$this->query = substr($this->query, 0, $len).' ';

		return $this;  
	}

	// UPDATE table,....
	private function update($param){

		$this->query .= "UPDATE ".$param.' ';
		
		return $this;
	}

	// $id AS '$value'
	static public function sql_as( $id, $value){
		return $id." AS '".$value."' ";
	}

	// FROM table,....
	private function from($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "FROM ".implode(', ', $param).' ';
		
		return $this;
	}

	// WHERE
	private function where(){
		$this->query .= "WHERE ";
		
		return $this;
	}

	// $id IS $value
	private function is($id, $value){
		$this->query .= $id.' IS '.$value.' ';

		return $this;
	}

	// $id IN (value,...)
	private function in($id, $array){
		if(!is_array($array))
			$array = array($array);
		$this->query .= $id.' IN (\''.implode('\', \'', $array).'\') ';

		return $this;
	}

	// $id LIKE '$value'
	private function like($id, $value){
		$this->query .= $id.' LIKE \''.$value.'\' ';
		
		return $this;
	}

	// $id = $value
	private function equals($id, $value){
		$this->query .= $id.' = \''.$value.'\' ';
		
		return $this;
	}

	// $id != $value
	private function not_equals($id, $value){
		$this->query .= $id.' != \''.$value.'\' ';
		
		return $this;
	}

	// OR
	private function sql_or(){
		$this->query .= 'OR ';

		return $this;
	}

	// AND
	private function sql_and(){
		$this->query .= 'AND ';
		
		return $this;
	}

	// [func($id, $value)] OR [func($id, $value)] OR ...
	private function or_recursive($func, $id_array, $value_array){
		if(!is_array($id_array))
			$id_array = array($id_array);

		if(!is_array($value_array))
			$value_array = array($value_array);

		//if the method exist, call it
		if((int)method_exists($this,$func) <= 0)
			return $this;


		foreach (array_map(null, $id_array, $value_array) as $key => $value) {
			$this->$func($value[0], $value[1]);
			$this->sql_or();
		}


		$len = strlen($this->query) - 3;
		$this->query = substr($this->query, 0, $len).' ';

		return $this;
	}

	// [func($id, $value)] AND [func($id, $value)] AND ...
	private function and_recursive($func, $id_array, $value_array){
		if(!is_array($id_array))
			$id_array = array($id_array);

		if(!is_array($value_array))
			$value_array = array($value_array);

		//if the method exist, call it
		if((int)method_exists($this,$func) <= 0)
			return $this;
		foreach (array_map(null, $id_array, $value_array) as $key => $value) {
			$this->$func($value[0], $value[1]);
			$this->sql_and();
		}

		$len = strlen($this->query) - 4;
		$this->query = substr($this->query, 0, $len).' ';

		return $this;
	}

	// INSERT INTO ... (...) VALUES
	private function sql_insert($table, $id_array){
		if(!is_array($id_array))
			$id_array = array($id_array);

		$this->query .= "INSERT INTO ".$table." (".implode(', ', $id_array).") VALUES ";

		return $this;
	}

	// (value, value, ...)
	private function sql_insert_values($value_array){
		if(!is_array($value_array))
			$value_array = array($value_array);

		TEST($value_array);
		$this->query .= "( '".implode('\', \'', $value_array)."') ";

		return $this;
	}

	// (value, value, ...),
	// (value, value, ...),
	// ...
	// (value, value, ...)
	private function sql_insert_values_recursive($value_array){
		if(!is_array($value_array))
			$value_array = array($value_array);
		TEST($value_array);
		foreach ($value_array as $key => $value){
			$this->sql_insert_values($value);
			$this->query .= ', ';
		}

		$len = strlen($this->query) - 2;
		$this->query = substr($this->query, 0, $len).' ';		

		return $this;
	}

	// (
	private function left_paren(){
		$this->query .= '( ';
		return $this;
	}

	// )
	private function right_paren(){
		$this->query .= ') ';
		return $this;
	}

	// ;
	private function end_query(){
		$this->query .= '; ';
		return $this;
	}

	// query
	private function to_string(){
		return $this->query;
	}
}


// $builder = new SQLBuilder();

?>
