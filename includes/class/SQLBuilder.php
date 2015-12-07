<?php 
require_once(CLASS_PATH."SQLLexical.php");
Class SQLBuilder{
	// hold sql query
	private $query;

	// default sql query = ""
	public function __construct($query = ""){
		$this->query = $query;
	}
	// this return SQL command to query searching for product in alter product view
	public function alter_product_query($data){
		///format key word to tokens
		$keywords = SQLLexical::format_product_query_to_array($data);
    	$keywords = SQLLexical::make_keywords($keywords);
    	//make query
    	$len = sizeof($keywords);
    	$tempID = array();
    	for($i = 0; $i < $len; $i++)
    		$tempID[$i] = 'Name';

		            	
		return $this->select(array("Name", SQLBuilder::sql_as("Unit", "UnitName"), "Price", SQLBuilder::sql_as("ID", "Id"), SQLBuilder::sql_as("Product_ID", "ProductId"))
					->from("tam_an.product")->where()
					->or_recursive('like', $tempID, $keywords)
					->to_string();
	}

	// 
	public function alter_product_remove_product_query($data){
		            	
		return $this->sql_delete()
					->from("tam_an.product")->where()
					->in('ID', $keywords)
					->to_string();
	}

	// 
	public function alter_product_update_product_query($data){
		            	
		return $this->sql_delete()
					->from("tam_an.product")->where()
					->in('ID', $keywords)
					->to_string();
	}

	public function alter_product_new_product_query($data){
		            	
		return $this->sql_delete()
					->from("tam_an.product")->where()
					->in('ID', $keywords)
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

		$this->query .= " DELETE ";
		
		return $this;
	}

	// DELETE
	private function update($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= " UPDATE ".implode(', ', $param).' ';
		
		return $this;
	}

	static public function sql_as( $id, $value){
		return " ".$id." AS '".$value."' ";
	}

	private function from($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "FROM ".implode(', ', $param).' ';
		
		return $this;
	}

	private function where(){
		$this->query .= "WHERE ";
		
		return $this;
	}

	private function is($id, $value){
		$this->query .= $id.' IS '.$value.' ';

		return $this;
	}

	private function in($id, $array){
		if(!is_array($array))
			$array = array($array);
		$this->query .= $id.' IN ('.implode(', ', $array).') ';

		return $this;
	}

	private function like($id, $value){
		$this->query .= $id.' LIKE \''.$value.'\' ';
		
		return $this;
	}

	private function equals($id, $value){
		$this->query .= $id.' = '.$value.' ';
		
		return $this;
	}

	private function not_equals($id, $value){
		$this->query .= $id.' != '.$value.' ';
		
		return $this;
	}

	private function sql_or(){
		$this->query .= ' OR ';

		return $this;
	}

	private function sql_and(){
		$this->query .= ' AND ';
		
		return $this;
	}

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
		$this->query = substr($this->query, 0, $len);

		return $this;
	}

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

		$len = strlen($this->query) - 3;
		$this->query = substr($this->query, 0, $len);

		return $this;
	}

	private function left_paren(){
		$this->query .= '( ';
		return $this;
	}

	private function right_paren(){
		$this->query .= ') ';
		return $this;
	}

	private function to_string(){
		return $this->query;
	}
}


// $builder = new SQLBuilder();
// print_r($builder->select(array('Name', 'ID'))->from('product')->where()->or_recursive('like', array('ID', 'ID'), array('productID','employeeID'))->to_string());

?>
