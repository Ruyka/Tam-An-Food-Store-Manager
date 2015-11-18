<?php 
$defaultNum = 4;
$curNum = 0; 
$product = array(0 => 'productA', 1 => 'productB', 2 => 'productC' );
$type = array(0 => 'typeA', 1 => 'typeB', 2 => 'typeC' );	

function makeProductList(){
	$productList = "";
	foreach ($GLOBALS['product'] as $key => $value) {
		$productList = $productList."<option value='$key'>".$value."</option>";
	}
	return $productList;
}

function createNew(){
	$productName = "product".strval($GLOBALS['curNum']);
	$numberName = "name".strval($GLOBALS['curNum']);
	$typeName = "type".strval($GLOBALS['curNum']);
	echo "<tr><td><select name='".$productName."'><option value='-1'>Chọn sản phẩm</option>".makeProductList()."</select></td>";
	echo "<td><input type='number' min='0' name='".$numberName."' placeholder='Số lượng'></td>";
	++$GLOBALS['curNum'];
}

function makePreview(){
	print_r($_POST);
}
?>	           
