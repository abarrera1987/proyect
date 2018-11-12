<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css?<?= config_item('version') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/normalize.css?<?= config_item('version') ?>">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.css">
	<link href="<?= base_url(); ?>assets/css/toastr.css" rel="stylesheet" type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/toastr.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/address.js"></script>
	<title><?= $data['title']; ?></title>
</head>
<body>
	<div class="content">
		<!-- Image and text -->
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<!-- <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
				<label class="text-white">
					Bienvenido <strong><?= $data['user']->name; ?></strong>
				</label>
			</a>
			<form class="form-inline">
				<a href="<?= base_url() ?>logOut">
					<label class="text-white" id="btnLogout">
						<strong>
							Salir
						</strong>
					</label>
				</a>				
			</form>
		</nav>