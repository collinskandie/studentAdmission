<?php
session_start();
include('conn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $email = htmlspecialchars($_POST['email']);
    // $password = htmlspecialchars($_POST['password']);
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "UPDATE students SET password = '$hashed_password' WHERE email='$email'";
    // $result = mysqli_query($conn, $sql);   
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE students SET password = '$hashed_password' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $error_message = "Password updated successfully";
        header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
    } else {
        $error_message = "Error updating password: " . mysqli_error($conn);
        header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
    }
} else {
    echo ('bruh! you keep on getting stuck. you are in the wrong place again');
}
