<?php 
  $pageTitle = "Profile";
  include("template/header.php");
?>

  <?php include("template/aside.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <?php include("template/nav.php") ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row mt-5">
            <!-- Content Column -->
            <div class="col-lg-10 offset-lg-1 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">Your Profile</h5>
                </div>
                <div class="card-body table-responsive">
                  <div>
 										<form method="POST" id="profileForm" enctype="multipart/form-data">
                      <div class="form-group row">
                        <div class="col-6">
                          <label for="username">First Name</label>
                          <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo $_SESSION['firstName'] ?>" placeholder=" e.g: John" required>
                        </div>
                        <div class="col-6">
                          <label for="username">Last Name</label>
                          <input type="text" name="lastName" id="lastName" class="form-control" value="<?php echo $_SESSION['lastName'] ?>" placeholder=" e.g: Doe" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $_SESSION['email'] ?>" placeholder="e.g: john.doe@test.com" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="insert your password">
                      </div>
                      <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm your password">
                      </div>
                      <button type="submit" id="updateButton" class="btn btn-primary btn-block">Update</button>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("template/footerContainer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
    
  </div>
  <!-- End of Page Wrapper -->

<?php include("template/footer.php") ?>

</html>
