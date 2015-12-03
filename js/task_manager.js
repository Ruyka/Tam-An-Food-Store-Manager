// on document ready load default task
// might need cookie or chace in the near future
// Switch task upon selected task
// function switch_task(task_id) {
// 	var task = document.getElementById(task_id);
// 	var val = task.value;

// 	if(val == "receipt")
// 		$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
// 	else 
// 		$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."blank.php"; ?>');
// }