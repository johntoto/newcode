<?php

function getConn() {
    $conn = mysqli_connect('localhost', 'root', "", "webmarketer");
    if (mysqli_errno($conn)) {
        echo "Could not connect to server and database" . mysqli_error();
    }
    return $conn;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addUsers() {
    $uNameErr = $fNameErr = $idNoErr = $phonNoErr = $emailErr = $cityErr = $addressErr = $passErr = $cPassErr = "";
    $uname = $fname = $idNo = $phoneNo = $email = $city = $address = $pass = $conPass = "";

    $conn = getConn();

    if (isset($_POST['submit']) && $_POST['submit'] == "Register") {

        if (!empty($uname && $fname && $idNo && $email && $city && $address && $phoneNo && $pass && $conPass)) {

            $getuser = "SELECT * FROM user WHERE userName ='$uname'";
            $runuser = mysqli_query($conn, $getuser) or die(mysqli_error($conn));

            $num = mysqli_num_rows($runuser);
            if ($num != 0) {
                $uNameErr = "The username is already taken.";
            } else {
                $uNameErr = "";
                echo $reg = "INSERT INTO `user` VALUES(Null,'$uname','$fname','$idNo','$email','$city',"
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
}

function leftPartAdmin() {
   echo "<div class=\"userLogin pull-right\">
            Logged in as:
            <strong>";
                if (isset($_SESSION['name'])) {
                    echo "<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=editProfile\">".strtoupper($_SESSION['name'])."</a> ";
                } else {
                    echo "Not logged in";
                }
         echo "       
            </strong>
        </div>";

        global $conn;

        $getBusiness = "SELECT * FROM businesses WHERE activeLevel = 1 ORDER BY addedOn DESC";
        $res_bus = mysqli_query($conn, $getBusiness) or die(mysqli_error($conn));

        $numBusiness = mysqli_num_rows($res_bus);

        $getUser = "SELECT * FROM user WHERE entry = 1 ORDER BY addedOn DESC";
        $res_user = mysqli_query($conn, $getUser) or die(mysqli_error($conn));

        $numUser = mysqli_num_rows($res_user);
        

        echo "
            <aside class=\"main-sidebar hidden-print\">
                <section>
                    <h2 class=\"text-center test\" style=\"color: #fff\">Admin Panel</h2>
                    <ul class=\" list-group \">
                        <li class=\"list-item active\"><a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=town\">Town</a></li>
                        <li class=\"list-item\"><a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=categ\">Categories</a></li>
                        <li class=\"list-item\"><a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=city\">City</a></li>
                        <li>
                            <a href=\"javascript:;\" data-toggle=\"collapse\" data-target=\"#users\" class=\"collapsed\" aria-expanded=\"false\">Users <i class=\"fa fa-fw fa-caret-down\"></i></a>
                            <ul id=\"users\" class=\"collapse dropin\" aria-expanded=\"false\" style=\"height: 0px;\">
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users&n=adduser\">Add User</a>
                                </li>
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users\">View Users</a>
                                </li>
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users&n=newUser\">New Users ($numUser)</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href=\"javascript:;\" data-toggle=\"collapse\" data-target=\"#business\" class=\"collapsed\" aria-expanded=\"false\">Business <i class=\"fa fa-fw fa-caret-down\"></i></a>
                            <ul id=\"business\" class=\"collapse dropin\" aria-expanded=\"false\" style=\"height: 0px;\">
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=addbusiness\">Add Business</a>
                                </li>
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business\">View Businesses</a>
                                </li>
                                <li>
                                    <a href=\"". htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=new\">New Requests ($numBusiness)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </aside>
        ";
}

function leftPartUser() {
   
    echo "<div class=\"userLogin pull-right\">
            Logged in as:
            <strong>";
                if (isset($_SESSION['name'])) {
                    echo "<a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=editProfile\" id='modal-profile'>".strtoupper($_SESSION['name'])."</a>";
                } else {
                    echo "Not logged in";
                }
         echo "       
            </strong>
        </div>";
        echo "
        <aside class=\"main-sidebar hidden-print\">
            <section>
                <h2 class=\"text-center test\" style=\"color: #fff\">User Panel</h2>
                <ul class=\" list-group \">
                    <li class=\"list-item\"><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=custService\">Customer Service</a></li>
                    <li class=\"list-item\"><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=offers\">Offers</a></li>
                    <li class=\"list-item\"><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=business\">Business</a></li>
                    <li class=\"list-item\"><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=comments\">Comments</a></li>
                    <li class=\"list-item\"><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=user&r=pics\">Pics</a></li>
                </ul>
            </section>
    </aside>";
}

function addPic ()
{

}

function viewPic ()
{
    global $conn, $selectErr;
    $userId = $_SESSION['loginId'];

    echo "<div class='row' style='margin-top:-30px;margin-bottom:20px;'>
    <form action='' method='post' class='form-inline'>
        <div class='form-group push-down pull-right'>
            <span class='span-error'> $selectErr</span><br>
              <select name='selectBusiness' >";
                echo "<option value=\"Select Business\">Select Business</option>";

                    $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                    $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                   while($row_bus = mysqli_fetch_array($res_bus))
                    {
                       $bus_id = $row_bus['businessId'];
                        $bus_name = $row_bus['businessName'];
                        
                        echo "<option value=\"$bus_id\">$bus_name</option>";
                    }
                    
        echo "
              </select>
              <input type='submit' name='submit' value='Filter' class='btn btn-primary'>
        </div>
    </form>
    </div>";

    $check = "SELECT * FROM businesses WHERE owner=" . $userId;
    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

    if(isset($_POST['submit']) && $_POST['submit'] == "Filter")
    {
        
        if($_POST['selectBusiness'] == "Select Business")
        {
            $selectErr = "Select a Business to filter";
        }
        else
        {
            $selBusiness = $_POST['selectBusiness'];

            $ch_pic = "SELECT profilePic FROM businesses WHERE businessId = ".$selBusiness;
            $r_pic = mysqli_query($conn, $ch_pic) or die(mysqli_error($conn));
            
            while($comm = mysqli_fetch_array($r_pic))
            {
                $b_pic = $comm['profilePic'];

                echo "
                        <div class=\"col-md-4\">
                            <a href=\"images/uploads/". $b_pic."\" data-title=\"First image\" data-lightbox=\"company\">
                                <img src=\"images/uploads/". $b_pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" height=\"400\">
                            </a>
                        </div>
                        ";
            }
            
            $row_bus = mysqli_fetch_array($res);
            
            $bus_id = $row_bus['businessId'];

            echo "<div class=\"gallery\" style=\"margin-bottom: 30px;margin-left: 30px;\">
                <div class=\"row\">";
            $check_pic = "SELECT * FROM pics WHERE businessId=".$selBusiness;
            $res_pic = mysqli_query($conn, $check_pic) or die(mysqli_error($conn));

            while ($row_comm = mysqli_fetch_array($res_pic)) {
                $pic = $row_comm['picture'];
                $picTitle = $row_comm['picTitle'];
                
                echo "
                    <div class=\"col-md-3\">
                        <a href=\"images/pics/". $pic."\" data-title=\"$picTitle\" data-lightbox=\"company\">
                            <img src=\"images/pics/". $pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" width=\"300\">
                        </a>
                    </div>
                    ";
            }
            echo "
                </div>
            </div>";
        }
    }
    else
    {
        $ch_pic = "SELECT profilePic FROM businesses WHERE owner = ".$userId;
        $r_pic = mysqli_query($conn, $ch_pic) or die(mysqli_error($conn));
        
        while($comm = mysqli_fetch_array($r_pic))
        {
            $b_pic = $comm['profilePic'];

            echo "
                    <div class=\"col-md-4\">
                        <a href=\"images/uploads/". $b_pic."\" data-title=\"First image\" data-lightbox=\"company\">
                            <img src=\"images/uploads/". $b_pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" width=\"400\">
                        </a>
                    </div>
                    ";
        }
        
        $row_bus = mysqli_fetch_array($res);
            
        $bus_id = $row_bus['businessId'];

        echo "<div class=\"gallery\" style=\"margin-bottom: 30px;margin-left: 30px;\">
            <div class=\"row\">";
        $check_pic = "SELECT * FROM pics ";
        $res_pic = mysqli_query($conn, $check_pic) or die(mysqli_error($conn));

        while ($row_comm = mysqli_fetch_array($res_pic)) {
            $pic = $row_comm['picture'];
            $picTitle = $row_comm['picTitle'];
            
            echo "
                <div class=\"col-md-3\">
                    <a href=\"images/pics/". $pic."\" data-title=\"$picTitle\" data-lightbox=\"company\">
                        <img src=\"images/pics/". $pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" width=\"300\">
                    </a>
                </div>
                ";
        }
        echo "
            </div>
        </div>";
    }
}

function newBusinessRequests() {
    global $conn;

    $priv_level = $_SESSION['access'];

    $getBusiness = "SELECT * FROM businesses WHERE activeLevel = 1 ORDER BY addedOn DESC";
    $res_bus = mysqli_query($conn, $getBusiness) or die(mysqli_error($conn));

    $numBusiness = mysqli_num_rows($res_bus);
    if ($numBusiness == 0) {
        echo "<b>No businesses are newly added</b>";
    } else {

        echo "
            <div class=\"table=responsive\">
                <table class=\"table table-hover table-condensed table-striped table-bordered\" id=\"sampleTable\">
                    <thead>
                        <tr class=\"cat_head\">
                            <th>#</th>
                            <th class='bus-name'>Business Name</th>
                            <th>Slogan</th>
                            <th>Category</td>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>";
    
            $i = 1;
            while ($row_bus = mysqli_fetch_array($res_bus)) {
                $busId = $row_bus['businessId'];
                $bName = $row_bus['businessName'];
                $slog = $row_bus['slogan'];
                $category = $row_bus['category'];
                $location = $row_bus['locatedAt'];
                $owner = $row_bus['owner'];


                $check_town = "SELECT * FROM towns WHERE townId =" . $location;
                $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

                $row_town = mysqli_fetch_array($res_town);
                    //$busId = $row_town['userId'];
                $locName = $row_town['townName'];

                $check_cat = "SELECT * FROM categories WHERE categoryId =". $category;
                $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

                $row_cat = mysqli_fetch_array($res_cat);
                $catName = ucFirst($row_cat['categoryName']);

                echo " 
                    <tr>
                        <td>$i</td>
                        <td>$bName</td>
                        <td>$slog</td>
                        <td>$catName</td>";

                            echo "
                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=editbusiness&id=$busId>View</a></td>
                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=approveBusin&id=$busId>Approve</a></td>
                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=rejectBusin&id=$busId>Reject</a></td>
                                ";
                       
                    echo "<tr>";
                $i++;
            }
        }
        echo "
                <tbody>
            </table>
        </div>";
}

function approveBusiness ()
{
    global $conn;

    $id = $_GET['id'];
    $upd = "UPDATE businesses SET activeLevel=2 WHERE businessId=$id";
    $res = mysqli_query($conn,$upd) or die(mysqli_error($conn));
    if($res)
    {
        $getBusiness = "SELECT * FROM businesses WHERE activeLevel = 1";
        $res_bus = mysqli_query($conn, $getBusiness) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($res_bus);
        $owner = $row['owner'];

        $get_user = "SELECT * FROM user WHERE userId = '$owner'";
        $res_user = mysqli_query($conn, $get_user) or die(mysqli_error($conn));
        $row_user = mysqli_fetch_array($res_user);
        $ownerEmail = $row_user['email'];

        $sendMailTo = "$ownerEmail";
        $subject = "Business approval";
        $mailbody = "This is to notify you that your business request to place your business on our site has approved. For further clarification you can contact us.";

        mail($sendMailTo,$subject,$mailbody);
       // $getBusiness = "SELECT * FROM businesses WHERE activeLevel = 1";
       // $res_bus = mysqli_query($conn, $getBusiness) or die(mysqli_error($conn));

        
        if(mail($sendMailTo,$subject,$mailbody))
        {
            echo "<script>window.alert('Email sent \n Business approved')</script>"; 
        }
        else
        {
            echo "<script>window.alert('Failed to send email \n Business approved')</script>"; 
        }

        $numBusiness = mysqli_num_rows($res_bus);
        if ($numBusiness != 0) {
           // echo "<script>window.alert('')</script>";
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=new','_self')</script>";
        }
        else
        {
            echo "<script>window.alert('No new business requests')</script>";
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
        }
    }
}

function rejectBusiness()
{
    global $conn;
    if(isset($_POST['submit']) && $_POST['submit'] == "Update")
    {
        $id = $_GET['id'];
    $upd = "UPDATE businesses SET activeLevel=3 WHERE businessId=$id";
   // $res = mysqli_query($conn,$upd) or die(mysqli_error($conn));
    if($res)
    {
        $getBusiness = "SELECT * FROM businesses WHERE activeLevel = 1 ";
        $res_bus = mysqli_query($conn, $getBusiness) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($res_bus);
        $owner = $row['owner'];

        $get_user = "SELECT * FROM user WHERE userId = '$owner'";
        $res_user = mysqli_query($conn, $get_user) or die(mysqli_error($conn));
        $row_user = mysqli_fetch_array($res_user);
      echo   $ownerEmail = $row_user['email'];
    echo "<script>window.alert('Business Rejected')</script>";
       // $to = "$ownerEmail";
        $subject = "Business approval";
        $mailbody = "This is to notify you that your business request to place your business on our site has been rejected. For further clarification you can contact us.";

        if(mail($to,$subject,$mailbody))
        {
            echo "<script>window.alert('Business Rejected')</script>"; 

            $numBusiness = mysqli_num_rows($res_bus);
            if ($numBusiness != 0) {
               // echo "<script>window.alert('Business Rejected')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=new','_self')</script>";
            }
            else
            {
                echo "<script>window.alert('No new business requests')</script>";
               // echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
            }
        }
        else
        {
            echo "<script>window.alert('Email sent ')</script>"; 
            echo "<script>window.alert('Failed to send email \n Business Rejected')</script>";
            echo "<script>alert('Failed to send email. Check your internet connection.')</script>";

            $numBusiness = mysqli_num_rows($res_bus);
            if ($numBusiness != 0) {
               // echo "<script>window.alert('Business Rejected')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=new','_self')</script>";
            }
            else
            {
                echo "<script>window.alert('No new business requests')</script>";
               // echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
            }
        }
  
    }
    }
    
}

function editPrivileges () 
{
    global $conn, $editErr;
/*
    if(isset($_POST['submit']) && $_POST['submit'] == "Update")
    {
        $id = $_GET['id'];

        if(empty($edit))
        {
            $ed = $_POST['edit'];
            echo $ed;
            echo "<script>window.alert('$ed')</script>";
        }
        else
        {
            $editErr = "Choose one option";
        }

        if(!empty($edit))
        {
            $upd = mysqli_query($conn,"UPDATE businesses SET activeLevel = $edit WHERE businessId = $id") or die(mysqli_error($conn));
            if($upd)
            {
                echo "<script>window.alert('okay')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
            }
        }
    }   */
   // else
   // {
        $check_bus = "SELECT * FROM businesses";
        $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));

        $row_bus = mysqli_fetch_array($res_bus);
        $busId = $row_bus['businessId'];
        $bName = $row_bus['businessName'];
        $desc = $row_bus['description'];
        $category = $row_bus['category'];
        $location = $row_bus['locatedAt'];
        $owner = $row_bus['owner'];
        $fon = $row_bus['phoneNo'];
        $email = $row_bus['email'];
        $add = $row_bus['address'];
        $web = $row_bus['website'];
        $slog = $row_bus['slogan'];

        $check_town = "SELECT * FROM towns WHERE townId =" . $location;
        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

        $row_town = mysqli_fetch_array($res_town);
        $locName = $row_town['townName'];

        $check_own = "SELECT * FROM user WHERE userId =" . $owner;
        $res_own = mysqli_query($conn, $check_own) or die(mysqli_error($conn));

        $row_own = mysqli_fetch_array($res_own);
        $user = ucFirst($row_own['userName']);

        $check_cat = "SELECT * FROM categories WHERE categoryId =". $category;
        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

        $row_cat = mysqli_fetch_array($res_cat);
        $catName = ucFirst($row_cat['categoryName']);

    echo "
            <div class='table-responsive tab-ed' style='align:center;'>
                <table class='table-bordered table-striped'>
                    <tr>
                        <td>Business Name : </td>
                        <td>$bName</td>
                    </tr>
                    <tr>
                        <td>Phone Number : </td>
                        <td>$fon</td>
                    </tr>
                    <tr>
                        <td>Email : </td>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <td>Address : </td>
                        <td>$add</td>
                    </tr>
                    <tr>
                        <td>Website : </td>
                        <td>$web</td>
                    </tr>
                    <tr>
                        <td>Town : </td>
                        <td>$locName</td>
                    </tr>
                    <tr>
                        <td>Category : </td>
                        <td>$catName</td>
                    </tr>
                    <tr>
                        <td>Slogan : </td>
                        <td>$slog</td>
                    </tr>
                    <tr>
                        <td>Description : </td>
                        <td>$desc</td>
                    </tr>
                    <tr>
                        <td>Edit : </td>
                        <td rowspan='2'>
                            <form method='post' style='padding-left:30px;'>
                                <div class='radio' style='color:blue;font-size:16px;'>
                                    <input type='radio' name='priv' value='1' >Pending
                                </div>
                                <div class='radio' style='color:green;font-size:16px;'>
                                   <input type='radio' name='priv' value='2' >Approve
                                </div>
                                <div class='radio' style='color:#D533B7;font-size:16px;'>
                                    <input type='radio' name='priv' value='3' >Reject
                                </div>
                                <div class='radio' style='color:red;font-size:16px;'>
                                    <input type='radio' name='priv' value='4' >Delete
                                </div>
                            <input type='submit' class='btn btn-primary pull-right' name='submit' value='Update'>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>";
  //  }
}


function ViewBusiness() {
    echo "
        <ul class='top-link'>
                <li class=\"list-link\">";
            global $busOwner, $conn;

            $priv_level = $_SESSION['access'];

            if ($priv_level !== "YES") {
                        
                        echo "<a href=" . $_SERVER['PHP_SELF'] . "?q=user&r=business&n=addbusiness>Add Business</a>";
            }
                    
            echo "
                </li>
        </ul>
        <div class=\"row\">
            <h2 class='text-center texxt' style='margin-bottom:0px;'>Registered Businesses</h2>
            <div>";
               
                $loginId = $_SESSION['loginId'];
                if ($priv_level == "YES") {
                    $check_bus = "SELECT * FROM businesses";
                    $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                } else {
                    $check_bus = "SELECT * FROM businesses WHERE owner='$loginId' && activeLevel = 2";
                    $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                }

                    $numBusiness = mysqli_num_rows($res_bus);
                    if ($numBusiness == 0) {
                        echo "<b>No business to show.</b>";
                    }
                    else {

                        
                            echo " 
                                <div class=\"table=responsive\" style=\"max-height: 450px;overflow: auto;\">
                                    <table class=\"table table-hover table-condensed table-striped table-bordered\" id=\"sampleTable\">
                                        <thead>
                                            <tr class=\"cat_head\">
                                                <th>#</th>
                                                <th class='bus-name'>Business Name</th>
                                                <th>Category</td>
                                                <th>Location</th>
                                                <th>owner</th>
                                                <th>Activated</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>";

                            $i = 1;
                            while ($row_bus = mysqli_fetch_array($res_bus)) {
                                $busId = $row_bus['businessId'];
                                $bName = $row_bus['businessName'];
                                $active = $row_bus['activeLevel'];
                                $category = $row_bus['category'];
                                $location = $row_bus['locatedAt'];
                                $owner = $row_bus['owner'];

                                if($active == 1)
                                {
                                    if($_SESSION['access'] == "YES")
                                    {
                                        $active = "<a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=edit&id=$busId style='color:blue;' title='click to edit'>Pending</a>";;
                                    }
                                    else
                                    {
                                        $active = "<span style='color:blue;'>Pending</span>";
                                    }
                                    
                                }
                                elseif($active == 2)
                                {
                                    if($_SESSION['access'] == "YES")
                                    {
                                        $active = "<a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=edit&id=$busId style='color:green;' title='click to edit'>Approved</a>";
                                    }
                                    else
                                    {
                                        $active = "<span style='color:green;'>Approved</span>";
                                    }
                                    
                                }
                                elseif($active == 3)
                                {
                                    if($_SESSION['access'] == "YES")
                                    {
                                        $active = "<a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=edit&id=$busId style='color:red;' title='click to edit'>Rejected</a>";
                                    }
                                    else
                                    {
                                        $active = "<span style='color:red;'>Rejected</span>";
                                    }
                                    
                                }
                                else
                                {
                                    if($_SESSION['access'] == "YES")
                                    {
                                        $active = "<a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=edit&id=$busId style='color:#D533B7;' title='click to edit'>Deleted</a>";
                                    }
                                    else
                                    {
                                        $active = "<span style='color:#D533B7;'>Deleted</span>";
                                    }
                                    
                                }

                                $check_town = "SELECT * FROM towns WHERE townId =" . $location;
                                $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

                                $row_town = mysqli_fetch_array($res_town);
                                $locName = $row_town['townName'];

                                $check_own = "SELECT * FROM user WHERE userId =" . $owner;
                                $res_own = mysqli_query($conn, $check_own) or die(mysqli_error($conn));

                                $row_own = mysqli_fetch_array($res_own);
                                $user = ucFirst($row_own['userName']);

                                $check_cat = "SELECT * FROM categories WHERE categoryId =". $category;
                                $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

                                $row_cat = mysqli_fetch_array($res_cat);
                                $catName = ucFirst($row_cat['categoryName']);

                                echo " 
                                    <tr>
                                        <td>$i</td>
                                        <td>$bName</td>
                                        <td>$catName</td>
                                        <td>$locName</td>
                                        <td>$user</td>
                                        <td>$active</td>";

                                        if ($priv_level == "YES") {
                                            echo "
                                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=editbusiness&id=$busId>View</a></td>
                                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business&n=deletebusiness&id=$busId>Delete</a></td>
                                                ";
                                        } 
                                        else {
                                            echo "
                                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=business&n=editbusiness&id=$busId>Edit</a></td>
                                                    <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=business&n=deletebusiness&id=$busId>Delete</a></td>
                                                ";
                                        }
                                    echo "<tr>";
                                $i++;
                            }
                    }
                    echo "
                    <tbody>
                </table>
            </div>
        </div>";
}

function deleteBusiness () {
    global $conn;
    if(isset($_GET['n']) && $_GET['n'] == "deletebusiness")
    {
        $control = $_GET['q'];

        if($control == "admin")
        {
            $id = $_GET['id'];
            $del_bus = "DELETE FROM businesses WHERE businessId=".$id;
            $res_bus = mysqli_query($conn,$del_bus) or die(mysqli_error($conn));

            if($res_bus) {
                echo "<script>alert('Deletion of business successful')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=business','_self')</script>";
            }
        }
        else
        {
            $id = $_GET['id'];
            $upd_bus = "UPDATE businesses SET activeLevel = 4 WHERE businessId=".$id;
            $res_bus = mysqli_query($conn,$upd_bus) or die(mysqli_error($conn));

            if($res_bus) {
                echo "<script>alert('Deletion of business successful')</script>";
                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=business','_self')</script>";
            }
        }

    }
}

function newUserRequests (){

    global $conn;
    echo "
        <div class=\"row\">
            <div class=\"table-responsive\">
                    <table align=\"center\" class=\"table table-striped table-bordered table-hover\" >
                        <thead>
                            
                            <tr class=\"cat_head\">
                                <td>#</td>
                                <td>Username</td>
                                <td>Full Name</td>
                                <td>Email</td>
                                <td>Town</td>
                                <td>Address</td>
                                <td>Phone No</td>
                                <td>Activated</td>
                                <td>Admin</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        ";
                          
                            $check_user = "SELECT * FROM user WHERE entry = 1";
                            $res_user = mysqli_query($conn, $check_user) or die(mysqli_error($conn));

                            $num_user_count = mysqli_num_rows($res_user);
                            if($num_user_count == 0)
                            {
                                //echo "<p class='text-center'><b>There is no new user account</b></p>    ";
                                echo "<b><script>window.alert(\"There is no new user account\")</script></b>";
                                echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users','_self')</script>";
                            }
                            else
                            {
                                 $i = 1;
                                while ($row_user = mysqli_fetch_array($res_user)) {
                                    $userId = $row_user['userId'];
                                    $userName = $row_user['userName'];
                                    $fName = ucFirst($row_user['fullName']);
                                    $email = $row_user['email'];
                                    $city = $row_user['city'];
                                    $address = $row_user['address'];
                                    $phoneNo = $row_user['phoneNo'];
                                    $active = $row_user['activated'];
                                    $priv_level = $row_user['administrator'];

                                $check_town = "SELECT * FROM towns WHERE townId=".$city;
                                $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));
                                $row_town = mysqli_fetch_array($res_town);
                                $town = $row_town['townName'];

                                    echo " 
                                    <tbody>
                                        <tr>
                                            <td>$i</td>
                                            <td>$userName</td>
                                            <td>$fName</td>
                                            <td>$email</td>
                                            <td>$town</td>
                                            <td>$address$i</td>
                                            <td>$phoneNo</td>
                                            <td>$active</td>
                                            <td>$priv_level</td>
                                            <td><a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users&n=edituser&id=$userId\">Edit</a></td>
                                            <td><a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users&n=deleteuser&id=$userId\">Delete</a></td>
                                        </tr>
                                        ";

                                    $i++;
                                }
                            }

            echo "
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>";
}

