<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once("../../../Config/config.php");

$sql = "SELECT * FROM User_data ORDER BY id DESC";
$result = mysqli_query($con, $sql);


if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}
 include('../../header.php');
 include('../../sidebar.php'); 
?>

<!-- <div class="container-fluid"> -->
  <div class="row mb-2">
    <div class="col-sm-6"><h1 class="m-0">User List</h1></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">User List</li>
      </ol>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <a href="create.php" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> Add User
          </a>
        </div>
      </div>
      <div class="card-body">
   
      <table id="example1" class="table table-bordered table-striped">
      
      <thead class="text-center">
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Image</th>
              <th>DOB</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Hobbies</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
              <?php while ($res = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= htmlspecialchars($res['id'] ?? 'N/A') ?></td>
                  <td>
                    <?= (!empty($res['first_name']) || !empty($res['last_name']))
                        ? htmlspecialchars(trim($res['first_name'] . ' ' . $res['last_name']))
                        : 'N/A' ?>
                  </td>
                  <td><?= !empty($res['email']) ? htmlspecialchars($res['email']) : 'N/A' ?></td>
                  <td>
                    <?php if (!empty($res['image_path']) && file_exists(__DIR__ . '/../user/' . $res['image_path'])): ?>
                      <img src="../user/<?= htmlspecialchars($res['image_path']) ?>" alt="Profile" style="width:60px; height:auto; border:1px solid gray; border-radius:12px;">
                    <?php else: ?>
                      <img src="../../../uploads/default.png" alt="Default Profile" style="width:60px; height:auto; object-fit:contain; border:1px solid gray; border-radius:12px;">
                    <?php endif; ?>
                  </td>

                  <td style="min-width: max-content;"><?= !empty($res['DOB']) ? date('d-m-Y', strtotime($res['DOB'])) : 'N/A' ?></td>
                  <td class="text-center">
                    <?php
                      if (!empty($res['phone_no'])) {
                        $phone = preg_replace('/\D/', '', $res['phone_no']);
                        echo "<a href='tel:+91$phone'>" . substr($phone, 0, 5) . ' ' . substr($phone, 5) . "</a>";
                      } else {
                        echo 'N/A';
                      }
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                      $gender = ($res['gender'] ?? '');
                      echo match($gender) {
                        'male'   => "<span class='badge badge-primary'>Male</span>",
                        'female' => "<span class='badge' style='background-color:pink;'>Female</span>",
                        'other'  => "<span class='badge badge-secondary'>Other</span>",
                        default  => "<span>N/A</span>"
                      };
                    ?>
                  </td>
                  <td>
                    <?php
                      if (!empty($res['hobby'])) {
                        foreach (explode(',', $res['hobby']) as $hobby) {
                          echo "<span class='badge badge-info w-100'>" . htmlspecialchars(trim($hobby)) . "</span><br>";
                        }
                      } else {
                        echo 'N/A';
                      }
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="view.php?id=<?= urlencode($res['id']) ?>" class="btn btn-info p-1" title="View User" aria-label="View User">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="edit.php?id=<?= urlencode($res['id']) ?>" class="btn btn-warning p-1" title="Edit User" aria-label="Edit User">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger p-1" title="Delete User" aria-label="Delete User" data-bs-toggle="modal" data-bs-target="#deleteModal<?= htmlspecialchars($res['id']) ?>">
                      <i class="fa fa-trash"></i>
                    </a>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal<?= $res['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $res['id'] ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel<?= $res['id'] ?>">Confirm Delete</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this record?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="delete.php?id=<?= htmlspecialchars($res['id']) ?>" class="btn btn-danger">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="10" class="text-center">No records found.</td></tr>
            <?php endif; ?>
          </tbody>
       

      </table>

      
       
        </div>
    </div>
    </div>



</div>

<!-- DataTables  & Plugins -->
<script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../plugins/jszip/jszip.min.js"></script>
<script src="../../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- jQuery -->
<script src="../../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="../../../plugins/jquery-ui/jquery-ui.min.js"></script>
<script>$.widget.bridge('uibutton', $.ui.button);</script>
<!-- Toastr -->
<script src="../../../plugins/toastr/toastr.min.js"></script>


<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", 
            {
                text: 'Reset',
                action: function () {
                    location.reload();
                }
            }
          ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function openDeleteModal(id) {
        var modal = new bootstrap.Modal(document.getElementById('deleteModal' + id));
        modal.show();
      }
    </script>
<?php include('../../footer.php'); ?>
