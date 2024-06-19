<?php
require_once 'dbconnect.php';

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 // output data of each row
 while($row = $result->fetch_assoc()) {
    echo "Name: " . $row["username"]. " - Email: " . $row["email"]. " - Password: " . $row["password"]. "<br>";
 }
} else {
 echo "0 results";
}
$conn->close();
?>