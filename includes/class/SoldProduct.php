<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
	require_once(CLASS_PATH . "Product.php");
	class SoldProduct extends Product{
		//number of product need to be sold
		private $number;
		// calculate the price of the number of product
		//price = number * product price
		public function calc_price(){
			return $this->number * $this->get_price();
		}
        // constructor whith the number of product to be sold
        public function __construct($number){
            $this->number = $number;
        }
        //convert to HTML to display 
        public function convert_to_HTML(){
            
        }
	}
?>