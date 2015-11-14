<?php 
$option = isset($_POST['task1']) ? $_POST['task1'] : false;
if($option){
	echo "HIT";
	exit;
}
else{
	echo "MISS";
	exit;
}
echo "TODO: switch_task automatically";
?>

