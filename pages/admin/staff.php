<!DOCTYPE html>
<html>

<head>
    <title>Faculties</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <style>
        /* CSS styles for the table and expansion */
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

        .department-row {
            display: none;
            background-color: #f9f9f9;
        }

        .department-row td {
            padding-left: 40px;
        }

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
    // PHP code for session and authorization check
    session_start();
    if (!$_SESSION['role']) {
        header("Location: ../../index.php?error_message=" . urlencode("You are not authorized to view this page"));
    }
    include("adminnav.php");
    include("../../php/conn.php");

    // Fetch faculties from the database
    $facultiesSql = "SELECT * FROM staff";
    $facultiesResult = mysqli_query($conn, $facultiesSql);
    $faculties = mysqli_fetch_all($facultiesResult, MYSQLI_ASSOC);

    // Fetch departments for each faculty
    // $departmentsSql = "SELECT * FROM departments";
    // $departmentsResult = mysqli_query($conn, $departmentsSql);
    // $departments = mysqli_fetch_all($departmentsResult, MYSQLI_ASSOC);
    
    // // Fetch programs for each department
    // $programsSql = "SELECT * FROM courses";
    // $programsResult = mysqli_query($conn, $programsSql);
    // $programs = mysqli_fetch_all($programsResult, MYSQLI_ASSOC);
    ?>

    <div class="main">
        <h1>Board Memebers</h1>


        <br>

        <table id="facultyTable">
            <!-- <p>Click on the table row to expand </p> -->
            <tr>

                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>

            <?php
            // Loop through faculties
            foreach ($faculties as $faculty) {
                echo '<tr>';
                echo "<td>" . $faculty["staff_id"] . "</td>";
                echo "<td>" . $faculty["first_name"] . "</td>";
                echo "<td>" . $faculty["last_name"] . "</td>";
                echo "<td>" . $faculty["email"] . "</td>";
                echo "<td>" . $faculty["role"] . "</td>";
                echo '</tr>';
            }

            // Check if no faculties found
            if (empty($faculties)) {
                echo "<tr><td colspan='4'>No faculties found.</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

        </table>

    </div>



</body>

</html>