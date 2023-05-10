<!DOCTYPE html>
<html>

<head>
    <title>Faculties</title>
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
    session_start();
    if (!$_SESSION['role']) {
        header("Location: ../../index.php?error_message=" . urlencode("You are not authorized to view this page"));
    }
    include("adminnav.php");
    include("../../php/conn.php");
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Get the form data
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Insert the new faculty into the database
        $sql = "INSERT INTO faculties (name, description) VALUES ('$name', '$description')";
        if (mysqli_query($conn, $sql)) {
            echo "New faculty added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Select all faculties from the faculties table
    $sql = "SELECT * FROM faculties";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="main">
        <h1>Active Enrollment status</h1>
        <?php
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Description</th></tr>";

        // Loop through each row in the result set and display it in a table row
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No faculties found.</td></tr>";
        }

        echo "</table>";

        // Close the database connection
        mysqli_close($conn);
        ?>
        <form method='post' class='faculty-form'>
            <label for='name'>Name:</label>
            <input type='text' name='name' id='name'>
            <label for='description'>Description:</label>
            <textarea name='description' id='description'></textarea>
            <br>
            <input type='submit' name='submit' value='Add Faculty'>
        </form>


    </div>
</body>

</html>