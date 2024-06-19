<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://unpkg.com/material-ui@latest/dist/material-ui.min.css" rel="stylesheet">
    <style>
        body{
        font-family: 'Roboto', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5;
        }

        #profile{
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 30px;
        /* width: 80%;
        margin: 100px; */
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-message{
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 30px;
        animation: slide-down 1s ease-out, fade-in 1s ease-out;
        }

        .user-data{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 50px;
        }

        .user-data p{
        margin: 0;
        margin-bottom: 10px;
        animation: fade-in 1s ease-out 0.2s;
        }

        .profile-buttons{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 50px;
        }

        .profile-button{
        background-color: #093131;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 15px;
        text-transform: uppercase;
        cursor: pointer;
        font-size: 1rem;
        margin-right: 10px;
        animation: fade-in 1s ease-out 0.6s;
        }

        @keyframes fade-in{
        from{
            opacity: 0;
        }
        to{
            opacity: 1;
        }
        }

        @keyframes slide-down{
        from{
            transform: translateY(-20px);
            opacity: 0;
        }
        to{
            transform: translateY(0);
            opacity: 1;
        }
        }
    </style>
</head>
<body>

<?php
session_start();

// Include the database connection
require "backend/dbconnect.php";

// Check if the user is logged in
if (!isset($_SESSION["suser"])) {
    header("Location: ./login_signup.html");
    exit;
}

// Get the user data from the session
$username = $_SESSION["suser"];
$fname = $_SESSION["sfname"];
$lname = $_SESSION["slname"];
$address = $_SESSION["saddress"];
$mobile_num = $_SESSION["smobile_num"];
$email = $_SESSION["semail"];
?>

<div class='profile' id="profile">
  <h1 class="welcome-message">Welcome, <?php echo $fname . " " . $lname; ?>!</h1>
  <div class="user-data">
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    <p><strong>First Name:</strong> <?php echo $fname; ?></p>
    <p><strong>Last Name:</strong> <?php echo $lname; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Mobile Number:</strong> <?php echo $mobile_num; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
  </div>
  <div class="profile-buttons">
    <button class="profile-button" name="edit_profile" onclick="location.href='backend/edit_profile.php'" class="btn btn-primary edit-acc" role="button">Edit Profile</button>
    <button class="profile-button" name="update_pass" onclick="location.href='update_pass.html'" class="btn btn-primary edit-acc" role="button">Change Password</button>
    <button class="profile-button" name="del_user" onclick="confirmDelete()" class="btn btn-primary edit-acc" role="button" color="red">Delete Account</button>
    <button class="profile-button" name="home" onclick="location.href='index.php'" class="btn btn-primary edit-acc" role="button">Home</button>
    <button class="profile-button" name="logout" onclick="location.href='backend/logout.php'" class="btn btn-primary edit-acc" role="button">Logout</button>
  </div>
</div>

<script>
function confirmDelete() {
  if (confirm("Are you sure you want to delete your account?")) {
    window.location.href = './del_user.php';
  }
}
</script>

</body>
</html>