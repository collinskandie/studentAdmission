<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../../css/admin.css" />
</head>
<style>
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
<link rel="stylesheet" href="../../../css/admin.css" />

<body>
    <?php
    include("../.../../adminnav.php");
    include("../../../php/conn.php");
    $enrollment_id = $_GET['enrollment_id'];

    $sql = "SELECT enrollments.*, CONCAT(students.first_name, ' ', COALESCE(students.middle_name, ''), ' ', students.last_name) AS studentName, courses.course_name 
    FROM enrollments 
    INNER JOIN students ON enrollments.student_id = students.student_id 
    INNER JOIN courses ON enrollments.course_id = courses.course_id 
    WHERE enrollments.enrollment_id = '$enrollment_id'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) == 1) {
        $enrollment = mysqli_fetch_assoc($results);
        $studentId = $enrollment['student_id'];
    } else {
        // handle error
    }
    //select qualifications
    $qualiSql = "SELECT * from student_qualifications WHERE student_id = '$studentId'";
    $qualifications = mysqli_query($conn, $sql);
    if (mysqli_num_rows($qualifications)> 0) {
        $qualif = mysqli_fetch_assoc($qualifications);
        $studentId = $enrollment['student_id'];
    } else {
        // handle error
    }

    ?>
    <div class="main">
        <br>
        <br>
        <br>
        <br>
        <h1>Action on Enrollment</h1>
        <div class="card">
            <div class="card-header">
                Details
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $enrollment['course_name'] ?></h5>
                <p class="card-text">Student Name: <?= $enrollment['studentName'] ?></p>
                <p class="card-text">Enrollment Date: <?= $enrollment['enrollment_date'] ?></p>
                Accademic Details
                <table>
                    <thead>
                        <tr>
                            <th>Qualifications</th>
                            <th>Updated at</th>
                            <th>Institutions</th>
                            <th>Certificate No</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($qualif as $enroll) : ?>
                            <tr>
                                <td><?= $enroll['qualification'] ?></td>
                                <td><?= $enroll['updated_at'] ?></td>
                                <td><?= $enroll['institutions_attended'] ?></td>
                                <td><?= $enroll['certificate_no'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if ($enrollment['approved_status'] == 'Approved') { ?>
                    <p class="card-text text-success">Approved</p>
                <?php } else if ($enrollment['approved_status'] == 'Declined') { ?>
                    <p class="card-text text-danger">Declined</p>
                <?php } else { ?>
                    <button class="card-text text-muted">Approve</button>
                    <button class="card-text text-muted">Decline</button>
                <?php } ?>

                <a href="#" class="btn btn-primary">View More Details</a>
            </div>
        </div>

    </div>
</body>

</html>