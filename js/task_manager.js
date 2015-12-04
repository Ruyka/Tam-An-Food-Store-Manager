// get server application path
task_manager_path = get_path("function","task_manager.php");
// list of option
task_option = ["receipt", "alter-product"];
// coresponding text for each option
task_option_text = ["In hóa đơn", "Quản lý sản phẩm"];
// get the number of option
option_num = task_option.length;

// function execute on form ready
$(document).ready(function(){
	// execute default task
	task_init();
});

// default function which only called once
function task_init(){	
	// set value to select
	document.getElementById("task1").value = task_option[0];
	document.getElementById("task2").value = task_option[1];

	// reload task for select
	switch_task(1);
	switch_task(2);
}

// change task name to its coresponding path 
function get_task_path(task){
	var path = null;
	switch(task){
		case 'receipt':
		// if task is "receipt" then get path of "receipt_task_view.php"
		path = get_path("view","receipt_task_view.php");
		break;
		case 'alter-product':
		// if task is "product" then get path of "alter_product_task_view.php"
		path = get_path("view","alter_product_task_view.php");
		break;
		default:
		// if none matched return "blank.php"
		path = get_path("view","blank.php");
	}
	return path;
}

// Switch task upon selected task
function switch_task(task_id) {
	// get element of the select which call the function
	var task_div = document.getElementById("task"+task_id);
	// get the chosen option
	var task = task_div.value;
	
	// load corresphong task to div
	$("#load"+task_id).load(get_task_path(task));
	// update it to session for easier identification later
	update_taskid_task(task_id, task);

	// remove the option of that task on the other div
	toggle_options_list(task_id, task);
}

// hide or un-hide option
function toggle_options_list(task_id, task){
	// get the other task id
	var task2_id = task_id == 1 ? 2 : 1;

	// remove class hide of previous hided option
	if($("#task"+task2_id).children(".hide").length != 0)
		$("#task"+task2_id).children(".hide").toggleClass('hide');

	// hide the option
	$("#task"+task2_id+" option[value='"+task+"']").toggleClass('hide');
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

// reload task without reload page
function reload_task(task){
	// get id of the task
	var task_id = get_taskid_from_task(task);
	// check if it's valid id
	if(task_id != -1 && !isNaN(task_id)){
		task_id = parseInt(task_id) + 1;
		// reload the task
		$("#load"+task_id).load(get_task_path(task));
	}
	else
		// if there is no such task, show toast
		make_toast('there is no such task', 3000);
}

// update session of the current task
function update_taskid_task(task_id, task){
    $.ajax({
        async: false,
        url: task_manager_path,
        type: "get",
        data: "q="+JSON.stringify({action:'update_taskid_task', id:task_id, 'task':task})
  });
}

// get current task of corresponding id
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