function addOffers() {

    global $titleErr, $offerErr, $endDateErr, $businessErr, $conn;

    echo "
            <ul class=\"top_link\">
                <li class=\"list-link\"><a href=\"" . $_SERVER['PHP_SELF'] . "?q=user&r=offers\">View Offer</a></li>
           </ul>";
    echo "<section>
            <form class='form-horizontal' method='post'>
                <div class='form-group'>
                    <label class='control-label col-sm-3'>Business Name:</label>
                    <span class=\"span-error\"> * $businessErr</span><br>
                    <div class='col-sm-9'>
                        <select name=\"business\">
                            <option value=\"Select Business\">Select Business</option>";
                        $userId = $_SESSION['loginId'];
                        $check_business = "SELECT * FROM businesses WHERE owner=" . $userId;
                        $res_business = mysqli_query($conn, $check_business) or die(mysqli_error($conn));

                        while ($row_business = mysqli_fetch_array($res_business)) {
                            $busId = $row_business['businessId'];
                            $busName = $row_business['businessName'];

                            echo "<option value=\" $busId\"> $busName </option>";
                        }
                        echo "</select>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3\">Offer Title:</label>
                    <span class=\"span-error\">* $titleErr</span><br>
                    <div class='col-sm-6'>
                        <input type=\"text\" class=\"form-control\" name=\"title\" placeholder=\"Enter name\">
                    </div>
               </div>
               <div class=\"form-group\">
                    <label class=\"control-label col-sm-3\">Description:</label>
                    <span class=\"span-error\">* $offerErr</span><br>
                    <div class='col-sm-6'>
                        <textarea name=\"offer\" class=\"form-control\" cols=\"25\" rows=\"5\" placeholder=\"Write a comment\"></textarea>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"control-label col-sm-3\">End Date:</label>
                    <span class=\"span-error\">* $endDateErr</span><br>
                    <div class='col-sm-6'>
                        <input type=\"date\" class=\"form-control\" name=\"endDate\" placeholder=\"yyyy-mm-dd\">
                    </div>
                </div>
                <div class=\"form-group\">
                    <div class='col-sm-offset-3 col-sm-10'>
                        <input type=\"submit\" name=\"submit\" class=\"btn btn-info btn-lg\" value=\"Add Offer\">
                    </div>
                </div>
            </form>
        </section>";
}

