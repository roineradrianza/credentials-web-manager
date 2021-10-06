<?php 
  $pageTitle = "Main";
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
                  <h5 class="m-0 font-weight-bold text-primary text-center">Latest  10 links</h5>
                </div>
                <div class="card-body table-responsive">
                  <div>
                    <table class="table table-bordered" id="linkTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>page name</th>
                          <th>login</th>
                          <th>password</th>
                          <th>category</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Content Column -->
            <div class="col-lg-8 offset-lg-2 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">Categories</h5>
                </div>
                <div class="card-body table-responsive">
                  <div>
                    <table class="table table-bordered" id="categoryTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>category</th>
                          <th>number of links</th>
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
