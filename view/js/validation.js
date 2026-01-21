
function validateRegistration() {
    const name = document.querySelector('input[name="name"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const pass = document.querySelector('input[name="password"]').value.trim();
    const number = document.querySelector('input[name="number"]').value.trim();
    const address = document.querySelector('input[name="address"]').value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "" || email === "" || pass === "" || number === "" || address === "") {
        Swal.fire("Error", "All fields must be filled out!", "error");
        return false;
    }

    if (!emailPattern.test(email)) {
        Swal.fire("Error", "Please enter a valid email address.", "warning");
        return false;
    }

    if (pass.length < 6) {
        Swal.fire("Error", "Password must be at least 6 characters.", "warning");
        return false;
    }

    if (number.length < 10) {
        Swal.fire("Error", "Please enter a valid mobile number.", "warning");
        return false;
    }

    return true;
}

// Validation for Login Form
function validateLogin() {
    const email = document.querySelector('input[name="email"]').value.trim();
    const pass = document.querySelector('input[name="password"]').value.trim();

    if (email === "" || pass === "") {
        Swal.fire("Error", "Email and Password are required!", "error");
        return false;
    }

    return true;
}