function viewOffers() {
    global $conn, $selectErr;
    $userId = $_SESSION['loginId'];
    
    echo " <ul class=\"direction\">
                <li class=\"list-link\"><a href=\"" . $_SERVER['PHP_SELF'] . "?q=user&r=offers&n=addoffer\">Add Offer</a></li>
            </ul>
            ";
    echo "<form action='' method='post' class='form-inline'>
            <div class='form-group push-down pull-right'>
                <span class='span-error'> $selectErr</span><br>
                <select name='selectBusiness' >";
                    echo "<option value=\"Select Business\">Select Business</option>";
    
                        $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                        $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                       while($row_bus = mysqli_fetch_array($res_bus))
                        {
                           $bus_id = $row_bus['businessId'];
                            $bus_name = $row_bus['businessName'];
                            
                            echo "<option value=\"$bus_id\">$bus_name</option>";
                        }
                        
                    echo "
                </select>
                <input type='submit' name='submit' value='Filter' class='btn btn-primary'>
            </div>
        </form>";

    

    $check = "SELECT * FROM businesses WHERE owner=" . $userId;
    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

    $num = mysqli_num_rows($res);
    if($num == 0)
    {
        echo "<b>No business associated with this account. 
                <br><br>Register a business so as to add an offer.</b>";
    }
    else
    {
        echo "
            <div class=\"main-content\">
                <div class='table-responsive'>
                    <table class=\"table table-hover table-condensed table-striped table-bordered\">
                        <thead>
                            <tr class=\"cat_head\">
                                <td>#</td>
                                <th>Offer Title</th>
                                <th>Offer Description</th>
                                <th>Owner</th>
                                <th>Added On</th>
                                <th>Valid Until</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>";
        if(isset($_POST['submit']) && $_POST['submit'] == "Filter")
        {
            
            if($_POST['selectBusiness'] == "Select Business")
            {
                $selectErr = "Select a Business to filter";
            }
            else
            {
                $selBusiness = $_POST['selectBusiness'];
                $i=1;
                $row_bus = mysqli_fetch_array($res);
         
              $bus_id = $row_bus['businessId'];
              $bus_name = $row_bus['businessName'];
              
              $get_offer = "SELECT * FROM offers WHERE businessId =".$selBusiness;
              $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));
              
              
             while($row_offer = mysqli_fetch_array($res_offer))
              {
                  $off_id = $row_offer['offerId'];
                  $off_title = $row_offer['offerTitle'];
                  $off_desc = $row_offer['description'];
                  $business = $row_offer['businessId'];
                  $time_start = date("F d, Y", strtotime($row_offer['addedOn']));
                  $time_end = date("F d, Y", strtotime($row_offer['validUntil']));
                  
                  $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                  $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                  $row_bus = mysqli_fetch_array($res_business);
                  $business = $row_bus['businessName'];
                  
                  echo "
                    <tr class='danger'>
                        <td>$i</td>
                        <td>$off_title</td>
                        <td>$off_desc</td>
                        <td>$business</td>
                        <td>$time_start</td>
                        <td>$time_end</td>
                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=offers&e=editupdate&id=$off_id>Edit</a></td>
                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=offers&e=deleteoffer&id=$off_id>Delete</a></td>
                </tr>";
                  
                  
                  $i++;
              }
            }
        }
        else
        {
            $i=1;
          while($row_bus = mysqli_fetch_array($res))
          {
              $bus_id = $row_bus['businessId'];
              $bus_name = $row_bus['businessName'];
              
              $get_offer = "SELECT * FROM offers WHERE businessId =".$bus_id;
              $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));
              
              
              while($row_offer = mysqli_fetch_array($res_offer))
              {
                  $off_id = $row_offer['offerId'];
                  $off_title = $row_offer['offerTitle'];
                  $off_desc = $row_offer['description'];
                  $business = $row_offer['businessId'];
                  $time_start = date("F d, Y", strtotime($row_offer['addedOn']));
                  $time_end = date("F d, Y", strtotime($row_offer['validUntil']));
                  
                  $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                  $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                  $row_bus = mysqli_fetch_array($res_business);
                  $business = $row_bus['businessName'];
                  
                  echo "
                    <tr>
                        <td>$i</td>
                        <td>$off_title</td>
                        <td>$off_desc</td>
                        <td>$business</td>
                        <td>$time_start</td>
                        <td>$time_end</td>
                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=offers&e=editupdate&id=$off_id>Edit</a></td>
                        <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=offers&e=deleteoffer&id=$off_id>Delete</a></td>
                    </tr>";
                  
                  $i++;
              }
              
          }
        }
    }
    echo "</tbody>
        </table>
            </div>
            </div>";
}

