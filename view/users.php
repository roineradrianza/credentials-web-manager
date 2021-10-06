<?php 
  $pageTitle = "Users";
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
          <div class="row">
            <!-- Content Column -->
            <div class="col-lg-10 offset-lg-1 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">Users</h5>
                </div>
                <div class="card-body table-responsive">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#userFormModal">
                    <span class="fas fa-plus d-md-none d-lg-none d-sm-inline-block"></span> <span class="d-none d-lg-inline-block">New User</span>
                  </button>

                  <!-- User Insert Modal -->
                  <div class="modal fade" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">New User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="userForm" enctype="multipart/form-data">
                              <div class="form-group row">
                                <div class="col-6">
                                  <label for="username">First Name</label>
                                  <input type="text" name="firstName" id="firstName" class="form-control" placeholder=" e.g: John" required>
                                </div>
                                <div class="col-6">
                                  <label for="username">Last Name</label>
                                  <input type="text" name="lastName" id="lastName" class="form-control" placeholder=" e.g: Doe" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="e.g: john.doe@test.com" required>
                              </div>
                              <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="type">
                                  <option value="member">Member</option>
                                  <option value="admin">Admin</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="insert your password" required>
                              </div>
                              <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm your password">
                              </div>          
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitButton">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- User Edit Modal -->
                  <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Edit User</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="userFormEdit" enctype="multipart/form-data">
                              <input type="hidden" name="userID" id="userID">
                              <input type="hidden" name="emailCompare" id="emailCompare">
                              <div class="form-group row">
                                <div class="col-6">
                                  <label for="username">First Name</label>
                                  <input type="text" name="firstName" id="firstNameEdit" class="form-control" placeholder=" e.g: John" required>
                                </div>
                                <div class="col-6">
                                  <label for="username">Last Name</label>
                                  <input type="text" name="lastName" id="lastNameEdit" class="form-control" placeholder=" e.g: Doe" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="emailEdit" class="form-control" placeholder="e.g: john.doe@test.com" required>
                              </div>
                              <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="typeEdit">
                                  <option value="member">Member</option>
                                  <option value="admin">Admin</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="passwordEdit" class="form-control" placeholder="insert your password">
                              </div>
                              <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPasswordEdit" class="form-control" placeholder="Confirm your password">
                              </div>          
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="editButton">Save changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div>
                    <table class="table table-bordered dt-body-nowrap" id="usersTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Full name</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Last connection</th>
                          <th class="text-center">Options</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-lg-10 offset-lg-1 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">Users Currently Signed</h5>
                </div>
                <div class="card-body table-responsive">
                  <div>
                    <table class="table table-bordered dt-body-nowrap" id="usersCurrentlySignedTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Full name</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th class="text-center">Options</th>
                        </tr>
                      </thead>
                    </table>
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