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
    session_start();
    if (!$_SESSION['role']) {
        header("Location: ../../index.php?error_message=" . urlencode("You are not authorized to view this page"));
    }

    include("adminnav.php");
    include("../../php/conn.php");

    $sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';
    $sql = "SELECT a.*, e.*, s.student_id, CONCAT(s.first_name, ' ', COALESCE(s.middle_name, ''), ' ', s.last_name) AS studentName, e.course_id, c.course_name
    FROM applications a JOIN students s ON a.student_id = s.student_id JOIN enrollments e ON a.enrollments_id = e.enrollment_id
    JOIN courses c ON e.course_id = c.course_id WHERE a.status = 'Pending'";
    if ($sortOption === 'asc') {
        $sql .= " ORDER BY studentName ASC";
    } elseif ($sortOption === 'desc') {
        $sql .= " ORDER BY studentName DESC";
    }


    $results = mysqli_query($conn, $sql);
    $enrollments = array();

    // Check if any rows were returned
    if (mysqli_num_rows($results) > 0) {
        // Loop through the rows and add them to the enrollments array
        while ($row = mysqli_fetch_assoc($results)) {
            $enrollments[] = $row;
        }
    }
    ?>
    <!-- main content -->
    <div class="main">
        <h1>Pending Applications</h1>
        <form method="GET" action="">
            <label for="sort">Sort</label>
            <select name="sort" id="sort" class="semester-dropdown">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
            <button type="submit" class="approve-btn semester-dropdown">Sort</button>
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Enrollment ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Enrollment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- loop through the enrollments and display each row -->
                <?php
                if (mysqli_num_rows($results) == 0) {
                    echo "<td colspan='8' style='text-align:center;'>No records</td>";
                } else {


                ?>
                    <?php foreach ($enrollments as $enrollment) : ?>
                        <tr>
                            <td><?= $enrollment['enrollment_id'] ?></td>
                            <td><?= $enrollment['student_id'] ?></td>
                            <td><?= $enrollment['studentName'] ?></td>
                            <td><?= $enrollment['course_id'] ?></td>
                            <td><?= $enrollment['course_name'] ?></td>
                            <td><?= $enrollment['enrollment_date'] ?></td>
                            <td><?= $enrollment['status'] ?></td>
                            <td>
                                <a href="./action/appaprrove.php?enrollment_id=<?= $enrollment['application_id'] ?>" class="approve-btn">Details</a>
                            </td>
                        </tr>
                <?php endforeach;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>