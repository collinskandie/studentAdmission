<?php
include("../../../php/conn.php");
session_start();
$course_id = $_GET['course_id'];
// echo $course_id;
$sql = "DELETE FROM courses WHERE course_id = $course_id";

if (mysqli_query($conn, $sql)) {
    $success_message = "Record with ID $course_id deleted successfully.";
    header("Location: ../courses.php?success_message=" . urlencode($success_message));
    exit();
} else {
    $error_message = "Delete error: " . mysqli_error($conn);
    header("Location: ../courses.php?error_message=" . urlencode($error_message));
    exit();
}
?>