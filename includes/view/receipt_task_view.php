<?php 
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 

?>

<script type="text/javascript" src="<?php echo CONFIG_PATH('js')."receipt_function.js"; ?>"></script>
<script type="text/javascript" src="<?php echo CONFIG_PATH('lib')."sorttable.js"; ?>"></script>

<div class="receipt-view" id="generate"></div>
