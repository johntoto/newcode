<style>
    .mee {
        color: white;
    }
</style>
<body data-spy="scroll" data-target="myNavbar">
    <header>
        <nav class="navbar navbar-inverse  navbar-fixed-top" role="navigation"> 
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="" class="nav navbar-brand">Online Marketer</a>
                </div>
                <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?q=home">Home page</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?q=contact" >Contact</a></li>
                         <li>
                             <?php
                                if(isset($_SESSION['name']))
                                {
                                    if(isset($_SESSION['access']) && $_SESSION['access'] == "YES")
                                    {
                                        echo "<a href=\"". $_SERVER['PHP_SELF']."?q=admin&r=home\" >Portal</a>";
                                    }
                                    else 
                                    {
                                        echo "<a href=\"". $_SERVER['PHP_SELF']."?q=user&r=home\" >Portal</a>";
                                    }
                                    
                                }
                             ?>
                        </li>
                        <li>
                            <?php if(isset($_SESSION['name']))
                            {
                                echo "<a href=\"". $_SERVER['PHP_SELF']."?q=logout\" >Log Out</a>";
                            }
                            else
                            {
                                echo "<a href=\"". $_SERVER['PHP_SELF']."?q=login\" >Login</a>";
                            }
                           ?>
                            
                        </li>
                       
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>

   