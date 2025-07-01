<?php
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$currentFile = basename($_SERVER['PHP_SELF']);
$currentPath = $_SERVER['SCRIPT_NAME'];
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="../../AJAX_CRUD/src/dashboard.php" class="brand-link">
    <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <div class="sidebar">
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="user-panel mt-3 mb-3 d-flex">
      <div class="image">
          <?php 
              $imagePath = !empty($response['image_path']) ? $response['image_path'] : '../../../uploads/profile.png';
              $fullPath = __DIR__ . '../../Basic_crud/user/' . $imagePath;
              $imgSrc = file_exists($fullPath) 
                  ? htmlspecialchars($imagePath) 
                  : '../../../uploads/profile.png';
          ?>
          <img src="<?= $imgSrc ?>" alt="Profile" style="width:25px; height:25px; border-radius:50%;">
      </div>
        <div class="info">
          <a href="#" class="d-block"><p>Hello, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p></a>
        </div>
      </div>
    <?php endif; ?>

    <div class="form-inline mt-3">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item">
      <a href="../../AJAX_CRUD/src/dashboard.php" class="nav-link <?= $currentFile === 'dashboard.php' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <?php if (isset($_SESSION['user_id'])): ?>
    <li class="nav-item <?= strpos($currentPath, '/Ajax_oop_student/') !== false || strpos($currentPath, '/Ajax_oop_user/') !== false ? 'menu-open' : '' ?>">
      <a href="#" class="nav-link <?= strpos($currentPath, '/Ajax_oop_student/') !== false || strpos($currentPath, '/Ajax_oop_user/') !== false ? 'active' : '' ?>">
        <i class="nav-icon fas fa-robot"></i>
        <p>Crud using Ajax<i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item <?= strpos($currentPath, '/Ajax_oop_student/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($currentPath, '/Ajax_oop_student/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Student Administration<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../AJAX_CRUD/Ajax_oop_student/index.php" class="nav-link <?= $currentFile === 'index.php' && strpos($currentPath, '/Ajax_oop_student/') !== false ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <p>Manage Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../AJAX_CRUD/Ajax_oop_student/create.php" class="nav-link <?= $currentFile === 'create.php' && strpos($currentPath, '/Ajax_oop_student/') !== false ? 'active' : '' ?>">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add New Student</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item <?= strpos($currentPath, '/Ajax_oop_user/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($currentPath, '/Ajax_oop_user/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>User Administration<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../AJAX_CRUD/Ajax_oop_user/index.php" class="nav-link <?= $currentFile === 'index.php' && strpos($currentPath, '/Ajax_oop_user/') !== false ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <p>Manage Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../AJAX_CRUD/Ajax_oop_user/create.php" class="nav-link <?= $currentFile === 'create.php' && strpos($currentPath, '/Ajax_oop_user/') !== false ? 'active' : '' ?>">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add New User</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>

    <li class="nav-item <?= strpos($currentPath, '/user/') !== false ? 'menu-open' : '' ?>">
      <a href="#" class="nav-link <?= strpos($currentPath, '/user/') !== false ? 'active' : '' ?>">
        <i class="nav-icon fas fa-database"></i>
        <p>Basic php crud<i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="../../Basic_crud/user/index.php" class="nav-link <?= $currentFile === 'index.php' && strpos($currentPath, '/Basic_crud/') !== false ? 'active' : '' ?>">
            <i class="fas fa-list nav-icon"></i>
            <p>Manage Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../Basic_crud/user/create.php" class="nav-link <?= $currentFile === 'create.php' && strpos($currentPath, '/Basic_crud/') !== false ? 'active' : '' ?>">
            <i class="fas fa-user-plus nav-icon"></i>
            <p>Add New User</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item <?= strpos($currentPath, '/OOP_CRUD_LTE/') !== false ? 'menu-open' : '' ?>">
      <a href="#" class="nav-link <?= strpos($currentPath, '/OOP_CRUD_LTE/') !== false ? 'active' : '' ?>">
        <i class="nav-icon fas fa-cogs"></i>
        <p>OOP Crud without Ajax<i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">

        <li class="nav-item <?= strpos($currentPath, '/OOP_crud_student/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($currentPath, '/OOP_crud_student/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Student Administration<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../OOP_CRUD_LTE/OOP_crud_student/index.php" class="nav-link <?= $currentFile === 'index.php' && strpos($currentPath, '/OOP_crud_student/') !== false ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <p>Manage Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../OOP_CRUD_LTE/OOP_crud_student/create.php" class="nav-link <?= $currentFile === 'create.php' && strpos($currentPath, '/OOP_crud_student/') !== false ? 'active' : '' ?>">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add New Student</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item <?= strpos($currentPath, '/OOP_CRUD_user/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($currentPath, '/OOP_CRUD_user/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>User Administration<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../../OOP_CRUD_LTE/OOP_CRUD_user/index.php" class="nav-link <?= $currentFile === 'index.php' && strpos($currentPath, '/OOP_CRUD_user/') !== false ? 'active' : '' ?>">
                <i class="fas fa-list nav-icon"></i>
                <p>Manage Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../OOP_CRUD_LTE/OOP_CRUD_user/create.php" class="nav-link <?= $currentFile === 'create.php' && strpos($currentPath, '/OOP_CRUD_user/') !== false ? 'active' : '' ?>">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Add New User</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </li>
    <?php else: ?>
      <div class="alert alert-warning" style="min-height: 100px; margin-top:10px;">
        Please log in to view the user list.<br>
        <a href='../../login.php' class='btn btn-primary' style='text-decoration:none;'>Login</a>
      </div>
    <?php endif; ?>
  </ul>
</nav>

  </div>
</aside>
<div class="content-wrapper">
  <div class="content-header">