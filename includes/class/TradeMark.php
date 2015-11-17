<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(CLASS_PATH . "BasicInfo.php");
	//this class will give us the infomation of trademark
	class TradeMark{
		//basic infomation of the trademark
		private $basic_info;
		// nation of the trademark
		private $nation;
		// website of the trademark
		private $website;

		//construct the object with data
		public function __construct($basic_info, $nation, $website){
			$this->basic_info = $basic_info;
			$this->nation = $nation;
			$this->website = $website;
		}
		//get the name of TradeMark
		public function get_name(){
			//get the name in basic infomation by using method get_name in BasicInfo Object
			return $this->basic_info->get_name();
		}
		//convert Object into HTML, to display to users
		public function convert_to_HTML(){
		  //dummy code, for testing
            return "Trade Mark " . $this->basic_info->convert_to_HTML(). " " . $this->nation . $this->website;
		}

	}
    
    
?>