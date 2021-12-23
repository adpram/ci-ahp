<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SPK Saham AHP</title>
	<link href="<?= base_url('assets/css/bootstrap4.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/swiper.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/magnific-popup.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
		<div class="container">

			<!-- Text Logo - Use this if you don't have a graphic logo -->
			<!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

			<!-- Image Logo -->
			<a class="navbar-brand logo-image" href="<?= base_url('main') ?>"><img
					src="<?= base_url('assets/logo.png') ?>" alt="alternative"></a>

			<!-- Mobile Menu Toggle Button -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
				aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-awesome fas fa-bars"></span>
				<span class="navbar-toggler-awesome fas fa-times"></span>
			</button>
			<!-- end of mobile menu toggle button -->
		</div> <!-- end of container -->
	</nav> <!-- end of navbar -->
	<!-- end of navigation -->

	<!-- Header -->
	<header id="header" class="ex-2-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Sign Up Form -->
					<div class="form-container">
                        <?php if (!empty($message)) { ?>
                            <div id="error-message">
                                <h6 style="color:red"><?= $message ?></h6>
                            </div>
                        <?php } ?>
						<h1 style="color:#5f4dee;">Login</h1>
                        <div class="confirm-div"></div>
						<form id="" data-toggle="validator" data-focus="false" method="POST"
							action="<?php echo base_url('login/proses'); ?>">
							<div class="form-group">
								<input type="text" class="form-control-input" name="username" id="lusername" required>
								<label class="label-control" for="lusername">Username</label>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control-input" name="password" id="lpassword" required>
								<label class="label-control" for="lpassword">Password</label>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control-submit-button">LOGIN</button>
							</div>
							<div class="form-message">
								<div id="lmsgSubmit" class="h3 text-center hidden"></div>
							</div>
						</form>
					</div> <!-- end of form container -->
					<!-- end of sign up form -->

				</div> <!-- end of col -->
			</div> <!-- end of row -->
		</div> <!-- end of container -->
	</header> <!-- end of ex-header -->
	<!-- end of header -->

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/swiper.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/jquery.magnific-popup.js') ?>"></script>
	<script src="<?= base_url('assets/js/validator.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <script>
        $(document).ready(function(){
            if($("#error-message").is(':visible')){
                setTimeout(function() { 
                    $("#error-message").fadeOut('slow');
                }, 2000);
            }
        });
    </script>
</body>

</html>