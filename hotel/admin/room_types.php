<?php


if(!isset($_SESSION)){

    session_start();

}

$log = (isset($_SESSION['login'])? $_SESSION['login']:false);

if(!$log)
{
    header("Location: http://localhost/ems/index.php");
}


include ('header.php');
include ('menu.php');
include('C:\xampp\htdocs\hotel\db\connection.php');

$sql = $conn->prepare("SELECT * FROM Room_type");
$sql->execute();

$res = $sql->get_result();

$data = array();

if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){

        $data[] = $row;
    }
}

?>

<div class="container-fluid">
    <hr>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="dashboard.php">Back to Dashboard</a> / Room Types</li>
        </ol>
    </nav>
    <hr>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>

    <body>
        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be populated by DataTable -->
            </tbody>
        </table>
           <!-- Place your modal here -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Room Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="roomId">
                        <div class="mb-3">
                            <label for="roomName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="roomName" required>
                        </div>
                        <div class="mb-3">
                            <label for="roomDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roomDescription" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="roomPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="roomPrice" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

<script>
// Pass PHP array to JavaScript as JSON
var dataSet = <?php echo json_encode($data); ?>;

$(document).ready(function() {
    // Initialize DataTable with dynamic data
    $('#userTable').DataTable({
        data: dataSet,
        columns: [
            { data: 'room_type_name' },       // Adjust to match your actual column names in the database
            { data: 'description' }, 
            { data: 'base_price' },
            { 
                data: null,        // Actions column
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-primary" onclick="editUser(${data.room_type_id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteUser(${data.room_type_id})">Delete</button>
                    `;
                }
            }
        ],
    order: [],
    rowCallback: function(row, data) {
        $(row).attr('id', 'row-' + data.room_type_id);  // Set a unique ID for the row
    },
    });
});

function editUser(id) {
    // Fetch room type details
    $.ajax({
        url: 'get_room.php',
        type: 'POST',
        data: { id: id }, // Send room_type_id to backend
        success: function(response) {
            const data = JSON.parse(response);
            if (data.error) {
                alert(data.error);
            } else {
                // Populate form fields with data
                $('#roomId').val(data.room_type_id); // Match hidden input for ID
                $('#roomName').val(data.room_type_name); // Match input for Name
                $('#roomDescription').val(data.description); // Match input for Description
                $('#roomPrice').val(data.base_price); // Match input for Price

                // Show the modal
                $('#editModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching room type:', error);
            alert('An error occurred. Please try again.');
        }
    });
}
function saveChanges() {
    // Get the form data
    const roomId = $('#roomId').val();
    const roomName = $('#roomName').val();
    const roomDescription = $('#roomDescription').val();
    const roomPrice = $('#roomPrice').val();

    // Send the data to the backend using AJAX
    $.ajax({
        url: 'update_room_type.php',  // The PHP script to handle the update
        type: 'POST',
        data: {
            roomId: roomId,
            roomName: roomName,
            roomDescription: roomDescription,
            roomPrice: roomPrice
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                Swal.fire('Success', data.message, 'success').then(() => {
                    $('#editModal').modal('hide');  // Close the modal
                    location.reload();  // Reload the page to reflect the changes
                });
            } else {
                Swal.fire('Error', data.error, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'An error occurred. Please try again.', 'error');
        }
    });
}




function deleteUser(id) {
    // Show confirmation popup
    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to remove this room type.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            // User confirmed, proceed with delete operation
            $.ajax({
                url: 'delete_room_type.php',  // URL to the delete PHP script
                type: 'POST',
                data: { id: id },  // Send the room ID to be deleted
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'The room type has been removed.',
                            'success'
                        ).then(() => {
                            // Optionally, remove the row from the table
                            $('#row-' + id).remove();  // Assuming your table row has an ID like 'row-id'
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to delete room type.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Delete error:', status, error);
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the room type.',
                        'error'
                    );
                }
            });
        }
    });
}

</script>

<script src="js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
