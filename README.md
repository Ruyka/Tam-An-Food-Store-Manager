 # Tam-An-Food-Store-Manager
CS300 project-1-1516, group 6

####CODE PRINCIPLE:
1. must include config file at the begin of file as followed:
<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

2. include the nessary file using require_once or include:
<?php include(DATABASE_PATH . "filename.abc");?>
<?php include(JAVASCRIPT_PATH . "filename.abc");?>
<?php include(LIBRARY_PATH . "filename.abc");?>
<?php include(IMAGE_PATH . "filename.abc");?>
<?php include(PUBLIC_HTML_PATH . "filename.abc");?>
<?php include(STYLE_PATH . "filename.abc");?>
<?php include(CLASS_PATH . "filename.abc");?>
<?php include(FUNCTION_PATH . "filename.abc");?>
<?php include(VIEW_PATH . "filename.abc");?>
<?php include(IMAGE_PATH . "filename.abc");?>


3. include the href link or src link by called CONFIG:

<?php echo CONFIG_PATH('style')."filename.css";?>
<?php echo CONFIG_PATH('image')."filename.abc";?>
...
--------------------------------------------------------|
4. PLEASE PLACE CODE IN RIGHT DIRECTORIES:				|
	-database: for database files						|
	-includes/view: templates, part of html/php files	|
	-includes/class: class object						|
	-includes/function: global function					|
	-js: javascript, jquery code						|
	-lib: libraries										|
	-media/image: images								|
	-public_HTML: php, html code						|
	-style: css files 									|
--------------------------------------------------------|