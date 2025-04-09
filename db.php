<?php
$host = "localhost";
$user = "root";
$password = "";  // Blank for XAMPP
$database = "college_events";  

// Database connection
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
