<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
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
                              <h1>Log in</h1> 
                              <p> 
                                  <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                  <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                              </p>
                              <p> 
                                  <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                  <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                              </p>
                              <p class="keeplogin"> 
                                  <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                  <label for="loginkeeping">Keep me logged in</label>
                              </p>
                              <p class="login button"> 
                                  <input type="submit" value="Login" /> 
                              </p>
                              <p class="change_link">
                                  Not a member yet ?
                                  <a href="<?php echo CONFIG_PATH('public_HTML')."sign-up";?>" class="to_register">Join us</a>
                              </p>
                          </form>
                      </div>
                  </div>
              </div>  
           
            </section>
        </div>
    </body>
</html>