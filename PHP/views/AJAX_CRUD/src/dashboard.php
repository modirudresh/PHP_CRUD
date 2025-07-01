<?php

include("../Ajax_oop_user/indexaction.php");
include("../Ajax_oop_student/indexaction.php");
include("../../OOP_CRUD_LTE/OOP_crud_student/indexaction.php");
include("../../OOP_CRUD_LTE/OOP_CRUD_user/indexaction.php");
include_once("../../header.php");
include_once("../../sidebar.php");
?>


<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php
            if (isset($_SESSION['user_name'])) {
           ?>
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
          <h3><?= isset($totalUsers) && is_numeric($totalUsers) ? htmlspecialchars($totalUsers) : 'N/A' ?></h3>
          <p> <small>            crud using ajax          </small> Users</p>          
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="../Ajax_oop_user/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
 
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
          <h3><?= isset($totalStudents) && is_numeric($totalStudents) ? htmlspecialchars($totalStudents) : 'N/A' ?></h3>
          <p> <small>            crud using ajax          </small> Students</p>          
          </div>
          <div class="icon">
          <i class="ion ion-university"></i>
          </div>
          <a href="../Ajax_oop_student/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
          <h3>
            <?= isset($Usercount) && is_numeric($Usercount) ? htmlspecialchars($Usercount) : 'N/A' ?>
        </h3>
        <p> <small>            crud without ajax          </small> Users</p>          
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="../../OOP_CRUD_LTE/OOP_CRUD_user/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
          <h3>
            <?= htmlspecialchars($Studentcount) ?>
        </h3>
        <p> <small>            crud without ajax          </small> Students</p>          
        </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="../Ajax_oop_user/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <?php
            } else {
              echo "<div class='alert alert-warning' style='min-height: 100px; margin-top:10px;'>Please log in to view the user list.<br><a href='../../login.php' class='btn btn-primary' style='text-decoration:none;'>Login</a></div>";
            }
?>
    </div>
</section>
</div>
</div>
<?php include_once("../../footer.php");