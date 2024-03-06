<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edumin - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=STATIC_ROOT; ?>/dashboard/images/favicon.png">
    <link href="<?=STATIC_ROOT; ?>/dashboard/css/style.css" rel="stylesheet">
    <!-- InPage styles -->
    <style>
        .login-background {
            background: url("<?=STATIC_ROOT; ?>/dashboard/images/profile/cover.jpg");
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="h-100 login-background">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Login to your portal</h4>
                                    <form method="post">
                                        <?php if (isset($_SESSION['message'])): ?>
                                        <h6 class="col-12 my-3 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                                            <?=$_SESSION['message']; ?>
                                        </h6>
                                        <?php endif ?>
                                        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                                        <div class="form-group">
                                            <label><strong>Matriculation Number <span class="text-danger">*</span></strong></label>
                                            <input type="text" name="matric_number" class="form-control" maxlength="15" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password <span class="text-danger">*</span></strong></label>
                                            <input type="password" name="password" class="form-control" maxlength="50" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember me</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me in</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Are you a staff? <a class="text-primary" href="<?=ROOT; ?>/staff/login">Sign in</a> here instead </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?=STATIC_ROOT; ?>/dashboard/vendor/global/global.min.js"></script>
	<script src="<?=STATIC_ROOT; ?>/dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/custom.min.js"></script>
    <script src="<?=STATIC_ROOT; ?>/dashboard/js/dlabnav-init.js"></script>

    <!-- InPage scripts -->

    <!-- Return only number keystrokes -->
    <script>
      // This functions only allows input fields to accept numbers
      function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
        // use  onkeypress="return onlyNumberKey(event)" on the input field
      }
    </script>
</body>

</html>