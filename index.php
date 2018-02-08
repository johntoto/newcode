<?php
session_start();
 @ $page = htmlspecialchars($_GET['q']);
if (!$page) {
    $page = "home";
}

include_once "functions/function.php";
include_once "functions/businessDetails.php";
$conn = getConn();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Web Marketer</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="css/lightbox.min.css">
        <link href="styles/styles.css" rel="stylesheet">
        <link href="styles/newStyles.css" rel="stylesheet">
        <link href="styles/csss.css" rel="stylesheet">
        
        
        <style>
            
        </style>
    </head>
    <body>
       
        <?php include_once "includes/header.php"; ?>

        <div class="top">
                <?php 
                 include ("pages/$page.php");
                ?>
        </div>

        <?php include_once "includes/footer.php"; ?>

        <script src="js/jquery-3.2.0.min.js" type="text/javascript"></script>
        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/lightbox-plus-jquery.min.js"></script>

    </body>
</html>