<!DOCTYPE html>
<html>

<head>
    <title>Student Enrollment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/enroll-css.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    };
    $id = $_SESSION['user'];
    include('../php/conn.php');
    $sql = "SELECT CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) AS fullname, email, phone FROM students WHERE student_id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Get the user's data from the database
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
    $sql = "SELECT * FROM courses";
    $courses = mysqli_query($conn, $sql);
    ?>
    <div class="container">
        <h1>CUEA Online Admission</h1>
        <div style="text-align: center;">
            <img src="../imgs/logo.png" style="display: block; margin: 0 auto;">
        </div>
        <div class="page-content" style="text-align: center;">
            <h3>Thank you for choosing to enroll with us, fill in the form</h3>
            <h5>Your progress</h5>
            <div class="progress">
                <div class="bar" id="progress-bar"></div>
            </div>
            <div class="percentage" id="percentage"></div>
        </div>
        <div style="align-content:center; margin-top: 50px;">
            <form action="../php/enroll.php" onsubmit="return validateEnroll();" method="POST">
                <h2>Student Recruitment Form</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo ($fullname); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo ($email); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo ($phone); ?>">
                </div>
                <div class="form-group">
                    <label for="program">Previous Qualification</label>
                    <textarea type="text" id="qualification" name="qualification"></textarea>
                </div>
                <div class="form-group">
                    <label for="program">Program of Interest:</label>

                    <select id="program" name="program">
                        <option value="">Please select a program</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($courses)) {
                            echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" name="submit">Enroll</button>
                </div>
            </form>
        </div>
    </div>
    <!-- <script src="../js/validations.js"></script> -->
    <script>
        let progress = 25; // Set the initial progress here
        let progressBar = document.getElementById("progress-bar");
        let percentage = document.getElementById("percentage");
        progressBar.style.width = progress + "%";
        percentage.innerHTML = progress + "%";

        function validateEnroll() {
            var prevQualif = document.getElementById("qualification").value;
            var programIntrest = document.getElementById("program").value;

            if (prevQualif == "") {
                alert("Qualification cannot be null");
                return false;
            }
            if (programIntrest == "") {
                alert("Please select your program of interest");
                return false;
            }

        }
    </script>
</body>

</html>