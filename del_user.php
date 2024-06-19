<?php

// Include the database connection file
require_once 'backend/dbconnect.php';
session_start();

// Get the user ID from the session variable
$userId = $_SESSION['user_id'];

// Build the SQL query to delete the user
$sql = "DELETE FROM user WHERE u_id = $userId";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('User deleted successfully'); window.location.href = 'backend/logout.php';</script>";
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);

?>