<?php
$servername = "localhost";
$username = "sugus"; // Replace with your database username
$password = "Dk@123"; // Replace with your database password
$dbname = "OP"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
