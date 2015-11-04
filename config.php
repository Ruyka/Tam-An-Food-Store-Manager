<?php
 
/*
    The important thing to realize is that the config file should be included in every
    page of your project, or at least any page you want access to these settings.
    This allows you to confidently use these settings throughout a project because
    if something changes such as your database credentials, or a path to a specific resource,
    you'll only need to update it here.
*/
    //store database
    defined("DATABASE_PATH")
        or define("DATABASE_PATH", realpath(dirname(__FILE__) . '/database' ));            
    //store include files: to create View of HTML, class and global function
    defined("INCLUDES_PATH")
        or define("INCLUDES_PATH", realpath(dirname(__FILE__) . '/includes' ));
    //store javascript files to support user interaction with our website
    defined("JAVASCRIPT_PATH")
        or define("JAVASCRIPT_PATH", realpath(dirname(__FILE__) . '/js' ));        
    //store library 
    defined("LIBRARY_PATH")
        or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/lib' ));
    //store images, sound or flash files
    defined("MEDIA_PATH")
        or define("MEDIA_PATH", realpath(dirname(__FILE__) . '/media' ));
    // store the main code of the project (html,php)
    defined("PUBLIC_HTML_PATH")
        or define("PUBLIC_HTML_PATH", realpath(dirname(__FILE__) . '/public_HTML' ));
    //store css file
    defined("STYLE_PATH")
        or define("STYLE_PATH", realpath(dirname(__FILE__) . '/style' ));
    //store class file (object) used in the project
    defined("CLASS_PATH")
        or define("CLASS_PATH", realpath(dirname(__FILE__) . '/class' ));
    //store global function handle the unrelated to class problem
    defined("CLASS_PATH")
        or define("CLASS_PATH", realpath(dirname(__FILE__) . '/includes/function' ));
        
    //the interface of website will be slit into different views and we store it in view
    defined("VIEW_PATH")
        or define("VIEW_PATH", realpath(dirname(__FILE__) . '/includes/view' ));
        
    //store the images, background,...
    defined("IMAGE_PATH")
        or define("IMAGE_PATH", realpath(dirname(__FILE__) . '/media/image' ));
    
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
    //root path
    defined("ROOT_PATH")
    	or define("ROOT_PATH",$_SERVER["DOCUMENT_ROOT"] . PROJECT);
	
    $config = array(
        //database infomation
        //we use the localhost to build our project
        "db" => array(
            "dbname" => "Tam_An_Food_Store_Manager",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
            
        ),
        //set base Url, to use
        "urls" => array(
            "baseUrl" => "http://tam-anfoodstore.com/"
        ),
        //set Path of nessessary directories that are used in project
        "paths" => array(
            //store database
            "database" => $_SERVER["DOCUMENT_ROOT"] . PROJECT . "database",
            //store include files: to create View of HTML, class and global function
            "includes" => $_SERVER["DOCUMENT_ROOT"] . PROJECT . "includes",
            //store javascript files to support user interaction with our website
            "js" => $_SERVER["DOCUMENT_ROOT"] . PROJECT . "js",
            //store library 
            "lib" => $_SERVER["DOCUMENT_ROOT"] . PROJECT . "lib",
            //store images, sound or flash files
            "media" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "media",
            // store the main code of the project (html,php)
            "public_HTML" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "public_HTML",
            //store css file
            "style" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "style",
            //store class file (object) used in the project
            "class" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "/includes/class",
            //store global function handle the unrelated to class porblem
            "function" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "/includes/function",
            //the interface of website will be slit into different views and we store it in view
            "view" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "/includes/view",
            //store the images, background,...
            "image" =>$_SERVER["DOCUMENT_ROOT"] . PROJECT . "media/image"   
        )
    );
 
    


/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 

?>
