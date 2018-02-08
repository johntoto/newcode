<?php
$cityErr = "";

$conn = getConn();

if (isset($_POST['submit']) && $_POST['submit'] == "Add City") {
    if ($_POST['city'] == "") {
        $cityErr = "City name is required";
    } else {
        $cityErr = "";
        $city = test_input($_POST['city']);
    }

    if (!empty($city)) {

        $get = "SELECT * FROM city WHERE cityName ='$city'";
        $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

        $num = mysqli_num_rows($run);
        if ($num != 0) {
            $cityErr = "The city name already exists.";
        } else {
            $cityErr = "";
            $reg = "INSERT INTO `city` VALUES(Null,'$city')";
            $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

            if ($run) {

                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=admin&r=city";
                header("Location:" . $redirect);
            }
        }
    }
}
    if(isset($_GET['e']) && $_GET['e'] == "editcity")
    {
        if(isset($_POST['submit']) && $_POST['submit'] == "Update")
        {
            $cityEditId = $_GET['id'];
            $cityName = $_POST['cityUpdate'];
             
            if (!empty($cityName)) {

                $get = "SELECT * FROM city WHERE cityName ='$cityName'";
                $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

                $num = mysqli_num_rows($run);
                if ($num != 0) {
                    $cityErr = "The city name already exists.";
                } else {
                    $cityErr = "";
                    $upd_city = "UPDATE city SET cityName = '$cityName' WHERE cityId=".$cityEditId;
                    $res_upd = mysqli_query($conn,$upd_city) or die(mysqli_error($conn));

                    if($res_upd)
                    {
                         //echo "<script>alert('Update successful')</script>";
                         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=city','_self')</script>";
                    }
                }
            }
            
           
        }   
    }

if(isset($_GET['e']) && $_GET['e'] == "deletecity")
{
    $cityEditId = $_GET['id'];
    
    $upd_city = "DELETE FROM city WHERE cityId=".$cityEditId;
    $res_upd = mysqli_query($conn,$upd_city) or die(mysqli_error($conn));

    if($res_upd)
    {
         //echo "<script>alert('Update successful')</script>";
         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=city','_self')</script>";
    }
}
        
?>
    
<!DOCTYPE html>
<html>
            <?php 
                if(isset($_GET['e']) && $_GET['e'] == "editcity")
                    {
                        $edit = $_GET['e'];
                        $cityEditId = $_GET['id'];
                        
                        $check = "SELECT * FROM city WHERE cityId=$cityEditId";
                        $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                        $row = mysqli_fetch_array($res);
                        $cityId = $row['cityId'];
                        $cityName = ucFirst($row['cityName']);
            ?>
                        <div class="inner-content tabl">
                            <form role="form" class="form-inline" action="" method="post">
                                <div class="form-group">
                                    <span class="span-error"> <?php echo $cityErr; ?></span><br>
                                    <label class="label-control">City Name:</label>
                                    <span class="span-error"> * </span>
                                    <input type="text" name="cityUpdate" class="form-control" autofocus value="<?php echo $cityName; ?>">
                                    <span><input type="submit" name="submit" class="btn btn-primary" value="Update"></span>
                                    <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=city" class="btn btn-primary">Clear</a>
                                </div>
                            </form>
                        </div>
            <?php
                    }
                    else
                    {
            ?>
                        <div class="city-form">
                            <form role="form" class="form-inline" action="" method="post">
                                <div class="form-group">
                                    <span class="span-error">  <?php echo $cityErr; ?></span><br>
                                    <label class="label-control">City Name:</label>
                                    <span class="span-error"> * </span>
                                    <input type="text" name="city" class="form-control" autofocus placeholder="Add City">
                                    <span><input type="submit" name="submit" class="btn btn-primary" value="Add City"></span>
                                    <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=city" class="btn btn-primary">Clear</a>
                                </div>
                            </form>
                        </div>
            <?php
                    }
            ?>
            <div class=" contSmall">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="cat_head">
                                <td>#</td>
                                <th colspan="3">City Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                                $check = "SELECT * FROM city";
                                $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                                $i = 1;
                                while ($row = mysqli_fetch_array($res)) {
                                    $cityId = $row['cityId'];
                                    $cityName = ucFirst($row['cityName']);
                                    echo " 
                                    <tr>
                                        <td>$i</td>
                                        <td>$cityName</td>
                                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=city&id=$cityId&e=editcity>Edit</a></td>
                                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=city&id=$cityId&e=deletecity>Delete</a></td>
                                    </tr>
                                    ";
                                    $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


