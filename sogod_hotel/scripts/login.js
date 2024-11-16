// JavaScript for basic form validation
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", (e) => {
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username === "" || password === "") {
            e.preventDefault();
            alert("Please fill in all fields");
        }
    });
});
