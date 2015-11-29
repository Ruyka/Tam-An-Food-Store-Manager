<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
  require_once(FUNCTION_PATH."check_sign_in.php");
  require_once(VIEW_PATH. "head.php");
  require_once(VIEW_PATH. "header.php");
?>


  <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        
        <link rel="shortcut icon" href="../favicon.ico"> 
        
        <link rel="stylesheet" type="text/css" 
                            href="<?php echo CONFIG_PATH('style')."login/demo.css" ?>"/>
        <link rel="stylesheet" type="text/css" 
                            href="<?php echo CONFIG_PATH('style')."login/style.css" ?>" />
        <link rel="stylesheet" type="text/css" 
                                href="<?php echo CONFIG_PATH('style')."login/animate-custom.css" ?>"/>
    </head>
    <body style = "background-color : #C6E2FF;">
        <div class="container">
            <section>  
                  
              <div id="container_demo" class = "vertical-center" >
                  <div id="wrapper">
                      <div id="login" class="animate form">
                          <form  action="<?php echo CONFIG_PATH('public_HTML');?>" autocomplete="on" method = "POST"> 
                              <h1>Xin Chào</h1> 
                              <p> 
                                  <label for="username" class="uname" data-icon="u" > Tên đăng nhập </label>
                                  <input id="username" name="username" required="required" type="text" placeholder="Tên đăng nhập"/>
                              </p>
                              <p> 
                                  <label for="password" class="youpasswd" data-icon="p"> Mật khẩu </label>
                                  <input id="password" name="password" required="required" type="password" placeholder="Mật khẩu" /> 
                              </p>
                              <p class="keeplogin"> 
                                  <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                  <label for="loginkeeping">Keep me logged in</label>
                              </p>
                              <p class="login button"> 
                                  <input type="submit" value="Đăng Nhập" /> 
                              </p>
                              <p class="change_link">
                                  
                              </p>
                          </form>
                      </div>
                  </div>
              </div>  
           
            </section>
        </div>
    </body>
</html>