function addComment() { 

        global $nameErr, $emailErr, $commentErr, $businessErr, $conn;

        echo " 
                  <div class=\"tabl\">
                  <ul class=\"text-center\">
                        <li class=\"list-link\"><a href=\"" . $_SERVER['PHP_SELF'] . "?q=user&r=comments\">View Offer</a></li>
                   </ul>
                  
                  <div class=\"col-md-8\">
                        <section>
                            <h4>Write a comment</h4>
                            <form class=\"form-horizontal\" method=\"POST\">
                                <div class=\"form-group\">
                                    <label class=\"label-control\">Business:</label>
                                    <span class=\"span-error\"> * $businessErr</span><br>
                                    <select name=\"business\">
                                        <option value=\"Select Business\">Select Business</option>";

        $userId = $_SESSION['loginId'];
        $check_business = "SELECT * FROM businesses WHERE owner=" . $userId;
        $res_business = mysqli_query($conn, $check_business) or die(mysqli_error($conn));

        while ($row_business = mysqli_fetch_array($res_business)) {
            $busId = $row_business['businessId'];
            $busName = $row_business['businessName'];

            echo "<option value=\" $busId\"> $busName </option>";
        }
        echo "</select>
                                </div>
                                <div class=\"form-group\">
                                    <label class=\"label-control\">Offer Title:</label>
                                    <span class=\"span-error\">* $titleErr</span>
                                    <input type=\"text\" class=\"form-control\" name=\"title\" placeholder=\"Enter name\">
                                </div>
                                <div class=\"form-group\">
                                    <label class=\"label-control\">Description:</label>
                                    <span class=\"span-error\">* $offerErr</span>
                                    <textarea name=\"offer\" class=\"form-control\" cols=\"25\" rows=\"5\" placeholder=\"Write a comment\"></textarea>
                                </div>
                                <div class=\"form-group\">
                                    <label class=\"label-control\">End Date:</label>
                                    <span class=\"span-error\">* $endDateErr</span>
                                    <input type=\"date\" class=\"form-control\" name=\"endDate\" placeholder=\"yyyy-mm-dd\">
                                </div>
                                <div class=\"form-group\">
                                    <input type=\"submit\" name=\"submit\" class=\"btn btn-info\" value=\"Add Offer\">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <div";
    
}

