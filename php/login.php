<?php

session_start();
include('conn.php');

if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {  
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    // Check if the email exists in the database
    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Get the user's data from the database
        $row = mysqli_fetch_assoc($result);
        // Check if the password matches the hashed password in the database
        if (password_verify($password, $row['password'])) {
            // Store the user's data in the session
            $_SESSION['user_id'] = $row['student_id'];           
            $_SESSION['email'] = $row['email'];
            
            mysqli_close($conn);           
            // Redirect to the dashboard page
            header("Location: ../index.php");
            // echo("Code imefika hapa");            
            exit();
        } else {
            // Display an error message if the password is incorrect
            $error_message = "password hakuna kama hyo.";
        }
    } else {
        // Display an error message if the email is not found in the database
        $error_message = "Invalid email";
    }
    // display error message on the login page
    if (isset($error_message)) {
        // echo '<script>alert("' . $error_message . '");</script>';
        header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
    }
} else {
    echo ('bruh! you keep on getting stuck. you are in the wrong place again');
}
?>
