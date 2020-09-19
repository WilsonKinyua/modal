<?php

session_start();
ob_start();

$user           = "root";
$password       = "";
$host           = "localhost";
$database       = "users_test";

$connection     = mysqli_connect($host,$user,$password,$database);
if(!$connection) {
    die("QUERY FAILED". mysqli_error($connection));
}

//   Some  reusable funtions

function mysqli_escape($string) {
    global $connection;
    return mysqli_escape_string($connection,$string);
}

function query($sql) {
    global $connection;
    return mysqli_query($connection,$sql);
}

function confirm($result) {
    global $connection;
    if(!$result) {
        die("Query failed".mysqli_error($connection));
    }
}

function redirect($location) {
     header("Location: " . $location);
}

?>



                               