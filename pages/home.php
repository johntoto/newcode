<?php
/* @ $page = $_GET[q];
  if (!$page) {
  $page = "home";
  } */
?>
<!DOCTYPE html>
<html>
    <style>
        .banner {
            height: 300px;
        }
    </style>
    <div class="container-fluid banner">
        <div class="row ">
            <div class="col-lg-8 col-md-8 slider-images">
                <div class="carousel slide" data-ride="carousel" id="carousel-ex">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-ex" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-ex" data-slide-to="1"></li>
                        <li data-target="#carousel-ex" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/banner/businessman.jpg" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="images/banner/marketing-graph.jpg" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="images/banner/digital-marketing.jpg" class="img-responsive">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-ex" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-ex" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <aside class="col-md-4 categories aside">
                <h2 class="texxt">Categories</h2>
                <p>
                    Welcome to E Marketer for online window shopping and business and service providers marketing. 
                    search for a business from the top bar or navigate through the categories to view businesses.
                </p>
                <?php include_once "includes/categoryLinks.php"; ?>
            </aside>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <section class="col-md-7 panga">

                <table class="table table-striped table-hover" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td colspan="3"><h2>Latest businesses </h2></td>
                        </tr>
                    </thead>
                    <tbody class="busines">
                        <?php
                        $check_bus = "SELECT * FROM businesses WHERE activeLevel = 2  ORDER BY addedOn DESC";
                        $res_bus = mysqli_query($conn, $check_bus) or die(mysqli_error($conn));

                        $num = mysqli_num_rows($res_bus);
                        if ($num != 0) {
                            while ($row_bus = mysqli_fetch_array($res_bus)) {
                                $busId = $row_bus['businessId'];
                                $bName = $row_bus['businessName'];
                                $bPic = $row_bus['profilePic'];
                                $bCat = $row_bus['category'];
                                $active = $row_bus['activeLevel'];
                                
                                $check_cat = "SELECT * FROM categories WHERE categoryId=".$bCat;
                                $res_cat = mysqli_query($conn, $check_cat) or die(mysqli_error($conn));
                                
                                $row_cat = mysqli_fetch_array($res_cat);
                                $catName = $row_cat['categoryName'];
                                
                                $bPic = "<img src='images/uploads/$bPic' class='img-responsive img-rounded img-circle' width='50' height='50' >";
                                echo "<tr>
                                        <td class=\"glyphic\">
                                        <span class=\"glyphicon glyphicon-forward\"></span></td>
                                        <td width='90'><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&business=$bName&b=$busId\">$bPic</a></td>
                                        
                                        <td class=\"table-content\" width='265'>
                                            <a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&business=$bName&b=$busId\">$bName</a>
                                        </td>
                                        <td width='30px'>&gt;&gt;</td>
                                        <td><a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=details&business=$bName&b=$busId\">$catName</a></td>
                                
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</html>
