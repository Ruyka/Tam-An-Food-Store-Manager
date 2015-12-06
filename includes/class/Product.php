<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Trademark.php");
	require_once(CLASS_PATH . "Unit.php");
// Product class contain info about a product in tam an store
class Product{

	//Properties:
	//id of the product in database
	private $product_id;
	//id of the product in company
	private $product_code;
	// name of the product
	private $name ;
	// infomation about unit of product
	private $unit ;
	// infomation about trademark of product
	private $trademark ;
	// the date that the product will be depleted
	private $dated;
	//save the type of the Product object
	protected $object_type;

	//Constructor
	public function __construct(){
		$this->product_id = "";
		$this->product_code="";
		$this->name = "";
		
		$this->unit = NULL;
		$this->trademark = NULL;
		$this->dated = "";
		$this->object_type = "Product";
	}
	//this function add the attribute for the product
    public function add_attribute( $name, $unit = NULL, 
    								$product_id = "", $product_code=""
    								, $trademark = NULL, $dated = NULL) {
    	
    	$this->name = $name;
		
		$this->unit = $unit;
		$this->product_id = $product_id;
		$this->product_code = $product_code;
		$this->trademark = $trademark;
		$this->dated = $dated;
    }
    

    //Method
	//get name of product to display
	public function get_name(){
		return $this->name;
	}
	
	
	//get price of product
	public function get_price(){
		return $this->unit->get_price();
	}

	//encode code to put in sql
	public function get_seperated_list(){
		//product Id
		$str = '%product_id%'. $this->product_id .'%product_id%';
		//product code
		if (strcmp($this->product_code, "")!=0)
			$str = $str . '%product_code%' . $this->product_code . '%product_code%';
		//name
		$str = $str . '%product_name%' . $this->name . '%product_name%';

		//unit
		if (!is_null($this->unit))
			$str = $str . '%unit%' . $this->unit->get_comma_seperated_list() . '%unit%';

		//trademark
		if (!is_null($this->trademark))
			$str = $str . '%trademark%' . $this->trademark->get_comma_seperated_list() . '%trademark%';
		
		//dated
		if (!is_null($this->dated))
			$str = $str . '%dated%' . $this->dated . '%dated%';
		
		return $str;
	}


	// convert object to json format
	// code = true, return json encode, else just return object data encode as an array
	public function json_encode($code = true){
		// 3 basic elements of the product must have
		$json = array();

		$json = array(
			'product_id' => $this->product_id,
			'product_code' => $this->product_code,
	        'name' => $this->name,
	        'object_type' => $this->object_type,
    	);

    	if (!is_null($this->unit))
    		$json['unit'] = $this->unit->json_encode(false);
    	else
    		$json['unit'] = $this->unit;
    	// json_encode parameter = false, return object not encode with json
    	//trademark is an Object so we must check its existence
    	// if it equal NULL, we still has it present in JSON encode
    	// else, we get the trademark object in to array of data
    	if (!is_null($this->trademark)) 
    		$json['trademark'] = $this->trademark->json_encode(false);
    	else 
    		$json['trademark'] = $this->trademark;

    	//add date
    	$json['dated'] = $this->dated;
    	
    	// code = true, return json encode, else just return object data encode as an array
    	if ($code)
    		return json_encode($json);
    	else
    		return $json;
	}
	//get data from json_data 
	public function get_data_from_json($json_data){
		// decode input using json decode
		$data = json_decode($json_data,true);
 		// if json last error is equal to NONE -> get the data from it
		if (json_last_error() == JSON_ERROR_NONE){
			$this->get_data($data);	
		}
	} 

	//get data from an array data 
	public function get_data_from_array($data){
		// a right Basic info array must have 6 properties id, naeme, total_number, unit, trademark, dated
		if ( isset($data['product_id']) && isset($data['name'])){
			
			$this->get_data($data);
		}
	}

	// get data from array
	private function get_data($data){

		//product id of database
		$this->product_id = $data['product_id'];
		//product Id of the company
		$this->product_code = $data['product_code'];
		// get name
		$this->name = $data['name'];
		// get unit data
		if (!is_null($data['unit'])){
			$this->unit = new Unit();
			$this->unit->get_data_from_array($data['unit']);
		}
		//get Trademark data
		if (!is_null($data['trademark'])){
			$this->trademark = new Trademark();
			$this->trademark->get_data_from_array($data['trademark']);
		}
		//get dated
		$this->dated = $data['dated'];
		
	}

}
	//test code
	 // $tmp = new Product();
  //    $tmp->add_attribute("Sữa",100,new Unit("hộp",10000), "RH1922",
  //    		new Trademark("1131ASAs",
  //    			new BasicInfo("Hồ Hữu Phát","hhphat@apcs.vn","0906332121","4 ABCD")
  //    			,"Việt Nam","google.com.vn"
  //    		)
  //    		,"17/11/2015");
  //   TEST($tmp->json_encode(false));
    
?>