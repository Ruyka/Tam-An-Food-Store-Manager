// get server application path
task_manager_path = get_path("function","task_manager.php");
// list of option
task_option = ["receipt", "alter-product"];
// coresponding text for each option
task_option_text = ["In hóa đơn", "Quản lý sản phẩm"];
// get the number of option
option_num = task_option.length;

function get_task_path(task){
	var path = null;
	switch(task){
		case 'receipt':
		path = get_path("view","receipt_task_view.php");
		break;
		case 'alter-product':
		path = get_path("view","alter_product_task_view.php");
		break;
		default:
		path = get_path("view","blank.php");
	}
	return path;
}

// Switch task upon selected task
function switch_task(task_id) {
	var task_div = document.getElementById("task"+task_id);
	var task = task_div.value;
	
	$("#load"+task_id).load(get_task_path(task));
	update_taskid_task(task_id, task);
}

function get_taskid_from_task(task){
	var task_id = null;
    $.ajax({
        async: false,
        url: task_manager_path,
        type: "get",
        data: "q="+JSON.stringify({action:'get_taskid_from_task', 'task':task}),
        success: function (id) {
          	task_id = id;
      }  
  });
		console.log(task_id)
    return task_id;
}

function reload_task(task){
	var task_id = get_taskid_from_task(task);
	if(task_id != -1 && !isNaN(task_id)){
		task_id = parseInt(task_id) + 1;
		console.log(task_id)
		$("#load"+task_id).load(get_task_path(task));
	}
	else
		make_toast('there is no such task', 3000);
}

function update_taskid_task(task_id, task){
    $.ajax({
        async: false,
        url: task_manager_path,
        type: "get",
        data: "q="+JSON.stringify({action:'update_taskid_task', id:task_id, 'task':task})
  });
}

function get_current_task(task_id){
	var current_task = null;
    $.ajax({
        async: false,
        url: task_manager_path,
        type: "get",
        data: "q="+JSON.stringify({action:'get_current_task', id:task_id}),
        success: function(task){
        	current_task = task;
        }
  });
    return current_task;
}