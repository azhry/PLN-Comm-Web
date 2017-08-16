<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login | PLN-Comm</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/css/material-kit.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/dataTables.material.css">

    <!--   Core JS Files   -->
	<script src="<?= base_url() ?>/assets/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?= base_url() ?>/assets/js/jquery.dataTables.js">
	</script>
	<script type="text/javascript" language="javascript" src="<?= base_url() ?>/assets/js/dataTables.material.js">
	</script>
</head>

<body class="signup-page">
	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<a class="navbar-brand" href="<?= base_url() ?>">PLN-Comm</a>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('<?= base_url('img/background.jpg') ?>'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<?= form_open('login') ?>
								<div class="header header-info text-center">
									<h4>Masuk ke PLN-Comm</h4>
									<div class="social-line" style="margin-left: 5%; margin-right: 5%;">
										Gunakan email yang telah didaftarkan pada PLN-Comm untuk login
									</div>
								</div>
								<p class="text-divider"></p>
								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input type="text" name="email" class="form-control" placeholder="Email...">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input name="password" type="password" placeholder="Password..." class="form-control" />
									</div>

								</div>
								<div class="footer text-center">
									<input type="submit" name="login" class="btn btn-info" value="Login">
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>

			<footer class="footer">
		        <div class="container">
		            <nav class="pull-left">
						<ul>
							<li>
								<a href="<?= base_url() ?>">
									PLN-Comm
								</a>
							</li>
						</ul>
		            </nav>
		            <div class="copyright pull-right">
		                &copy; 2017, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Peserta Magang PLN, Azhary Arliansyah dan Ryan Fadholi</a>
		            </div>
		        </div>
		    </footer>

		</div>

    </div>


</body>

	<!--   Core JS Files   -->
	<script src="<?= base_url() ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>/assets/js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="<?= base_url() ?>/assets/js/nouislider.min.js" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="<?= base_url() ?>/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="<?= base_url() ?>/assets/js/material-kit.js" type="text/javascript"></script>

</html>

