<?php
session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM students WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['student_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['firt_name'];
            $success_message = "Successful login";
            header("Location: ../index.php?success_message=" . urlencode($success_message));
            exit();
        } else {
            $error_message = "Invalid email or password";
        }
    } else {
        $error_message = "Invalid email or password";
    }

    error_log("Login error: " . $error_message);
    header("Location: ../pages/login.php?error_message=" . urlencode("Invalid email or password"));
    exit();
} else {
    echo ('You are in the wrong place');
}
