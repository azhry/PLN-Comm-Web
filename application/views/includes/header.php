<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?= $title ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
	<script src="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.0.4/material.js"></script>
</head>

<body class="main">

<!-- Navbar will come here -->
					<nav class="navbar navbar-info">
						<div class="container">
							<div class="navbar-header">
								<a class="navbar-brand" href="#pablo"><?= isset($nav_title) ? $nav_title : 'PLN-Comm' ?></a>
							</div>
							<ul class="nav navbar-nav navbar-right" id="example-navbar-info">
								<?php  
									$is_logged_in = $this->session->userdata('user_id');
									if (isset($is_logged_in)):
								?>
								<li>
			    					<a href="<?= base_url('user/logout') ?>">
			    						Logout <i class="material-icons">exit_to_app</i>
			    					</a>
			    				</li>
			    				<?php endif; ?>
			        		</ul>
						</div>
					</nav>
<!-- end navbar -->