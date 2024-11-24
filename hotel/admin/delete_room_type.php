<?php
// Include database connection
include('C:\xampp\htdocs\hotel\db\connection.php');

// Check if the room ID is provided
if (isset($_POST['id'])) {
    $roomId = $_POST['id'];

    // Prepare the SQL query to delete the room type by ID
    $sql = $conn->prepare("DELETE FROM Room_type WHERE room_type_id = ?");
    $sql->bind_param("i", $roomId);  // "i" for integer

    // Execute the query
    if ($sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Room type deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete room type']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
