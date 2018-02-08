<!DOCTYPE html>

<html>
    <ul class="list-group">
        <?php
        $check = "SELECT * FROM categories";
        $res = mysqli_query($conn, $check) or die(mysqli_error($conn));

        $i = 1;
        while ($row = mysqli_fetch_array($res)) {
            $catId = $row['categoryId'];
            $catName = $row['categoryName'];
            echo "
                    <li class=\"list-group-item\">
                        <span class=\"glyphicon glyphicon-arrow-right reduce\"></span>
                        <a href=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "?q=portfolio&cat=$catId\">".ucfirst($catName)."</a>
                    </li>";
            $i++;
        }
        ?>
    </ul>
</html>
