<?php
$busNameErr = $profPicErr = $categErr = $sloganErr = $descErr = $emailErr = $townErr = $addressErr = $phoneNoErr = "";
$busName = $town = $prod_image = $run_upd = $email ="";

$categErr = "";

$conn = getConn();

if (isset($_POST['submit']) && $_POST['submit'] == "Register Business") {
    if ($_POST['busName'] == "") {
        $busNameErr = "Business name is required";
    } else {
        $busNameErr = "";
        $busName = test_input($_POST['busName']);
    }

    if ($_POST['town'] == "Select town") {
        $townErr = "Select a town";
    } else {
        $townErr = "";
        $town = test_input($_POST['town']);
    }

    if ($_POST['category'] == "Select category") {
        $categErr = "Select a Category";
    } else {
        $categErr = "";
        $categ = test_input($_POST['category']);
    }

    if (empty($_POST['phoneNo'])) {
        $phoneNoErr = "Phone number is required";
    } else {
        $phoneNoErr = "";
        $phoneNo = test_input($_POST['phoneNo']);
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $emailErr = "";
        $email = test_input($_POST['email']);
    }

    if (empty($_POST['web'])) {
        $webErr = "web is required";
    } else {
        $webErr = "";
        $web = test_input($_POST['web']);
    }

    if (empty($_POST['slogan'])) {
        $sloganErr = "Slogan is required";
    } else {
        $sloganErr = "";
        $slogan = test_input($_POST['slogan']);
    }

    if (empty($_FILES['picha']['name'])) {
        $profPicErr = "Profile Picture is required";
    } else {
        $profPicErr = "";
        $prod_image = $_FILES['picha']['name'];
    }

    if (empty($_POST['address'])) {
        $addressErr = "Address is required";
    } else {
        $addressErr = "";
        $address = test_input($_POST['address']);
    }

    if (empty($_POST['desc'])) {
        $descErr = "Description is required";
    } else {
        $descErr = "";
        $desc = test_input($_POST['desc']);
    }

    $userId = $_SESSION['loginId'];

    if (!empty($busName && $slogan && $categ && $desc && $address && $phoneNo && $userId && $prod_image && $town && $web)) {
        
            $prod_image = $_FILES['picha']['name'];
            $prod_image_tmp = $_FILES['picha']['tmp_name'];

            move_uploaded_file($prod_image_tmp, 'E:\xampp\htdocs\webmarketer\images\uploads/' . $prod_image);

            $getBus = "SELECT * FROM businesses WHERE businessName ='$busName'";
            $runBus = mysqli_query($conn, $getBus) or die(mysqli_error($conn));

            $num = mysqli_num_rows($runBus);
            if ($num != 0) {
                $busNameErr = "The username is already taken.";
            } else {
                $time = date("Y-m-d H:i:s");
                $active = 1;
                $busNameErr = "";
                $reg = "INSERT INTO `businesses` VALUES('Null','$busName','$slogan','$time','$categ','$desc','$address',"
                . "'$phoneNo','$email','$userId','$prod_image','$town','$web','$active')";
               $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

                if ($run) {
                    echo "<script>alert('Registration successful')</script>";
                    //echo "<script>window.open(".htmlspecialchars($_SERVER['PHP_SELF'])."?q=business","'_self')</script>";
                    if($_SESSION['access'] == "YES")
                    {
                        echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
                    }
                    else
                    {
                        echo "<script>location.replace(\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=business\")</script>";
                    }
                    
                }
            }
        
    }
}

