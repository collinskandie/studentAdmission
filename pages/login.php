<?php

session_start();
include('../php/conn.php');

if (isset($_POST['submit'])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);  
  $sql = "SELECT * FROM students WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);    
    if (password_verify($password, $row['password'])) {      
      $_SESSION['user'] = $row['student_id'];
      $_SESSION['email'] = $row['email'];
      
      header("Location: ../index.php");                  
      exit();
    } else {     
      $error_message = "password hakuna kama hyo.";
    }
    
  } else {    
  //  $error_message = $result;
  } 
  if (isset($error_message)) {
   echo '<script>alert("' . $error_message . '");</script>';
    header("Location: ../pages/login.php?success_message=" . urlencode($error_message));
  }
} else {

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8" />
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/Login.css" />
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
    // session_start();
    if(isset($_SESSION['user'])){
      header("Location: ../index.php");
    }
    if (isset($errors) && !empty($errors)) { ?>
      <div style="color: red">
        <?php foreach ($errors as $error) { ?>
          <p><?php echo $error; ?></p>
        <?php } ?>
      </div>
    <?php } ?>
    <div class="login-box">
      <h1>CUEA Online Admission</h1>
      <div style="text-align: center">
        <img src="../imgs/logo.png" style="display: block; margin: 0 auto" />
      </div>
      <h1>Login</h1>
      <form action="login.php" method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" />
        <span id="emailError" class="error"></span><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <span id="usernameError" class="error"></span><br />
        <input type="submit" name="submit" value="submit" />
        <p>New user <a href="../pages/Register.php">Register</a></p>
      </form>
    </div>
    <!-- validation javascript -->
    <script src="../js/validations.js"></script>
  </body>

  </html>
<?php
}
?>