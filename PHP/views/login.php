<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | Admin Panel</title>
  <link rel="shortcut icon" href="../dist/img/AdminLTELogo.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

  <style>
    * { box-sizing: border-box; font-size: 14px; }
    body {
      font-family: 'Source Sans Pro', sans-serif;
      background-color: #f4f6f9;
      overflow-x: hidden;
    }
  </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><b class="h4">Admin</b>LTE</h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="userForm" action="loginAction.php" method="post" novalidate>
        <div class="input-group mb-1">
          <input type="email"
                 class="form-control <?= isset($_SESSION['login_error']) ? 'is-invalid' : '' ?>"
                 id="email"
                 name="email"
                 placeholder="Enter email address"
                 autocomplete="off"
                 autocapitalize="off"
                 spellcheck="false">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>

        <div class="input-group mb-1">
          <input type="password"
                 class="form-control password <?= isset($_SESSION['login_error']) ? 'is-invalid' : '' ?>"
                 id="password"
                 name="password"
                 placeholder="Enter password"
                 autocomplete="new-password"
                 autocapitalize="off"
                 spellcheck="false">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fa fa-eye toggle icon" style="cursor: pointer;"></span></div>
          </div>
        </div>

        <?php if (isset($_SESSION['login_error'])): ?>
          <div class="invalid-feedback d-block mb-2">Invalid email or password.</div>
          <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>

        <div class="row mb-3 mt-2">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember Me</label>
            </div> -->
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <div class="text-right">
        <p><b><a href="forgot-password.php">Forgot password?</a></b></p>
        <p class="text-center mb-0">Don't have an account? <a href="register.php">Create account</a></p>
      </div>
    </div>
  </div>
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>

<script>
$(function () {
  $.validator.addMethod('pattern', function (value, element, param) {
    return this.optional(element) || param.test(value);
  }, 'Invalid format.');

  $('#userForm').validate({
    rules: {
      email: { required: true, email: true },
      password: {
        required: true,
        minlength: 8,
        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/
      }
    },
    messages: {
      email: {
        required: "Email is required",
        email: "Invalid email/password."
      },
      password: {
        required: "Password is required",
        minlength: "Minimum 8 characters",
        pattern: "Invalid email/password."
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    highlight: function (element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid').addClass('is-valid');
    }
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.querySelector(".toggle");
  const input = document.querySelector(".password");
  toggle.classList.add("fa-eye-slash");
  toggle.addEventListener("click", () => {
    if (input.type === "password") {
      input.type = "text";
      toggle.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      input.type = "password";
      toggle.classList.replace("fa-eye", "fa-eye-slash");
    }
  });

  <?php if (isset($_SESSION['message'])): ?>
    toastr.options = {
      closeButton: true,
      progressBar: true
    };
    toastr["<?= $_SESSION['status'] ?>"]("<?= addslashes($_SESSION['message']) ?>");
    <?php unset($_SESSION['message'], $_SESSION['status']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['logout_message'])): ?>
    toastr.options = {
      closeButton: true,
      progressBar: true
    };
    toastr.info("<?= addslashes($_SESSION['logout_message']) ?>");
    <?php unset($_SESSION['logout_message']); ?>
  <?php endif; ?>
});
</script>

</body>
</html>