function viewComments() {
    global $conn, $selectErr;
    $userId = $_SESSION['loginId'];

    $check = "SELECT * FROM businesses WHERE owner=" .$userId;
    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

    $num = mysqli_num_rows($res);
    if($num == 0)
    {
        echo "<b>No business associated with this account. 
                <br><br>Register a business so as to add an offer.</b>";
    }
    else
    {
        echo "<div class=''>
                <form action='' method='post' class='form-inline'>
                    <div class='form-group  modify-section'>
                        <span class='span-error'> $selectErr</span><br>
                          <select name='selectBusiness' >";
                            echo "<option class='selec-form' value=\"Select Business\">Select Business</option>";
            
                                $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                                $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                               while($row_bus = mysqli_fetch_array($res_bus))
                                {
                                   $bus_id = $row_bus['businessId'];
                                    $bus_name = $row_bus['businessName'];
                                    
                                    echo "<option value=\"$bus_id\">$bus_name</option>";
                                }
                                
                    echo "
                          </select>
                          <input type='submit' name='submit' value='Filter' class='btn btn-primary'>
                    </div>
                </form>
             </div>";

        echo "<div class='table-responsive'>
                <div class='push-down-table' style='margin-top:0px'>
                    <table class='table table-bordered table-striped'>
                        <thead>
                            <tr class='cat_head'>
                                <td>#</td>
                                <th>Comment Writer</th>
                                <th>Writer Email</th>
                                <th>Comment</th>
                                <th>Business</th>
                                <th>Added On</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                    if(isset($_POST['submit']) && $_POST['submit'] == "Filter")
                    {
                      
                        if($_POST['selectBusiness'] == "Select Business")
                        {
                            $selectErr = "Select a Business to filter";
                        }
                        else
                        {
                             $selBusiness = $_POST['selectBusiness'];
                            
                              $row_bus = mysqli_fetch_array($res);
                        
                              $bus_id = $row_bus['businessId'];
                              $bus_name = $row_bus['businessName'];
                              
                              $get_comm = "SELECT * FROM comments WHERE businessId =".$selBusiness;
                              $res_comm = mysqli_query($conn,$get_comm) or die(mysqli_error($conn));
                              $num_comm = mysqli_num_rows($res_comm);
                              if($num_comm == 0)
                              {
                                    echo "<b>No comments associated with this business.
                                    </b>";
                              }
                              else
                              {
                                $i=1;
                                 while($row_comment = mysqli_fetch_array($res_comm))
                                  {
                                      $comment_id = $row_comment['commentId'];
                                      $writer_name = $row_comment['fullName'];
                                      $comment = $row_comment['comment'];
                                      $email = $row_comment['email'];
                                      $business = $row_comment['businessId'];
                                      $time_added = date("F d, Y", strtotime($row_comment['addedOn']));
                                      
                                      $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                                      $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                                      $row_bus = mysqli_fetch_array($res_business);
                                      $business = $row_bus['businessName'];
                                      
                                      echo "
                                        <tr>
                                            <td>$i</td>
                                            <td>$writer_name</td>
                                            <td>$email</td>
                                            <td>$comment</td>
                                            <td>$business</td>
                                            <td>$time_added</td>
                                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=comments&e=updatecomment&id=$comment_id>Edit</a></td>
                                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=comments&e=deletecomment&id=$comment_id>Delete</a></td>
                                         </tr>";
                                      
                                      
                                      $i++;
                                  }
                              }
                        }
                      
                    }
                    else
                    {
                        $row_bus = mysqli_fetch_array($res);
                        $business_id = $row_bus['businessId'];

                        $get_comm = "SELECT * FROM comments WHERE businessId =".$business_id;
                        $res_comm = mysqli_query($conn,$get_comm) or die(mysqli_error($conn));
                        $num_comm = mysqli_num_rows($res_comm);

                        if($num_comm == 0)
                        {
                            echo "<b>No comments associated with this business.
                                    </b></b>";
                        }
                        else
                        {
                            $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                                $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));

                            $i=1;
                            while($row = mysqli_fetch_array($res_bus))
                            {
                                $business_id = $row['businessId'];
                                $get_comm = "SELECT * FROM comments WHERE businessId =".$business_id;
                                $res_comm = mysqli_query($conn,$get_comm) or die(mysqli_error($conn));
                                
                                while($row_comment = mysqli_fetch_array($res_comm))
                                {
                                      $comment_id = $row_comment['commentId'];
                                      $writer_name = $row_comment['fullName'];
                                      $comment = $row_comment['comment'];
                                      $email = $row_comment['email'];
                                      $business = $row_comment['businessId'];
                                      $time_added = date("F d, Y", strtotime($row_comment['addedOn']));
                                      
                                      $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                                      $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                                      $row_bus = mysqli_fetch_array($res_business);
                                      $business = $row_bus['businessName'];
                                      
                                      echo "
                                        <tr>
                                            <td>$i</td>
                                            <td>$writer_name</td>
                                            <td>$email</td>
                                            <td>$comment</td>
                                            <td>$business</td>
                                            <td>$time_added</td>
                                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=comments&e=updatecomment&id=$comment_id>Edit</a></td>
                                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=comments&e=deletecomment&id=$comment_id>Delete</a></td>
                                    </tr>";
                                      
                                      $i++;
                                  }
                            }
                        }
                    }
                echo "
                        </tbody>
                    </table>
                    </div>
                </div>
                ";

    }
}

