<?php
    $displayLinks = $editErr = $output = "";

    if(isset($_POST['submit']) && $_POST['submit'] == "Update")
    {
        $id = $_GET['id'];

        if(empty($_POST['priv']))
        {
            $editErr = "<script>window.alert('Choose one option')</script>";
            echo "<span style='color:red'>$editErr</span>";
        }
        else
        {
            $ed = $_POST['priv'];
        }

        if(!empty($_POST['priv']))
        {
            //$cons = "UPDATE businesses SET activeLevel = $ed WHERE businessId = $id";
            //$upd = mysqli_query($conn,$con) or die(mysqli_error($conn));
            $upd = mysqli_query($conn,"UPDATE businesses SET activeLevel = '$ed' WHERE businessId = $id") or die(mysqli_error($conn));
            if($upd)
            {
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
            }
        }
    }

?>

<!DOCTYPE html>
    <style>
        
    </style>
<html>

   
    <?php
          leftPartAdmin();

    ?>


    <div class="top-links text-center" style="margin-top: -15px; margin-bottom: 5px;">
        <?php echo $displayLinks; ?>
    </div>

    <?php

        if (isset($_GET['r']) && $_GET['r'] == 'home' && $_GET['q'] == "admin") {
    ?>
    
            <div class="content-wrapper" style="min-height: 500px">
                <div class="hom-adm">
                    <div class="row">
                        <div class="container">
                            <div class="col-md-10 col-sm-10">
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=admin&r=users" class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                                        <span class="info">
                                            <h2 class="inside-data">Users</h2>
                                            <?php
                                                global $conn;
                                                $get_users = mysqli_query($conn, "SELECT * FROM user") or die(mysqli_error($conn));
                                                $num_users = mysqli_num_rows($get_users);
                                                echo "<p > <b>".$num_users."</b></p>";
                                            ?>
                                        </span>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=admin&r=business" class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                                      <span class="info">
                                        <h2 class="inside-data">Businesses</h2>
                                        <?php
                                                global $conn;
                                                $get_bus = mysqli_query($conn, "SELECT * FROM businesses") or die(mysqli_error($conn));
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
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=admin&r=business" class="widget-small danger"><i class="icon fa fa-comments-o fa-3x"></i>
                                      <span class="info">
                                        <h2 class="inside-data">Business Requests</h2>
                                        <?php
                                                global $conn;
                                                $get_bus = mysqli_query($conn, "SELECT * FROM businesses WHERE activeLevel = 1 ") or die(mysqli_error($conn));
                                                $num_bus = mysqli_num_rows($get_bus);
                                                echo "<p > <b>".$num_bus."</b></p>";
                                            ?>
                                      </span>
                                    </a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=admin&r=business" class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                                      <span class="info" >
                                        <h2 class="inside-data">Deleted Businesses</h2>
                                        <?php
                                                global $conn;
                                                $get_bus = mysqli_query($conn, "SELECT * FROM businesses WHERE activeLevel = 4") or die(mysqli_error($conn));
                                                $num_bus = mysqli_num_rows($get_bus);
                                                echo "<p > <b>".$num_bus."</b></p>";
                                            ?>
                                      </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pullFooter" style="margin-top: 70px;">
                    <?php include "./includes/footer.php"; ?>
                </div>
            </div>
    <?php
        }
        else
        {
    ?>

        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12" >
                    <div class="card"  style="min-height: 400px;">
                        <div class="display" style="margin-bottom: 10px;margin-top: -15px;">
                            <?php echo $output ?>
                        </div>
                        <div class="card-body">

                            <?php

                                if (isset($_GET['r']) && $_GET['r'] == 'business') 
                                {
                                    //newBusiness = id = 1;
                                    //ApprovedBusiness = id =2;
                                    //Suspended Business = id = 3;
                                    //user deleted business id = 4;

                                    if (isset($_GET['n']) && $_GET['n'] == "addbusiness")
                                    {
                                        include_once 'business.php';
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "deletebusiness" )
                                    {
                                        deleteBusiness();
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "editbusiness")
                                    {
                                        include_once 'business.php';
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "new")
                                    {
                                        newBusinessRequests();
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "appsroveBusin")
                                    {
                                        approveBusiness();
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "rejesctBusin")
                                    {
                                        rejectBusiness();
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "edit")
                                    {
                                        editPrivileges();
                                    }
                                    else
                                    {
                                         viewBusiness();
                                   }                                   
                                }

                                if (isset($_GET['r']) && $_GET['r'] == 'users') {

                                    //newBusiness = id = 1;
                                    //ApprovedBusiness = YES;
                                    //Suspended Business = activated = NO;

                                    if (isset($_GET['n']) && $_GET['n'] == "adduser"){
                                        include_once 'addUsers.php';
                                        
                                    } 
                                    elseif(isset($_GET['n']) && $_GET['n'] == "edituser")
                                    {
                                        include_once 'addUsers.php';
                                    }
                                    elseif(isset($_GET['n']) && $_GET['n'] == "newUser")
                                    {
                                        newUserRequests();
                                    }
                                    else
                                    {
                                        include_once 'viewUser.php';
                                    }
                                }

                                if (isset($_GET['r']) && $_GET['r'] == 'town') {

                                    include_once 'town.php';
                                }

                                if (isset($_GET['r']) && $_GET['r'] == 'city') {
                                    //if (isset($_GET['n']) && $_GET['n'] == "addcity") {
                                        
                                        include_once 'city.php';
                                   // } 
                                   // else {
                                     //   include_once 'viewUser.php';
                                   // }
                                }

                                if (isset($_GET['r']) && $_GET['r'] == 'categ') {
                                   // if (isset($_GET['n']) && $_GET['n'] == "adduser") {

                                        include_once 'categ.php';
                                    //} 
                                    //else {
                                     //   include_once 'viewUser.php';
                                   // }
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
    
<?php } ?>
</html>