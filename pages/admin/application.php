<!DOCTYPE html>
<html>

<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../../css/admin.css" />
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      font-family: Arial, sans-serif;
      font-size: 14px;
      text-align: left;
    }

    th,
    td {
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .approve-btn,
    .decline-btn,
    .view-btn {
      display: inline-block;
      padding: 6px 12px;
      background-color: #008cba;
      color: #fff;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      border-radius: 4px;
      margin-right: 8px;
    }

    .approve-btn:hover,
    .decline-btn:hover,
    .view-btn:hover {
      background-color: #004c6d;
    }
  </style>
</head>

<body>
  <?php
  include("adminnav.php");
  include("../../php/conn.php");

  $sql = "SELECT * FROM applications";
  $result = mysqli_query($conn, $sql);
  ?>
  <!-- main content -->
  <div class="main">
    <h1>Active Application</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
      <table>
        <tr>
          <th>Application ID</th>

          <th>Student Name</th>
          <th>Course Name</th>
          <th>Date of Application</th>
          <th>Level of Study</th>
          <th>Student Type</th>
          <th>Study Mode</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) {
          $enrollid = $row['enrollments_id'];
          $sqlEnroll = "SELECT enrollments.*, CONCAT(students.first_name, ' ', COALESCE(students.middle_name, ''), ' ', students.last_name) AS studentName, courses.course_name 
          FROM enrollments INNER JOIN students ON enrollments.student_id = students.student_id INNER JOIN courses ON enrollments.course_id = courses.course_id where enrollment_id= '$enrollid'";
          $results = mysqli_query($conn, $sqlEnroll);
          $enrollment = mysqli_fetch_assoc($results); ?>
          <tr>
            <td><?php echo $row['application_id']; ?></td>
            <td><?php echo $enrollment['studentName']; ?></td>
            <td><?php echo $enrollment['course_name']; ?></td>
            <td><?php echo $enrollment['enrollment_date']; ?></td>
            <td><?php echo $row['level_of_study']; ?></td>
            <td><?php echo $row['student_type']; ?></td>
            <td><?php echo $row['study_mode']; ?></td>
          </tr>
        <?php } ?>
      </table>
    <?php
    } else {
      echo "No records found.";
    }
    ?>


  </div>
</body>

</html>