<?php
session_start();
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
  if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
  }
  if (isset($errors) && !empty($errors)) { ?>
    <div style="color: red">
      <?php foreach ($errors as $error) { ?>
        <p><?php echo $error; ?></p>
    <?php }
    } ?>
    </div>

    <div class="login-box">
      <h1>CUEA Online Admission</h1>
      <div style="text-align: center">
        <img src="../imgs/logo.png" style="display: block; margin: 0 auto" />
      </div>
      <h1>Login</h1>
      <form action="../php/login.php" method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" />
        <span id="emailError" class="error"></span><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <span id="usernameError" class="error"></span><br />
        <input type="submit" name="submit" value="submit" />
        <p>New user <a href="../pages/Register.php">Register</a></p>
        <p>Forgot password <a href="../pages/resetpass.php">Reset</a></p>
      </form>
    </div>
    <!-- validation javascript -->
    <script src="../js/validations.js"></script>
</body>

</html>