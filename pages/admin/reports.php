<!DOCTYPE html>
<html>

<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../../css/admin.css" />
</head>

<body>
  <?php
  include("adminnav.php");
  session_start();
  if(!$_SESSION['role']){
    // echo "<script>alert('You are not authorized to view this page')</script>";   
    header("Location: ../../index.php?error_message=" . urlencode("You are not authorized to view this page"));
  }
  ?>

  <!-- main content -->
  <div class="main">
    <h1>System Reports</h1>
    <p>
      Summary
    </p>
  </div>
</body>

</html>