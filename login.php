<?php

session_start();
if (isset($_SESSION["et_status"])) {
    header("location:homepage");
}
?>
<html lang="en"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EyeTranspo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="assets/sweetalert/sweetalert.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo.png">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-center p-5">
                <div class="brand-logo">
                  <img src="assets/images/logo-banner.png" style="width: 100%;">
                </div>
                <br>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form method="POST" id="frm_login" class="pt-3">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="input[username]" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg"
										placeholder="Password" name="input[password]" autocomplete="off">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-semibold auth-form-btn">SIGN IN</button>
                  </div>
                  <!-- <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
		<script src="assets/sweetalert/sweetalert.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->

    <script type="text/javascript">
			$("#frm_login").submit(function(e) {
				e.preventDefault();
				var url = "./controllers/sql.php?c=LoginUser&q=login";
				var data = $("#frm_login").serialize();
				$("#btn_submit").prop('disabled', true);
				$("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Verifying ...");
				$.ajax({
					type: "POST",
					url: url,
					data: data,
					success: function(data) {
						var json = JSON.parse(data);
						
						if (json.data != 0) {
							swal("Success!", "All is cool! Signed in successfully", "success");
							window.location = "homepage";
						} else {
							swal("Login Failed!", 'Your username or password is incorrect. Please try again.', "warning");
						}

						// var json = JSON.parse(data);
						console.log(json.data);

					}
				});


			});
		</script>
  
  </body>
</html>