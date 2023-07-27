<!DOCTYPE html>
<!--declares document type as HTML5-->
<!--HTML5 standard is the latest version of HTML-->
<html>
<!--marks beginning of HTML document-->

<head>
  <!--contains metadata for the document such as title, character encoding, css styles etc..-->
  <!--metadata is data that provides additional information about other data, included in the head tag in a html document-->
  <title>Registration Form</title>
  <!--tag to set the title of the web page as "Registration Form"-->
  <style>
    /*tag used to embed/include CSS code directly within an HTML document*/
    /*CSS stands for Cascading Style Sheets*/
    body {
      /*contains various CSS properties and their corresponding values for application in the body element*/
      background-color: #0b0544;
      /*sets background color of an HTML element to a specified color using the code*/
      font-family: Arial, sans-serif;
      /*used to specify the font family for text content within an HTML element*/
      /*Arial is the preffered font family to be used and incase it is not available, sans-serif is used as the generic font family/alternative*/
    }

    /*marks end of body element*/

    .registration-box {
      /*class selector rule that targets HTML elements with the class attribute set to "registration-box."*/
      /* A CSS class selector is used to target and apply styles to HTML elements that have a specific class attribute*/
      background-color: #fff;
      /*Sets the background color of the .registration-box container to white (#fff)*/
      border-radius: 10px;
      /*border-radius is a CSS property that allows you to control the curvature of an element's corners*/
      /*this line of code is used to round the corners of the .registration-box container, creating a smooth, slightly curved appearance with a border radius of 10 pixels*/
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      /*takes 4 values: horizontal offset(0), vertical offset(0), blur radius(10px), & shadow color(rgba(0, 0, 0, 0.3))*/
      /*Adds a subtle box shadow to the .registration-box container.*/
      margin: 100px auto;
      /*centers container of the page by pushing it 100px down from the top and  centers it horizontally by setting the left and right margins to auto*
      padding: 20px;
      /*a padding creates space btwn the content inside the container and its edges*/
      /*this line adds 20px of padding to all 4 sides of the container*/
      max-width: 600px;
      /*sets the maximum width an element can have*/
      /*element is set not to exceed a width of 600px*/
    }

    h1 {
      /*indicates heading1/main heading*/
      text-align: center;
      /*used to horizontally center the text inside <h1> elements on the web page*/
      /*text-align property is commonly used to control the alignment of text within an element*/
      /*setting the property to center aligns it at the center of its container*/
    }

    /*marks end of h1 styles*/

    /*code that applies a flexbox layout for the form element for its child elements to be verically arranged*/
    form {
      /*element containing child elements*/
      display: flex;
      /*activates flexbox layout on the elent and its child elements that allows alignment control, distribution & order of the child elements within the container*/
      flex-direction: column;
      /*sets main axis of the flex container to be vertical*/
    }

    /*end of form container*/

    label {
      margin-top: 10px;
      /*margin-top property adds space between the top edge of the <label> element and the preceding content or element*/
      /*set to 10px ie applies a margin of 10px to the top of all <label> elements on the web page*/
      /*The margin creates visual separation, making the form elements more readable and enhancing the overall design.*/
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      /*declaring and styling the text, email and password input fields*/
      padding: 10px;
      /*adds 10px padding between the input field and its edge*/
      /*a padding creates space btwn the content inside the container and its edges*/
      border-radius: 5px;
      /*border-radius controls the curvature of an element's corners*/
      /*this line of code rounds the corners of the 3 input fields by 5px border radius making it smooth and appear slightly curved*/
      border: 1px solid;
      /*apply a 1px solid border around the input fields*/
      margin-bottom: 20px;
      /*adds 20px of space below each input field*/
    }

    /*end of text, email and password input fields styling*/

    input[type="submit"] {
      /*declaring and styling the submit button*/
      background-color: #0b0544;
      /*sets the background color of the submit button to a dark blue (#0b0544)*/
      color: #fff;
      /*sets the text color of the button to white (#fff)*/
      padding: 10px;
      /*sets distance between submit and the edge of the button to 10px/adds 10px of padding around the submit button*/
      border-radius: 5px;
      /*creates slightly rounded corners with a 5px border radius*/
      border: none;
      /*removes the default border of the button*/
      cursor: pointer;
      /*change the mouse cursor to a pointer when hovering over the button*/
      font-weight: bold;
      /*sets the font weight of the button text to bold*/
    }

    /*marks end of button styling*/

    input[type="submit"]:hover {
      /*styling for the submit button when hovered over*/
      background-color: #3e8e41;
      /*sets background color to a different one when hovering over the button*/
    }

    /*end of hover styling*/
  </style>
  <!--end of registration page styling-->

</head>
<!--end of head element-->

<body>
  <!--contains registration info/form-->
  <div class="registration-box">
    <!--HTML element with the CSS class "registration-box" assigned to it-->
    <h1>CUEA Online Admission</h1>
    <!--contains the main heading/heading1 of the webpage-->
    <div style="text-align: center;">
      <!--justifies the heading/text to be at the centre of the web page-->
      <img src="../imgs/logo.png" style="display: block; margin: 0 auto;">
      <!--contains the path to the image source that contains the logo used-->
    </div>

    <h1>Register</h1>
    <!--sets heading 1/main heading of the webpage to Register-->
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
      <p>Already have an account <a href="./login.php">Login</a></p>
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
      if (email.length == 0 || email.indexOf("@") == -1 || email.indexOf(".") == -1) {
        //checks if the length of the email is equal to zero/empty, does not contain the @ symbol and dot.
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

      function isPasswordValid(password) {
        let hasNumber = false;
        let hasUpperCase = false;
        let hasSymbol = false;

        for (const char of password) {
          if (!hasNumber && !isNaN(char)) {
            hasNumber = true;
          } else if (!hasUpperCase && char === char.toUpperCase() && char !== char.toLowerCase()) {
            hasUpperCase = true;
          } else if (!hasSymbol && isSymbol(char)) {
            hasSymbol = true;
          }

          if (hasNumber && hasUpperCase && hasSymbol) {
            break; // All conditions met, no need to continue checking
          }
        }

        if (!(hasNumber && hasUpperCase && hasSymbol) || password.length < 8) {
          alert("Password must have at least one number, one uppercase letter, and one symbol.");
          return false;
        }

        return true;
      }
    }
  </script>
</body>

</html>