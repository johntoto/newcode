<?php
// check the validatidy of us if the user exists
$login_error = '';
$epr = '';

if (isset($_POST['submit']) && $_POST['submit'] == "Login") {
    $conn = getConn();

    $name = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($name) && !empty($password)) {
        $check_user = "SELECT * FROM user WHERE userName = '$name' && activated = 'YES'";
        $res_user = mysqli_query($conn, $check_user) or die(mysqli_error($conn));

        $row_user = mysqli_fetch_array($res_user);

        $userId = $row_user['userId'];
        $user_name = $row_user['userName'];
        $user_password = $row_user['password'];
        $priv_level = $row_user['administrator'];

        if ($user_name == $name && $user_password == $password) {
            $_SESSION['loginId'] = $userId;
            $_SESSION['name'] = $user_name;
            $_SESSION['access'] = $priv_level;

            if ($priv_level == "YES") {
                
                $redirect = htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=home";
                header('Location:' . $redirect);
            } else {
                $redirect = htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=home";
                header('Location:' . $redirect);
            }
        } else {

            $login_error = "Wrong username or password";
        }
    } else {
        $login_error = "Enter username and password";
    }
}

if(isset($_POST['submit']) && $_POST['submit'] == "Reset")
{
    $resEmail = $_POST['resetEmail'];

    $check_em = "SELECT * FROM user WHERE email = '$resEmail'";
    $res_em = mysqli_query($conn, $check_em) or die(mysqli_error($conn));

    $row_num = mysqli_num_rows($res_em);

    if($row_num == 0)
    {
        echo "<script>window.alert('No account is associated with this email')</script>";
    }
    else
    {
        $arr = uniqid();
        $to = $resEmail;
        $subject = "Online marketer Password reset";
        $body = "You requested to change your password. If its not you, please contact us. You can login and change your password. \n \n Your new password is :".$arr;
        $from = "noreply@onlinemarketer.com";

        if(mail($to, $subject, $body,'From:$from'))
        {
            $change_pass = "UPDATE user SET password = '$arr' WHERE email LIKE '$resEmail'";
            $res_pass = mysqli_query($conn,$change_pass) or die(mysqli_error($conn));
            if($res_pass)
            {
                echo "<script>window.alert('Check your email for the reset email.')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=login',_self')</script>";   
            }
        }
        else
        {
            echo "<script>window.alert('Check your internet connection and try again.')</script>";
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=login',_self')</script>";
        }


    }
}
?>
<html>
    <body class="login-page">
    
        <div class="container top" id="login">
            <div class="row">
                <div class="col-md-1"></div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=login" method="post">
                    <div class="col-md-10">
                        <fieldset class="">
                            <legend>Login</legend>
                            <div class="form-horizontal">
                                <span style="color:red"><?php echo $login_error; ?></span>
                                <div class="form-group">
                                    <label for="username" class="control-label">Username:</label>
                                    <input type="text" id="username" name="username"autofocus class="form-control col-md-4" placeholder="Enter your username">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control " placeholder="Enter your password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" name="submit" class="btn btn-success" value="Login">
                                    <span class="pull-right"><a href="" data-toggle="modal" data-target="#modal-login">Forgot Password</a></span>
                                    <p>If you don't have an account <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=register">click here</a> to register.</p>
                                </div>
                            </div>     
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal" id="modal-login">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h3 class="text-center">Reset your Password</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <label class="control-label">Email : </label>
                                <input type="text" class="form-control" name="resetEmail" style="font-style: italic" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info" name="submit" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>