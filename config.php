<?php
 

    //store database
    defined("DATABASE_PATH")
        or define("DATABASE_PATH", realpath(dirname(__FILE__) . '/database/' ).'/');            
    //store include files: to create View of HTML, class and global function
    defined("INCLUDES_PATH")
        or define("INCLUDES_PATH", realpath(dirname(__FILE__) . '/includes/' ).'/');
    //store javascript files to support user interaction with our website
    defined("JAVASCRIPT_PATH")
        or define("JAVASCRIPT_PATH", realpath(dirname(__FILE__) . '/js/' ).'/');        
    //store library 
    defined("LIBRARY_PATH")
        or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/lib/' ).'/');
    //store images, sound or flash files
    defined("MEDIA_PATH")
        or define("MEDIA_PATH", realpath(dirname(__FILE__) . '/media/' ).'/');
    // store the main code of the project (html,php)
    defined("PUBLIC_HTML_PATH")
        or define("PUBLIC_HTML_PATH", realpath(dirname(__FILE__) . '/public_HTML/' ).'/');
    //store css file
    defined("STYLE_PATH")
        or define("STYLE_PATH", realpath(dirname(__FILE__) . '/style/' ).'/');
    //store class file (object) used in the project
    defined("CLASS_PATH")
        or define("CLASS_PATH", realpath(dirname(__FILE__) . '/class/' ).'/');
    //store global function handle the unrelated to class problem
    defined("FUNCTION_PATH")
        or define("FUNCTION_PATH", realpath(dirname(__FILE__) . '/includes/function' ).'/');
        
    //the interface of website will be slit into different views and we store it in view
    defined("VIEW_PATH")
        or define("VIEW_PATH", realpath(dirname(__FILE__) . '/includes/view'  ).'/');
        
    //store the images, background,...
    defined("IMAGE_PATH")
        or define("IMAGE_PATH", realpath(dirname(__FILE__) . '/media/image/' ).'/');
    
    //if IS_TEST is true then we test the project in PROJECT folder with WAMP
    defined("IS_TEST") or define("IS_TEST",true);
    if (IS_TEST){
    	defined("PROJECT")
    		or define("PROJECT",'Tam-An-Food-Store-Manager');
    }
    else
    {
    	defined("PROJECT")
    		or define("PROJECT",'');
    }
    //root path F:\\...
    defined("ROOT_PATH")
    	or define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . PROJECT .'/');
     ///root with server name http://...
	defined("ROOT_SERVER")
        or define("ROOT_SERVER", "http://".$_SERVER['HTTP_HOST']."/".PROJECT."/");
   	
    //database infomation
        //we use the localhost to build our project 
    //database name
    defined("DBNAME")
        or define("DBNAME", "tam_an");
    //user name to log into database
    defined("USERNAME")
        or define("USERNAME", "root");
    //password
    defined("PASSWORD")
        or define("PASSWORD", "");
    //the host of the project
    defined("SERVER")
        or define("SERVER", "localhost");
            
    $config = array(
        
        
        //set base Url, to use
        "urls" => array(
            "baseUrl" => "http://tam-anfoodstore.com/"
        ),
        //set Path of nessessary directories that are used in project
        //set the path according to the server link http://localhost/ ...
        "paths" => array(
            //store database
            "database" => ROOT_SERVER . "database/",
            //store include files: to create View of HTML, class and global function
            "includes" => ROOT_SERVER . "includes/",
            //store javascript files to support user interaction with our website
            "js" => ROOT_SERVER . "js/",
            //store library 
            "lib" => ROOT_SERVER . "lib/",
            //store images, sound or flash files
            "media" => ROOT_SERVER . "media/",
            // store the main code of the project (html,php)
            "public_HTML" => ROOT_SERVER . "public_HTML/",
            //store css file
            "style" =>ROOT_SERVER . "style/",
            //store class file (object) used in the project
            "class" =>ROOT_SERVER ."includes/class/",
            //store global function handle the unrelated to class porblem
            "function" =>ROOT_SERVER ."includes/function/",
            //the interface of website will be slit into different views and we store it in view
            "view" =>ROOT_SERVER . "includes/view/",
            //store the images, background,...
            "image" =>ROOT_SERVER . "media/image/"   
        )
    );
    
    function CONFIG_PATH($tmp){
        global $config;
        return $config["paths"][$tmp];
    }
    

/*
    Error reporting.
*/
    ini_set("error_reporting", "true");
    error_reporting(E_ALL|E_STRCT);
    ini_set('default_charset', 'utf-8'); 

?>