if(isset($_GET['n']) && $_GET['n'] == "editbusiness")
    {
        if(isset($_POST['submit']) && $_POST['submit'] == "Update Business")
        {
    
        $id = $_GET['id'];

        if ($_POST['busName'] == "") {
            $busNameErr = "Business name is required";
        } else {
            $busNameErr = "";
            $busName = test_input($_POST['busName']);
        }

        if ($_POST['town'] == "Select town") {
            $townErr = "Select a town";
        } else {
            $townErr = "";
            $town = test_input($_POST['town']);
        }

        if ($_POST['category'] == "Select category") {
            $categErr = "Select a Category";
        } else {
            $categErr = "";
            $categ = test_input($_POST['category']);
        }

        if (empty($_POST['phoneNo'])) {
            $phoneNoErr = "Phone number is required";
        } else {
            $phoneNoErr = "";
            $phoneNo = test_input($_POST['phoneNo']);
        }

        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $emailErr = "";
            $email = test_input($_POST['email']);
        }
        if (empty($_POST['web'])) {
            $emailErr = "web is required";
        } else {
            $emailErr = "";
            $web = test_input($_POST['web']);
        }

        if (empty($_POST['slogan'])) {
            $sloganErr = "Slogan is required";
        } else {
            $sloganErr = "";
            $slogan = test_input($_POST['slogan']);
        }

        if (empty($_POST['address'])) {
            $addressErr = "Address is required";
        } else {
            $addressErr = "";
            $address = test_input($_POST['address']);
        }

        if (empty($_POST['desc'])) {
            $descErr = "Description is required";
        } else {
            $descErr = "";
            $desc = test_input($_POST['desc']);
        }

       // $userId = $_SESSION['loginId'];

        if (!empty($busName && $slogan && $categ && $desc && $address && $phoneNo && $email && $town && $web)) {

                $time = date("Y-m-d H:i:s");

                $getbus = "SELECT businessName FROM businesses WHERE businessId ='$id'";
                $runbus = mysqli_query($conn, $getbus) or die(mysqli_error($conn));
                $rowbus = mysqli_fetch_array($runbus);
                $CurrentNam = $rowbus['businessName'];

            if($busName !== $CurrentNam)
            {
                $get_bus = "SELECT businessName FROM businesses WHERE businessName ='".$busName."'";
                $run_bus = mysqli_query($conn, $get_bus) or die(mysqli_error($conn));
                $num_bus = mysqli_num_rows($run_bus);

                if ($num_bus > 0) {
                    $busNameErr = "The business Name is already taken.";
                }
                else
                {
                    $busNameErr = "";
                    $reg = "UPDATE businesses SET businessName = '$busName', slogan = '$slogan', addedOn = '$time', category = '$categ', description = '$desc', address = '$address', phoneNo = '$phoneNo', locatedAt = '$town', website = '$web' WHERE businessId=".$id;
                    $run_upd = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));
                }
            }
            else
            {
                $busNameErr = "";
                $reg = "UPDATE businesses SET businessName = '$busName', slogan = '$slogan', addedOn = '$time', category = '$categ', description = '$desc', address = '$address', phoneNo = '$phoneNo', locatedAt = '$town', website = '$web' WHERE businessId=".$id;
                $run_upd = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));
            }
            if($run_upd) {
                if($_SESSION['access'] == "YES")
                {
                    echo "<script>alert('Update of business successful')</script>";
                    echo "<script>location.replace(\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business\")</script>";
                }
                else
                {
                    echo "<script>alert('Update of business successful')</script>";
                    echo "<script>location.replace(\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=business\")</script>";
                }
            }
        }
     }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <style>
         .addColor {
            color: blue;
         }
        </style>
    </head>
<?php
if(isset($_GET['n']) && $_GET['n'] == "editbusiness")
{
    $id = $_GET['id'];

    $check_bus = "SELECT * FROM businesses WHERE businessId = '$id'";
    $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));

    $row_bus = mysqli_fetch_array($res_bus);

    $busId = $row_bus['businessId'];
    $bName = $row_bus['businessName'];
    $slog = $row_bus['slogan'];
    $category = $row_bus['category'];
    $location = $row_bus['locatedAt'];
    $add = $row_bus['address'];
    $phon = $row_bus['phoneNo'];
    $email = $row_bus['email'];
    $web = $row_bus['website'];
    $desc = $row_bus['description'];
    $pic = $row_bus['profilePic'];
    $owner = $row_bus['owner'];


    $check_town = "SELECT * FROM towns WHERE townId =" . $location; 
    $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

    $row_town = mysqli_fetch_array($res_town);
    $locId = $row_town['townId'];
    $locName = ucFirst($row_town['townName']);

    $check_cat = "SELECT * FROM categories WHERE categoryId =". $category;
    $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

    $row_cat = mysqli_fetch_array($res_cat);
    $catId = $row_cat['categoryId'];
    $catName = ucFirst($row_cat['categoryName']);

