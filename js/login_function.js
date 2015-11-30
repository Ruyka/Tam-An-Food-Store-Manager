
//prevent the login form to reload 
$(document).ready(function(){
    $("#login-form").submit(function(event){
      event.preventDefault();
  });
});

// config url location
var url = window.location.href;
url = url.split("/");
config_url = "http://"+url[2]+"/Tam-An-Food-Store-Manager/includes/function/general_function.php";

// get check_sign_in.php path
login_path = null;
$.ajax({
    async: false,
    url: config_url,
    type: "post",
    data: {action:'JS_CONFIG_PATH', directory:'function', file:'check_sign_in.php'},
    success: function (data) {
      login_path = data;
  }  
});


//check the sign in of user
//if sign in error return the message
function check_sign_in(){
    login_message = null;
    $.ajax({
        async: false,
        url: login_path,
        type: "post",
        //put in username and password
        data: {username:$("#username").val(), password:$("#password").val()},
        success: function (data) {
          login_message = data;
      }  
    });
    //if login message appear then we have an error
    obj_msg = JSON.parse(login_message);
    login_message = obj_msg.message;

    if (login_message.localeCompare("")!=0){ 
      $("#error_message").hide("fast");
      $("#error_message").html(login_message);
      $("#error_message").show("fast");
      $("#password").focus();
      $("#password").html("");
    }
    //else we redirect to HOME page
    else
    {
        home_path = null;
        $.ajax({
            async: false,
            url: config_url,
            type: "post",
            data: {action:'JS_CONFIG_PATH', directory:'public_HTML', file: ''},
            success: function (data) {
              home_path = data;
            }  
        });
        window.location.replace(home_path);
    }
}
