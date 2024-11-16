<?php
session_start();
require 'config.php'; // Connect to your database

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if user is admin
    $queryAdmin = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmtAdmin = $conn->prepare($queryAdmin);
    $stmtAdmin->bind_param('ss', $username, $password);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    if ($resultAdmin->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header('Location: admin/dashboard.php');
        exit();
    }

    // Query to check if user is guest
    $queryGuest = "SELECT * FROM guest WHERE email = ? AND password = ?";
    $stmtGuest = $conn->prepare($queryGuest);
    $stmtGuest->bind_param('ss', $username, $password);
    $stmtGuest->execute();
    $resultGuest = $stmtGuest->get_result();

    if ($resultGuest->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'guest';
        header('Location: customer/dashboard.php');
        exit();
    }

    // If login fails
    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management - Login</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/login.js" defer></script>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <img src="assets/logo.png" alt="Logo" class="logo">
            <h2>Sign In</h2>
            <form method="POST" action="index.php" id="loginForm">
                <div class="input-group">
                    <label for="username">Email/Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
