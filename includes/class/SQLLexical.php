<?php
	class SQLLexical{
		static function format_product_query_to_array($query){
	  		$keyword_tokens = explode('+', trim($query,'+'));
	  		foreach ($keyword_tokens as $key => $value) {
			  	if(empty($value))
			  		unset($keyword_tokens[$key]);
			  	}
		    $keyword_tokens = preg_grep('/^\s*\z/', $keyword_tokens, PREG_GREP_INVERT);

		    $keyword_tokens = array_map('trim', $keyword_tokens);

		    return $keyword_tokens;
		}

		// change 'keyword' => '%keyword%'
		static function make_keywords($keywords){
			if(!is_array($keywords))
				$keywords = array($keywords);

			foreach ($keywords as $key => $value) 
				$keywords[$key] = "%".$value."%";
			
			return $keywords;
		}

	}

?>