<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../../css/admin.css" />
  <style>
    .card-container {
      display: flex;
      flex-wrap: wrap;
    }

    .card {
      width: calc(33.33% - 30px);
      margin: 10px;
      padding: 20px;
      box-sizing: border-box;
      background-color: #f2f2f2;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
    }

    .card h2 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 16px;
    }
  </style>
</head>

<body>
  <?php
  include("adminnav.php");
  include("../../php/conn.php");

  if (!$_SESSION['role']) {
    header("Location: ../../index.php?");
  }
  $sql = "SELECT COUNT(*) AS rejected_students_count
  FROM enrollments
  WHERE approved_status = 'Declined'";
  $results = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($results);
  //
  $accp = "SELECT COUNT(*) AS accepted_students_count
  FROM enrollments
  WHERE approved_status = 'Approved'";
  $resul = mysqli_query($conn, $accp);
  $accepted = mysqli_fetch_assoc($resul);
  //all students
  $allstudents = "SELECT COUNT(*) AS all_students
  FROM students";
  $students = mysqli_query($conn, $allstudents);
  $all_students = mysqli_fetch_assoc($students);
  //all stuff
  $allstaff = "SELECT COUNT(*) AS all_staff
  FROM staff";
  $staff = mysqli_query($conn, $allstaff);
  $allstaff = mysqli_fetch_assoc($staff);
  //all courses
  $coursesCount = "SELECT COUNT(*) AS all_courses
  FROM courses";
  $allcourses = mysqli_query($conn, $coursesCount);
  $courses = mysqli_fetch_assoc($allcourses);
  //all application
  $application = "SELECT COUNT(*) AS all_application
  FROM applications";
  $applications = mysqli_query($conn, $application);
  $appAll = mysqli_fetch_assoc($applications);
  //all application pending approval
  $pending = "SELECT COUNT(*) AS all_pending
  FROM enrollments
  WHERE approved_status = 'Pending'";
  $appPending = mysqli_query($conn, $pending);
  $appPendings = mysqli_fetch_assoc($appPending);
  ///
  $departments = "SELECT COUNT(*) AS all_departments
  FROM departments";
  $depart = mysqli_query($conn, $departments);
  $department = mysqli_fetch_assoc($depart);
  // count faculties 
  $fac = "SELECT COUNT(*) AS faculties
  FROM faculties";
  $facs = mysqli_query($conn, $fac);
  $faculties = mysqli_fetch_assoc($facs);

  //more actions here

  ?>
  <div class="main">
    <h1>Summary</h1>
    <h4>Enrollments</h4>
    <div class="card-container">
      <div class="card">
        <h2>Process </h2>
        <h1><?= $all_students['all_students']; ?></h1>
      </div>
      <div class="card">
        <h2>Approved </h2>
        <h1><?= $accepted['accepted_students_count']; ?></h1>
      </div>
      <div class="card">
        <h2>Rejected </h2>
        <h1><?= $row['rejected_students_count']; ?></h1>
      </div>

    </div>
    <h4>Applications</h4>
    <div class="card-container">
      <div class="card">
        <h2>Process </h2>
        <!-- change this after adding approvals in application db -->
        <h1><?= $accepted['accepted_students_count']; ?></h1>
      </div>
      <div class="card">
        <h2>Approved </h2>
        <!-- add approved counter here  -->
        <h1><?= $courses['all_courses']; ?></h1>
      </div>
      <div class="card">
        <h2>Rejected </h2>
        <!-- add rejected applictaion counter here  -->
        <h1><?= $appAll['all_application']; ?></h1>
      </div>
    </div>
    <h4>Faculties</h4>
    <div class="card-container">
      <a href="faculties.php" class="card" style="text-decoration: none;">
        <h2>All Faculties</h2>
        <h1><?= $faculties['faculties']; ?></h1>
      </a>
    </div>
    <h4>Members</h4>
    <div class="card-container">
      <a href="staff.php" class="card" style="text-decoration: none;">
        <h2>Board members</h2>
        <h1><?= $allstaff['all_staff']; ?></h1>
      </a>
    </div>
  </div>
</body>

</html>