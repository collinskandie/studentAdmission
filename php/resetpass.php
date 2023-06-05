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

    $sql = "
    DECLARE @UpdatedStudents TABLE (student_id INT);
    
    UPDATE students
    SET password = '$hashed_password'
    OUTPUT inserted.student_id INTO @UpdatedStudents
    WHERE email = '$email';
    
    SELECT student_id FROM @UpdatedStudents;
    ";

    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
        $user = $result['student_id'];
        $sqllogs = "INSERT INTO logs (actions, actionby, actiondate, actiontime, category, actiontable,user_role) 
                VALUES ('Reset Password','$user',CURDATE(), CURTIME(),'forgot password','students','student')";
        mysqli_query($conn, $sqllogs);
        $error_message = "Password updated successfully";
        header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
    } else {
        $error_message = "Error updating password: " . mysqli_error($conn);
        header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
    }
} else {
    echo ('404, error: page soesnt not exhist');
}
