<?php
use App\Models\User;

if (!isLoggedIn()) {
  $_SESSION['isLoggedIn'] = false;
  redirect(getPath($routes, 'homepage'));
}
if (isLoggedIn()) {
  $user = new User();
  $user = unserialize($_SESSION['user']);
  if ($user->getUserGroup() == 'CUSTOMER') {
    redirect(getPath($routes, 'homepage'));
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>2LKSHOP</title>
  <link href="/2LKShop/public/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
  <link href="/2LKShop/public/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
  <link href="/2LKShop/public/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <link href="/2LKShop/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="/2LKShop/public/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link href="/2LKShop/public/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
  <link href="/2LKShop/public/css/admin.css" rel="stylesheet" type="text/css" />
  <script src="/2LKShop/public/js/jquery.min.js"></script>
  <script src="/2LKShop/public/js/simple-notify.min.js"></script>
  <script src="/2LKShop/public/js/sweetalert2.all.min.js"></script>
</head>

<body>

  <div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">
      <!-- LOGO -->
      <a href="/2LKShop" class="logo text-center logo-light">
        <span class="logo-lg">
          <img src="/2LKShop/public/images/SVG/Logo.svg" alt="" height="30" />
        </span>
        <span class="logo-sm">
          <img src="/2LKShop/public/images/SVG/logo-sm.svg" alt="" height="30" />
        </span>
      </a>

      <!-- LOGO -->
      <a href="adminHome.html" class="logo text-center logo-dark">
        <span class="logo-lg">
          <img src="/2LKShop/public/images/SVG/Logo.svg" alt="" height="30" />
        </span>
        <span class="logo-sm">
          <img src="/2LKShop/public/images/SVG/logo-sm.svg" alt="" height="30" />
        </span>
      </a>

      <div class="h-100" id="leftside-menu-container" data-simplebar="">
        <!--- Sidemenu -->
        <ul class="side-nav">
          <li class="side-nav-item">
            <a href="/2LKShop/admin" class="side-nav-link">
              <i class="uil-home-alt"></i>
              <span> Dashboards </span>
            </a>
          </li>
          <hr>
          <?php
          if (isLoggedIn() && in_array('P_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="/2LKShop/admin/product" class="side-nav-link">
                        <i class="uil-briefcase"></i>
                        <span> Product </span>
                      </a>
                    </li>
          <?php endif ?>
          <?php
          if (isLoggedIn() && in_array('Br_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminBrands') ?>" class="side-nav-link">
                        <i class="uil-tag-alt"></i>
                        <span> Brands </span>
                      </a>
                    </li> 
          <?php endif ?>
          <?php
          if (isLoggedIn() && in_array('Ca_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminCategory') ?>" class="side-nav-link">
                        <i class="uil-archive-alt"></i>
                        <span> Categories </span>
                      </a>
                    </li>
          <?php endif ?>

          <hr>
          <?php
          if (isLoggedIn() && in_array('Or_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="/2LKShop/admin/orders" class="side-nav-link">
                        <i class="uil-file-check-alt"></i>
                        <span> Orders </span>
                      </a>
                    </li>
          <?php endif ?>

          <hr>
          <?php
          if (isLoggedIn() && in_array('U_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminUsers') ?>" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> Users </span>
                      </a>
                    </li>
          <?php endif ?>
          <?php
          if (isLoggedIn() && in_array('R_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminRoles') ?>" class="side-nav-link">
                        <i class="uil-sign-left"></i>
                        <span> Roles </span>
                      </a>
                    </li>
          <?php endif ?>
          <?php
          if (isLoggedIn() && in_array('Per_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminPermissions') ?>" class="side-nav-link">
                        <i class="uil-layers"></i>
                        <span> Permissions </span>
                      </a>
                    </li>
          <?php endif ?>
          <?php
          if (isLoggedIn() && in_array('PerGr_View', $user->getPermissions())):
            ?>
                    <li class="side-nav-item">
                      <a href="<?php echo getPath($routes, 'adminPermissionGroups') ?>" class="side-nav-link">
                        <i class="uil-layer-group"></i>
                        <span> Permission Groups </span>
                      </a>
                    </li>
          <?php endif ?>

        </ul>

        <!-- Help Box -->

        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>
      </div>
      <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="content">
        <!-- Topbar Start -->
        <div class="navbar-custom">
          <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list d-lg-none">
              <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                  <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" />
                </form>
              </div>
            </li>
            <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                  <img src="/2LKShop/public/images/productImg/Image.png" alt="user-image" class="rounded-circle" />
                </span>
                <span>
                  <span class="account-user-name"><?php echo $user->getUsername() ?></span>
                  <span class="account-position"><?php echo $user->getUserGroup() ?></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="/2LKShop/logout" class="dropdown-item notify-item">
                  <i class="mdi mdi-logout me-1"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
          <button class="button-menu-mobile open-left">
            <i class="mdi mdi-menu"></i>
          </button>
        </div>
        <!-- end Topbar -->

        <!-- Start Content-->
        <div class="container-fluid">
          <?php require ("$name.view.php") ?>
        </div>
        <!-- container -->
      </div>
      <!-- content -->

      <!-- Footer Start -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <script>
                document.write(new Date().getFullYear());
              </script>
              © Techshop
            </div>
            <div class="col-md-6">
              <div class="text-md-end footer-links d-none d-md-block">
                <a href="javascript: void(0);">About</a>
                <a href="javascript: void(0);">Support</a>
                <a href="javascript: void(0);">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- end Footer -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
  </div>
  <script src="/2LKShop/public/js/vendor.min.js"></script>
  <script src="/2LKShop/public/js/app.min.js"></script>

  <!-- third party js -->
  <script src="/2LKShop/public/js/vendor/apexcharts.min.js"></script>
  <script src="/2LKShop/public/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="/2LKShop/public/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
  <script src="/2LKShop/public/js/vendor/jquery.dataTables.min.js"></script>
  <script src="/2LKShop/public/js/vendor/dataTables.bootstrap5.js"></script>
  <script src="/2LKShop/public/js/vendor/dataTables.responsive.min.js"></script>
  <script src="/2LKShop/public/js/vendor/responsive.bootstrap5.min.js"></script>
  <script src="/2LKShop/public/js/vendor/dataTables.checkboxes.min.js"></script>
  <!-- third party js ends -->

  <!-- demo app -->
  <script src="/2LKShop/public/js/pages/demo.dashboard.js"></script>
</body>

</html>