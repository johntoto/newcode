<?php
  $titleErr = $offerErr = $endDateErr = $businessErr = $selectErr = $picErr = "";
  $busNameErr = $profPicErr = $categErr = $sloganErr = $descErr = $emailErr = $townErr = $titleErr = $selectErr = $addressErr = $phoneNoErr = "";
  $busName = $town = $prod_image = $desc = $pic_title = "";
  //$nameErr = $emailErr = $commentErr = $businessErr = "";
  
if (isset($_POST['submit']) && $_POST['submit'] == "Add Offer") {

    if (empty(htmlspecialchars($_POST['offer']))) {
        $offerErr = "Offer is required";
    } else {
        $offerErr = "";
        $offer = htmlspecialchars($_POST['offer']);
    }

    if (empty(htmlspecialchars($_POST['title']))) {
        $titleErr = "Offer title is required";
    } else {
        $titleErr = "";
        $title = htmlspecialchars($_POST['title']);
    }
    
    if (empty(htmlspecialchars($_POST['business'])) || $_POST['business'] == "Select Business") {
        $businessErr = "Select Business";
    } else {
        $businessErr = "";
        $business = htmlspecialchars($_POST['business']);
    }

    $time = date("Y-m-d H:i:s");
    $endDate = htmlspecialchars($_POST['endDate']);

    if (empty($_POST['endDate'])) {
        $endDateErr = "End date is required";
    } elseif ($endDate == $time) {
        $endDateErr = "End date should not be equal to todays date";
    } else {
        if (!empty($offer && $title && $endDate && $business)) {

            $ins_offer = "INSERT INTO offers VALUES('Null','$title','$offer','$time','$endDate','$business')";
            $run_offer = mysqli_query($conn, $ins_offer) or die(mysqli_error($conn));

            if ($run_offer) {
                $offerErr = "offer inserted successfully";
                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=offers";
                header("Location:" . $redirect);
            }
        }
    }
}

if (isset($_POST['submit']) && $_POST['submit'] == "Add Service") {

    if (empty(htmlspecialchars($_POST['title']))) {
        $titleErr = " Service title is required";
    } else {
        $titleErr = "";
        $title = htmlspecialchars($_POST['title']);
    }

    if (empty(htmlspecialchars($_POST['description']))) {
        $descErr = "Description is required";
    } else {
        $descErr = "";
        $desc = htmlspecialchars($_POST['description']);
    }
    
    if (empty(htmlspecialchars($_POST['business'])) || $_POST['business'] == "Select Business") {
        $businessErr = "Select Business";
    } else {
        $businessErr = "";
        $business = htmlspecialchars($_POST['business']);
    }

    $time = date("Y-m-d H:i:s");
    //$endDate = htmlspecialchars($_POST['endDate']);

        if (!empty($desc && $title  && $business)) {
            
            echo $ins_offer = "INSERT INTO customerservices VALUES('Null','$business','$title','$desc','$time')";
            $run_offer = mysqli_query($conn, $ins_offer) or die(mysqli_error($conn));

            if ($run_offer) {
                $offerErr = "Customer Service inserted successfully";
                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=custService";
                header("Location:" . $redirect);
            }
            
        }
}

