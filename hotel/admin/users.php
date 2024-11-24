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

$sql = $conn->prepare("SELECT * FROM guest");
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
            <li class="breadcrumb-item active" aria-current="page"><a href="dashboard.php">Back to Dashboard</a> / Users List</li>
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
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be populated by DataTable -->
            </tbody>
        </table>
        <!-- Edit User Modal -->
<div class="modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                <input type="hidden" id="userId">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="con_num" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contactNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
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
            { data: 'username' },       // Adjust to match your actual column names in the database
            { 
                data: null,             // Full Name column (concatenate first_name and last_name)
                render: function(data, type, row) {
                    return data.first_name + ' ' + data.last_name; // Combine first_name and last_name
                }
            },
            { data: 'email' },
            { data: 'con_num' },
            { data: 'address' },
        
            { 
                data: null,        // Actions column
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-primary" onclick="editUser(${data.guest_id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteUser(${data.guest_id})">Delete</button>
                    `;
                }
            }
        ],
    order: [],
    rowCallback: function(row, data) {
        $(row).attr('id', 'row-' + data.guest_id);  // Set a unique ID for the row
    },
    });
});

function editUser(id) {
    // Fetch user details
    $.ajax({
        url: 'get_user.php', // Backend script to fetch user details by ID
        type: 'POST',
        data: { id: id }, // Send user ID to backend
        success: function(response) {
            const data = JSON.parse(response);
            if (data.error) {
                alert(data.error); // Handle error if user not found or other issues
            } else {
                // Populate form fields with fetched user data
                $('#userId').val(data.guest_id); // Use guest_id for user ID
                $('#userName').val(data.username); // Match input for Username
                $('#firstName').val(data.first_name); // Match input for First Name
                $('#lastName').val(data.last_name); // Match input for Last Name
                $('#email').val(data.email); // Match input for Email
                $('#contactNumber').val(data.con_num); // Match input for Contact Number
                $('#address').val(data.address); // Match input for Address

                // Show the modal
                $('#editUserModal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user details:', error);
            alert('An error occurred. Please try again.');
        }
    });
}

function saveChanges() {
    // Get the form data
    const userId = $('#userId').val(); // Still references the correct hidden input
    const userName = $('#userName').val();
    const firstName = $('#firstName').val();
    const lastName = $('#lastName').val();
    const email = $('#email').val();
    const contactNumber = $('#contactNumber').val();
    const address = $('#address').val();

    // Send the updated data to the backend using AJAX
    $.ajax({
        url: 'update_user.php', // Backend script to handle the update
        type: 'POST',
        data: {
            userId: userId, // Send as userId
            userName: userName,
            firstName: firstName,
            lastName: lastName,
            email: email,
            contactNumber: contactNumber,
            address: address
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                Swal.fire('Success', data.message, 'success').then(() => {
                    $('#editUserModal').modal('hide'); // Close the modal
                    location.reload(); // Reload the page to reflect the changes
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
    // Implement your delete action logic here
    Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to remove user with account number ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, perform delete operation 
                $.ajax({
                    url: 'delete_user.php', // Replace with your delete script URL
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        // Handle success message or update UI as needed
                        console.log('Delete success:', response);

                        Swal.fire(
                            'Deleted!',
                            'Your account has been removed.',
                            'success'
                        ).then(() => {
                            document.getElementById('tr-'+ dara.guest_id).style.display = 'none';
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error or show error message
                        console.error('Delete error:', status, error);
                        Swal.fire(
                            'Error!',
                            'Failed to delete account.',
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
