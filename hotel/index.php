<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- MDBootstrap and Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .gradient-custom-2 {
      background: #fccb90;
      background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
      background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    }

    @media (min-width: 768px) {
      .gradient-form {
        height: 100vh !important;
      }
    }

    @media (min-width: 769px) {
      .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
      }
    }
  </style>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <?php
                    if (isset($_GET['invalid-credentials'])) {
                        if (!empty($_SESSION['success'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" style="font-size:20px; background-color: #f8d7db; color: blue; border: 1px solid #f5c6cb; border-radius: 5px; padding: 10px; width: 41%;">' . $_SESSION['success'];
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 20px; line-height: 1;">';
                            echo '<span aria-hidden="true">&times;</span>';
                            echo '</button></div>';
                            $_SESSION['success'] = "";
                        }
                    }

                    if (isset($_GET['invalid-login'])) {
                      if (!empty($_SESSION['success'])) {
                          echo '<div class="alert alert-warning alert-dismissible fade show" style="font-size:20px; background-color: #f8d7db; color: red; border: 1px solid #f5c6cb; border-radius: 5px; padding: 10px; width: 41%;">' . $_SESSION['success'];
                          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 20px; line-height: 1;">';
                          echo '<span aria-hidden="true">&times;</span>';
                          echo '</button></div>';
                          $_SESSION['success'] = "";
                      }
                  }
                ?>

                  <div class="text-center">
                    <h4 class="mt-1 mb-5 pb-1">Welcome to Paeng Hotel Reservation</h4>
                  </div>

                  <form method="post" action="loginpro.php">
                    <p>Please login to your account</p>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" id="form2Example11" class="form-control" name="username"
                        placeholder="Phone number or email address" />
                      <label class="form-label" for="form2Example11">Username</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example22" class="form-control" />
                      <label class="form-label" for="form2Example22">Password</label>
                      <br>
                      <input type="checkbox" id="showPassword" onclick="togglePassword()"> Show Password
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">
                        Log in</button>
                    </div>
                  </form>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="registration.php" class="btn btn-outline-danger">Create new</a>
                  </div>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center" style="background-image: url('images/paeng2.png'); background-size: cover; background-position: center;">
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    // Toggle password visibility
    function togglePassword() {
      var passwordField = document.getElementById('form2Example22');
      var showPassword = document.getElementById('showPassword');
      if (showPassword.checked) {
        passwordField.type = 'text'; // Show password
      } else {
        passwordField.type = 'password'; // Hide password
      }
    }
  </script>

</body>

</html>
