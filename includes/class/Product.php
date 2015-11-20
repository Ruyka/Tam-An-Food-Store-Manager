<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "Trademark.php");
	require_once(CLASS_PATH . "Unit.php");
// Product class contain info about a product in tam an store
class Product{

	//Properties:
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
	
	//save the type of the Product object
	protected $object_type;

	//Constructor
	public function __construct(){
		$this->name = "";
		$this->total_number = 0;
		$this->unit = new Unit();
		$this->trademark = new Trademark();
		$this->dated = "";
		$this->object_type = "Product";
	}
	//this function add the attribute for the product
    public function add_attribute( $name, $total_number, $unit, $trademark = NULL, $dated = NULL) {
    	$this->name = $name;
		$this->total_number = $total_number;
		$this->unit = $unit;
		$this->trademark = $trademark;
		$this->dated = $dated;
    }
    

    //Method
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
	

	// convert object to json format
	// code = true, return json encode, else just return object data encode as an array
	public function json_encode($code = true){
		// 3 basic elements of the product must have
		$json = array();

		$json = array(
	        'name' => $this->name,
	        'total_number' => $this->total_number,
	        // json_encode parameter = false, return object not encode with json
	        'unit' => $this->unit->json_encode(false),	
	        'object_type' => $this->object_type,
    	);
    	
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
		// a right Basic info array must have 5 properties naeme, total_number, unit, trademark, dated
		if ( isset($data['name']) && isset($data['total_number']) && isset($data['unit']) 
				&& isset($data['trademark']) && isset($data['dated']) ){
			
			$this->get_data($data);
		}
	}

	// get data from array
	private function get_data($data){

		// get name
		$this->name = $data['name'];
		//get total numbet off product that remains
		$this->total_number = $data['total_number'];
		// get unit data
		$this->unit->get_data_from_array($data['unit']);
		//get Trademark data
		$this->trademark->get_data_from_array($data['trademark']);
		//get dated
		$this->dated = $data['dated'];
		
	} 
}

    
    
?>