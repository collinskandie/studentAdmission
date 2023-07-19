<?php
//opening tag used to indicate the beginning of a PHP code in a PHP file.
session_start();
//function used to create a session or resume an existing session
//a session is what stores the data and all requests made by a user in a website
?>
<!--closing tag in PHP used to indicate the end of the PHP code block-->
<!DOCTYPE html>
<!--declares document type as HTML5-->
<!--HTML5 standard is the latest version of HTML-->
<html>
  <!--marks beginning of HTML document-->

<head>
  <!--contains metadata for the document such as title, character encoding, css styles etc..-->
  <!--metadata is data that provides additional information about other data, included in the head tag in a html document-->
  <meta charset="UTF-8" />
  <title>Login Page</title>
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
    <?php if (isset($_GET['error_message'])) : ?> 
      // checks if the error_message parameter is set in the URL's query string. If it is set, the code inside the if statement is executed.
      var success_message = "<?php echo $_GET['error_message']; ?>";
      alert(success_message);
    <?php endif; ?>
    <?php if (isset($_GET['success_message'])) : ?>
      var success_message = "<?php echo $_GET['success_message']; ?>";
      alert(success_message);
    <?php endif; ?>
  </script>
</head>

<body>
  <?php
  // session_start();
  if (isset($_SESSION['user'])) { // checks if the $_SESSION['user'] variable is set, indicating that the user is already logged in
    header("Location: ../index.php"); //function that redirects logged in user to the homepage
  }
  if (isset($errors) && !empty($errors)) { ?> <!--checks if the $errors variable is set and not empty -->
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
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />
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
        if (email.length == 0 || email.indexOf("@") == -1 || email.indexOf(".") == -1) {
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