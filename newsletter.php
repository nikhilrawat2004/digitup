<?php
// newsletter.php

require_once 'backend/dbconnect.php';

if (isset($_POST['newsletter_submit'])) {
    $email = $_POST['email_address'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.')</script>";
    } else {
        $query = "INSERT INTO news (email) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "<script>alert('Newsletter Subscribed successfully'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $query . "<br>" . $conn->error . "')</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>