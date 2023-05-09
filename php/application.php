<?php
session_start();
include('conn.php');
if (isset($_POST['submit'])) {
    // Studddent details 
    $student_id = $_SESSION['user'];
    $id_pass = mysqli_real_escape_string($conn, $_POST['docNumber']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $maritalStatus = mysqli_real_escape_string($conn, $_POST['docNumber']);
    $impared = mysqli_real_escape_string($conn, $_POST['impared']);

    //guardian table
    $guardianname = mysqli_real_escape_string($conn, $_POST['guardianname']);
    $guard_relation = mysqli_real_escape_string($conn, $_POST['guard_relation']);
    $guard_address = mysqli_real_escape_string($conn, $_POST['guard_address']);
    $gaurdian_number = mysqli_real_escape_string($conn, $_POST['gaurdian_number']);
    $gaurdian_email = mysqli_real_escape_string($conn, $_POST['gaurdian_email']);

    // sponsor 
    $sponsrelationship = mysqli_real_escape_string($conn, $_POST['sponsrelationship']);
    $sponsname = mysqli_real_escape_string($conn, $_POST['sponsname']);
    $sponaddress = mysqli_real_escape_string($conn, $_POST['sponaddress']);
    $spon_number = mysqli_real_escape_string($conn, $_POST['spon_number']);
    $spon_email = mysqli_real_escape_string($conn, $_POST['spon_email']);
    //program table
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $sponsor_type = mysqli_real_escape_string($conn, $_POST['sponsor_type']);
    $mode = mysqli_real_escape_string($conn, $_POST['mode']);
    // student qualification 
    $Institute = mysqli_real_escape_string($conn, $_POST['Institute']);
    $qualifications = mysqli_real_escape_string($conn, $_POST['quali']);
    $indexnu = mysqli_real_escape_string($conn, $_POST['indexnu']);
    $certNo = mysqli_real_escape_string($conn, $_POST['certNo']);
    $studentbefore = mysqli_real_escape_string($conn, $_POST['studentbefore']);

    // continue from here    

    if (empty($errors)) {

        $sql = "UPDATE students SET id_pass='$id_pass', dob='$dob', nationality='$nationality', gender='$gender', marital_status='$maritalStatus', impared='$impared' WHERE id='$student_id'";
        if (mysqli_query($conn, $sql)) {
            $success_message = "You have successfully updated student details";
        } else {
            $success_message = "Error occured";
        }

        $sql = "SELECT * FROM enrollments WHERE student_id = '$student_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Display an error message if the email address already exists            
            $success_message = "You have an active enrollment";
            header("Location: ../index.php?success_message=" . urlencode($success_message));
        } else {
            // Create a new record in the students table with the user's data
            $sql_enroll = "INSERT INTO enrollments (student_id, course_id, enrollment_date) VALUES ('$student_id', '$course_id')";
            mysqli_query($conn, $sql_enroll);
            $sql_qualification = "INSERT INTO student_qualifications (student_id,qualification) VALUES ('$student_id', '$qualification')";
            mysqli_query($conn, $sql_qualification);
            $sql_progress = "INSERT INTO progress (student_id, progress_level, progress_points) VALUES ('$student_id','$level','$level_points')";
            if (mysqli_query($conn, $sql_progress)) {
                $success_message = "Enrolled Successfully, pending approval";
                header("Location: ../index.php?success_message=" . urlencode($success_message));
            }
            $errors[] = "Error: " . $sql_progress . "<br>" . mysqli_error($conn);
        }
    }
} else {
    echo ("<p>Am sorry but you are lost. You are not supposed to see this page.<p>");
}
?>
<?php if (!empty($errors)) { ?>
    <div class="error">
        <?php foreach ($errors as $error) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
<?php } ?>