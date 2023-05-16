<!DOCTYPE html>
<html>

<head>
  <title>Registration Form</title>
  <style>
    body {
      background-color: #0b0544;
      font-family: Arial, sans-serif;
    }

    .registration-box {
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
    input[type="email"],
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
    }

    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
  </style>

</head>

<body>
  <div class="registration-box">
    <h1>CUEA Online Admission</h1>
    <div style="text-align: center;">
      <img src="../imgs/logo.png" style="display: block; margin: 0 auto;">
    </div>
    <!--   -->
    <h1>Register</h1>
    <form action="../php/register.php" onsubmit="return validateRegister();" method="POST">
      <label for="fname">First Name:</label>
      <input type="text" id="first_name" name="firstName">
      <label for="middleName">Middle Name:</label>
      <input type="text" id="middle_name" name="middleName">
      <label for="lastName">Last Name:</label>
      <input type="text" id="last_name" name="lastName">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm-password">
      <input type="submit" name="submit" value="Register">
      <p>Already have an account <a href="/pages/login.php">Login</a></p>
    </form>
  </div>
  <script>
    function validateRegister() {
      var firstName = document.getElementById("first_name").value;
      var lastName = document.getElementById("last_name").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;

      if (firstName == "") {
        alert("Please enter your first name");
        return false;
      }
      if (lastName == "") {
        alert("Last name cannot be blank");
        return false;
      }
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
        alert("Please enter your password");
        return false;
      }
      if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }
      // Check if password has a number, an uppercase letter, and a symbol
      var passwordPattern =
        /^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,}$/;

      if (!passwordPattern.test(password)) {
        alert(
          "Password must have at least one number, one uppercase letter, and one symbol."
        );
        return false;
      }
    }
  </script>
</body>

</html>