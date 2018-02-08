<?php

$uNameErr = $fNameErr = $idNoErr = $phonNoErr = $emailErr = $cityErr = $addressErr = $passErr = $cPassErr = $activeErr = $accessErr = "";
$uname = $fname = $idNo = $phoneNo = $email = $city = $cId = $run = $address = $pass = $conPass = $active = $access = "";

 if (isset($_POST['submit']) && $_POST['submit'] == "Edit profile") {
        $id =  $_SESSION['loginId'];

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

        if (!empty($_POST['city'])) {
           $city = test_input($_POST['city']);
        }

        if (empty($_POST['address'])) {
            $addressErr = "Address is required";
        } else {
            $addressErr = "";
            $address = test_input($_POST['address']);
        }

        if (empty($_POST['town'])) {
            $townErr = "This is required";
        } else {
            $townErr = "";
            $town = test_input($_POST['town']);
        }

        

        if (!empty($_POST['password'])) {
         	$pass = $_POST['password'];
         	$confPass = $_POST['confPass'];
         	if($pass !== $confPass)
         	{
         		echo "<script>alert('The passwords must be equal')</script>";
         	}
         	else
         	{
         		$password = $_POST['password'];
         	}
        }
        
        if(!empty($uname && $fname && $idNo && $email && $city && $address && $phoneNo  && $town)) {

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
                  echo  $reg = "UPDATE `user` SET userName='$uname', fullName='$fname',idNumber ='$idNo',email = '$email',city = '$city',town = '$town',address = '$address',phoneNo = '$phoneNo',password = '$password' WHERE userId = '$id'";
                    $run = mysqli_query($conn, $reg) or die("Could not be updated" . mysqli_error($conn));
                }
            }
            else
            {
                $uNameErr = "";
               echo $reg = "UPDATE `user` SET userName='$uname', fullName='$fname',idNumber ='$idNo',email = '$email',city = '$city',town = '$town',address = '$address',phoneNo = '$phoneNo',password = '$password' WHERE userId = '$id' ";
                $run = mysqli_query($conn, $reg) or die("Could not be updates" . mysqli_error($conn));
            }
        
            if ($run) {
            	if($_SESSION['access'] == "YES")
            	{
            		echo "<script>alert('Update successful')</script>";
                	echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin','_self')</script>";
            	}
            	else
            	{
            		echo "<script>alert('Update successful')</script>";
                	echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=home','_self')</script>";
            	}
            }
        }
    }

?>
<?php

	$conn = getConn();

	$priv_lev = $_SESSION['access'];

	if($priv_lev == "YES")
	{
		//leftPartAdmin();
	}
	else
	{
		//leftPartUser();
	}

	$name = $_SESSION['name'];

	$get_user = "SELECT * FROM user WHERE userName = '$name'";
	$res = mysqli_query($conn,$get_user) or die(mysqli_error($conn));
	$row = mysqli_fetch_array($res);

	$uName = $row['userName'];
	$fName = $row['fullName'];
	$idNumber = $row['idNumber'];
	$email = $row['email'];
	$phone = $row['phoneNo'];
	$city = $row['city'];
	$add = $row['address'];
	$town = $row['town'];

	$get_city = "SELECT * FROM city WHERE cityId = '$city'";
	$res = mysqli_query($conn,$get_city) or die(mysqli_error($conn));
	$row = mysqli_fetch_array($res);
	$city = $row['cityName'];
	$city_id = $row['cityId'];
?>

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-1"></div>
			<div class="col-md-10 card-edit">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<h2>Personal Details</h2>
							</tr>
						</thead>
						<tbody>
							<form method="post">
								<tr>
									<td>UserName:</td>
									<td><input type="text" class="form-control" name="uName" value="<?php echo $uName; ?>"></td>
								</tr>
								<tr>
									<td>Full Name:</td>
									<td><input type="text" class="form-control" name="fName" value="<?php echo $fName; ?>"></td>
								</tr>
								<tr>
									<td>Id Number:</td>
									<td><input type="text" class="form-control" name="idNumber" value="<?php echo $idNumber; ?>"></td>
								</tr>
								<tr>
									<td>Email:</td>
									<td><input type="text" class="form-control" name="email" value="<?php echo $email; ?>"></td>
								</tr>
								<tr>
									<td>Address:</td>
									<td><input type="text" class="form-control" name="address" value="<?php echo $add; ?>"></td>
								</tr>
								<tr>
									<td class="">Phone Number:</td>
									<td><input type="text" class="form-control" name="phoneNo" value="<?php echo $phone; ?>"></td>
								</tr>
								<tr class="form-group">
				                    <td class="label-control">City:</td>
				                    <td>
				                        <select name="city">
				                            <option value="<?php echo $city_id; ?>"><?php echo $city; ?></option>
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
				                        </td>
				                </tr>
								<tr>
									<td>Town:</td>
									<td><input type="text" class="form-control" name="town" value="<?php echo $town; ?>"></td>
								</tr>
								<tr>
									<td>Password:</td>
									<span style="color: red;"><?php echo $passErr; ?></span>
									<td><input type="text" class="form-control" name="password"></td>
								</tr>
								<tr>
									<td>Confirm Password:</td>
									<td><input type="text" class="form-control" name="confPass"></td>
								</tr>
								<tr>
									<td colspan='2' class="text-center">
										<input type="submit" name="submit" class="btn btn-info" value="Edit profile" style="color: #fff;font-weight: bold;">
									</td>
								</tr>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<div style="margin-left: 200px">
	<?php include_once "includes/footer.php" ?>

</div>