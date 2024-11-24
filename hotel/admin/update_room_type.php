<?php
// Include database connection
include('C:\xampp\htdocs\hotel\db\connection.php');

// Check if the form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['roomId'])) {
    $roomId = $_POST['roomId'];
    $roomName = $_POST['roomName'];
    $roomDescription = $_POST['roomDescription'];
    $roomPrice = $_POST['roomPrice'];

    // Prepare the SQL query to update the room type
    $sql = $conn->prepare("UPDATE Room_type SET room_type_name = ?, description = ?, base_price = ? WHERE room_type_id = ?");
    $sql->bind_param("ssdi", $roomName, $roomDescription, $roomPrice, $roomId);  // "ssdi" stands for string, string, double, int

    // Execute the query
    if ($sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Room type updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update room type']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
