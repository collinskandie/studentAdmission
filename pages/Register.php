<!DOCTYPE html>
<html>

<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="../css/Register.css">
</head>

<body>
  <div class="registration-box">
    <h1>CUEA Online Admission</h1>
    <div style="text-align: center;">
      <img src="../imgs/logo.png" style="display: block; margin: 0 auto;">
    </div>
    <!--   -->
    <h1>Register</h1>
    <form action="../php/register.php"  onsubmit="return validateRegister();" method="POST">
      <label for="fname">First Name:</label>
      <input type="text" id="first_name" name="firstName">
      <label for="middleName">Middle Name:</label>
      <input type="text" id="middle_name" name="lastName">
      <label for="lastName">Last Name:</label>
      <input type="text" id="last_name" name="lastName">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm-password">
      <input type="submit" name="submit" value="Register"  >
      <p>Already have an account <a href="/pages/login.php">Login</a></p>
    </form>
  </div>
  <script src="../js/validations.js"></script>
</body>

</html>