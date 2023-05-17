 <!-- top navigation -->
 <style>
     .dropdown {
         position: relative;
         display: inline-block;
     }

     .dropdown-content {
         display: none;
         position: absolute;
         z-index: 1;
     }

     .dropdown-content a {
         color: white;
         padding: 12px 16px;
         text-decoration: none;
         display: block;
     }

     .dropdown:hover .dropdown-content {
         display: block;
     }
 </style>
 <div class="topnav">
     <div class="top_nav">
         <a href="../resetpass.php" class="user-profile">User Profile</a>
         <a href="../../php/logout.php" class="logout">Logout</a>
     </div>
 </div>
 <!-- side navigation -->
 <div class="sidenav">
     <div style="text-align: center">
         <img src="../../imgs/logo.png" style="display: block; margin: 0 auto" />
     </div>
     <div class="side_nav">
         <a href="admin.php">Home</a>
         <a href="active.php">Active Enrollment</a>
         <a href="application.php">Active Applications</a>         
         <div class="dropdown">
             <a class="dropbtn">Reports ▼</a>
             <div class="dropdown-content">
                 <a href="./faculties.php">Faculties</a>                
                 <a href="./departments.php">Departments</a>
                 <a href="./courses.php">Courses</a>
                 <a href="./perdepart.php">Students per Department</a>
                 <a href="./perfacult.php">Students per Faculty</a>
                 <a href="./perlevel.php">Students per level</a>
                 <a href="./acceptedstudents.php">Accepted Students</a>
                 <a href="./rejectedstudents.php">Rejected Students</a>
             </div>
         </div>
     </div>


 </div>