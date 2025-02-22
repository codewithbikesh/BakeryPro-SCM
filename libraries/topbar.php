

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="#" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">SCM Application for Bakery Products</span>
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-400 small"><j style="color:black;"><?php echo $_SESSION['FIRST_NAME']. ' '.$_SESSION['LAST_NAME'] ;?></j></span>
                <img class="img-profile rounded-circle" src="../<?php print $_SESSION['my_photo_path'].'?rand='.rand(1,2000); ?>">
              </a>

              <?php 
		                $user_id = $_SESSION['MEMBER_ID'];
		                $type_id = $_SESSION['TYPE'];
              ?>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <button class="dropdown-item" onclick="on()" style="color:black;">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-dark-600"></i>
                  Profile
                </button>

                <a class="dropdown-item" href="settings.php?action=edit & id='<?php echo $user_id; ?>'" style="color:black;">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-dark-600"></i>
                  Settings
                </a>

                <a class="dropdown-item" href="change_password.php?action=edit & id='<?php echo $user_id; ?>'" style="color:black;">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-dark-600"></i>
                  Change Password
                </a>

                <?php if ($type_id == '1'){ ?>
                <a class="dropdown-item" href="data_privacy.php" style="color:black;">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-dark-600"></i>
                  Data Privacy
                </a>
                <?php } ?>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="color:black;">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-dark-600"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
          
        <!-- Begin Page Content -->
        <div class="container-fluid">