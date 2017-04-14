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
			if (strcmp($product['object_type'], self::PRODUCT) == 0){
				$p = new Product();
			}
			else if (strcmp($product['object_type'], self::SOLD_PRODUCT) == 0){
				$p = new SoldProduct($product['number']);
			}
			else if (strcmp($product['object_type'], self::IMPORT_PRODUCT) == 0)
				$p = new ImportProduct($product['import_price']);
			//get data
			$p->get_data_from_array($product);
			return $p;
		}
	}	

?>