function addCustomerService() {
   global $titleErr, $descErr, $businessErr, $conn;

    echo "
        <ul class=\"top_link\">
            <li class=\"list-link\"><a href=\"" . $_SERVER['PHP_SELF'] . "?q=user&r=custService\">View Customer Service</a></li>
       </ul>";

       if(isset($_GET['e']) && $_GET['e'] == "editupdate")
        {
            $bid = $_GET['id'];
            
              $get_offer = "SELECT * FROM customerservices WHERE serviceId =".$bid;
              $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));

              $row_cust = mysqli_fetch_array($res_offer);

              $business = $row_cust['businessId'];
              $cust_desc = $row_cust['description'];
              $cust_title = $row_cust['title'];
            
              //$added = date("F d, Y", strtotime($row_cust['addedOn']));

              $get_business = "SELECT * FROM businesses WHERE businessId =".$business;
              $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
            
              $row_bus = mysqli_fetch_array($res_business);
              $business = $row_bus['businessName'];
              $busId = $row_bus['businessId'];
            
            echo "
            <section>
                <h2>Update service</h2>
                <form class=\"form-horizontal\" method=\"POST\">
                    <div class=\"form-group\">
                        <label class=\"control-label\">Business:</label>
                        <span class=\"span-error\"> *". $businessErr."</span><br>
                        <div class='col-md-9'>
                            <input type='text' name='business' readonly class='form-control' value='$business'>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label class=\"label-control\">Service Title:</label>
                        <span class=\"span-error\">*". $titleErr."</span><br>
                        <div class='col-sm-9'>
                            <input type=\"text\" value='$cust_title' class=\"form-control\" name=\"title\" placeholder=\"Service Title\">
                        </div>
                   </div>
                    <div class=\"form-group\">
                        <label class=\"label-control\">Description:</label>
                        <span class=\"span-error\">*". $descErr."</span><br>
                        <div class='col-sm-9'>
                            <input type='text' name=\"description\" value=\"$cust_desc\" class=\"form-control\" cols=\"25\" rows=\"5\" placeholder=\"Write a description\">
                        </div>
                    </div>
                    <input type='hidden' value='$busId' name='busId'>
                    <div class=\"form-group\">
                        <input type=\"submit\" name=\"submit\" class=\"btn btn-info\" value=\"Update Service\">
                    </div>
                </form>
            </section>";
        }
        else{
            echo "<section>
                    <form class='form-horizontal' method='post'>
                        <div class='form-group'>
                            <label class='control-label col-sm-3'>Business Name:</label>
                            <span class=\"span-error\"> * $businessErr</span><br>
                            <div class='col-sm-9'>
                                <select name=\"business\">
                                    <option value=\"Select Business\">Select Business</option>";
                                $userId = $_SESSION['loginId'];
                                $check_business = "SELECT * FROM businesses WHERE owner=" . $userId;
                                $res_business = mysqli_query($conn, $check_business) or die(mysqli_error($conn));

                                while ($row_business = mysqli_fetch_array($res_business)) {
                                    $busId = $row_business['businessId'];
                                    $busName = $row_business['businessName'];

                                    echo "<option value=\" $busId\"> $busName </option>";
                                }
                                echo "</select>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-sm-3\">Service Title:</label>
                            <span class=\"span-error\">* $titleErr</span><br>
                            <div class='col-sm-6'>
                                <input type=\"text\" class=\"form-control\" name=\"title\" placeholder=\"Service Title\">
                            </div>
                       </div>
                       <div class=\"form-group\">
                            <label class=\"control-label col-sm-3\">Description:</label>
                            <span class=\"span-error\">* $descErr</span><br>
                            <div class='col-sm-6'>
                                <textarea name=\"description\" class=\"form-control\" cols=\"25\" rows=\"5\" placeholder=\"Write a comment\"></textarea>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <div class='col-sm-offset-3 col-sm-10'>
                                <input type=\"submit\" name=\"submit\" class=\"btn btn-info btn-lg\" value=\"Add Service\">
                            </div>
                        </div>
                    </form>
                </section>";
                                               
            }
}

