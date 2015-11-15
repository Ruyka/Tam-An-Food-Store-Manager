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
	
	//this function add the attribute for the product
    public function addAttribute( $name, $total_num, $unit, $trademark = NULL, $dated = NULL) {
    	$this->name = $name;
		$this->total_num = $total_num;
		$this->unit = $unit;
		$this->trademark = $trademark;
		$this->dated = $dated;
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
        //dummy code, for testing
        if (!is_null($this->trademark))
            return "Product " . $this->name . $this->total_number . $this->dated . $this->unit->get_name() . $this->trademark->convert_to_HTML();
        else
        return "Product " . $this->name . $this->total_number . $this->dated . $this->unit->get_name() ;
	}
}
    
?>