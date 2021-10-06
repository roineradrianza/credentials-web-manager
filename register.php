<?php 
session_start();
if (isset($_SESSION['userID'])) {
  header("Location: view/");
}
else{
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="theme-color" content="#4e73df" />

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="view/components/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container pt-5">

    <div class="justify-content-center pt-5">
      <div class="card o-hidden mt-5 border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form class="user" id="registerForm">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" name="firstName" class="form-control form-control-user" id="firstName" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="lastName" class="form-control form-control-user" id="lastName" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email Address">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="confirm_password" class="form-control form-control-user" id="confirm_password" placeholder="Repeat Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Create Account
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="login.php">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <!-- Core plugin JavaScript-->
  <script src="view/components/js/jquery.easing.min.js"></script>  

  <!-- Custom scripts for all pages-->
  <script src="view/components/js/sb-admin-2.min.js"></script>
  <script src="register.js"></script>

</body>

</html>
<?php } ?>