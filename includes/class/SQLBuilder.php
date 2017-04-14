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

	public function get_list_of_product_info(){
		return $this->select(array("Name", SQLBuilder::sql_as("Unit", "UnitName"), "Price", SQLBuilder::sql_as("ID", "Id"), SQLBuilder::sql_as("Product_ID", "ProductId"), SQLBuilder::sql_as("Bought","Import_Price")))
			->from("tam_an.product")->where()
			->not_equals('Price',0)
			->to_string();
	}

	//PRIVATE method
	// SELECT param 1,...,param n
	public function select($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "SELECT ".implode(', ', $param).' ';
		
		return $this;
	}

	// DELETE
	public function sql_delete(){

		$this->query .= "DELETE ";
		
		return $this;
	}

	// SET ID = Value,....
	public function set($id_array, $value_array){
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
	public function update($param){

		$this->query .= "UPDATE ".$param.' ';
		
		return $this;
	}

	// $id AS '$value'
	static public function sql_as( $id, $value){
		return $id." AS '".$value."' ";
	}

	// FROM table,....
	public function from($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "FROM ".implode(', ', $param).' ';
		
		return $this;
	}

	// WHERE
	public function where(){
		$this->query .= "WHERE ";
		
		return $this;
	}

	// $id IS $value
	public function is($id, $value){
		$this->query .= $id.' IS '.$value.' ';

		return $this;
	}

	// $id IN (value,...)
	public function in($id, $array){
		if(!is_array($array))
			$array = array($array);
		$this->query .= $id.' IN (\''.implode('\', \'', $array).'\') ';

		return $this;
	}

	// $id LIKE '$value'
	public function like($id, $value){
		$this->query .= $id.' LIKE \''.$value.'\' ';
		
		return $this;
	}

	// $id = $value
	public function equals($id, $value){
		$this->query .= $id.' = \''.$value.'\' ';
		
		return $this;
	}

	// $id != $value
	public function not_equals($id, $value){
		$this->query .= $id.' != \''.$value.'\' ';
		
		return $this;
	}

	// OR
	public function sql_or(){
		$this->query .= 'OR ';

		return $this;
	}

	// AND
	public function sql_and(){
		$this->query .= 'AND ';
		
		return $this;
	}

	// [func($id, $value)] OR [func($id, $value)] OR ...
	public function or_recursive($func, $id_array, $value_array){
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
	public function and_recursive($func, $id_array, $value_array){
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
	public function sql_insert($table, $id_array){
		if(!is_array($id_array))
			$id_array = array($id_array);

		$this->query .= "INSERT INTO ".$table." (".implode(', ', $id_array).") VALUES ";

		return $this;
	}

	// (value, value, ...)
	public function sql_insert_values($value_array){
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
	public function sql_insert_values_recursive($value_array){
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
	public function left_paren(){
		$this->query .= '( ';
		return $this;
	}

	// )
	public function right_paren(){
		$this->query .= ') ';
		return $this;
	}

	// ;
	public function end_query(){
		$this->query .= '; ';
		return $this;
	}

	// query
	public function to_string(){
		return $this->query;
	}
}


// $builder = new SQLBuilder();

?>
