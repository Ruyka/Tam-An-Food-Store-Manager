<?php

class Product{
	public $name ;
	public $total_number;
	public $unit ;
	public $trademark ;
	public $dated;
	function __construct( $name, $total_num, $unit, $trademark, $dated) {
		$this->name = $name;
		$this->total_num = $total_num;
		$this->unit = $unit;
		$this->trademark = $trademark;
		$this->dated = $dated;
	}
	function __construct( $name, $unit, $total_num) {
		$this->name = $name;
		$this->total_num = $total_num;
		$this->unit = $unit;
	}
	function get_name(){
		return $name;
	}
	function get_total_number(){
		return $total_number;
	}
	function get_price(){
		return $unit->get_price();
	}
	function convert_to_HTML(){
		
	}
}
?>