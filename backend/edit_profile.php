<?php
session_start();
include("dbconnect.php");

// Check if the user has submitted a form
if (isset($_POST["edit_profile"])) {
    // Get the updated field and value from the form
    if (isset($_POST["field"]) && isset($_POST["new_value"])) {
        $field = $_POST["field"];
        $new_value = $_POST["new_value"];

        // Update the user data in the database
        $stmt = $conn->prepare("UPDATE user SET $field = ? WHERE u_id = ?");
        $stmt->bind_param("si", $new_value, $_SESSION["user_id"]);
        $stmt->execute();

        // Update the session variable for the updated field
        $_SESSION["s" . $field] = $new_value;

        echo '<script>alert("Field Changed successfully")</script>';
        // Redirect the user back to the profile page
        header("Location: ../profile.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=.0">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        form{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label{
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"]{
            padding: 15px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"]{
            padding: 15px 10px;
            background-color: #093131;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        select{
            padding: 15px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h2>Username: <?php echo $_SESSION["suser"]; ?></h2>
    <form action="edit_profile.php" method="post">
        <label for="field">Choose a field to update:</label><br>
        <select id="field" name="field">
            <option value="fname">First Name</option>
            <option value="lname">Last Name</option>
            <option value="address">Address</option>
            <option value="mobile_num">Mobile Number</option>
            <option value="email">Email</option>
        </select><br>
        <label for="new_value">New value:</label><br>
        <input type="text" id="new_value" name="new_value"><br>
        <input type="submit" name="edit_profile" value="Edit Profile">
    </form>
</body>
</html>