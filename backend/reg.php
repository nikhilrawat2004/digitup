<?php
    include("dbconnect.php");
?><?php

    $mail = $_POST['mail'];
    $un = $_POST['username'];
    $pass = $_POST['pass'];
    $mobile_num = $_POST['mobile_num'];
    $address = $_POST['address'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $sql = "INSERT INTO user (username, email, password, mobile_num, address, fname, lname)
        VALUES ('$un', '$mail', '$pass', '$mobile_num', '$address', '$fname', '$lname')";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Registration Successful";
    }
    else{
        echo "Registration Failed";
    }

?>