<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    // handle error condition
}

include "db.php";
session_start();

$serviceProvider = $_SESSION['Service_provider'];

// Retrieve the sorting and filtering options
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';

// Retrieve the upcoming appointments from the database
$sql = "SELECT * FROM appointments where serviceProvider = '$serviceProvider'";

if ($sortOption === 'date_asc') {
    $sql .= " ORDER BY appointmentDate ASC";
} elseif ($sortOption === 'date_desc') {
    $sql .= " ORDER BY appointmentDate DESC";
} elseif ($sortOption === 'name_asc') {
    $sql .= " ORDER BY customerName ASC";
} elseif ($sortOption === 'name_desc') {
    $sql .= " ORDER BY customerName DESC";
} elseif ($sortOption === 'category_asc') {
    $sql .= " ORDER BY Category ASC";
} elseif ($sortOption === 'category_desc') {
    $sql .= " ORDER BY Category DESC";
} elseif ($sortOption === 'subcategory_asc') {
    $sql .= " ORDER BY Subcategory ASC";
} elseif ($sortOption === 'subcategory_desc') {
    $sql .= " ORDER BY Subcategory DESC";
}

$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Appointmenrts</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            display: flex;
            align-items: center;
            padding: 20px;


        }

        nav {
            flex: 1;
            text-align: right;
        }

        nav ul {
            display: inline-block;
            list-style-type: none;
        }

        nav ul li {
            display: inline-block;
            margin-right: 20px;
        }

        a {
            text-decoration: none;
            color: #555;
        }

        p {
            color: #555;
        }

        .container {
            max-width: 1300px;
            margin: auto;
            padding-left: 25px;
            padding-right: 25px;
        }

        .row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .col-2 {
            flex-basis: 50%;
            min-width: 300px;
        }

        .col-2 img {
            max-width: 120%;
            padding: 50px 0;
        }

        .col-2 h1 {
            font-size: 50px;
            line-height: 60px;
            margin: 25px 0;
        }

        .btn {
            display: inline-block;
            background: #ff523b;
            color: #fff;
            padding: 8px 30px;
            margin: 30px 0;
            border-radius: 30px;
            transition: background 0.5s;
        }

        .btn:hover {
            background: #563434;
        }

        .header {
            background: radial-gradient(#fff, #ffd6d6);
        }

        .header .row {
            margin-top: 70px;
        }

        .categories {
            margin: 70px 0;
        }

        .col-3 {
            flex-basis: 30%;
            min-width: 250px;
            margin-bottom: 30px;
        }

        .col-3 img {
            width: 400px;
            height: 400px;
        }

        /* Side Navigation */
        .sidenav {
            background-color: #f1f1f1;
            width: 200px;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .sidenav a {
            padding: 16px;
            text-decoration: none;
            display: block;
        }

        .sidenav a:hover {
            background-color: #ddd;
        }

        .content {
            margin-left: 200px;

            padding: 16px;
        } 


        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .hidden {
            display: none;
        }


        .topnav {
            background-color: grey;
            overflow: hidden;
        }

        .topnav a {
            float: left;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: #333;
        }

        .topnav a.active {
            background-color: #fff;
            color: #333;
        }
    </style>

</head>

<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="images/logo.jpg" width="125px">
                </div>
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <!-- <button id="logout-button" name="logout"><a href="logout.php">Log out</a></button> -->
                    </ul>
                </nav>
                <img src="images/cart.jpg" width="40px" height="40px">
            </div>
        </div>
    </div>
    <main>
        <div class="sidenav">
            <a href="sregistar.php">Service registar</a>
            <a href="mservices.php">Manage services</a>
            <a href="mappointments.php">Manage appointments</a>
            <a href="cratings.php">Customer ratings</a>
            <a href="alerts.php">Notification and alerts</a>
            <a href="saccounts.php">Profile and account settings </a>
            <a href="help.php">Help and support</a>
        </div>
        <div class="content">

            <div class="topnav">
                <a href="sortappoint.php">Appointment List</a>
                <a href="#about">Status and Actions</a>
                <a href="#services">Availability and Scheduling</a>
                <a href="#contact">Booking History</a>
            </div>
            <br>
            <form method="GET" action="">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort">
                    <option value="date_asc">Date (Ascending)</option>
                    <option value="date_desc">Date (Descending)</option>
                    <option value="name_asc">Name (Ascending)</option>
                    <option value="name_desc">Name (Descending)</option>
                    <option value="category_asc">Category (Ascending)</option>
                    <option value="category_desc">Category (Descending)</option>
                    <option value="subcategory_asc">Subcategory (Ascending)</option>
                    <option value="subcategory_desc">Subcategory (Descending)</option>
                </select>
                <button type="submit">Apply</button>
            </form>
            <br>
            <!-- </div> -->
            <!-- </div> -->
            <?php
            // Display the fetched appointment data      
            echo "<table>";
            echo "<tr>
            <th>Appointment ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Category</th>
            <th>Subcategory</th>
          </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                // Display appointment details in table rows
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['appointmentDate'] . "</td>";
                echo "<td>" . $row['customerName'] . "</td>";
                echo "<td>" . $row['Category'] . "</td>";
                echo "<td>" . $row['Subcategory'] . "</td>";
                echo "</tr>";
                // ... display other details
            }

            echo "</table>";
            ?>
        </div>
    </main>
</body>

</html>