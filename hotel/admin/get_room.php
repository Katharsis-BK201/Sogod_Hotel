<?php
include('C:\xampp\htdocs\hotel\db\connection.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = $conn->prepare("SELECT * FROM Room_type WHERE room_type_id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();

    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Room type not found']);
    }
}

?>
