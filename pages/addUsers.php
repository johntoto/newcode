<?php
$uNameErr = $fNameErr = $idNoErr = $phonNoErr = $emailErr = $cityErr = $addressErr = $passErr = $cPassErr = $activeErr = $accessErr = "";
$uname = $fname = $idNo = $phoneNo = $email = $city = $cId = $run = $address = $pass = $conPass = $active = $access = "";

$conn = getConn();

if (isset($_POST['submit']) && $_POST['submit'] == "Register") {
    if ($_POST['uName'] == "") {
        $uNameErr = "Username is required";
    } else {
        $uNameErr = "";
        $uname = test_input($_POST['uName']);
    }

    if ($_POST['fName'] == "") {
        $fNameErr = "Fullname is required";
    } else {
        $fNameErr = "";
        $fname = ucFirst(test_input($_POST['fName']));
    }

    if (empty($_POST['idNumber'])) {
        $idNoErr = "Id number is required";
    } else {
        $idNoErr = "";
        $idNo = test_input($_POST['idNumber']);
    }

    if (empty($_POST['phoneNo'])) {
        $phonNoErr = "Phone number is required";
    } else {
        $phonNoErr = "";
        $phoneNo = test_input($_POST['phoneNo']);
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $emailErr = "";
        $email = test_input($_POST['email']);
    }

    if (empty($_POST['city']) || $_POST['city'] == "Select City") {
        $cityErr = "City is required";
    } else {
        $cityErr = "";
        $city = test_input($_POST['city']);
    }

    if (empty($_POST['address'])) {
        $addressErr = "Address is required";
    } else {
        $addressErr = "";
        $address = test_input($_POST['address']);
    }

    if (empty($_POST['password'])) {
        $passErr = "Password is required";
    } else {
        $passErr = "";
        $pass = test_input($_POST['password']);
    }

    if (empty($_POST['cPassword'])) {
        $cPassErr = "Confirm Password is required";
    } else {
        $cPassErr = "";
        $conPass = test_input($_POST['cPassword']);
    }
    if($pass !== $conPass)
    {
        $cPassErr = "Confirm Password must equal password";
    }
    elseif (!empty($uname && $fname && $idNo && $email && $city && $address && $phoneNo && $pass && $conPass)) {

        $getuser = "SELECT * FROM user WHERE userName ='$uname'";
        $runuser = mysqli_query($conn, $getuser) or die(mysqli_error($conn));

        $num = mysqli_num_rows($runuser);
        if ($num != 0) {
            $uNameErr = "The username is already taken.";
        } else {
            $uNameErr = "";
            $reg = "INSERT INTO `user` VALUES(Null,'$uname','$fname','$idNo','$email','$city',"
            . "'$address','$phoneNo','$pass','NO','YES')";
            $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

            if ($run) {
                echo "<script>alert('Registration successful')</script>";
                //echo "<script>window.open('','_self')</script>";
                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=login";
                header("Location:" . $redirect);
            }
        }
    }
}

