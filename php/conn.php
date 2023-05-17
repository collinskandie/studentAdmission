<?php 

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "online_enrollment";
$conn = mysqli_connect($host, $username, $password, $database);

 // Check the connection
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 else{
    return "Connection success";
 }
?>