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
                      <div  id="register"  class="animate form">
                        <!-- change to login page on success sign up account-->
                          <form  action="validate_sign_up.php" autocomplete="on" method = "POST"> 
                              <h1> Sign up </h1> 
                              <p> 
                                  <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                  <input id="usernamesignup" name="username" required="required" type="text" placeholder="my username" />
                              </p>
                              <p> 
                                  <label for="usernamesignup" class="uname" data-icon="u">Your name</label>
                                  <input id="usernamesignup" name="name" required="required" type="text" placeholder="my name" />
                              </p>
                              <p> 
                                  <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                  <input id="emailsignup" name="email" required="required" type="email" placeholder="my email"/> 
                              </p>
                              <p> 
                                  <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                  <input id="passwordsignup" name="password" required="required" type="password" placeholder="my password"/>
                              </p>
                              <p> 
                                  <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                  <input id="passwordsignup_confirm" name="password_confirm" required="required" type="password" placeholder="confirm password"/>
                              </p>
                              <p class="signin button"> 
                                  <input type="submit" value="Sign up" name ="request"/> 
                              </p>
                              <p class="change_link">  
                                  Already a member ?
                                  <a href="<?php echo CONFIG_PATH('public_HTML')."login";?>" class="to_register"> Go and log in </a>
                              </p>
                          </form>
                      </div>
                  </div>
              </div>  
           
            </section>
        </div>
    </body>
</html>