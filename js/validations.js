// validate login inputs
function validateForm() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  if (email == "") {
    alert("Please enter your email");
    return false;
  }
  // Regular expression pattern for email validation
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   check if email is the correct format 

  if (!emailPattern.test(email)) {
    alert("Please enter a valid email address.");
    return false;
  }

  if (password == "") {
    alert("Please enter a password.");
    return false;
  }

  // Add additional validation here, such as checking for minimum password length or valid email format.

  alert("Login successful!");
}

