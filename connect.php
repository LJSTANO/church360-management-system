<?php
$servername = "localhost";
$username = "root";
$password = ""; // Add your database password here
$dbname = "CHURCH360"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
