<?php
$categErr = "";

$conn = getConn();

if (isset($_POST['submit']) && $_POST['submit'] == "Add Category") {
    if ($_POST['categ'] == "") {
        $categErr = "Category name is required";
    } else {
        $categErr = "";
        $categ = ucfirst(test_input($_POST['categ']));
    }


    if (!empty($categ)) {

        $get = "SELECT * FROM categories WHERE categoryName ='$categ'";
        $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

        $num = mysqli_num_rows($run);
        if ($num != 0) {
            $categErr = "The category name already exists.";
        } else {
            $categErr = "";
            $reg = "INSERT INTO `categories` VALUES(Null,'$categ')";
            $run = mysqli_query($conn, $reg) or die("Could not be added" . mysqli_error($conn));

            if ($run) {

                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ')</script>";
            }
        }
    }
}

if(isset($_GET['e']) && $_GET['e'] == "editcat")
    {
        if(isset($_POST['submit']) && $_POST['submit'] == "Update")
        {
            $catEditId = $_GET['id'];
            $categUpdateName = ucfirst($_POST['categUpdate']);
            
            if (!empty($categUpdateName)) {

                $get = "SELECT * FROM categories WHERE categoryName ='$categUpdateName'";
                $run = mysqli_query($conn, $get) or die(mysqli_error($conn));

                $num = mysqli_num_rows($run);
                if ($num != 0) {
                    $categErr = "The category name already exists.";
                } else {
                    $cityErr = "";
                    $upd_city = "UPDATE categories SET categoryName = '$categUpdateName' WHERE categoryId=".$catEditId;
                    $res_upd = mysqli_query($conn,$upd_city) or die(mysqli_error($conn));

                    if($res_upd)
                    {
                         //echo "<script>alert('Update successful')</script>";
                         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ','_self')</script>";
                    }
                }
            }
            
           
        }   
    }

if(isset($_GET['e']) && $_GET['e'] == "deletecat")
{
    $categEditId = $_GET['id'];
    
    $upd_cat = "DELETE FROM categories WHERE categoryId=".$categEditId;
    $res_cat = mysqli_query($conn,$upd_cat) or die(mysqli_error($conn));

    if($res_cat)
    {
         //echo "<script>alert('Update successful')</script>";
         echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ','_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html>
    <style>

    </style>
    
    <div class="">
        <div class="">
            <?php 
                if(isset($_GET['e']) && $_GET['e'] == "editcat")
                {
                    $edit = $_GET['e'];
                    $catEditId = $_GET['id'];

                    $check = "SELECT * FROM categories WHERE categoryId=$catEditId";
                    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                    $row = mysqli_fetch_array($res);
                    $catId = $row['categoryId'];
                    $catName = ucFirst($row['categoryName']);
            ?>
                    <div class="categ-form">
                        <form role="form" class="form-inline" action="" method="post">
                            <div class="form-group">
                                <span class="span-error">  <?php echo $categErr; ?></span><br>
                                <label class="label-control">Category Name:</label>
                                <span class="span-error"> * </span>
                                <input type="text" name="categUpdate" class="form-control" autofocus value="<?php echo $catName; ?>" >
                                <span><input type="submit" name="submit" class="btn btn-primary" value="Update"></span>
                                <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=categ" class="btn btn-primary">Clear</a>
                            </div>
                        </form>
                    </div>
            <?php
                }
                else
                {
            ?>
                    <div class="categ-form">
                        <form role="form" class="form-inline" action="" method="post">
                            <div class="form-group">
                                <span class="span-error">  <?php echo $categErr; ?></span><br>
                                <label class="label-control">Category Name:</label>
                                <span class="span-error"> * </span>
                                <input type="text" name="categ" class="form-control" autofocus placeholder="Add Categoryy">
                                <span><input type="submit" name="submit" class="btn btn-primary" value="Add Category"></span>
                                <a href="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>?q=admin&r=categ" class="btn btn-primary">Clear</a>
                            </div>
                        </form>
                    </div>
            <?php 
                }
            ?>
            <div class=" contSmall">
                <div class="">
                    <table class="table table-striped">
                        <thead>
                            <tr class="cat_head">
                                <td>#</td>
                                <th colspan="3">Category Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $check = "SELECT * FROM categories";
                                $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                                $i = 1;
                                while ($row = mysqli_fetch_array($res)) {
                                    $catId = $row['categoryId'];
                                    $catName = ucFirst($row['categoryName']);
                                    echo " 
                                    <tr>
                                        <td>$i</td>
                                        <td>$catName</td>
                                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ&id=$catId&e=editcat>Edit</a></td>
                                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ&id=$catId&e=deletecat>Delete</a></td>
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
    </div>
    
