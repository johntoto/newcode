<?php
$townErr = "";

$conn = getConn();

if (isset($_POST['submit']) && $_POST['submit'] == "Add Town") {
    if ($_POST['town'] == "") {
        $townErr = "Town name is required";
    } else {
        $townErr = "";
        $town = test_input($_POST['town']);
    }


    if (!empty($town)) {

        $get = "SELECT * FROM towns WHERE townName ='$town'";
        $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

        $num = mysqli_num_rows($run);
        if ($num != 0) {
            $townErr = "The town name already exists.";
        } else {
            $townErr = "";
            $reg = "INSERT INTO `towns` VALUES(Null,'$town')";
            $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

            if ($run) {

                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=admin&r=town";
                header("Location:" . $redirect);
            }
        }
    }
}

if(isset($_GET['e']) && $_GET['e'] == "editown")
    {
        if(isset($_POST['submit']) && $_POST['submit'] == "Update")
        {
            $townEditId = $_GET['id'];
            $townUpdateName = $_POST['townUpdate'];
            
            if (!empty($townUpdateName)) {

                $get = "SELECT * FROM towns WHERE townName ='$townUpdateName'";
                $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

                $num = mysqli_num_rows($run);
                if ($num != 0) {
                    $townErr = "The town name already exists.";
                } else {
                    $townErr = "";
                    $upd_town = "UPDATE towns SET townName = '$townUpdateName' WHERE townId=".$townEditId;
                    $res_upd = mysqli_query($conn,$upd_town) or die(mysqli_error($conn));

                    if($res_upd)
                    {
                         //echo "<script>alert('Update successful')</script>";
                         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=town','_self')</script>";
                    }
                }
            }
            
           
        }   
    }

if(isset($_GET['e']) && $_GET['e'] == "deletetown")
{
    $townEditId = $_GET['id'];
    
    $upd_city = "DELETE FROM towns WHERE townId=".$townEditId;
    $res_upd = mysqli_query($conn,$upd_city) or die(mysqli_error($conn));

    if($res_upd)
    {
         //echo "<script>alert('Update successful')</script>";
         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=town','_self')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
   
    <div class="row top">
        <div class="col-md-8 content tabl">
            <?php 
                if(isset($_GET['e']) && $_GET['e'] == "editown")
                {
                    //$edit = $_GET['e'];
                    $townEditId = $_GET['id'];

                    $check = "SELECT * FROM towns WHERE townId=$townEditId";
                    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                    $row = mysqli_fetch_array($res);
                    $townId = $row['townId'];
                    $townName = $row['townName'];
            ?>
                <div class="inner-content town-form">
                    <form role="form" class="form-inline" action="" method="post">
                        <div class="form-group">
                            <span class="span-error">  <?php echo $townErr; ?></span><br>
                            <label class="label-control">Town Name:</label>
                            <span class="span-error"> * </span>
                            <input type="text" name="townUpdate" class="form-control" autofocus="" value="<?php echo $townName; ?>">
                            <span><input type="submit" name="submit" class="btn btn-primary" value="Update"></span>
                            <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=town" class="btn btn-primary">Clear</a>
                        </div>
                    </form>
                </div>
            <?php
                } else {
            ?>
            <div class="inner-content town-form">
                <form role="form" class="form-inline" method="post">
                    <div class="form-group">
                        <span class="span-error"> <?php echo $townErr; ?></span><br>
                        <label class="label-control">Town Name:</label>
                        <span class="span-error"> * </span>
                        <input type="text" name="town" class="form-control" autofocus="" placeholder="Add Town">
                        <span><input type="submit" name="submit" class="btn btn-primary" value="Add Town"></span>
                        <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=town" class="btn btn-primary">Clear</a>
                    </div>
                </form>
            </div>
            <?php } ?>
            <div class="contSmall table-responsive">
                <table align="center" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="cat_head">
                            <td>#</td>
                            <th colspan="3">Town Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $check = "SELECT * FROM towns";
                            $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                            $i = 1;
                            while ($row = mysqli_fetch_array($res)) {
                                $townId = $row['townId'];
                                $townName = $row['townName'];
                                echo " 
                                <tr>
                                    <td>$i</td>
                                    <td>$townName</td>
                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=town&id=$townId&e=editown>Edit</a></td>
                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=town&id=$townId&e=deletetown>Delete</a></td>
                                </tr>
                                ";
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


