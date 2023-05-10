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

  $sql = "SELECT app.*, CONCAT(stu.first_name, ' ', stu.middle_name, ' ', stu.last_name) AS studentName,  cour.*,
  enr.enrollment_date FROM applications app  JOIN enrollments enr ON app.enrollments_id = enr.enrollment_id JOIN students stu ON enr.student_id = stu.student_id JOIN courses cour ON enr.course_id = cour.course_id;";

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
          <th>Enrollment ID</th>
          <th>Student Name</th>
          <th>Course Name</th>
          <th>Date of Application</th>
          <th>Level of Study</th>
          <th>Student Type</th>
          <th>Study Mode</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['application_id']; ?></td>
            <td><?php echo $row['enrollments_id']; ?></td>
            <td><?php echo $row['studentName']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['enrollment_date']; ?></td>
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