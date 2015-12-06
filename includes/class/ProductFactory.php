<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Product.php");
	require_once(CLASS_PATH . "SoldProduct.php");
	require_once(CLASS_PATH . "ImportProduct.php");
	class ProductFactory{
		const PRODUCT = "Product";
		const SOLD_PRODUCT = "SoldProduct";
		const IMPORT_PRODUCT = "ImportProduct";
		static public function create_product($product){
			if (strcmp($product, self::PRODUCT) == 0)
				return new Product();
			else if (strcmp($product, self::SOLD_PRODUCT) == 0)
				return new SoldProduct();
			else if (strcmp($product, self::SOLD_PRODUCT) == 0)
				return new ImportProduct();
		}
	}	

?>

