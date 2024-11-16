<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Update the paths based on your directory structure -->
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/dashboard.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="assets/SH_logo.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <!-- Updated links to correct paths -->
            <li><a href="home.php" id="home">Home</a></li>
            <li><a href="manage_users.php" id="manage_users">Manage Users</a></li>
            <li><a href="manage_bookings.php" id="manage_bookings">Manage Bookings</a></li>
            <li><a href="manage_rooms.php" id="manage_rooms">Add Rooms</a></li>
            <li><a href="manage_amenities.php" id="manage_amenities">Add Amenities</a></li>
            <li><a href="#" onclick="logout()" class="btn-logout">Logout</a></li>
        </ul>
        

    </div>

    <div class="main-content">
        <div id="content" class="content">
            <h2>Welcome to Admin Dashboard</h2>
            <p>Select an option from the menu to start managing the system.</p>
        </div>
    </div>

    <script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                // Redirect to the logout page (or login page if no logout script)
                window.location.href = '../index.php'; // Adjust path if needed
            }
        }
    </script>
</body>
</html>

