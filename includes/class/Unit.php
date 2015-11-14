<?php
	//this class store infomation about the Unit of product

	class Unit{
		//unit name of the product
		private $unit_name;
		//price of per unit of product, in Vietnam currency
		private $price;
		//constructor allow to create a Unit with name and price
		public function __construct($unit_name, $price){
			$this->unit_name = $unit_name;
			$this->price = $price;
		}
		//method to get name of the Unit
		public function get_name(){
			return $this->unit_name;
		}
		//methdo to get price of the Unit
		public function get_price(){
			return $this->price;
		}
	}
?>