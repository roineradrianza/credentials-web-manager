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

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="view/components/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 mt-5 pt-lg-5 pt-md-3 pt-sm-3 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5 mt-4">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form method="POST" id="formContainer" class="user">
                    <div class="form-group">
                      <input type="text" type="username" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter Username or Email Address..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                    </div>

                    <div class="text-center mb-4">
                      <a class="small" href="#" id="resetButton">Forgot your password? Recover it!</a>
                    </div>
                    <button type="submit" id="submitButton" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <!--
                    <div class="text-center">
                      <a class="small" href="register.php">Don't have an account yet? Create one!</a>
                    </div>
                    -->
                  </form>
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
  <script src="login.js"></script>


</body>

</html>
<?php } ?>