// on document ready load default task
// might need cookie or chace in the near future
$(document).ready(function(){
	$("#task1").parent().find("div.load").load(get_path("view","receipt_task_view.php"));
});
// Switch task upon selected task
function switch_task(task_id) {
	var task = document.getElementById(task_id);
	var val = task.value;
		
	if(val.localeCompare("receipt")==0)
		$("#"+task_id).parent().find("div.load").load(get_path("view","receipt_task_view.php"));
	else if (val.localeCompare("alter-product")==0)
		$("#"+task_id).parent().find("div.load").load(get_path("view","alter_product_task_view.php"));
	else
		$("#"+task_id).parent().find("div.load").load(get_path("view","blank.php"));
}

function get_task