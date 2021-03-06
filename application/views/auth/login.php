<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/login.css">
  <style>
  	img{
  		width: 120px;
  		height: 120px;
  		margin: 0 auto;
  	}
  	.login-box{
  		margin: 3% auto;
  	}
  	h2{
		color: #FFF;
		font-weight: bold;
  	}
  </style>

</head>
<body>
	<h2 class="text-center">SISTEMA DE INFORMACION ESTUDIANTIL</h2>
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  	<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="IESTP SAN MARCOS" class="img-responsive">
	<p class="login-box-msg">Introduzca sus datos para iniciar sesión</p>

	<form action="<?php echo base_url() ?>auth/validar" method="post">
	  <div class="form-group has-feedback">
		<input type="text" class="form-control input-lg" placeholder="Username" name="username" id="username" required autocomplete="off">
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	  </div>
	  <div class="form-group has-feedback">
		<input type="password" class="form-control input-lg" placeholder="Password" name="password" id="password" required autocomplete="off">
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	  </div>
	  <div class="form-group">
		<button type="submit" class="btn btn-warning btn-lg btn-block btn-flat" id="btn-login">Acceder</button>
	  </div>
	  	

	  	<?php if ($this->session->flashdata("error")): ?>
	  		<div class="alert alert-danger alert-dismissable text-justify">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<p><?php echo $this->session->flashdata("error");?></p>
		  	</div>
	  	<?php endif ?>
		<!-- /.col -->
	</form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/jquery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
