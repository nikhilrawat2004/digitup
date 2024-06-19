<?php
$servername ='localhost' ;
$username = 'root';
$password = '';
$dbname = 'digitup';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
?>
