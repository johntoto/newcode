<?php
$comm = $name = $email = $busId = "";
$commErr = $nameErr = $emailErr = $endDateErr = $titleErr = "";
//$busin = "";
if (isset($_GET['b'])) {
    $busin = htmlspecialchars($_GET['b']);
}

if (isset($_POST['submit']) && $_POST['submit'] == "Add Comment") {

    if (empty(htmlspecialchars($_POST['comment']))) {
        $commErr = "Comment is required";
    } else {
        $commErr = "";
        $comm = htmlspecialchars($_POST['comment']);
    }

    if (empty(htmlspecialchars($_POST['name']))) {
        $nameErr = "Name is required";
    } else {
        $nameErr = "";
        $name = htmlspecialchars($_POST['name']);
    }

    if (empty(htmlspecialchars($_POST['email']))) {
        $emailErr = "Email is required";
    } else {
        $emailErr = "";
        $email = htmlspecialchars($_POST['email']);
    }

    $businessId = htmlspecialchars($_POST['myBusId']);

    $time = date("Y-m-d H:i:s");

    if (!empty($comm && $email && $name && $businessId)) {

        $ins_comm = "INSERT INTO comments VALUES('Null','$name','$email','$comm','$businessId','$time')";
        $run_comm = mysqli_query($conn, $ins_comm);

        if ($run_comm) {
            $commErr = "Comment submitted successfully";
            $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&r=comments&b=" . $busin;
            header("Location:" . $redirect);
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style>
            
            .col-md-2 {
                background-color: blue;
            }
        </style>
    </head>
    <body>

        <?php
        $check_bus = "SELECT * FROM businesses WHERE businessId=" . $busin;
        $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));

        $row_bus = mysqli_fetch_array($res_bus);

        $busId = $row_bus['businessId'];
        $bName = $row_bus['businessName'];
        $add = $row_bus['address'];
        $phon = $row_bus['phoneNo'];
        $category = $row_bus['category'];
        $location = $row_bus['locatedAt'];
        $busPic = $row_bus['profilePic'];
        $website = $row_bus['website'];
        $desc = $row_bus['description'];

        $check_town = "SELECT * FROM towns WHERE townId =".$location;
        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

        $row_town = mysqli_fetch_array($res_town);

        $town = $row_town['townName'];

        $check_cat = "SELECT * FROM categories WHERE categoryId =" . $category;
        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

        $row_cat = mysqli_fetch_array($res_cat);

        $categoryName = ucfirst($row_cat['categoryName']);

        ?>
        <div class="container-fluid top">
            <h2 class="text-center text"><?php echo $bName; ?> </h2>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?home"><span class="fa-long-arrow-left">Back</span></a>
            <div class="row">
       
              <?php
                if(isset($_GET['r']))
                {
                    if ( $_GET['r'] == "offers") {
                        businessOffers();
                    }
                    elseif ( $_GET['r'] == "comments") {
                        businessComments();
                    }
                    elseif ( $_GET['r'] == "pics") {
                        businessPics();
                    }
                }
                else{
                    businessDetails ();
            
                }
                
              ?>
                
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="busLinks">
                        <ul>
                            <li>
                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=details&b=<?php echo $busin;?>">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=details&b=<?php echo $busin ?>&r=pics">Photos</a>

                            </li>
                            <li>
                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=details&b=<?php echo $busin ?>&r=offers">Offers</a>

                            </li>
                            <li>
                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=details&b=<?php echo $busin ?>&r=comments&key=1">Comments</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal dialog for entering new comment -->
                        <div class="modal" id="modal-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <h3 class="text-center">Add Comment</h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                            <form method="POST">
                                                <input type="hidden" name="myBusId" value="<?php echo $busId; ?>">
                                                <div class="form-group">
                                                    <label class="label-control">Name:</label>
                                                    <span class="span-error">* <?php echo $nameErr ?></span>
                                                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="label-control">Email:</label>
                                                    <span class="span-error">* <?php echo $emailErr ?></span>
                                                    <input type="text" name="email" class="form-control" placeholder="Enter email">
                                                </div>
                                                <div class="form-group">
                                                    <label class="label-control">Comment:</label>
                                                    <span class="span-error">* <?php echo $commEr ?></span>
                                                    <textarea name="comment" class="form-control" cols="25" rows="5" placeholder="Write a comment"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="submit" class="btn btn-success" value="Add Comment">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="" class="btn btn-info" data-dismiss="modal">Close</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                <!-- End modal dialog -->

    </body>
</html>
