<?php
    function businessDetails ()
    {
        global $busPic,$bName,$phon,$add,$categoryName,$website,$town,$desc;

        echo "<div class=\"tabl col-md-8 bus-desc\">
                    <div class=\"table-data\">
                        <div class='row'>
                            <img src=\"./images/uploads/".$busPic."\" class=\"img-responsive img-rounded\" alt=\"Business iamge\">
                        </div>
                        <br>
                        <table class=\"table-bus\">
                            <tbody>
                                <tr>
                                <td class=\"tabl-bus\">Business Name:</td>
                                <td class=\"tabl-data\"> $bName</td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Business Category:</td>
                                <td class=\"tabl-data\">". $categoryName."</td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Business Address:</td>
                                <td class=\"tabl-data\">$add $town</td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Phone Number:</td>
                                <td class=\"tabl-data\">$phon</td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Business website:</td>
                                <td class=\"tabl-data\"><a href='http://$website'>" . $website . "</a></td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Business Location:</td>
                                <td class=\"tabl-data\"> $town</td>
                            </tr>
                            <tr>
                                <td class=\"tabl-bus\">Business description:</td>
                                <td class=\"tabl-data\" style='width:600px;'> $desc</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>";
    }

function businessPics () 
{

    global $conn, $busPic;

    echo "<div class=\"col-sm-8\" style='min-height:450px;'>
        <h4 class=\"text-left\" style=\"font-style: italic; color: #0610e066\"> Business Details / <span style=\"color: #000\">Business Photos</span></h4>

            <section class=\"pics\">
                <div class=\"gallery\" style=\"margin-bottom: 30px;margin-left: 30px;\">
                    <div class=\"row\">
            ";

        
            $busId = $_GET['b'];

            $ch_pic = "SELECT * FROM businesses WHERE businessId =".$busId;
            $r_pic = mysqli_query($conn, $ch_pic) or die(mysqli_error($conn));
            $comm = mysqli_fetch_array($r_pic);
            $b_pic = $comm['profilePic'];

            echo "
                    <div class=\"col-md-4\">
                        <a href=\"images/uploads/". $b_pic."\" data-title=\"First image\" data-lightbox=\"company\">
                            <img src=\"images/uploads/". $b_pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" width=\"400\">
                        </a>
                    </div>
                    ";
                
                $check_pic = "SELECT * FROM pics WHERE businessId =".$busId;
                $res_pic = mysqli_query($conn, $check_pic) or die(mysqli_error($conn));

                    while ($row_comm = mysqli_fetch_array($res_pic)) {
                        $pic = $row_comm['picture'];
                        $picTitle = $row_comm['picTitle'];
                        
                        echo "
                            <div class=\"col-md-3\">
                                <a href=\"images/pics/". $pic."\" data-title=\"".$picTitle."\" data-lightbox=\"company\">
                                    <img src=\"images/pics/". $pic."\" class=\" img-thumbnail\" alt=\"Business iamge\" width=\"300\">
                                </a>
                            </div>
                            ";
                
                }
        echo "
                </div>
            </div>
        </section>
    </div>";
}

function businessOffers ()
{
    global $conn,$busin;

    echo "
            <div class=\"col-md-8 col-sm-8 offer-details\">
            <h4 class=\"text-left\" style=\"font-style: italic; color: #ddd;\"> <a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=details&b=".$busin."\">Business Details</a>/ <span style=\"color: #000\">Offers</span></h4>


            <section class=\"offers\">";
             
            $busId = $_GET['b'];
            
            $check_off = "SELECT * FROM offers WHERE businessId=".$busId;
            $res_off = mysqli_query($conn, $check_off) or die(mysqli_error($conn));

            $num_row = mysqli_num_rows($res_off);
            if ($num_row == 0) {
                echo "<b>No offer to display currently</b>";
            } 
            else 
            {
                while ($row_off = mysqli_fetch_array($res_off)) {
                    $offTitle = $row_off['offerTitle'];
                    $offdesc = $row_off['description'];
                    $start = $row_off['addedOn'];
                    $endDate = $row_off['validUntil'];
                    $businessId = $row_off['businessId'];

                    $check_busin = "SELECT * FROM businesses WHERE businessId=" . "'$businessId'";
                    $res_busin = mysqli_query($conn, $check_busin) or die(mysqli_error($conn));

                    $row_bus = mysqli_fetch_array($res_busin);

                    $startDate = date('F d, Y', strtotime($start));
                    $endDate = date('F d, Y', strtotime($endDate));
                    $busNam = $row_bus['businessName'];
                echo "          
                    <div class=\"panel\">
                        <div class=\"panel-default\">
                            <div class=\"panel-heading\">
                                <div class=\"col-sm-12\">
                                    <h2 class=\"panel-title col-sm-3\"><b>Offer Title</b></h2>
                                    <div class=\"col-md-9 title\">
                                     From". $startDate ." ----
                                    End". $endDate."
                                    </div>
                                </div>
                            </div>
                            <div class=\"panel-body\">
                                <div class=\"col-sm-4\">
                                    <b>".$offTitle."</b> -->
                                </div>
                                <div class=\"col-sm-8\">
                                    ". $offdesc."
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            }
        echo "
            </section>
        </div>";
}

function businessComments()
{

    global $conn,$nameErr,$emailErr,$commEr,$busin;

    echo "
            <div class=\"col-sm-11 com-details\">
                <div class=\"comment-header\">
                    <h4 class=\"text-left\" style=\"font-style: italic; color: #ddd;margin-bottom: 30px\"> <a href=\"".htmlspecialchars($_SERVER['PHP_SELF'])."?q=details&b=".$busin."\">Business Details</a>/ <span style=\"color: #000\">comments</span></h4>

                    <button type=\"button\" data-toggle=\"modal\" data-target=\"#modal-1\" class=\"btn btn-success pull-right\" style=\"margin-top: -40px\">Add Comment</button>
                </div>
                
                <section class=\"comments\">";
         
                    $busId = $_GET['b'];
                    
                    $check_comm = "SELECT * FROM comments WHERE businessId='$busId' ORDER BY addedOn DESC";
                    $res_comm = mysqli_query($conn, $check_comm) or die(mysqli_error($conn));

                    $num_row = mysqli_num_rows($res_comm);
                    if ($num_row == 0) {
                        echo "<b>No comment to display currently</b>";
                    } else {
                        while ($row_comm = mysqli_fetch_array($res_comm)) {
                            $writer = $row_comm['fullName'];
                            $comment = $row_comm['comment'];
                            $addedOn = $row_comm['addedOn'];

                            $addedOn = date('F d, Y', strtotime($addedOn));

                          echo "<div class=\"panel com-sect\">
                                        <div class=\"panel-default bus-desc\">
                                            <div class=\"panel-heading\">
                                                <b>". $writer."</b>&nbsp;&nbsp;&nbsp;Commented on ".$addedOn."
                                            </div>
                                            <div class=\"cosl-md-4\">
                                            <div class=\"panel-body\">
                                                ". $comment ."
                                            </div>
                                            </div>
                                        </div>
                                </div>";
                            }
                        }
                    echo "                    
               </section>
        </div>";
}



?>