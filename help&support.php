<!DOCTYPE html>
<?php
session_start();

require("backend/dbconnect.php");  

$fname = $_SESSION["sfname"];
$lname = $_SESSION["slname"];
?>
<html>
<head>
    <title>Help & Support</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container{
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        h1{
            text-align: center;
            margin-bottom: 30px;
        }

        .user-name{
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-group{
            margin-bottom: 20px;
        }

        label{
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        textarea{
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .submit-button{
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover{
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Help & Support Form</h1>
        <div class="user-name">Welcome, <?php echo $fname . " " . $lname; ?></div>
        <form action="" method="post">
            <div class="form-group">
                <label for="problem">Please describe the problem you are facing:</label>
                <textarea id="problem" name="problem"></textarea>
            </div>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get the problem description from the textarea
        $problem = $_POST['problem'];

        // Get the user's ID, username, and email from the session
        $u_id = $_SESSION['user_id'];
        $username = $_SESSION["suser"];
        $email = $_SESSION["semail"];

        // Set the status to 0 (unresolved)
        $status = 0;

        // Prepare the SQL query
        $query = "INSERT INTO query (u_id, username, email, query, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind the parameters
        $stmt->bind_param("issss", $u_id, $username, $email, $problem, $status);

        // Execute the query
        $result = $stmt->execute();

        // Check for errors
        if ($result === false) {
            echo "Error: " . $query . "<br>" . $conn->error;
        } else {
            echo "<script>alert('Issue submitted!')</script>";
        }

        // Close the statement
        $stmt->close();

        echo "<script>alert('Issue submitted!')</script>";

    }
    ?>
</body>
</html>