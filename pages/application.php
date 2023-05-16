﻿</html>
<!DOCTYPE html>
<html>

<head>
    <title>Application Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/application.css">
    <style>
        body {
            background-color: #0b0544;
            /* color:#fff; */
        }

        form {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        .form-row {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #0b0544;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .columns-container {
            display: flex;
            flex-wrap: wrap;
        }

        .column {
            flex: 1;
            margin: 2px;
            /* margin: 0 10px; */
        }

        /* Style for the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: white;
            position: fixed;
            margin-left: -10px;
            top: 0;
            width: 100%;
            border-radius: 10px;
        }

        /* Style for the links in the top navigation bar */
        .topnav a {
            float: right;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Style for the active link in the top navigation bar */
        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }

        /* Style for the user profile dropdown in the top navigation bar */
        .topnav .dropdown {
            float: right;
            overflow: hidden;
        }

        /* Style for the user profile dropdown button in the top navigation bar */
        .topnav .dropdown .dropbtn {
            font-size: 17px;
            border: none;
            outline: none;
            color: black;
            padding: 14px 16px;
            background-color: inherit;
            margin: 0;
        }

        /* Style for the user profile dropdown content in the top navigation bar */
        .topnav .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
        }

        /* Style for the user profile dropdown links in the top navigation bar */
        .topnav .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Style for the user profile dropdown links on hover in the top navigation bar */
        .topnav .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the user profile dropdown content when the user clicks on the dropdown button in the top navigation bar */
        .topnav .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <?php
    include('../php/conn.php');
    session_start();
    $id = $_SESSION['user'];
    $sqlUser = "SELECT * FROM students WHERE student_id='$id'";
    $results = mysqli_query($conn, $sqlUser);
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        $userName = $row['first_name'];
    }
    ?>
    <div class="topnav">
        <a href="../php/logout.php">Logout</a>
        <div class="dropdown">
            <button class="dropbtn"><?= $userName; ?></button>
            <div class="dropdown-content">
                <a href="../pages/resetpass.php">Change Password</a>
            </div>
        </div>
    </div>
    <?php
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    };

    $sql = "SELECT CONCAT(first_name, ' ', IFNULL(middle_name, ''), ' ', last_name) AS fullname, email, phone FROM students WHERE student_id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $fullname = $row['fullname'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
    $sql_courses = "SELECT * FROM enrollments WHERE student_id ='$id'";
    $results = mysqli_query($conn, $sql_courses);
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        $enrollments_id = $row['enrollment_id'];
        $c_id = $row['course_id'];
        $new_sql = "SELECT course_name FROM courses WHERE course_id='$c_id'";
        $courses = mysqli_query($conn, $new_sql);
        $usercourse = mysqli_fetch_assoc($courses);
        $course = $usercourse['course_name'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $docNumber = mysqli_real_escape_string($conn, $_POST['docNumber']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
        $maritalStatus = mysqli_real_escape_string($conn, $_POST['maritalStatus']);
        $impared = mysqli_real_escape_string($conn, $_POST['impared']);
        $religion = mysqli_real_escape_string($conn, $_POST['religion']);
        $guardianname = mysqli_real_escape_string($conn, $_POST['guardianname']);
        $guard_relation = mysqli_real_escape_string($conn, $_POST['guard_relation']);
        $guard_address = mysqli_real_escape_string($conn, $_POST['guard_address']);
        $gaurdian_number = mysqli_real_escape_string($conn, $_POST['gaurdian_number']);
        $gaurdian_email = mysqli_real_escape_string($conn, $_POST['gaurdian_email']);
        $sponsrelationship = mysqli_real_escape_string($conn, $_POST['sponsrelationship']);
        $sponsname = mysqli_real_escape_string($conn, $_POST['sponsname']);
        $sponaddress = mysqli_real_escape_string($conn, $_POST['sponaddress']);
        $spon_number = mysqli_real_escape_string($conn, $_POST['spon_number']);
        $spon_email = mysqli_real_escape_string($conn, $_POST['spon_email']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $sponsor_type = mysqli_real_escape_string($conn, $_POST['sponsor_type']);
        $mode = mysqli_real_escape_string($conn, $_POST['mode']);
        $Institute = mysqli_real_escape_string($conn, $_POST['Institute']);
        $quali = mysqli_real_escape_string($conn, $_POST['quali']);
        $indexnu = mysqli_real_escape_string($conn, $_POST['indexnu']);
        $certNo = mysqli_real_escape_string($conn, $_POST['certNo']);
        $studentbefore = mysqli_real_escape_string($conn, $_POST['studentbefore']);

        //update student table
        if ($id) {
            // echo $dob;
            $updateStudent = "UPDATE students SET id_passport='$docNumber', dob='$dob',nationality='$nationality',gender='$gender',marital_status='$maritalStatus',religion='$religion',parent_first_name='$guardianname',parent_last_name=' ',parent_email='$gaurdian_email',parent_phone='$gaurdian_number' where student_id='$id'";
            if (mysqli_query($conn, $updateStudent)) {
                // echo "<script>alert('Student record updated successfully.')</script>";
                //inserrt guardian details
                $addGuardian = "INSERT INTO guardians (first_name, last_name, email, phone)
                VALUES ('$guardianname', '', '$gaurdian_email', '$gaurdian_number')";
                mysqli_query($conn, $addGuardian);
                //insert sponsors details
                $addSponsor = "INSERT INTO sponsor (student_id, name, address, phone, email)
                VALUES ('$id','$sponsname','$sponaddress','$spon_number','$spon_email')";
                mysqli_query($conn, $addSponsor);
                //insert into application
                // application_id, enrollments_id, student_id, level_of_study, student_type, study_mode
                $apply = "INSERT INTO applications (enrollments_id, student_id, level_of_study, student_type, study_mode)
                VALUES ('$enrollments_id','$id','$level','$sponsor_type','$mode')";
                mysqli_query($conn, $apply);
                $academic = "UPDATE student_qualifications set qualification='$quali',institutions_attended='$Institute', index_no='$indexnu', certificate_no='$certNo', student_before='$studentbefore'";
                mysqli_query($conn, $academic);
                //update progress
                $level = "Final";
                $level_points = 80;
                $message = "Your Application has been completely, wait for admission letter to be issued!";
                $updateProgressSql = "UPDATE progress SET progress_level = '$level', progress_points = $level_points, message = '$message' WHERE student_id = $id";
                mysqli_query($conn, $updateProgressSql);
                $success_message ="Successfully Applied for the course, proceed to download your admission letter";
                header("Location: ../index.php?message=<?=$success_message ?>");
            } else {
                echo "Problems";
            }
        }
    }
    ?>

    <div class="container">
        <h1>CUEA Online Admission</h1>
        <div style="text-align: center;">
            <img src="../imgs/logo.png" style="display: block; margin: 0
                    auto;">
        </div>
        <div class="page-content" style="text-align: center;">
            <h3>Welcome</h3>
            <h5>Your progress</h5>
            <div class="progress">
                <div class="bar" id="progress-bar"></div>
            </div>
            <div class="percentage" id="percentage"></div>
        </div>
        <div style="align-content:center; margin-top: 50px;">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateApplication();" method="POST">
                <h2>Student Application Form</h2>
                <h3>Student details</h3>
                <div class="form-row">
                    <label for="name">Student Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo ($fullname); ?>" readonly>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo ($email); ?>" readonly>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Phone Number</label>
                            <input type="number" id="number" name="number" value="<?php echo ($phone); ?>">
                        </div>
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="phone">ID/Passport</label>
                            <input type="number" id="docNumber" name="docNumber" placeholder="Use Birth Number if null">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="form-row">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div class="form-row">

                        <label for="nationality">Nationality:</label>
                        <input type="text" id="nationality" name="nationality">
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Please select your gender</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="maritalStatus">Marital Status</label>
                            <select id="maritalStatus" name="maritalStatus">
                                <option value="">Please select your marital
                                    status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="impared">Impared</label>
                            <select id="impared" name="impared">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <div class="form-row">
                                <label for="religion">Religion</label>
                                <input type="text" id="religion" name="religion">
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Guardian Details</h3>
                <div class="form-row">
                    <label for="name">Full Name</label>
                    <input type="text" id="guardian" name="guardianname">
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="relationship">Relationship:</label>
                            <input type="text" id="relationship" name="guard_relation">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Address</label>
                            <input type="text" id="address" name="guard_address">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Phone Number</label>
                            <input type="number" id="gaurdian_number" name="gaurdian_number">
                        </div>
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Email Address</label>
                            <input type="email" id="email" name="gaurdian_email">
                        </div>
                    </div>
                </div>
                <h3>Sponsor Details</h3>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="relationship">Sponsor:</label>
                            <input type="text" id="sponsrelationship" name="sponsrelationship" placeholder="e.g Parent/Bank/NGO">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="name">Name</label>
                            <input type="text" id="sponsname" name="sponsname">
                        </div>
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Address</label>
                            <input type="text" id="address" name="sponaddress">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="contacts">Phone Number:</label>
                            <input type="number" id="number" name="spon_number">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <label for="contacts">Email Address</label>
                    <input type="email" id="email" name="spon_email">
                </div>
                <h3>Program Details</h3>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="level">Level of Studies</label>
                                <select id="level" name="level">
                                    <option value="">Please select a level</option>
                                    <option value="phd">PHD</option>
                                    <option value="bachelors">Bachelors Degree</option>
                                    <option value="cert">Certificate</option>
                                    <option value="dip">Diploma</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="program">Program of Interest:</label>
                                <input type="text" id="program" name="program" value="<?php echo ($course); ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="studenttype">Student Type</label>
                                <select id="sponsor_type" name="sponsor_type">
                                    <option value="">Please select type</option>
                                    <option value="gov">Government Sponsered</option>
                                    <option value="self">Self Sponsored</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="study_mode">Study Mode</label>
                            <select id="mode" name="mode">
                                <option value="">Please select a program</option>
                                <option value="ftime">Full-time</option>
                                <option value="ptime">Part-time</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h3>Academic Profile</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="Institute">Institutions Attended</label>
                        <textarea type="textarea" id="Institute" name="Institute"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <label for="Qualification">Qualifications</label>
                    <textarea type="text" id="quali" name="quali"></textarea>
                </div>
                <div class="columns-container">
                    <div class="column">
                        <div class="form-row">
                            <label for="IndexNo">Index No</label>
                            <input type="text" id="indexnu" name="indexnu" placeholder="Kenyan High School">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-row">
                            <label for="certNo">Certificate No</label>
                            <input type="text" id="certNo" name="certNo" placeholder="School leaving certificate number">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <label for="studentBefore">Student before?</label>
                    <select id="studentbefore" name="studentbefore">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="form-row">
                    <button type="submit" class="btn" name="submit">Submit</button>
                </div>
            </form>

        </div>
    </div>
    <!-- <script src="../js/validations.js"></script> -->

    <script>
        let progress = 50; // Set the initial progress here
        let progressBar = document.getElementById("progress-bar");
        let percentage = document.getElementById("percentage");

        progressBar.style.width = progress + "%";
        percentage.innerHTML = progress + "%";

        function updateProgress() {
            progress += 10; // Increment the progress by 10 on each click
            if (progress > 100) {
                progress = 100; // Set the progress to 100 if it exceeds 100
            }
            progressBar.style.width = progress + "%";
            percentage.innerHTML = progress + "%";
        }
        //validate form
        function validateApplication() {
            var studentName = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phoneNumber = document.getElementById("number").value;
            var IdPassport = document.getElementById("docNumber").value;
            var dob = document.getElementById("dob").value;
            var nationality = document.getElementById("nationality").value;
            var gender = document.getElementById("gender").value;
            var impared = document.getElementById("impared").value;
            var religion = document.getElementById("religion").value;
            var guardian = document.getElementById("guardianname").value;
            var relationship = document.getElementById("guard_relation").value;
            var address = document.getElementById("guard_address").value;
            var sponsname = document.getElementById("sponsname").value;
            var sponsrelationship = document.getElementById("sponsrelationship").value;
            var level = document.getElementById("level").value;
            var program = document.getElementById("program").value;
            var sponsor_type = document.getElementById("sponsor_type").value;
            var mode = document.getElementById("mode").value;
            var Institute = document.getElementById("Institute").value;
            var quali = document.getElementById("quali").value;
            var indexnu = document.getElementById("indexnu").value;
            var certNo = document.getElementById("certNo").value;
            var studentbefore = document.getElementById("studentbefore").value;


            if (studentName == "") {
                alert("Name cannot be null");
                return false;
            }
            if (email == "") {
                alert("Please enter your email");
                return false;
            }
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (phoneNumber == "") {
                alert("Phone number cannot be null");
                return false;
            }
            if (IdPassport == "") {
                alert("Enter your ID number");
                return false;
            }
            if (dob == "") {
                alert("Date of birth cannot be null");
                return false;
            }
            if (nationality == "") {
                alert("Nationality cannot be null");
                return false;
            }
            if (gender == "") {
                alert("select your gender");
                return false;
            }
            if (impared == "") {
                alert("State of imparedness cannot be left blank");
                return false;
            }
            if (religion == "") {
                alert("Please state your religion");
                return false;
            }
            if (guardian == "") {
                alert("Guardian name cannot be empty");
                return false;
            }
            if (relationship == "") {
                alert("Whats your relationship with the guardian");
                return false;
            }
            if (address == "") {
                alert("Address cannot be blank");
                return false;
            }
            if (sponsname == "") {
                alert("Sponsor name cannot be blank");
                return false;
            }
            if (sponsrelationship == "") {
                alert("Please state who is your sponsor");
                return false;
            }
            if (level == "") {
                alert("Level of education cannot be blank");
                return false;
            }
            if (program == "") {
                alert("Select a program of choice");
                return false;
            }
            if (sponsor_type == "") {
                alert("Type of sponsor cannot be blank");
                return false;
            }
            if (mode == "") {
                alert("Select mode of study");
                return false;
            }
            if (Institute == "") {
                alert("Details of previous instituition");
                return false;
            }
            if (quali == "") {
                alert("Previous qualifications cannot be blank");
                return false;
            }
            if (indexnu == "") {
                alert("Index number cannot be blank");
                return false;
            }
            if (certNo == "") {
                alert("Certificate number cannot be blank");
                return false;
            }
            if (studentbefore == "") {
                alert("Cannot be left blank");
                return false;
            }
        }
    </script>
</body>

</html>