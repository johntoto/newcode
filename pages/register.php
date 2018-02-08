<?php
$uNameErr = $fNameErr = $idNoErr = $phonNoErr = $emailErr = $cityErr = $addressErr = $passErr = $cPassErr = "";
$uname = $fname = $idNo = $phoneNo = $email = $city = $address = $pass = $conPass = "";

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
        $fname = test_input($_POST['fName']);
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

    if ($_POST['city'] == "Select City") {
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
        $cPass = test_input($_POST['cPassword']);
        if($cPass !== $pass)
        {
            $cPassErr = "Confirm Password must equal password";
        }
        else{
            $conPass = test_input($_POST['cPassword']);
        }
    }
    if (!empty($uname && $fname && $idNo && $email && $city && $address && $phoneNo && $pass && $conPass)) {

        $getuser = "SELECT * FROM user WHERE userName ='$uname'";
        $runuser = mysqli_query($conn, $getuser) or die(mysqli_error($conn));

        $num = mysqli_num_rows($runuser);
        if ($num != 0) {
            $uNameErr = "The username is already taken.";
        } else {
            $uNameErr = "";
//changed code        
            $time = date("Y-m-d");
            $reg = "INSERT INTO `user` VALUES(Null,'$uname','$fname','$idNo','$email','$city','$city','$address','$phoneNo','$time','$pass','NO','YES','2')";
            $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

            if ($run) {
               // echo "<script>alert('Registration successful')</script>";
//end changed code              
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=login','_self')</script>";
                //$redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=login";
                //header("Location:" . $redirect);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

    <div class="container top">
        <form role="form" action="" method="post">
            <h2 class="text-center text">&nbsp;&nbsp;<u><strong>Enter your details to register</strong></u></h2>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">User Name:</label>
                    <span class="span-error"> * <?php echo $uNameErr; ?></span>
                    <input type="text" name="uName" class="form-control" autofocus placeholder="User Name">
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
                    <select name="city" class="form-control">
                        <b><option value="Select City">Select City</option></b>
                        <?php 
                            $get_city = "SELECT * FROM city ";
                            $res_city = mysqli_query($conn,$get_city) or die(mysqli_error($conn));
                            
                            while($num_row = mysqli_fetch_array($res_city))
                            {
                                $city_id = $num_row['cityId'];
                                $city_name = $num_row['cityName'];
                                
                                echo "<option value='$city_id'>$city_name</option>";
                            }
                        
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="label-control">Address:</label>
                    <span class="span-error"> * <?php echo $addressErr; ?></span>
                    <input type="text" name="address" class="form-control" placeholder="Address">
                </div>
                <div class="form-group">
                    <label class="label-control">Password:</label>
                    <span class="span-error"> * <?php echo $passErr; ?></span>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="label-control">Confirm Password:</label>
                    <span class="span-error"> * <?php echo $cPassErr; ?></span>
                    <input type="password" name="cPassword" class="form-control" placeholder="Confirm password">
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

</html>