?>
        
        <div class="update business-add">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <h2 class="text-center text">&nbsp;&nbsp;<u><strong>Edit Business Profile</strong></u></h2>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="label-control">Business Name:</label>
                                    <span class="span-error"> * <?php echo $busNameErr; ?></span>
                                    <input type="text" value="<?php echo $bName; ?>" name="busName" class="form-control addColor" autofocus placeholder="Business Name">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Address:</label>
                                    <span class="span-error"> * <?php echo $addressErr; ?></span>
                                    <input type="text" value="<?php echo $add; ?>" name="address" class="form-control addColor" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Phone Number:</label>
                                    <span class="span-error"> * <?php echo $phoneNoErr; ?></span>
                                    <input type="text" value="<?php echo $phon; ?>" name="phoneNo" class="form-control addColor" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Email:</label>
                                    <span class="span-error"> * <?php echo $emailErr; ?></span>
                                    <input type="text" value="<?php echo $email; ?>" name="email" class="form-control addColor" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Website:</label>
                                    <input type="text" value="<?php echo $web; ?>" name="web" class="form-control addColor" placeholder="Enter Website URL">
                                </div>
                                <div class="form-group addColor">
                                    <label class="label-control">Town:</label>
                                    <span class="span-error"> * <?php echo $townErr; ?></span><br>
                                    <select class="addColor" name="town" style="padding: 5px; font-size: 16px;">
                                        <option value="<?php echo $locId; ?>"><?php echo $locName; ?></option>
                                        <?php
                                        $check_town = "SELECT * FROM towns";
                                        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

                                        while ($row_town = mysqli_fetch_array($res_town)) {
                                            $townId = $row_town['townId'];
                                            $townName = $row_town['townName'];
                                            ?>
                                            <option class="form-control" value="<?php echo $townId; ?>"><?php echo $townName ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Description:</label>
                                    <span class="span-error"> * <?php echo $descErr; ?></span><br>
                                    <input type="text" value="<?php echo $desc; ?>" class="text-control addColor" name="desc" placeholder="Enter your desciption of the business" style="width: 350px;">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Slogan:</label>
                                    <span class="span-error"> * <?php echo $sloganErr; ?></span><br>
                                    <input type="text" value="<?php echo $slog; ?>" class="text-control addColor" name="slogan" placeholder="Slogan" style="width: 350px;">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Category:</label>
                                    <span class="span-error"> * <?php echo $categErr; ?></span><br>
                                    <select class="addColor" name="category" style="padding: 5px; font-size: 16px;">
                                        <option value="<?php echo $catId; ?>"><?php echo $catName; ?></option>
                                        <?php
                                        $check_cat = "SELECT * FROM categories";
                                        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

                                        while ($row_cat = mysqli_fetch_array($res_cat)) {
                                            $catId = $row_cat['categoryId'];
                                            $catName = $row_cat['categoryName'];
                                           
                                          echo "<option value=" .$catId. ">". $catName." </option>";
                                     
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Business Pic:</label>
                                    <img src="images/uploads/<?php echo $pic; ?>" class="img-responsive" width="100px" height="80px" style="padding-bottom: 5px;">
                                    <span class="help-block">The picture shall be edited in business details page.</span>

                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Update Business" class="btn btn-primary btn-lg" style="color: #fff">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div> 
<?php
}
else
{
?> 
        <div class=" business-add">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <h2 class="text-center text">&nbsp;&nbsp;<u><strong>Business Registration</strong></u></h2>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="label-control">Business Name:</label>
                                    <span class="span-error"> * <?php echo $busNameErr; ?></span>
                                    <input type="text" name="busName" class="form-control" placeholder="Business Name">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Address:</label>
                                    <span class="span-error"> * <?php echo $addressErr; ?></span>
                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Phone Number:</label>
                                    <span class="span-error"> * <?php echo $phoneNoErr; ?></span>
                                    <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Email:</label>
                                    <span class="span-error"> * <?php echo $emailErr; ?></span>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Website:</label>
                                    <input type="text" name="web" class="form-control" placeholder="Enter Website URL">
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Town:</label>
                                    <span class="span-error"> * <?php echo $townErr; ?></span><br>
                                    <select class="" name="town">
                                        <option value="Select town">Select Town</option>
                                        <?php
                                        $check_town = "SELECT * FROM towns";
                                        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

                                        while ($row_town = mysqli_fetch_array($res_town)) {
                                            $townId = $row_town['townId'];
                                            $townName = $row_town['townName'];
                                            ?>
                                            <option class="form-control" value="<?php echo $townId; ?>"><?php echo $townName ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Description:</label>
                                    <span class="span-error"> * <?php echo $descErr; ?></span><br>
                                    <textarea class="text-control" cols="25" rows="3" name="desc" placeholder="Enter your desciption of the business"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Slogan:</label>
                                    <span class="span-error"> * <?php echo $sloganErr; ?></span><br>
                                    <textarea class="text-control" cols="25" rows="3" name="slogan" placeholder="Slogan"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Category:</label>
                                    <span class="span-error"> * <?php echo $categErr; ?></span><br>
                                    <select  name="category">
                                        <option value="Select category">Select Category</option>
                                        <?php
                                        $check_cat = "SELECT * FROM categories";
                                        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

                                        while ($row_cat = mysqli_fetch_array($res_cat)) {
                                            $catId = $row_cat['categoryId'];
                                            $catName = $row_cat['categoryName'];
                                           
                                          echo "  <option value=" .$catId. ">". $catName." </option>";
                                     
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="label-control">Profile Pic:</label>
                                    <span class="span-error"> * <?php echo $profPicErr; ?></span>
                                    <input type="file"  name="picha">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Register Business" class="btn btn-primary btn-lg">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div> 

<?php
}
?>