<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/styleLogin.css?<?= config_item('version') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/normalize.css?<?= config_item('version') ?>">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.css">
	<link href="<?= base_url(); ?>assets/css/toastr.css" rel="stylesheet" type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/toastr.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/address.js"></script>
	<title><?= $data['title']; ?></title>
</head>
<body>

	<div class="container" >
		<div id="contFormLogin" class="row justify-content-center align-items-center">
			<form id="formLogin" method="POST" class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6 p-5 rounded">
				<div class="row">
					<div class="col-12 text-center">
						<h1 class="wow bounceInRight">
							Bienvenido
						</h1>
					</div>
					<div class="col-12 col-md-4 mb-md-2">
						<label class="wow bounceInRight">
							Correo:
						</label>
					</div>
					<div class="col-12 col-md-8 mb-md-2">
						<input type="email" name="email" id="email" class="form-control wow bounceInLeft" onkeyup="validarEmail(this.value)">
					</div>
					<div class="col-12 col-md-4">
						<label class="wow bounceInRight">
							Contraseña
						</label>
					</div>
					<div class="col-12 col-md-8">
						<input type="password" name="pass" id="pass" class="form-control wow bounceInLeft" >
					</div>
					<div class="col-12 mt-3 text-right">
						<button type="button" id="btnLogin" class="btn btn-primary wow bounceInRight">Iniciar sesión</button>
					</div>
					<div class="col-12 mt-3 text-right">
						<label id="errorForm"></label>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="loading" style="display: none;">
		<img src="<?= base_url(); ?>assets/img/loading.gif" class="popupLoading">
	</div>

	<script type="text/javascript" src="<?= base_url(); ?>assets/js/login.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/popup.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/config.js"></script>
	<input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<script src="<?= base_url(); ?>assets/js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
</body>
</html>