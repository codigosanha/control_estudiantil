<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISGEB | Login</title>
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
  	<h2 class="text-center title-login">SISTEMA BIBLIOTECARIO</h2>
	<p class="login-box-msg">Introduzca sus datos para iniciar sesion</p>

	<form action="<?php echo base_url() ?>auth/validar" method="post">
	  <div class="form-group has-feedback">
		<input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	  </div>
	  <div class="form-group has-feedback">
		<input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	  </div>
	  <div class="form-group">
		<button type="submit" class="btn btn-primary btn-block btn-flat" id="btn-login">Acceder</button>
	  </div>
	  	<?php 
	  		$displayErrorLogin = "none";
	  		$messageErrorLogin = "";
	  		if ($this->session->flashdata("error")){
	  			$displayErrorLogin = "block";
	  			$messageErrorLogin =$this->session->flashdata("error");
	  		}
	  	?>
		<div class="alert alert-danger alert-dismissable text-justify" style="display: <?php echo $displayErrorLogin;?>">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<p class="messageErrorLogin"><?php echo $messageErrorLogin;?></p>
	  	</div>
	  

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

<script>
	$(document).ready(function(){
		var limit_attempt = 5;
		var attempts = "<?php echo $this->session->userdata('attempts');?>";
		if (attempts == limit_attempt) {
			var add_time_last_attempt = "<?php echo $this->session->userdata('add_time_last_attempt');?>";
			$("#email").attr("disabled","disabled");
			$("#password").attr("disabled","disabled");
			$("#btn-login").attr("disabled","disabled");
			$(".alert").show();
			$(".alert").append("<p>Ha llegado al limite de intentos...Vuelva a intentarlo en "+messageTime(add_time_last_attempt)+"<p>");
		}
		if (attempts > 0 && attempts < limit_attempt) {
			$(".alert").show();
			$(".alert").append("<p>Le quedan "+(limit_attempt-Number(attempts))+" intentos<p>");
		}

		function messageTime(add_time_last_attempt){
			var date = new Date();
  			var time = Math.floor(date.getTime()/1000);
  			diff = add_time_last_attempt - time;
  			if (diff > 60) {
  				minutes = Math.ceil(diff / 60);
  				return minutes+ " minutos";
  			} else{
  				return diff+" segundos";
  			}
		}
	});
	
</script>


</body>
</html>
