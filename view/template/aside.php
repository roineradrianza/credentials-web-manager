    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
          <i class="fas fa-table"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Panel</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $pageTitle == "Tutorial" ? "../../" : './'; ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <?php if ($_SESSION['type'] == 'admin'): ?>
        
      <li class="nav-item <?php echo $pageTitle == "Users" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>users.php">
          <i class="fas fa-user"></i>
          <span>Users</span></a>
      </li>
        
      <?php endif ?>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item <?php echo $pageTitle == "Links" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>links.php">
          <i class="fas fa-link"></i>
          <span>Links</span></a>
      </li>
      <li class="nav-item <?php echo $pageTitle == "Categories" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>categories.php">
          <i class="fas fa-grip-horizontal"></i>
          <span>Categories</span></a>
      </li>      
      <li class="nav-item <?php echo $pageTitle == "Settings" ? "active":""; echo $pageTitle == "API Key" ? "active":""; echo $pageTitle == "Profile" ? "active":"" ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#collapseSettings" aria-controls="collapseSettings">
          <i class="fas fa-cog"></i>
          <span>Settings</span></a>
        <div id="collapseSettings" class="collapse" aria-labelledby="heading">
          <div class="bg-white py-2 collapse-inner rounded">
            <a href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>profile.php" class="collapse-item">My Profile</a>
            <a href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>myAPIKey.php" class="collapse-item">API Key</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?php echo $pageTitle == "Tutorial" ? "active" : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" aria-expanded="false" data-target="#collapseTutorial" aria-controls="collapseSettings">
          <i class="fas fa-file-alt"></i>
          <span>Tutorial</span></a>
        <div id="collapseTutorial" class="collapse" aria-labelledby="heading">
          <div class="bg-white py-2 collapse-inner rounded">
            <a href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>tutorial/set-up-api-key/" class="collapse-item">Set up API Key</a>
            <a href="<?php echo $pageTitle == "Tutorial" ? "../../" : ''; ?>tutorial/link-account/" class="collapse-item">Where do I put and see my information on my wordpress site</a>
          </div>
        </div>
      </li>


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->