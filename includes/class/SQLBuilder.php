<?php 
Class SQLBuilder{
	// hold sql query
	private $query;

	// default sql query = ""
	public function __construct($query = ""){
		$this->query = $query;
	}

	// SELECT param 1,...,param n
	public function select($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "SELECT ".implode(', ', $param).' ';
		
		return $this;
	}

	static public function sql_as($value){
		$temp = " AS '".$value."' ";

		return $temp;
	}

	public function from($param){
		if(!is_array($param))
			$param = array($param);

		$this->query .= "FROM ".implode(', ', $param).' ';
		
		return $this;
	}

	public function where(){
		$this->query .= "WHERE ";
		
		return $this;
	}

	public function is($id, $value){
		$this->query .= $id.' IS '.$value.' ';

		return $this;
	}

	public function in($id, $array){
		if(!is_array($array))
			$array = array($array);
		$this->query .= $id.' IN ('.implode(', ', $array).') ';

		return $this;
	}

	public function like($id, $value){
		$this->query .= $id.' LIKE \''.$value.'\' ';
		
		return $this;
	}

	public function equals($id, $value){
		$this->query .= $id.' = '.$value.' ';
		
		return $this;
	}

	public function not_equals($id, $value){
		$this->query .= $id.' != '.$value.' ';
		
		return $this;
	}

	public function sql_or(){
		$this->query .= ' OR ';

		return $this;
	}

	public function sql_and(){
		$this->query .= ' AND ';
		
		return $this;
	}

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
		$this->query = substr($this->query, 0, $len);

		return $this;
	}

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

		$len = strlen($this->query) - 3;
		$this->query = substr($this->query, 0, $len);

		return $this;
	}

	public function left_paren(){
		$this->query .= '( ';
		return $this;
	}

	public function right_paren(){
		$this->query .= ') ';
		return $this;
	}

	public function to_string(){
		return $this->query;
	}
}


// $builder = new SQLBuilder();
// print_r($builder->select(array('Name', 'ID'))->from('product')->where()->or_recursive('like', array('ID', 'ID'), array('productID','employeeID'))->to_string());

?>
