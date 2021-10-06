  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JavaScript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="components/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="components/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <!-- Core plugin JavaScript-->
  <?php if ($pageTitle == "Tutorial"): ?>

  <script src="../../components/js/jquery.easing.min.js"></script>  

  <!-- Custom scripts for all pages-->
  <script src="../../components/js/sb-admin-2.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.6.1/viewer.min.js"></script>
  <script type="text/javascript" src="../../components/js/tutorial.js"></script>
    
  <?php else: ?>
    
  <script src="components/js/jquery.easing.min.js"></script>  

  <!-- Custom scripts for all pages-->
  <script src="components/js/sb-admin-2.min.js"></script>
  
  <?php endif ?>
  <script type="text/javascript" src="components/js/updateSession.js"></script>
  <?php if ($pageTitle == "Users"): ?>
<script type="text/javascript" src="components/js/user.js"></script>
  <?php endif ?>
  <?php if ($pageTitle == "Categories"): ?>
<script type="text/javascript" src="components/js/category.js"></script>
  <?php endif ?>
  <?php if ($pageTitle == "Links"): ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script type="text/javascript" src="components/js/link.js"></script>
  <?php endif ?>
  <?php if ($pageTitle == "Main"): ?>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script type="text/javascript" src="components/js/dashboard.js"></script>
  <?php endif ?>
  <?php if ($pageTitle == "API Key"): ?>
<script type="text/javascript" src="components/js/apiKey.js"></script>
  <?php endif ?>
  <?php if ($pageTitle == "Profile"): ?>
<script type="text/javascript" src="components/js/profile.js"></script>
  <?php endif ?>

  <!-- Page level custom scripts -->

</body>

</html>