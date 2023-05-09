function login() {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
  
    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value)) {
      alert("Please enter a valid email address");
    }
      return;
    }
  
    // Password validation
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-=_+[\]{}|\\;:'",.<>/?]).{8,}$/;
    if (!passwordRegex.test(passwordInput.value)) {
      alert("Please enter a valid password with at least 8 characters, including upper and lower case letters, digits, and special characters");
      return;
    }
  