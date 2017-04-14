// get server application path
task_manager_path = get_path("function","task_manager.php");
// list of option
task_option = get_task_options();
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
	document.getElementById("task1").value = task_option[1][0];

	// reload task for select
	switch_task(1);
}

function get_task_options(){
	var task_options = null;
    $.ajax({
        async: false,
        url: task_manager_path,
        type: "get",
        data: "q="+JSON.stringify({action:'get_task_options'}),
        success: function (option) {
          	task_options = JSON.parse(option);
      }  
  });
    return task_options;
}

// change task name to its coresponding path 
function get_task_path(task){
	for(var i in task_option){
		if(task_option[i][0].localeCompare(task) == 0)
			return task_option[i][1];
	}
	return task_option[0][1];
}

// Switch task upon selected task
function switch_task(task_id) {
	// get element of the select which call the function
	var task_div = document.getElementById("task"+task_id);
	// get the chosen option
	var task = task_div.value;
	// load corresphong task to div
	$("#load"+task_id).load(get_task_path(task));
  // update task with server
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
        console.log(task_id);
      }  
  });
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

// // swap two view
// function exchange_task(){
// 	var temp = document.getElementById("load1").innerHTML;
// 	document.getElementById("load1").innerHTML = document.getElementById("load2").innerHTML;
// 	document.getElementById("load2").innerHTML = temp;

//     $.ajax({
//         async: false,
//         url: task_manager_path,
//         type: "get",
//         data: "q="+JSON.stringify({action:'exchange_task'}),
//         success: function(task){
//         	current_task = task;
//         }
//   });
// }