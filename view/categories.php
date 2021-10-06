<?php 
  $pageTitle = "Categories";
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
                  <h5 class="m-0 font-weight-bold text-primary text-center">Categories</h5>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#insertModal" onclick="insertForm();">
                    <span class="fas fa-plus d-md-none d-lg-none d-sm-inline-block"></span> <span class="d-none d-md-inline-block">New Categories</span>
                  </button>

                  <!-- Category Insert/Edit Modal -->
                  <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="categoryFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">New Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="insertForm" enctype="multipart/form-data">
                              <input type="hidden" name="id" id="id" value="">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder=" e.g: Tech" required>
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description"></textarea>
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
                </div>
                <div class="card-body table-responsive">
                  <div>
                    <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
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