if(isset($_GET['e']) && $_GET['e'] == "editupdate")
{
    if(isset($_POST['submit']) && $_POST['submit'] == "Update Service")
    {
        $id = $_GET['id'];
        $time = date("Y-m-d H:i:s");
        $busId = $_POST['busId'];
    
        if (empty(htmlspecialchars($_POST['title']))) {
            $titleErr = " Service title is required";
        } else {
            $titleErr = "";
        echo    $title = htmlspecialchars($_POST['title']);
        }

        if (empty(htmlspecialchars($_POST['description']))) {
            $descErr = "Description is required";
        } else {
            $descErr = "";
          echo  $desc = htmlspecialchars($_POST['description']);
        }

        if (empty(htmlspecialchars($_POST['business']))) {
            $businessErr = "Enter Business Name";
        } else {
            $businessErr = "";
          echo  $business = htmlspecialchars($_POST['business']);
        }

        $ins_serv = "UPDATE customerservices SET businessId='$busId',title='$title', description='$desc',addedOn='$time' WHERE serviceId =".$id;
        $run_serv = mysqli_query($conn, $ins_serv) or die(mysqli_error($conn));

        if ($run_serv) {
            $offerErr = "Customer Service updated successfully";
            $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=custService";
            header("Location:" . $redirect);
        }
    }

    if(isset($_POST['submit']) && $_POST['submit'] == "Update Offers")
    {
        $id = $_GET['id'];
        $time = date("Y-m-d H:i:s");
        $busId = $_POST['busId'];
    
        if (empty(htmlspecialchars($_POST['title']))) {
            $titleErr = " Offers title is required";
        } else {
            $titleErr = "";
            $title = htmlspecialchars($_POST['title']);
        }

        if (empty(htmlspecialchars($_POST['description']))) {
            $descErr = "Description is required";
        } else {
            $descErr = "";
            $desc = htmlspecialchars($_POST['description']);
        }

        if (empty(htmlspecialchars($_POST['business']))) {
            $businessErr = "Enter Business Name";
        } else {
            $businessErr = "";
            $business = htmlspecialchars($_POST['business']);
        }

         if (empty(htmlspecialchars($_POST['endDateDate']))) {
            $endDateErr = "Date is required";
        } else {
            $endDateErr = "";
            $endDate = htmlspecialchars($_POST['endDate']);
        } 

        if(!empty($business && $title && $desc && $endDate ))
        {
            $ins_off = "UPDATE offers SET businessId='$busId',title='$title', description='$desc',addedOn='$time' WHERE serviceId =".$id;
            $run_off = mysqli_query($conn, $ins_off) or die(mysqli_error($conn));

            if ($run_off) {
                $redirect = htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=offers";
                header("Location:" . $redirect);
            }
        }

    }
    
}


if(isset($_GET['r']) && $_GET['r'] == ("offers" || "comments"))
{
    if(isset($_POST['submit']) && $_POST['submit'] == "Filter")
    {
        if($_POST['selectBusiness'] == "Select Business")
        {
            $selectErr = "Select a Business to filter";
        }
        else
        {
            $selectErr = "";
            $selBusiness = $_POST['selectBusiness'];
        }
    }
}

if(isset($_GET['e']) && $_GET['e'] == "deleteoffer")
    {
        $id = $_GET['id'];
        $check = "DELETE FROM offers WHERE offerId=".$id;
        $res = mysqli_query($conn,$check) or die(mysqli_error($conn));
        
        if($res)
        {
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=offers','_self')</script>";
        }
    }
if(isset($_GET['e']) && $_GET['e'] == "deletecomment")
    {
        $id = $_GET['id'];
        $check = "DELETE FROM comments WHERE commentId=".$id;
        $res = mysqli_query($conn,$check) or die(mysqli_error($conn));
        
        if($res)
        {
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=comments','_self')</script>";
        }
    }

if(isset($_GET['e']) && $_GET['e'] == "deleteservice")
    {
        $id = $_GET['id'];
        $check = "DELETE FROM customerservices WHERE serviceId=".$id;
        $res = mysqli_query($conn,$check) or die(mysqli_error($conn));
        
        if($res)
        {
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=customerService','_self')</script>";
        }
    }

