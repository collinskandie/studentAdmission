<?php
session_start(); // start session

$username = $_POST['Email'];
$password = $_POST['password'];

if ($Email == 'your_emailaddress' && $password == 'your_password') {
    // login successful
    $_SESSION['logged_in'] = true; // set session variable
    header('Location: home.php'); // redirect to home page
    exit();
} else {
    // login failed
    header('Location: login.html'); // redirect back to login page
    exit();
}
?>
