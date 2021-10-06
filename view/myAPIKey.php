<?php 
  $pageTitle = "API Key";
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
            <div class="col-lg-10 mt-5 offset-lg-1 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mt-5 mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center">API Key</h5>
                </div>
                <div class="card-body table-responsive">
                  <div>
                  	<form method="POST" id="apiKeyForm">
											<div class="input-group mb-3">
												<?php if (isset($_SESSION['apiKey'])): ?>
												<input type="text" id="apiKeyField" name="apiKeyField" class="form-control" placeholder="Your API Key..." aria-label="Your API key" value="<?php echo $_SESSION['apiKey'] ?>" aria-describedby="button-addon2" readonly>	
												<?php else: ?>
											  <input type="text" id="apiKeyField" class="form-control" placeholder="Your API Key..." aria-label="Your API key" value="" aria-describedby="button-addon2" readonly>	
												<?php endif ?>
											  <div class="input-group-append">
											    <button class="btn btn-primary" type="submit" id="button-addon2">Generate</button>
											  </div>
											</div>
											<small class="form-text text-muted text-center">
											  This is your API Key, with this key you can access to your credentials using our wp plugin.
											</small>
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
