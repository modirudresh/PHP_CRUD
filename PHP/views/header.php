<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | Admin Panel</title>
  <link rel="shortcut icon" href="../../../dist/img/AdminLTELogo.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css" />
  <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css" />
  <link rel="stylesheet" href="../../../plugins/toastr/toastr.min.css" />
  <link rel="stylesheet" href="../../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
  <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />

  <style>
    * { box-sizing: border-box; font-size: 14px; }
   body { font-family: 'Source Sans Pro', sans-serif; background-color: #f4f6f9; 
  overflow-x: hidden;
}
  
</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit"><i class="fas fa-search"></i></button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search"><i class="fas fa-times"></i></button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <?php if (isset($_SESSION['user_name'])): ?>
      <li class="nav-item dropdown">
      <a class="nav-link img-thumbnail" data-toggle="dropdown" href="#" aria-expanded="false">
        <?php
            $imgPath = !empty($_SESSION['image_path']) ? $_SESSION['image_path'] : 'uploads/profile.png';
            $fullPath = __DIR__ . '/views/Basic_crud/user/' . $imgPath;
            $imgSrc = file_exists($fullPath) ? htmlspecialchars($imgPath) : '../../../uploads/profile.png';
        ?>
        <img src="<?= $imgSrc ?>" alt="Profile" style="width:25px; height:auto; border-radius:50%;" />
        <i class="fas fa-angle-down ml-1"></i>
    </a>
        <div class="dropdown-menu dropdown-menu-right p-2" style="min-width: 220px;">
          <span class="dropdown-item-text text-sm text-muted">
            Hello, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>
          </span>
          <div class="dropdown-divider"></div>
          <a href="../change_password.php" class="dropdown-item"><i class="fas fa-key mr-2"></i> Change Password</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
        </div>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
      </li>
      <?php endif; ?>
    </ul>
  </nav>

  <?php if (!empty($_SESSION['message'])): ?>
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <script src="../../../plugins/toastr/toastr.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        toastr.options = {
          closeButton: true,
          progressBar: true,
          positionClass: "toast-top-right",
          timeOut: 2000,
        };
        toastr["<?= $_SESSION['status'] === 'success' ? 'success' : 'error' ?>"]("<?= addslashes($_SESSION['message']) ?>", "<?= ucfirst($_SESSION['status']) ?>");
      });
    </script>
    <?php unset($_SESSION['errors'], $_SESSION['status'], $_SESSION['message']); ?>
  <?php endif; ?>

  <aside class="control-sidebar control-sidebar-dark"></aside>

  <!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-right" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h6 class="modal-title" id="logoutModalLabel">Confirm Logout</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size:28px; font-weight:900;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="../../logout.php" class="btn btn-sm btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
