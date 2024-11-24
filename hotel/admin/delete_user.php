<?php
include('C:\xampp\htdocs\hotel\db\connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the SQL query to delete the user
    $sql = $conn->prepare("DELETE FROM guest WHERE guest_id = ?");
    $sql->bind_param('i', $id);  // 'i' means integer type

    if ($sql->execute()) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user.";
    }
}
?>
