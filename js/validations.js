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
//validate user registration form
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
  var passwordPattern =/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,}$/;

  if (!passwordPattern.test(password)) {
    alert(
      "Password must have at least one number, one uppercase letter, and one symbol."
    );
    return false;
  }
}
//enrollment form validator
function validateEnroll(){
  var prevQualif = document.getElementById("qualification").value;
  var programIntrest = document.getElementById("program").value;
  
  if (prevQualif == ""){
    alert("Qualification cannot be null");
    return false;
  }
  if (programIntrest == ""){
    alert("Please select your program of interest");
    return false;
  }
  
  window.location.href='Application.html'

}