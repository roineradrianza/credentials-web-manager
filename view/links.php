<?php 
  $pageTitle = "Links";
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
            <div class="col-lg-12 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">Links</h5>
                  <button type="button" class="btn btn-primary mb-4 d-sm-block" data-toggle="modal" data-target="#insertModal">
                  <span class="fas fa-plus d-md-none d-lg-none d-sm-inline-block" onclick="insertForm();"></span> <span class="d-none d-md-inline-block" onclick="insertForm();">New Link</span>
                </button>
                </div>
                <!-- Button trigger modal -->

                <!-- Link Insert/Edit Modal -->
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="linkFormModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">New Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form method="POST" id="insertForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                              <label for="pageName">Page Name</label>
                              <input type="text" name="pageName" id="pageName" class="form-control" placeholder=" e.g: Gmail" required>
                            </div>
                            <div class="form-group">
                              <label for="url">Page URL</label>
                              <input type="url" name="link" id="link" class="form-control" placeholder=" e.g: https://gmail.com/" required>
                            </div>
                            <div class="form-group">
                              <label for="username">login</label>
                              <input type="text" name="username" id="username" class="form-control" placeholder=" e.g: username" required>
                            </div>
                            <div class="form-group">
                              <label for="password">password</label>
                              <input type="text" name="password" id="password" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label>Category</label>
                              <select id="categoryID" name="categoryID" class="form-control selectpicker" data-live-search="true" required></select>
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
                <div class="card-body table-responsive">
                  <div>
                    <table class="table table-bordered" id="linkTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Page</th>
                          <th>Login</th>
                          <th>Password</th>
                          <th>Category</th>
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

</html>
