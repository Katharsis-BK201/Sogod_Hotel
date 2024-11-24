<?php

        session_start();

        $log = $_SESSION['login'] ?? false; // Null coalescing operator


    if(!$log)
    {
        header("Location: /hotel/index.php");
    }
    
    include 'header.php';
    include 'menu.php';
    include('C:\xampp\htdocs\hotel\db\connection.php');

    
    

?>

<style>

    .font-size{
      font-size: 30px;
    }
</style>

<div class="container-fluid">
    <div class="alert alert-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <div class="row mt-3">
    <!-- Row 1
    <div class="col-md-4">
        <div class="p-5 mb-3 bg-success text-white font-size d-flex flex-column border border-danger">
            <div class="d-flex justify-content-between">
                <span>Verifications</span>
                <span><i class="fas fa-exclamation-triangle"></i></span>
            </div>
            <div class="d-flex justify-content-between">
                <span class = "text-danger"></span>
                <a href="verification.php"><button class="btn btn-light text-primary mt-auto" style="width: 100%;">View More</button></a>
            </div>
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-5 mb-3 bg-danger text-white font-size d-flex flex-column border border-primary">
            <div class="d-flex justify-content-between">
              <span>Instructors</span>
              <span><i class="fas fa-users"></i></span>
            </div>
            <div class="d-flex justify-content-between">
                <span class = "text-primary"></span>
                <a href="instructors_list.php"><button class="btn btn-light text-primary mt-auto" style="width: 100%;">View More</button></a>
            </div>
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-5 mb-3 bg-secondary text-white font-size d-flex flex-column border border-warning">
            <div class="d-flex justify-content-between">
              <span>Users</span>
              <span><i class="fas fa-user"></i></span>
            </div>
            <div class="d-flex justify-content-between">
                <span class = "text-warning"></span>
                <a href="users_list.php"><button class="btn btn-light text-primary mt-auto" style="width: 100%;">View More</button></a>
            </div>
            
        </div>
    </div> -->
    
</div>



        <!-- do not touch this line -->
    </div> 
</div>
<!-- do not delete this code -->


</body>
</html>



<script src="js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 


