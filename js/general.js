// config url location
var url = window.location.href;
url = url.split("/");
config_url = "http://"+url[2]+"/Tam-An-Food-Store-Manager/includes/function/general_function.php";


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