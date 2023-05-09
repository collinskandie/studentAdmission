 <!DOCTYPE html>
 <html>

 <head>
     <title>Home page</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/index.css">
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
     <script>
         // Check if there's a success message in the URL and display it as a JavaScript alert
         <?php if (isset($_GET['success_message'])) : ?>
             var success_message = "<?php echo $_GET['success_message']; ?>";
             alert(success_message);
         <?php endif; ?>
     </script>
 </head>

 <body>
     <?php
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: pages/login.php');
            exit;
        };
        $id = $_SESSION['user'];

        include('./php/conn.php');
        $sql = "SELECT * FROM progress WHERE student_id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $level = $row['progress_level'];
            $level_points = $row['progress_points'];
        } else {
            $level = "enroll";
            $level_points = 0;
        }
        $sqlUser = "SELECT * FROM students WHERE student_id='$id'";
        $results = mysqli_query($conn, $sqlUser);
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_assoc($results);
            $userName = $row['first_name'];
            // echo $userName;
        }

        ?>
     <div class="topnav">
         <a href="php/logout.php">Logout</a>
         <div class="dropdown">
             <button class="dropbtn"><?php echo $userName; ?></button>
             <div class="dropdown-content">
                 <a href="./pages/resetpass.php">Change Password</a>
             </div>
         </div>
     </div>
     <div class="container">
         <h1>CUEA Online Admission</h1>
         <div style="text-align: center;">
             <img src="./imgs/logo.png" style="display: block; margin: 0 auto;">
         </div>
         <div class="page-content" style="text-align: center;">
             <h3>Welcome <?php echo $userName; ?></h3>
             <h5>Your progress</h5>
             <div class="progress">
                 <div class="bar" id="progress-bar"></div>
             </div>
             <div class="percentage" id="percentage"></div>
         </div>
         <?php
            if ($level === "enroll") {
            ?>
             <div style="align-content:center; margin-top: 50px;">
                 <button class="btn-action" onclick="window.location.href='./pages/enroll.php'" style="text-align: center;">Proceed to Enroll</button>
             </div>
         <?php
            } else if ($level === "application") {
            ?>
             <div style="align-content:center; margin-top: 50px; text-align: center;">
                 If existing application proceed to
                 <button class="btn-action" onclick="window.location.href='./pages/application.php'">Proceed to Application</button>
             </div>
         <?php
            } else {
            ?>
             <div style="align-content:center; margin-top: 50px; text-align: center;">
                 You have an exhisting enrollment awaiting approval, please be patient.
                 <button class="btn-action">Pending Approval</button>
             </div>

         <?php
            }
            ?>

     </div>

     <script>
         let progress = <?php echo $level_points; ?>;
         let progressBar = document.getElementById("progress-bar");
         let percentage = document.getElementById("percentage");

         progressBar.style.width = progress + "%";
         percentage.innerHTML = progress + "%";
     </script>
 </body>

 </html>