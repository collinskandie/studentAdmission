<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
  <link rel="stylesheet" href="../css/Login.css" />
  <style>
    body {
      background-color: #0b0544;
      font-family: Arial, sans-serif;
    }

    .login-box {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      margin: 100px auto;
      padding: 20px;
      max-width: 600px;
    }

    h1 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #0b0544;
      color: #fff;
      padding: 10px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      max-width: 60px;
    }

    input[type="submit"]:hover {

      background-color: #925a1b;
    }
  </style>
  <script>
   
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
      <form action="../php/login.php" onsubmit="return validateForm();" method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" />
        <span id="emailError" class="error"></span><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
        <span id="usernameError" class="error"></span><br />
        <input type="submit" name="submit" value="submit" />
        <p>New user <a href="../pages/Register.php">Register</a></p>
        <p><a href="../pages/admin/adminlogin.php">Admin login</a></p>
        <p>Forgot password <a href="../pages/resetpass.php">Reset</a></p>
      </form>
    </div>
    <!-- validation javascript -->
    <script>
      function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        if (email == "") {
          alert("Please enter your email");
          return false;
        }
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
          alert("Please enter a valid email address.");
          return false;
        }
        if (password == "") {
          alert("Please enter a password.");
          return false;
        }
      }
    </script>
</body>
</html>