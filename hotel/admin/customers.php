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

$sql = $conn->prepare("SELECT * FROM Guest");
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
            <li class="breadcrumb-item active" aria-current="page"><a href="dashboard.php">Back to Dashboard</a> / Customers</li>
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
    </head>

    <body>
        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be populated by DataTable -->
            </tbody>
        </table>
    </body>
    </html>

<script>
// Pass PHP array to JavaScript as JSON
var dataSet = <?php echo json_encode($data); ?>;

$(document).ready(function() {
    $('#userTable').DataTable();
});

function editUser(id) {
    // Implement your edit action logic here
    alert("Edit user with ID: " + id);
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
                            document.getElementById('tr-'+ id).style.display = 'none';
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
