<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SIS</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/style.css">
</head>
<body>

<div class="container info-estudiante">
		<header>
			
			<h1 class="text-center">SISTEMA DE INFORMACION ESTUDIANTIL</h1>
			<img src="<?php echo base_url(); ?>assets/images/logo.png" alt="IESTP SAN MARCOS" class="img-responsive">
		</header>
		<section>
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-xs-12">
					<h4 class="text-center">Buscar información del estudiante</h4>
					<div class="form-group">
						<form action="<?php echo base_url();?>welcome/getInfoEstudiante" method="POST" id="form-search-estudiante">
							<div class="input-group">
						      	<input type="text" name="dni" class="form-control" placeholder="Introduzca DNI " required="required" maxlength="8">
						      	<span class="input-group-btn">
						        	<button class="btn btn-warning" type="submit">Buscar</button>
						      	</span>
						    </div><!-- /input-group -->
					    </form>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-12 col-xs-12">
					<div style="display: none;" id="infoEstudiante">
						<br>
						<p class="text-center"><strong>INFORMACION DEL ESTUDIANTE</strong></p>
						<div class="table-responsive">
							<table class="table table-bordered" style="background: #d2d6de;">
								<tbody>
									<tr>
										<th>NOMBRES:</th>
										<td id="nombres"></td>
									</tr>
									<tr>
										<th>APELLIDOS:</th>
										<td id="apellidos"></td>
									</tr>
									<tr>
										<th>DNI:</th>
										<td id="dni"></td>
									</tr>
									<tr>
										<th>SEMESTRE:</th>
										<td id="semestre"></td>
									</tr>
									<tr>
										<th>PROGRAMA DE ESTUDIO:</th>
										<td id="programa_estudio"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" id="tbmodulos" style="background: #d2d6de;">
								<thead>
									<tr>
										<th colspan="2" class="text-center">INFORMACION DE MODULOS</th>
										<th colspan="4" class="text-center">INFORMACION DEL CERTIFICADO</th>
									</tr>
									<tr>
										<th>MODULO</th>
										<th>PRACTICA</th>
										<th>FECHA DE EMISION</th>
										<th>FECHA DE ENTREGA</th>
										<th>N° DE REGISTRO</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		
	
</div>
<div class="modal modal-default fade" id="modal-informe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Información de Practica Modular</h4>
            </div>

          	<div class="modal-body">
             
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-danger btn-cancelar-practica pull-left" data-dismiss="modal">Cancelar</button>
          	</div>
         
        </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
</div>


<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.js"></script>

<script>
	var base_url = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>assets/frontend/script.js"></script>

</body>
</html>