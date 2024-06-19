<?php
session_start();
include("dbconnect.php");

$un =  $_POST['un'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM user WHERE username = '$un'";
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row["username"] == $un && $row["password"]==$pass) {
            $_SESSION['suser'] = $un;
            $_SESSION["spass"] = $pass;
            $_SESSION["sfname"] = $row["fname"];
            $_SESSION["slname"] = $row["lname"];
            $_SESSION["semail"] = $row["email"];
            $_SESSION["smobile_num"] = $row["mobile_num"];
            $_SESSION["saddress"] = $row["address"];
            $_SESSION["user_id"] = $row["u_id"];

            header("Location: ../index.php");
        } else {
            echo "<script>alert('Login Failed!')</script>";
            header("Refresh:0; url=Location: ../login_signup.html");
            
        }
    } else {
        echo "<script>alert('Login Failed!')</script>";
        header("Refresh:0; url=Location: ../login_signup.html");
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
