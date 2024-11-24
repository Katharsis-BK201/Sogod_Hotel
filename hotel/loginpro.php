<?php

    session_start();


include('C:\xampp\htdocs\hotel\db\connection.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Username and password cannot be empty.';
    header("Location: index.php?err=true");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $username && $password) {

    $sql = "SELECT * FROM Admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        $stmt->close(); 
        $sql = "SELECT * FROM Guest WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }

    if ($row && isset($row['password']) && password_verify($password, $row['password'])) {
        if ($row['role'] === "Admin" || $row['role'] == "admin") {

            $_SESSION['users'] = [
                'admin_id' => $row['admin_id'],
                'username' => $row['username'],
                'role' => $row['role']   
            ];
            $_SESSION['login'] = true;
            header("Location: admin/dashboard.php");
            exit();

        }else{

            $_SESSION['users'] = [
                'FirstName' => $row['first_name'],
                'LastName' => $row['last_name'],
                'guest_id' => $row['guest_id'],
                'email' => $row['email'],
                'Role' => $row['role'],
            ];
            $_SESSION['login'] = true;
            header("Location: guest/dashboard.php");
            exit();
        } 
        
        

    } else {
        $_SESSION['error'] = 'Invalid Username or Password';
        header("Location: index.php?invalid-credentials=true");
        exit();
    }
} else {
    $_SESSION['login'] = false;
    header("Location: index.php?invalid-login=true");
    exit();
}

$stmt->close();
$conn->close();
?>
