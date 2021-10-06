<?php 
  $pageTitle = "Tutorial";
  include("../../template/header.php");
?>

  <?php include("../../template/aside.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <?php include("../../template/nav.php") ?>
  
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row mt-5">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0 font-weight-bold text-primary text-center text-capitalize">how to set up your <span class="text-uppercase">api</span> key</h5>
                </div>
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6 mb-sm-4">
                        <img src="../../components/images/annotation.svg" class="img-fluid"> 
                      </div>
                      
                      <div class="col-md-6 align-self-center" id="tutorial-container">
                        <p>
                          (<strong>Note A: Once you set your API Key both accounts will be linked.
                          <br>
                          You only need to setup your API key ONCE when you first setup your account.
                          <br>
                          This means if you add or change any link information, categories, etc, in one app it will be automatically added to the other app and vise versa.</strong>
)
                        </p>
                        <h4 class="text-primary"> Step 1</h4>
                        <p>Go to <a href="../../myAPIKey.php" target="_blank"> Settings (click the following link...) > API Key.</a></p>
                        <h4 class="text-primary"> Step 2</h4>
                        <p>Now click <span class="text-primary text-capitalize">"generate"</span> and the system automatically will generate an API Key.                       
                        </p>
                        <p>
                        This is your New API Key.
                        With this key you can access your credentials on your wp plugin and your app.
                        (<strong>Refer Note A on "How To Set Up Your API Key" for further information.</strong>)
                        </p>
                        <p><strong>Note:</strong> In case that you already had been generated an API Key, when you click <span class="text-primary text-capitalize">"generate"</span> a box will pop up with the following content:</p>
                        <div class="swal-container mb-4" style="border:2px solid rgba(0,0,0,0.1)">
                          <div class="swal2-header"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-error" style="display: none;"></div><div class="swal2-icon swal2-question" style="display: none;"></div><div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div><div class="swal2-icon swal2-info" style="display: none;"></div><div class="swal2-icon swal2-success" style="display: none;"></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: flex;">Are you sure?</h2><button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×</button></div>
                          <div class="swal2-content"><div id="swal2-content" class="swal2-html-container" style="display: block;">if you generate another <b>API Key</b>, the current API Key <b>won't work</b></div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message"></div></div>
                          <div class="swal2-actions"><button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">Yes, delete it</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: inline-block; background-color: rgb(221, 51, 51);">Cancel</button></div>
                        </div>               
                        <p>If you want to generate another API Key, just click "Yes, delete it".
                        <br>
                        <strong>Note: If you generate another API Key, the current API Key won't work anymore.</strong>
                        </p>
                        <h4 class="text-primary"> Step 3</h4>
                        <p>Now <strong>“HIGHLIGHT”</strong> and <strong>“COPY”</strong> the <span class="text-primary text-uppercase">API key</span> you have just generated, then go to your WORDPRESS (WP site) and login to it.
                        It will look something like this … <span class="text-primary">https://YOURWEBSITEADDRESS.com/wp-admin/wp-login.php</span></p>
                        <h4 class="text-primary"> Step 4</h4>
                        <p>Once you are logged into your Wordpress (WP) site look under left hand side for the <span class="text-primary">“DASHBOARD”</span>, scroll down and find <span class="text-primary">“WEB CREDENTALS”</span> and <span class="text-primary">“hover”</span> over to show <span class="text-primary">“API Key Setting” </span>, it should be the last item. CLICK <span class="text-primary">“THE API Key Sttings”</span> link.
                        <figure class="mb-2 text-center">
                          <img id="image" src="../../components/images/wc-menu.png" class="img-fluid" alt="Web Credentials Menu">
                          <caption><strong class="text-primary">Touch the image to open it</strong></caption>
                        </figure>
                         Now just <strong>“paste”</strong> the API Key you copied (looks something like this:<span class="text-primary">44VwkgMxSMCgtL9fwSy0ebKmJdJhmIlkvdX3JB6Yxh7HlxZnrySEDQejVeTw20200711</span>)Once you have entered your <strong>“NEW”</strong> API Key … CLICK <strong>“Send Credentials”</strong>.
                        </p>
                        <figure class="mb-2 text-center">
                          <img id="image2" src="../../components/images/wc-api-key.png" class="img-fluid" alt="API Key Form">
                          <caption><strong class="text-primary">Touch the image to open it</strong></caption>
                        </figure>
                        <h4 class="text-primary"> Step 5</h4>
                        <p>
                          <span class="text-primary">“WELL DONE”</span>… Now BOTH your WP Site and Web APP are automatically synched with whatever information you put into either one.
                          (<strong>Note A: Once you set your API Key both accounts will be linked.
                          You only need to setup your API key ONCE when you first setup your account.
                          This means if you add or change any link information, categories, etc, in one app it will be automatically added to the other app and vise versa.</strong>)
                        </p>
                      </div>
                    </div>
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
      <?php include("../../template/footerContainer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
    
  </div>
  <!-- End of Page Wrapper -->

<?php include("../../template/footer.php") ?>

</html>
