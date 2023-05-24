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

        .faculty-form {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        .faculty-form label {
            display: block;
            margin-bottom: 5px;
        }

        .faculty-form input[type='text'],
        .faculty-form textarea {
            width: 60%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .faculty-form input[type='submit'] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .faculty-form input[type='submit']:hover {
            background-color: #3e8e41;
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

    // Function to sanitize input data
    function sanitize($data)
    {
        global $conn;
        $data = trim($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    // Add new faculty to the database
    if (isset($_POST['submit'])) {
        $name = sanitize($_POST['name']);
        $description = sanitize($_POST['description']);

        $insertSql = "INSERT INTO faculties (name, description) VALUES ('$name', '$description')";
        $insertResult = mysqli_query($conn, $insertSql);

        if ($insertResult) {
            echo "<script>alert('Faculty added successfully');</script>";
        } else {
            echo "<script>alert('Failed to add faculty');</script>";
        }
    }

    // Fetch faculties from the database
    $facultiesSql = "SELECT * FROM faculties";
    $facultiesResult = mysqli_query($conn, $facultiesSql);
    $faculties = mysqli_fetch_all($facultiesResult, MYSQLI_ASSOC);

    // Fetch departments for each faculty
    $departmentsSql = "SELECT * FROM departments";
    $departmentsResult = mysqli_query($conn, $departmentsSql);
    $departments = mysqli_fetch_all($departmentsResult, MYSQLI_ASSOC);

    // Fetch programs for each department
    $programsSql = "SELECT * FROM courses";
    $programsResult = mysqli_query($conn, $programsSql);
    $programs = mysqli_fetch_all($programsResult, MYSQLI_ASSOC);
    ?>

    <div class="main">
        <h1>Faculties</h1>

        <!-- Form code for adding a new faculty -->
        <form method='post' class='faculty-form'>
            <label for='name'>Name:</label>
            <input type='text' name='name' id='name'>
            <label for='description'>Description:</label>
            <textarea name='description' id='description'></textarea>
            <br>
            <input type='submit' name='submit' value='Add Faculty'>
        </form>
        <br>

        <table id="facultyTable">
            <p>Click on the table row to expand </p>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            <?php
            // Loop through faculties
            foreach ($faculties as $faculty) {
                echo "<tr class='faculty-row' data-faculty-id='" . $faculty["id"] . "'>";
                echo "<td>" . $faculty["id"] . "</td>";
                echo "<td>" . $faculty["name"] . "</td>";
                echo "<td>" . $faculty["description"] . "</td>";
                echo "<td>";
                echo "<a href='./action/deletefaculty.php?id=" . $faculty["id"] . "' class='delete-btn' style='background-color: red; color:white;'>Delete</a>";
                echo "</td>";
                echo "</tr>";

                // Loop through departments for the current faculty
                foreach ($departments as $department) {
                    if ($department["faculty_id"] == $faculty["id"]) {
                        echo "<tr class='department-row' data-faculty-id='" . $faculty["id"] . "'>";
                        echo "<td></td>"; // Empty cell for indentation
                        echo "<td>" . $department["name"] . "</td>";
                        echo "<td>" . $department["name"] . "</td>";
                        echo "<td></td>"; // Empty cell for action column
                        echo "</tr>";

                        // Loop through programs and display them for the current department
                        // foreach ($programs as $program) {
                        //     if ($program["department_id"] == $department["id"]) {
                        //         echo "<tr class='program-row' data-depart-id='" .  $department["id"] . "'>";
                        //         echo "<td></td>"; // Empty cell for indentation
                        //         echo "<td>" . $program["course_name"] . "</td>";
                        //         echo "<td>" . $program["course_description"] . "</td>";
                        //         echo "<td></td>"; // Empty cell for action column
                        //         echo "</tr>";
                        //     }
                        // }
                    }
                    // echo "<tr><td colspan='4'>No departments found.</td></tr>";
                }
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

    <script>
        // JavaScript code to toggle visibility of department rows when a faculty row is clicked
        document.addEventListener('DOMContentLoaded', function() {
            var facultyRows = document.querySelectorAll('.faculty-row');

            facultyRows.forEach(function(row) {
                row.addEventListener('click', function() {
                    var facultyId = row.getAttribute('data-faculty-id');
                    var departmentRows = document.querySelectorAll('.department-row[data-faculty-id="' + facultyId + '"]');

                    departmentRows.forEach(function(departmentRow) {
                        departmentRow.style.display = (departmentRow.style.display === 'none') ? 'table-row' : 'none';
                    });
                });
            });

            var departmentRows = document.querySelectorAll('.department-row');

            departmentRows.forEach(function(row) {
                row.addEventListener('click', function() {
                    var departmentId = row.getAttribute('data-depart-id');
                    var programRows = document.querySelectorAll('.program-row[data-depart-id="' + departmentId + '"]');

                    programRows.forEach(function(programRow) {
                        programRow.style.display = (programRow.style.display === "none") ? 'table-row' : 'none';
                    });
                });
            });
        });
    </script>
</body>

</html>