<?php
$display = $searchCat = $locatSearch = "";
if(isset($_GET['cat']))
{
    $cat = $_GET['cat'];
    
    $check_bus = "SELECT * FROM businesses WHERE category=".$cat;
    $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));

    $num_row = mysqli_num_rows($res_bus);
    if($num_row == 0){
        $display = "<b style=\"color:red;\">No business associated with that category</b>";
    }

    $i=1;
   while($row_num=mysqli_fetch_array($res_bus))
   {
        $busId = $row_num['businessId'];
        $bName = $row_num['businessName'];
        $slog = $row_num['slogan'];
        $category = $row_num['category'];
        $location = $row_num['locatedAt'];
        $desc = $row_num['description'];
        $pic = $row_num['profilePic'];

        $check_cat = "SELECT * FROM categories WHERE categoryId = $category";
        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

        $row_cat = mysqli_fetch_array($res_cat);
        $catName = $row_cat['categoryName'];
        
        $check_town = "SELECT * FROM towns WHERE townId =" . $location;
        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

        $row_town = mysqli_fetch_array($res_town);
        $locName = $row_town['townName'];
       
        $display .= " 
                    <div id=\"bus-edit\" class=\"bus-det view hm-blue-light\">
                            <img src=\"images/uploads/". $pic ."\" class=\"img-responsive img-rounded\"  height=\"100px\" ><br>
                           <b> Businss type : </b>".$catName." </br>
                            <b>Location: </b>". $locName."<br>
                            <b>Description :</b>".$desc ."<br>
                            <p><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&business=$bName&b=$busId\" >view profile <span><i class=\"fa-long-arrow-right pulse\"></i></span></a></p>
                        </div>
                    ";
       $i++;
   }
    
}


if (isset($_POST['submit']) && $_POST['submit'] == "Search") 
{
    $search = $_POST['search'];
    $search = preg_replace("#[^0-9a-z]#i","",$search);
    
    if($_POST['searchCat'] !== "Select Category")
    {
        $searchCat = $_POST['searchCat'];
    }
    else
    {
        $searchCat = "";
    }
    
    if($_POST['searchLocat'] !== "Select Location")
    {
        $locatSearch = $_POST['searchLocat'];
    }
     else
    {
        $locatSearch = "";
    }
    
    if(!empty($search) && !empty($searchCat) && !empty($locatSearch))
    {
        $check_bus = "SELECT * FROM businesses WHERE businessName LIKE '%".$search."%' and category = ".$searchCat." and locatedAt =".$locatSearch;
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    elseif(!empty($search) && !empty($searchCat))
    {
        $check_bus = "SELECT * FROM businesses WHERE businessName LIKE '%".$search."%' and category=".$searchCat;
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    elseif(!empty($search) && !empty($locatSearch))
    {
        $check_bus = "SELECT * FROM businesses WHERE businessName LIKE '%".$search."%' and locatedAt=".$locatSearch;
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    elseif(!empty($searchCat) && !empty($locatSearch))
    {
        $check_bus = "SELECT * FROM businesses WHERE category=$searchCat"." and locatedAt=".$locatSearch;
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    elseif(!empty($searchCat))
    {
        $check_bus = "SELECT * FROM businesses WHERE category=$searchCat";
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    elseif(!empty($locatSearch))
    {
        $check_bus = "SELECT * FROM businesses WHERE locatedAt=".$locatSearch;
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search".mysqli_error($conn));
    }
    else{
        $check_bus = "SELECT * FROM businesses WHERE businessName LIKE '%$search%'";
        $res_bus = mysqli_query($conn, $check_bus) or die("Could not search");
    }
        
    //$check_bus = "SELECT * FROM businesses WHERE businessName LIKE '%$search%'";
    //$res_bus = mysqli_query($conn, $check_bus) or die("Could not search");

    $num = mysqli_num_rows($res_bus);
    if ($num == 0) {
        $display .= "<p class=\"color\">There is no search results";
    } 
    else 
    {

    $i=1;
   while($row_bus = mysqli_fetch_array($res_bus))
   {
       $busId = $row_bus['businessId'];
        $bName = $row_bus['businessName'];
        $slog = $row_bus['slogan'];
        $category = $row_bus['category'];
        $location = $row_bus['locatedAt'];
        $desc = $row_bus['description'];
        $pic = $row_bus['profilePic'];
        
        $check_cat = "SELECT * FROM categories WHERE categoryId = $category";
        $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

        $row_cat = mysqli_fetch_array($res_cat);
        $catName = ucfirst($row_cat['categoryName']);
        
        $check_town = "SELECT * FROM towns WHERE townId =" . $location;
        $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

        $row_town = mysqli_fetch_array($res_town);
        //$busId = $row_town['userId'];
        $locName = ucfirst($row_town['townName']);

        $display .= " 
                        <div id=\"bus-edit\" class=\"bus-det\">
                            <img src=\"images/uploads/". $pic ."\" class=\"img-responsive img-rounded\"  height=\"100px\" ><br>
                            <b>Business name : </b>$bName <br>
                           <b> Businss type : </b>".$catName." </br>
                            <b>Location: </b>". $locName."<br>
                            <b>Description :</b>".$desc ."<br>
                            <p><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&business=$bName&b=$busId\" >view profile <span><i class=\"fa-long-arrow-right pulse\"></i></span></a></p>
                        </div>
                    ";
       $i++;
        }
    }
}
   

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Web Marketer</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>


        </style>

    </head>
    <body>

        <div class="container top soll">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?home"><span class="fa-long-arrow-left" style="margin-top: -20px;">Back</span></a>
            <div class="row">
                <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=portfolio">
                    <h3 class="textSearch">Search business:</h3>
                    <div class="col-lg-3 col-md-3 port-data">
                        <div class="form-group">
                            <label>Search for:</label><br>
                            <input type="text" name="search" autofocus placeholder="Search business" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 port-data">
                        <div class="form-group">
                            <label>Category:</label><br>
                            <select name="searchCat" style="padding: 5px; border-radius: 3px">
                                <option value="Select Category">Select Category</option>
                                <?php
                                    $check_cat = "SELECT * FROM categories";
                                    $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));

                                    while($row_cat = mysqli_fetch_array($res_cat))
                                    {
                                        $catId = $row_cat['categoryId'];
                                        $catName = $row_cat['categoryName'];
                                    
                                        echo "<option value=\"$catId\">$catName</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 port-data">
                        <div class="form-group">
                            <label>Location:</label><br>
                            <select name="searchLocat" style="padding: 5px; border-radius: 3px">
                                <option value="Select Location">Select Location</option>
                                <?php
                                    $check_town = "SELECT * FROM towns";
                                    $res_town = mysqli_query($conn, $check_town) or die(mysqli_error($conn));

                                    while($row_town = mysqli_fetch_array($res_town))
                                    {
                                        $townId = $row_town['townId'];
                                        $townName = $row_town['townName'];
                                    
                                        echo "<option value=\"$townId\">$townName</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group port-data">
                            <input type="submit" name="submit" class="btn btn-info" value="Search" style="margin-top: 20px;">
                        </div>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="port">
                
                   <?php echo $display ?>

                   
            </div>
        </div>

</html>
