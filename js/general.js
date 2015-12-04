// config url location
var url = window.location.href;
url = url.split("/");
config_url = "http://"+url[2]+"/Tam-An-Food-Store-Manager/includes/function/general_function.php";

// get list pf product from database
function get_list_of_product(){
    var tmp = null;
    $.ajax({
        async: false,
        url: get_path('function','receipt_function.php'),
        type: "get",
        data: "q="+JSON.stringify({action:'get_receipt_data_from_server'}),
        success: function (data) {
          tmp = JSON.parse(data);
      }  
    });
    var list_of_product;
    if (typeof tmp['list_product'] !== 'undefined') {
        // the variable is defined
        list_of_product = tmp['list_product'];
    }
    else{
        list_of_product = "";
    }
    return list_of_product;
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