function viewCustomerService() {
    global $conn, $selectErr;
    $userId = $_SESSION['loginId'];
    
    echo " <ul class=\"direction\">
                <li class=\"list-link\"><a href=\"" . $_SERVER['PHP_SELF'] . "?q=user&r=custService&n=addService\">Add Customer Service</a></li>
            </ul>
            ";
    echo "<form action='' method='post' class='form-inline'>
            <div class='form-group push-down pull-right'>
                <span class='span-error'> $selectErr</span><br>
                  <select name='selectBusiness' >";
                    echo "<option value=\"Select Business\">Select Business</option>";
    
                        $check_bus = "SELECT * FROM businesses WHERE owner=" . $userId;
                        $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));
                       while($row_bus = mysqli_fetch_array($res_bus))
                        {
                           $bus_id = $row_bus['businessId'];
                            $bus_name = $row_bus['businessName'];
                            
                            echo "<option value=\"$bus_id\">$bus_name</option>";
                        }
                        
            echo "
                  </select>
                  <input type='submit' name='submit' value='Filter' class='btn btn-primary'>
            </div>
            </form>";

    

    $check = "SELECT * FROM businesses WHERE owner=" . $userId;
    $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

    $num = mysqli_num_rows($res);
    if($num == 0)
    {
        echo "<p><b>No business associated with this account. 
                <br><br>Register a business so as to add a service.</b></p>";
    }
    else
    {
        
        echo "
            <div class=\"main-content services\">
                <div class='table-responsive'>
                <table class=\"table table-striped table-bordered\">
                <thead>
                    <tr class=\"cat_head\">
                        <td>#</td>
                        <th>Service Title</th>
                        <th>Service Description</th>
                        <th>Business Name</th>
                        <th>Added On</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        if(isset($_POST['submit']) && $_POST['submit'] == "Filter")
        {
            
            if($_POST['selectBusiness'] == "Select Business")
            {
                $selectErr = "Select a Business to filter";
            }
            else
            {
                $selBusiness = $_POST['selectBusiness'];
                $i=1;
                $row_bus = mysqli_fetch_array($res);
          
                $bus_id = $row_bus['businessId'];
                $bus_name = $row_bus['businessName'];
              
                $get_offer = "SELECT * FROM customerservices WHERE businessId =".$selBusiness;
                $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));
              
              
                 while($row_cust = mysqli_fetch_array($res_offer))
                  {
                      $cust_id = $row_cust['serviceId'];
                      $business = $row_cust['businessId'];
                      $cust_desc = $row_cust['description'];
                      $cust_title = $row_cust['title'];
                      $added = date("F d, Y", strtotime($row_cust['addedOn']));
                      
                      $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                      $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                      $row_bus = mysqli_fetch_array($res_business);
                      $business = $row_bus['businessName'];
                      
                      echo "
                        <tr class='danger'>
                            <td>$i</td>
                            <td>$cust_title</td>
                            <td>$cust_title</td>
                            <td>$cust_desc</td>
                            <td>$business</td>
                            <td>$added</td>
                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=customerservice&e=editupdate&id=$cust_id>Edit</a></td>
                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=customerservice&e=deleteservice&id=$cust_id>Delete</a></td>
                        </tr>";
                      
                      $i++;
                  }
            }
          
        }
        else
        {
            $i=1;
              while($row_bus = mysqli_fetch_array($res))
              {
                  $bus_id = $row_bus['businessId'];
                  $bus_name = $row_bus['businessName'];
                  
                  $get_offer = "SELECT * FROM customerservices WHERE businessId =".$bus_id;
                  $res_offer = mysqli_query($conn,$get_offer) or die(mysqli_error($conn));
                  
                  
                  while($row_cust = mysqli_fetch_array($res_offer))
                  {
                      $cust_id = $row_cust['serviceId'];
                      $business = $row_cust['businessId'];
                      $cust_desc = $row_cust['description'];
                      $cust_title = $row_cust['title'];
                      $added = date("F d, Y", strtotime($row_cust['addedOn']));
                      
                      $get_business = "SELECT businessName FROM businesses WHERE businessId =".$business;
                      $res_business = mysqli_query($conn,$get_business) or die(mysqli_error($conn));
                      $row_bus = mysqli_fetch_array($res_business);
                      $business = $row_bus['businessName'];
                      
                      echo "
                        <tr>
                            <td>$i</td>
                            <td>$cust_title</td>
                            <td>$cust_desc</td>
                            <td>$business</td>
                            <td>$added</td>
                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=custService&e=editupdate&id=$cust_id>Edit</a></td>
                            <td><a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?q=user&r=custService&e=deleteservice&id=$cust_id>Delete</a></td>
                        </tr>";
                      
                      $i++;
                  }
                  
              }
        }
    }
    echo "</tbody>
            </table>
            </div>
            </div>";
}
