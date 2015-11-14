<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Trademark.php");
	require_once(CLASS_PATH . "Unit.php");
// Product class contain info about a product in tam an store
class Product{
	// name of the product
	private $name ;
	// total number of the product in storage
	private $total_number;
	// infomation about unit of product
	private $unit ;
	// infomation about trademark of product
	private $trademark ;
	// the date that the product will be depleted
	private $dated;
	// constructor for full info product
	public function __construct( $name, $total_num, $unit, $trademark, $dated) {
		$this->name = $name;
		$this->total_num = $total_num;
		$this->unit = $unit;
		$this->trademark = $trademark;
		$this->dated = $dated;
	}
	// constructor for knowing a name and unit and total numbe of product
	public function __construct( $name, $unit, $total_num) {
		$this->name = $name;
		$this->total_num = $total_num;
		$this->unit = $unit;
	}
	//get name of product to display
	public function get_name(){
		return $this->name;
	}
	//get total number of the product to display
	public function get_total_number(){
		return $this->total_number;
	}
	//get price of product
	public function get_price(){
		return $this->unit->get_price();
	}
	//convert the product to format HTML to display for user
	public function convert_to_HTML(){

	}
}
?>