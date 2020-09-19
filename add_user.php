<?php 

    include "config.php";

    if(!isset($_POST['add_user'])) {
        header("Location: index.php");
    }

if(isset($_POST['add_user'])) {
    $fname      = mysqli_escape($_POST['fname']);
    $lname      = mysqli_escape($_POST['lname']);
    $email      = mysqli_escape($_POST['email']);
    $gender     = mysqli_escape($_POST['gender']);
    $address    = mysqli_escape($_POST['address']);
    $phone      = mysqli_escape($_POST['phone']);

    $query = query("INSERT INTO users(first_name, last_name, email, gender, address, phone) VALUES('{$fname}','{$lname}','{$email}','{$gender }','{$address}','{$phone}')");
    confirm($query);
    $_SESSION['success'] = 'User added Successfully!!!!';
    redirect("index.php");

}


?>