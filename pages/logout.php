<?php


$redirect = htmlspecialchars($_SERVER['PHP_SELF'])."?q=login";
header("Location:".$redirect);
session_destroy();