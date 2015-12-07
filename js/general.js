
// config url location
var url = window.location.href;
url = url.split("/");
config_url = "http://"+url[2]+"/Tam-An-Food-Store-Manager/includes/function/general_function.php";


// get list pf product from database
function get_list_of_product(query){
    // if there is no query, get list of product from receipt function
    if(typeof query === 'undefined'){
        function_file_name = 'receipt_function.php';
        send_action = 'get_receipt_data_from_server';
    }
    //else get data from function in alter_product_function 
    else{
        function_file_name = 'alter_product_function.php';
        send_action = 'get_data_with_query_from_server';
    }
    //AJAX, send GET
    var tmp = null;
    $.ajax({
        async: false,
        url: get_path('function',function_file_name)+"?q="+JSON.stringify({action:send_action}),
        type: "post",
        data: {query:query},
        success: function (data) {
          tmp = JSON.parse(data);

      }  
    });
    //return list of product
    var list_of_product;
    if (typeof tmp['list_product'] !== 'undefined') {
        // the variable is defined
        return tmp['list_product'];
    }
    return tmp['error'];
}

function save_alter_change(array_product){
    //AJAX, send GET
    function_file_name = 'alter_product_function.php';
    send_action = 'push_alter_product_data_to_server';
    var tmp = null;
    $.ajax({
        async: false,
        url: get_path('function',function_file_name)+"?q="+JSON.stringify({action:send_action}),
        type: "post",
        data: {array_product:JSON.stringify(array_product)},
        success: function (data) {

        }  
    });

}

function save_new_product(array_product){
    //AJAX, send GET
    function_file_name = 'alter_product_function.php';
    send_action = 'push_new_product_data_to_server';
    var tmp = null;
    $.ajax({
        async: false,
        url: get_path('function',function_file_name)+"?q="+JSON.stringify({action:send_action}),
        type: "post",
        data: {array_product:JSON.stringify(array_product)},
        success: function (data) {
          
        }  
    });
}
// get path
function get_path(direc, f){
	var path = "";
	$.ajax({
		async: false,
		url: config_url,
		type: "post",
		data: {action:'JS_CONFIG_PATH', directory: direc, file: f},
		success: function (data) {
			path = data;
		}  
	});
	return path;
}

function get_username(){
	// get user name
	var user_name = "";
	$.ajax({
	    async: false,
	    url: config_url,
	    type: "post",
	    data: {action:'get_username'},
	    success: function (data) {
	      user_name = data;
        }  
	});
	return user_name;
}

// function to make a toast like in android
function make_toast(Msg,time){
    // set message
    $("#toast").html(Msg);
    // set toast time
    $("#toast").fadeIn(400).delay(time).fadeOut(400);
}

$(document).ready(function(){
    make_toast("Xin Chào "+get_username()+". Chúc một ngày tốt lành!", 3000);
});