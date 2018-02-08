<?php

    if(isset($_GET['n']) && $_GET['n'] == "deleteuser")
    {
        $id = $_GET['id'];
        $check = "DELETE FROM user WHERE userId=".$id;
        $res = mysqli_query($conn,$check) or die(mysqli_error($conn));
        
        if($res)
        {
            echo "<script>window.open('".htmlspecialchars($_SERVER['PHP_SELF'])."?q=admin&r=users','_self')</script>";
        }
    }

?>
<!DOCTYPE html>
<html>
    <style>
       .cat_head{
    background-color :#2DAAE4;
    font-size: 18px;
}
    </style>
    
    <div class="row">
        <h2 class='text-center texxt' style='margin-top:-10px;margin-bottom:0px;'>Registered Users</h2>
            <div class="table-responsive" style="max-height: 450px;overflow: auto;">
                <table align="center" class="table table-striped table-condensed table-bordered table-hover" >
                    <thead>
                        
                        <tr class="cat_head">
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
                    <tbody>
                        <?php
                        $check_user = "SELECT * FROM user";
                        $res_user = mysqli_query($conn, $check_user) or die(mysqli_error($conn));

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
                        ?>
                    </tbody>
                </table>  
            </div>
    </div>
</html>