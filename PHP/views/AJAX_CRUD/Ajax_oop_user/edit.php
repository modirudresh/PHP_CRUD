<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

include_once("editaction.php");

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAjax) {
    $success = updateUser($_POST, $_FILES);
    header('Content-Type: application/json');
    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
    }
    exit;
}

$allHobbies = ["Reading", "Singing", "Yoga", "Dancing", "Swimming", "Writing", "Drawing", "Painting", "Blogging", "Travelling", "Cricket", "Photography", "Cooking", "Coding", "Gaming", "Cycling", "Skiing"];
$selectedHobbies = array_map('trim', explode(',', $user['hobby'] ?? ''));
$selectedHobbiesMap = array_map('strtolower', $selectedHobbies);

if (!$isAjax) {
    include_once("../../header.php");
    include_once("../../sidebar.php");
}
?>

<?php if (!$isAjax): ?>
<div class="container-fluid">
<?php endif; ?>

<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <form id="userForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($user['image_path'] ?? '') ?>">

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone_no" maxlength="10" value="<?= !empty($user['phone_no']) ? htmlspecialchars($user['phone_no']) : '' ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="form-text text-muted d-block"><b>Current Image:</b></label>
                            <img src="<?= !empty($user['image_path']) && file_exists(__DIR__ . '/../../../' . $user['image_path']) ? '../../../' . htmlspecialchars($user['image_path']) : '../../../uploads/default.png' ?>" class="img-thumbnail mt-1 shadow" style="height: 80px; width: auto;">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Profile Image <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image_path" id="imageInput" accept="image/*">
                                <label class="custom-file-label" for="imageInput">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="text-muted d-block">Preview :</label>
                            <div class="d-flex flex-column align-items-center">
                                <img id="imagePreview" src="../../../uploads/preview.png" class="img-thumbnail shadow mb-1" style="max-width: 100px; max-height: 80px;">
                                <span id="imageName" class="text-muted small" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="DOB">Date of Birth <span class="text-danger">*</span></label>
                            <div class="input-group date" id="dobPicker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#dobPicker" name="DOB" value="<?= htmlspecialchars($user['DOB'] ?? '') ?>" placeholder="YYYY-MM-DD" autocomplete="off" />
                                <div class="input-group-append" data-target="#dobPicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Gender <span class="text-danger">*</span></label>
                            <div class="bg-light border rounded p-2">
                            <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender_<?= strtolower($g) ?>" value="<?= $g ?>" <?= (isset($user['gender']) && $user['gender'] === $g) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="gender_<?= strtolower($g) ?>"><?= $g ?></label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Hobbies <span class="text-danger">*</span></label>
                            <div class="bg-light border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php foreach ($allHobbies as $index => $h): ?>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="hobby[]" id="hobby_<?= $index ?>" value="<?= $h ?>" <?= in_array(strtolower($h), $selectedHobbiesMap) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="hobby_<?= $index ?>"><?= $h ?></label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                        </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address"><?= !empty($user['address']) ? htmlspecialchars($user['address']) : '' ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="country">
                                <option value="">Select</option>
                                <option value="india" <?= (isset($user['country']) && strtolower($user['country']) === 'india') ? 'selected' : '' ?>>India</option>
                                <option value="UK" <?= (isset($user['country']) && strtolower($user['country']) === 'uk') ? 'selected' : '' ?>>UK</option>
                                <option value="usa" <?= (isset($user['country']) && strtolower($user['country']) === 'usa') ? 'selected' : '' ?>>USA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning float-right">Update User</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php if (!$isAjax): ?>
</div>
<?php include_once("../../footer.php"); ?>
<?php endif; ?>
<script>
$(document).ready(function () {
    bsCustomFileInput.init();

    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        if (!$(this).valid()) return;

        var formData = new FormData(this);
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    toastr.success(res.message);
                    $('#editUserModal').modal('hide');
                    setTimeout(() => window.location.reload(), 0.1);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function () {
                toastr.error('Something went wrong.');
            },
            complete: function () {
                submitBtn.prop('disabled', false).text('Update User');
            }
        });
    });

    $('#imageInput').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
                $('#imageName').text(file.name).show();
            };
            reader.readAsDataURL(file);
            $(this).next('.custom-file-label').text(file.name);
        }
    });
});
</script>

