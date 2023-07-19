<?php

// Database connection
$host = "localhost";
$database = "online_enrollment";
$username = "root";
$password = "Collin@Admin";
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    return "Connection success";
}
?>