if(isset($_POST['submit']) && $_POST['submit'] == "Add")
    {
        if(empty($_FILES['picha']['name']))
        {
            $picErr = "Choose a picture";
            
        }

        if(empty($_POST['selectBusiness']) || $_POST['selectBusiness'] == "Select Business")
        {
            $selectErr = "Choose a business";
        }
        else
        {
            $selectErr = "";
            $bus_id = $_POST['selectBusiness'];
        }

        if(empty($_POST['title']))
        {
            $titleErr = "Write a title";
            
        }
        else
        {
            $titleErr = "";
            $pic_title = $_POST['title'];
        }
        
        if(!empty($pic_title && $bus_id))
        {
            $picErr = "";

            $pic_title = $_POST['title'];

            $pic = $_FILES['picha']['name'];
            $tmp_name = $_FILES['picha']['tmp_name'];

            move_uploaded_file($tmp_name, 'E:\xampp\htdocs\webmarketer\images\pics/'.$pic);

            $ins_pic = "INSERT INTO pics VALUES(Null,'$pic','$pic_title','$bus_id')";
            $run_pic = mysqli_query($conn,$ins_pic) or die(mysqli_error($conn));

        }
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
        
        </style>
    </head>
    <body>
            <?php leftPartUser (); ?>

            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="card"  style="min-height: 400px;">
                            <div class="card-body">
                         <?php

                            if (isset($_GET['r']) && $_GET['r'] == 'home' && $_GET['q'] == "user") {
                                $access = $_SESSION['loginId'];

                                ?>
                                <div class="row">
                                    <div class="container">
                                        <div class="col-md-10 col-sm-10" style="padding-top: 50px;">
                                            <div class="col-md-6 col-sm-6">
                                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=user&r=custService" class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                                                    <span class="info">
                                                        <h2 class="inside-data">Customer Service</h2>
                                                        <?php
                                                global $conn;

                                                $userId = $_SESSION['loginId'];

                                                $check = "SELECT * FROM businesses WHERE owner=" . $userId;
                                                $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                                                $i=0;
                                                while($row_bus = mysqli_fetch_array($res))
                                                  {
                                                      $bus_id = $row_bus['businessId'];
                                                      
                                                      $get_ser = "SELECT * FROM customerservices WHERE businessId =".$bus_id;
                                                      $res_ser = mysqli_query($conn,$get_ser) or die(mysqli_error($conn));

                                                      while($fetch = mysqli_fetch_array($res_ser))
                                                      {
                                                            $i+=1;
                                                      }
                                                  }

                                                echo "<p > <b>".$i."</b></p>";
                                            ?>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=user&r=business" class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                                                  <span class="info">
                                                    <h2 class="inside-data">Businesses</h2>
                                                    <?php
                                                            global $conn;
                                                            $get_bus = mysqli_query($conn, "SELECT * FROM businesses WHERE owner = $access ") or die(mysqli_error($conn));
                                                            $num_bus = mysqli_num_rows($get_bus);
                                                            echo "<p > <b>".$num_bus."</b></p>";
                                                        ?>
                                                  </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                        <div class="container">
                            <div class="col-md- col-sm-10">
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=user&r=offers" class="widget-small danger"><i class="icon fa fa-comments-o fa-3x"></i>
                                      <span class="info">
                                        <h2 class="inside-data">Offers</h2>
                                        <?php
                                                global $conn;

                                                $userId = $_SESSION['loginId'];

                                                $check = "SELECT * FROM businesses WHERE owner=" . $userId;
                                                $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                                                $i=0;
                                                while($row_bus = mysqli_fetch_array($res))
                                                  {
                                                      $bus_id = $row_bus['businessId'];
                                                      
                                                      $get_offer = "SELECT * FROM offers WHERE businessId =".$bus_id;
                                                      $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));

                                                      while($fetch = mysqli_fetch_array($res_offer))
                                                      {
                                                            $i+=1;
                                                      }
                                                  }

                                                echo "<p > <b>".$i."</b></p>";
                                            ?>
                                      </span>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=user&r=comments" class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                                      <span class="info" >
                                        <h2 class="inside-data">Comments</h2>
                                        <?php
                                                global $conn;

                                                $userId = $_SESSION['loginId'];

                                                $check = "SELECT * FROM businesses WHERE owner=" . $userId;
                                                $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

                                                $i=0;
                                                while($row_bus = mysqli_fetch_array($res))
                                                  {
                                                      $bus_id = $row_bus['businessId'];
                                                      
                                                      $get_comment = "SELECT * FROM comments WHERE businessId =".$bus_id;
                                                      $res_comment = mysqli_query($conn,$get_comment) or die(mysqli_error($conn));
                                                      
                                                      while($fetch = mysqli_fetch_array($res_comment))
                                                      {
                                                            $id = $fetch['commentId'];
                                                            $i+=1;
                                                      }
                                                  }

                                                echo "<p > <b>".$i."</b></p>";
                                            ?>
                                      </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                            }

                            global $conn, $selectErr;
                            $userId = $_SESSION['loginId'];

                            if (isset($_GET['r']) && $_GET['r'] == 'comments') {
                                if(isset($_GET['n']) && $_GET['n'] == "addcomment")
                                {
                                    echo "<div class=\"col-md-1\"></div>";
                                    addComment();
                                }
                                else
                                {   echo "<div style=\"min-height: 400px;\">";
                                    viewComments();
                                    echo "</div>";
                                }
                              
                            }

                            if (isset($_GET['r']) && $_GET['r'] == 'business') 
                                {
                                    if (isset($_GET['n']))
                                    {
                                        if($_GET['n'] == 'addbusiness') 
                                        {
                                            include_once 'business.php';
                                        }
                                        elseif($_GET['n'] == "editbusiness" )
                                        {
                                            include_once 'business.php';
                                        }
                                        elseif($_GET['n'] == "deletebusiness" )
                                        {
                                            deleteBusiness();
                                        }
                                    }
                                     else
                                    {
                                        ViewBusiness();
                                    }
                                }
                            
                            if (isset($_GET['r']) && $_GET['r'] == 'offers') {
                                if(isset($_GET['n']) && $_GET['n'] == "addoffer")
                                {
                                        addOffers();
                                }
                                else
                                {
                                    viewOffers();
                                }
                            }

                             if (isset($_GET['r']) && $_GET['r'] == 'pics') {
                                
                                echo "<button type='button' data-toggle='modal' data-target='#pic-modal' class='btn btn-info'>Add</button>";
                                viewPic();
                            }  

                            if (isset($_GET['r']) && $_GET['r'] == 'custService') {
                                if(isset($_GET['n']) && $_GET['n'] == "addService")
                                {
                                        addCustomerService();     
                                    
                                }
                                else
                                {
                                    if(isset($_GET['e']) && $_GET['e'] == "editupdate")
                                    {
                                            addCustomerService();
                                    }
                                    else{
                                        viewCustomerService();
                                    }
                                }
                             }


                        ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pullFooter">
                    <?php include "./includes/footer.php"; ?>
                </div>
            </div>
            
            <div class="modal" id="pic-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title">
                                <h2>Add new pic</h2>
                                <button type="button" class="close" data-dismiss="modal" style="float: left;">&times;</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class='form-group'>
                                    <span class='span-error'><?php echo $selectErr; ?></span><br>
                                      <select name='selectBusiness' style="padding: 5px">";
                                       <?php echo "<option value=\"Select Business\">Select Business</option>";

                                            $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                                            $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                                           while($row_bus = mysqli_fetch_array($res_bus))
                                            {
                                               $bus_id = $row_bus['businessId'];
                                                $bus_name = $row_bus['businessName'];
                                                
                                                echo "<option value=\"$bus_id\">$bus_name</option>";
                                            }
                                            
                                            echo "
                                                  </select>";
                                                  
                                      ?>
                                </div>
                                <div class="form-group">
                                    <label class='label-control'>Add Pic </label>
                                    <span style='color:red'><?php echo $picErr; ?> </span>
                                    <input type="file" name="picha">
                                </div>
                                <div class="form-group">
                                    <label class='control-label'> Pic title </label>
                                    <span style='color:red'><?php echo $titleErr; ?> </span>
                                     <input type='text' name='title' class='form-control' style='width:200px' placeholder='Picture title'>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' class='btn btn-info' name='submit' value='Add'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </body>
</html>
