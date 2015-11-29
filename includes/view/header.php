<!-- Header part of Tam An webpage can import when has include config.php -->
<div id="navbar navbar-default no-print">
   
    <div class = "inner-nav-content">
        <div class="navbar-header">
            <div class = "navbar-brand">
                <div id="logodiv">
                    <img id="logo" src="<?php echo CONFIG_PATH('image')."logo.jpg"?>"  />         
                </div>            
            </div>
            
            <button type="button" class="navbar-toggle" data-toggle="collapse" 
                                                        data-target=".navbar-collapse" style="margin-top:0px;padding-top:0px">
                <div id="sign-in" >
                    <?php 
                        $logouturl = CONFIG_PATH('public_HTML'). 'log-out/';
                        if (isset($USER_NAME))
                            echo $USER_NAME."<br \>"
                            .'<a tabindex="-1" style = "float:right" href="'.$logouturl.'">Log Out</a>';
                    ?>
                    
                </div>
                
            </button>

        </div>
        
        <div class = "collapse navbar-collapse">
           
           <div class="inner-collapse">
                <div id ="header"><p> ORGANICFOOD <span id="VN"> VIỆT NAM </span> </p></div>
                
                <ul id="sign-in" class="nav navbar-nav">
 
                    <li>
                        <div >
                            <?php 
                                $logouturl = CONFIG_PATH('public_HTML'). 'log-out/';
                                if (isset($USER_NAME))
                                    echo $USER_NAME."<br \>"
                                    .'<a tabindex="-1" style = "float:right" href="'.$logouturl.'">Log Out</a>';
                            ?>
                            
                        </div>
                    </li>                 
                </ul>
                
            </div>
        </div>
    </div>
   

   
</div>