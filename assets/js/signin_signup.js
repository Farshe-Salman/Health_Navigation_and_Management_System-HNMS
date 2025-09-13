const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active"); 
});






// // Signup form validation
// const signUpForm = document.querySelector(".sign-up form");
// if (signUpForm) {
//     const nameInput = signUpForm.querySelector('input[placeholder="Name"]');
//     const emailInput = signUpForm.querySelector('input[placeholder="E-mail or Phone"]');
//     const passwordInput = signUpForm.querySelector('input[placeholder="Password"]');
//     const confirmInput = signUpForm.querySelector('input[placeholder="Confirm Password"]');

//     function showError(input, msg) {
//         let error = input.nextElementSibling;
//         if (!error || !error.classList.contains("error-msg")) {
//             error = document.createElement("div");
//             error.className = "error-msg";
//             input.parentNode.insertBefore(error, input.nextSibling);
//         }
//         error.textContent = msg;
//         input.style.border = "1px solid red";
//     }

//     function clearError(input) {
//         let error = input.nextElementSibling;
//         if (error && error.classList.contains("error-msg")) error.textContent = "";
//         input.style.border = "";
//     }

//     nameInput.addEventListener("input", () => {
//         if (nameInput.value.trim().length < 3) showError(nameInput, "Name at least 3 letters");
//         else clearError(nameInput);
//     });

//     emailInput.addEventListener("input", () => {
//         const email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         const phone = /^[0-9]{10,15}$/;
//         if (!email.test(emailInput.value) && !phone.test(emailInput.value)) showError(emailInput, "Enter valid email or phone");
//         else clearError(emailInput);
//     });

//     passwordInput.addEventListener("input", () => {
//         if (passwordInput.value.length < 6) showError(passwordInput, "Password min 6 characters");
//         else clearError(passwordInput);
//     });

//     confirmInput.addEventListener("input", () => {
//         if (confirmInput.value !== passwordInput.value) showError(confirmInput, "Passwords do not match");
//         else clearError(confirmInput);
//     });

//     signUpForm.addEventListener("submit", (e) => {
//         if (
//             nameInput.value.trim().length < 3 ||
//             (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value) && !/^[0-9]{10,15}$/.test(emailInput.value)) ||
//             passwordInput.value.length < 6 ||
//             confirmInput.value !== passwordInput.value
//         ) {
//             e.preventDefault();
//             alert("Error!");
//         }
//     });
// }

// // Signin form validation (simple)
// const signInForm = document.querySelector(".sign-in form");
// if (signInForm) {
//     const emailInput = signInForm.querySelector('input[placeholder="E-mail or Phone"]');
//     const passwordInput = signInForm.querySelector('input[placeholder="Password"]');

//     signInForm.addEventListener("submit", (e) => {
//         let valid = true;
//         if (emailInput.value.trim() === "") {
//             alert("Enter your email or phone");
//             valid = false;
//         }
//         if (passwordInput.value.trim() === "") {
//             alert("Enter your password");
//             valid = false;
//         }
//         if (!valid) e.preventDefault();
//     });
// }