if(isset($_GET['n']) && $_GET['n'] == "edituser")
{
    if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
        $id = $_GET['id'];

        if ($_POST['uName'] == "") {
            $uNameErr = "Username is required";
        } else {
            $uNameErr = "";
            $uname = test_input($_POST['uName']);
        }

        if ($_POST['fName'] == "") {
            $fNameErr = "Fullname is required";
        } else {
            $fNameErr = "";
            $fname = ucFirst(test_input($_POST['fName']));
        }

        if (empty($_POST['idNumber'])) {
            $idNoErr = "Id number is required";
        } else {
            $idNoErr = "";
            $idNo = test_input($_POST['idNumber']);
        }

        if (empty($_POST['phoneNo'])) {
            $phonNoErr = "Phone number is required";
        } else {
            $phonNoErr = "";
            $phoneNo = test_input($_POST['phoneNo']);
        }

        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $emailErr = "";
            $email = test_input($_POST['email']);
        }

       // if (!empty($_POST['city'])) {
           $city = test_input($_POST['city']);
       // }

        if (empty($_POST['address'])) {
            $addressErr = "Address is required";
        } else {
            $addressErr = "";
            $address = test_input($_POST['address']);
        }

        if (empty($_POST['active'])) {
            $activeErr = "Select one option";
        } else {
            $activeErr = "";
            $active = test_input($_POST['active']);
        }

        if (empty($_POST['access'])) {
            $accessErr = "Select one option";
        } else {
            $accessErr = "";
            $access = test_input($_POST['access']);
        }
        
        if(!empty($uname && $fname && $idNo && $email && $city && $address && $phoneNo && $active && $access)) {

            $getuser = "SELECT userName FROM user WHERE userId ='$id'";
            $runuser = mysqli_query($conn, $getuser) or die(mysqli_error($conn));
            $rowuser = mysqli_fetch_array($runuser);
            $CurrentNam = $rowuser['userName'];
           
            if($uname !== $CurrentNam)
            {
                $get_user = "SELECT userName FROM user WHERE userName ='".$uname."'";
                $run_user = mysqli_query($conn, $get_user) or die(mysqli_error($conn));
                $num = mysqli_num_rows($run_user);
           
                if ($num > 0) {
                    $uNameErr = "The username is already taken.";
                }
                else
                {
                    $uNameErr = "";
                    $reg = "UPDATE `user` SET userName='$uname', fullName='$fname',idNumber ='$idNo',email = '$email',city = '$city',address = '$address',phoneNo = '$phoneNo',activated = '$active',administrator = 'access' WHERE userId = '$id'";
                    $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));
                }
            }
            else
            {
                $uNameErr = "";
                $reg = "UPDATE `user` SET userName='$uname', fullName='$fname',idNumber ='$idNo',email = '$email',city = '$city',address = '$address',phoneNo = '$phoneNo',activated = '$active',administrator =    '$access' WHERE userId = '$id' ";
                $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));
            }
        
            if ($run) {

                echo "<script>alert('Update successful')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users','_self')</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>

<html>
<?php
if(isset($_GET['n']) && $_GET['n'] == "edituser")
{
    $id = $_GET['id'];

    $check_user = "SELECT * FROM user WHERE userId = ".$id;
    $res_user = mysqli_query($conn, $check_user) or die(mysqli_error($conn));

    $row_user = mysqli_fetch_array($res_user);

    $userId = $row_user['userId'];
    $uName = $row_user['userName'];
    $fName = ucFirst($row_user['fullName']);
    $email = $row_user['email'];
    $city = $row_user['city'];
    $idNo = $row_user['idNumber'];
    $address = $row_user['address'];
    $phoneNo = $row_user['phoneNo'];
    $active = $row_user['activated'];
    $priv_level = $row_user['administrator'];

    $chec_city = "SELECT cityName FROM city WHERE cityId =".$city;
    $res_city = mysqli_query($conn, $chec_city) or die(mysqli_error($conn));

    $row_city = mysqli_fetch_array($res_city);
    //$cId = $row_city['cityId'];
    $cName = $row_city['cityName'];

?>

    <div class="row">
        <form role="form" action="" method="post">
            <h2 class="text-center">&nbsp;&nbsp;<u><strong>Update your details</strong></u></h2>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">User Name:</label>
                    <span class="span-error"> * <?php echo $uNameErr; ?></span>
                    <input type="text" name="uName" autofocus value="<?php echo $uName; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label class="label-control">Full Name:</label>
                    <span class="span-error"> * <?php echo $fNameErr; ?></span>
                    <input type="text" name="fName" value="<?php echo $fName; ?>" class="form-control" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label class="label-control">ID Number:</label>
                    <span class="span-error"> * <?php echo $idNoErr; ?></span>
                    <input type="text" name="idNumber" value="<?php echo $idNo; ?>" class="form-control" placeholder="ID Number">
                </div>
                <div class="form-group">
                    <label class="label-control">Phone Number:</label>
                    <span class="span-error"> * <?php echo $phonNoErr; ?></span>
                    <input type="text" name="phoneNo" value="<?php echo $phoneNo; ?>" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label class="label-control">Email:</label>
                    <span class="span-error"> * <?php echo $emailErr; ?></span>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Address:</label>
                    <span class="span-error"> * <?php echo $addressErr; ?></span>
                    <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder="Address">
                </div>
                <div class="form-group">
                    <label class="label-control">City:</label>
                    <span class="span-error"> * <?php echo $cityErr; ?></span>
                    <div>
                        <select name="city">
                            <option value="<?php echo $city; ?>"><?php echo $cName; ?></option>
                                <?php
                                $check_city = "SELECT * FROM city";
                                $res_city = mysqli_query($conn, $check_city) or die(mysqli_error($conn));

                                while ($row_city = mysqli_fetch_array($res_city)) {
                                    $citytId = $row_city['cityId'];
                                    $cityName = $row_city['cityName'];
                                   
                                  echo "<option value=" .$citytId. ">". $cityName." </option>";
                             
                                }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-control">Activated:</label>
                    <span class="span-error"> * <?php echo $activeErr; ?></span>
                    <div class="radio">
                        <label></label>
                        <input type="radio" name="active" value="YES">&nbsp; YES   
                    </div>
                    <div class="radio">
                        <label></label>
                        <input type="radio" name="active" value="NO"> &nbsp;NO
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-control">Administrator Access:</label>
                    <span class="span-error"> * <?php echo $accessErr; ?></span>
                    <div class="radio">
                        <label></label>
                        <input type="radio" name="access" value="YES"> &nbsp;YES
                    </div>
                    <div class="radio">
                        <label></label>
                        <input type="radio" name="access" value="NO">&nbsp; NO
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="label-control"></label>
                <div class="col-md-offset-4 col-md-4">
                    <input type="submit" name="submit" class="btn btn-info btn-lg btn-block" value="Update">
                </div>
            </div>
        </form>
    </div>
<?php
}
else
{
?>
    <div class="row">
        <form role="form" action="" method="post">
            <h2 class="text-center">&nbsp;&nbsp;<u><strong>Enter your details to register</strong></u></h2>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">User Name:</label>
                    <span class="span-error"> * <?php echo $uNameErr; ?></span>
                    <input type="text" name="uName" autofocus class="form-control" placeholder="User Name">
                </div>
                <div class="form-group">
                    <label class="label-control">Full Name:</label>
                    <span class="span-error"> * <?php echo $fNameErr; ?></span>
                    <input type="text" name="fName" class="form-control" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <label class="label-control">ID Number:</label>
                    <span class="span-error"> * <?php echo $idNoErr; ?></span>
                    <input type="text" name="idNumber" class="form-control" placeholder="ID Number">
                </div>
                <div class="form-group">
                    <label class="label-control">Phone Number:</label>
                    <span class="span-error"> * <?php echo $phonNoErr; ?></span>
                    <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label class="label-control">Email:</label>
                    <span class="span-error"> * <?php echo $emailErr; ?></span>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">City:</label>
                    <span class="span-error"> * <?php echo $cityErr; ?></span>
                    <div>
                        <select name="city">
                            <option value="Select City">Select City</option>
                                <?php
                                $check_city = "SELECT * FROM city";
                                $res_city = mysqli_query($conn, $check_city) or die(mysqli_error($conn));

                                while ($row_city = mysqli_fetch_array($res_city)) {
                                    $citytId = $row_city['cityId'];
                                    $cityName = $row_city['cityName'];
                                   
                                  echo "<option value=" .$citytId. ">". $cityName." </option>";
                             
                                }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label-control">Address:</label>
                    <span class="span-error"> * <?php echo $addressErr; ?></span>
                    <input type="text" name="address" class="form-control" placeholder="Address">
                </div>
                <div class="form-group">
                    <label class="label-control">Password:</label>
                    <span class="span-error"> * <?php echo $passErr; ?></span>
                    <input type="text" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="label-control">Confirm Password:</label>
                    <span class="span-error"> * <?php echo $cPassErr; ?></span>
                    <input type="text" name="cPassword" class="form-control" placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <label class="label-control"></label>
                    <div class="col-md-6">
                        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Register">
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
    }
?>
</html>
