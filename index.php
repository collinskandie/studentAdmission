 <!DOCTYPE html>
 <html>

 <head>
     <title>Home page</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/index.css">
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

        ?>
     <div class="container">
         <h1>CUEA Online Admission</h1>
         <div style="text-align: center;">
             <img src="./imgs/logo.png" style="display: block; margin: 0 auto;">
         </div>
         <div class="page-content" style="text-align: center;">
             <h3>Welcome</h3>
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
     <!-- show enroll buttons -->

     <script>
         let progress = <?php echo $level_points; ?>;
         let progressBar = document.getElementById("progress-bar");
         let percentage = document.getElementById("percentage");

         progressBar.style.width = progress + "%";
         percentage.innerHTML = progress + "%";
     </script>
 </body>

 </html>