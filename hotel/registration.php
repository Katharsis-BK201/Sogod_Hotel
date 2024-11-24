<?php  

    if(isset($_SESSION)){
        session_start();
    }

    include('C:\xampp\htdocs\hotel\db\connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $role = $_POST['role'];

    // Validate password and retype password
    if ($password === $retype_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $admin = $conn->prepare("INSERT INTO Admin (username, password, role) VALUES (?, ?,?)");
        $admin->bind_param("sss", $username, $hashed_password, $role);

        if($admin->execute()){
            $_SESSION['success'] = "Admin Registration Successfully";
            header("Location: index.php");
        }
    } else {
        echo "error: ". $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
</head>
<style>
    /* Reset some default styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #007bff;
        outline: none;
    }

    button[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Success and Error messages */
    .success-message {
        color: green;
        text-align: center;
        margin-top: 10px;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-top: 10px;
    }

</style>
<body>
    <div class="container">
        <h2>Admin Registration Form</h2>
        <form method="POST" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="retype_password">Retype Password</label>
                <input type="password" id="retype_password" name="retype_password" required>
            </div>

            <div class="form-group">
                <label for="role">Account Role</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>
