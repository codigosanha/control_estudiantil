<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Estudiantil | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/login.css">

</head>
<body>
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
  	<h2 class="text-center title-login">SISTEMA DE CONTROL ESTUDIANTIL</h2>
	<p class="login-box-msg">Introduzca sus datos para iniciar sesion</p>

	<form action="<?php echo base_url() ?>auth/validar" method="post">
	  <div class="form-group has-feedback">
		<input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	  </div>
	  <div class="form-group has-feedback">
		<input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	  </div>
	  <div class="form-group">
		<button type="submit" class="btn btn-primary btn-block btn-flat" id="btn-login">Acceder</button>
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
