<?php
include('connection.php'); // Database connection

if (
    isset($_POST['userId'], $_POST['userName'], $_POST['firstName'], $_POST['lastName'], 
    $_POST['email'], $_POST['contactNumber'], $_POST['address'])
) {
    $userId = $_POST['userId']; // Corresponds to guest_id in the database
    $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE guest SET username = ?, first_name = ?, last_name = ?, email = ?, con_num = ?, address = ? WHERE guest_id = ?");
    $stmt->bind_param("ssssssi", $userName, $firstName, $lastName, $email, $contactNumber, $address, $userId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update user.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
}
?>
