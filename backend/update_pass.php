<?php
session_start();
include("dbconnect.php");

if (isset($_SESSION['suser']) && isset($_POST['currpass']) && isset($_POST['newpass'])) {
    $un = $_SESSION['suser'];
    $pass = $_SESSION['spass'];
    $currpass = $_POST['currpass'];
    $newpass = $_POST['newpass'];

    if ($currpass == $pass) {
        $sql = "UPDATE user SET password='$newpass' WHERE username='$un' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Password Updated!'); window.location.href='./logout.php';</script>";
        } else {
            echo "<script>alert('Password Update Failed!'); window.location.href='../profile.php';</script>";
        }
    } else {
        echo "<script>alert('Current Password is Incorrect!'); window.location.href='../update_pass.html';</script>";
    }
} else {
    echo "<script>alert('Please enter both the current and new passwords.'); window.location.href='../update_pass.html';</script>";
}
?>